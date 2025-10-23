<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CallLog;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LOBDashboardController extends Controller
{
    public function index(){
        $userId = Auth::id();
        $userLob = Auth::user()->lob;
        
        // 1. Total Profit/Loss Metrics
        $profitData = DB::table('travel_bookings')
            ->join('users', 'travel_bookings.user_id', '=', 'users.id')
            ->where('users.lob', $userLob)
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->selectRaw('
                SUM(gross_value) as gross_mco,
                SUM(net_value) as net_mco,
                COUNT(*) as total_bookings,
                SUM(CASE WHEN payment_status_id = 3 THEN net_value ELSE 0 END) as refund_amount,
                SUM(CASE WHEN payment_status_id = 4 OR booking_status_id = 22 THEN net_value ELSE 0 END) as chargeback_amount
            ')
            ->first();
            
        $totalCalls = CallLog::whereHas('user', function($q) use ($userLob) {
            $q->where('lob', $userLob);
        })->count();
        
        $refundPercentage = $profitData->total_bookings > 0 ? 
            round((DB::table('travel_bookings')
                ->join('users', 'travel_bookings.user_id', '=', 'users.id')
                ->where('users.lob', $userLob)
                ->where('payment_status_id', 3)->count() / $profitData->total_bookings) * 100, 2) : 0;
                
        $chargebackPercentage = $profitData->total_bookings > 0 ? 
            round((DB::table('travel_bookings')
                ->join('users', 'travel_bookings.user_id', '=', 'users.id')
                ->where('users.lob', $userLob)
                ->where(function($q) {
                    $q->where('payment_status_id', 4)->orWhere('booking_status_id', 22);
                })->count() / $profitData->total_bookings) * 100, 2) : 0;
                
                
        $rpc = $totalCalls > 0 ? round($profitData->net_mco / $totalCalls, 2) : 0;
        $conversion = $totalCalls > 0 ? round(($profitData->total_bookings / $totalCalls) * 100, 2) : 0;
        
        // 2. Booking Reports - Current Month Daily Data (1-30)
        $currentMonth = now()->format('Y-m');
        $daysInMonth = now()->daysInMonth;
        
        $bookingData = DB::table('travel_bookings as b')
            ->join('users as u', 'b.user_id', '=', 'u.id')
            ->where('u.lob', $userLob)
            ->whereIn('b.booking_status_id', [19, 20])
            ->whereRaw('DATE_FORMAT(b.created_at, "%Y-%m") = ?', [$currentMonth])
            ->selectRaw('
                DAY(b.created_at) as day,
                COUNT(*) as total_bookings,
                SUM(CASE WHEN b.payment_status_id = 3 THEN 1 ELSE 0 END) as refunded_bookings,
                SUM(CASE WHEN b.payment_status_id = 4 OR b.booking_status_id = 22 THEN 1 ELSE 0 END) as chargeback_bookings,
                SUM(b.net_value) as net_mco
            ')
            ->groupBy('day')
            ->get()
            ->keyBy('day');
            
        $bookingReportsDaily = collect(range(1, $daysInMonth))->map(function($day) use ($bookingData) {
            return (object)[
                'day' => $day,
                'net_mco' => $bookingData->get($day)->net_mco ?? 0,
                'refunded_bookings' => $bookingData->get($day)->refunded_bookings ?? 0,
                'chargeback_bookings' => $bookingData->get($day)->chargeback_bookings ?? 0
            ];
        });
            
        $bookingReports = [
            'total_bookings' => $profitData->total_bookings,
            'total_calls' => $totalCalls,
            'refunded_bookings' => DB::table('travel_bookings')
                ->join('users', 'travel_bookings.user_id', '=', 'users.id')
                ->where('users.lob', $userLob)
                ->where('payment_status_id', 3)->count(),
            'chargeback_bookings' => DB::table('travel_bookings')
                ->join('users', 'travel_bookings.user_id', '=', 'users.id')
                ->where('users.lob', $userLob)
                ->where(function($q) {
                    $q->where('payment_status_id', 4)->orWhere('booking_status_id', 22);
                })->count(),
            'refund_percentage' => $refundPercentage,
            'chargeback_percentage' => $chargebackPercentage,
            'actual_conversion' => $conversion,
            'rpc' => $rpc,
            'daily_data' => $bookingReportsDaily
        ];
        
        // 3. Campaign Data
        $campaignData = DB::table('call_logs')
            ->join('users', 'call_logs.user_id', '=', 'users.id')
            ->join('campaigns', 'call_logs.campaign_id', '=', 'campaigns.id')
            ->leftJoin('travel_bookings', 'call_logs.user_id', '=', 'travel_bookings.user_id')
            ->where('users.lob', $userLob)
            ->groupBy('campaigns.id', 'campaigns.name')
            ->selectRaw('
                campaigns.name,
                COUNT(call_logs.id) as total_calls,
                COUNT(CASE WHEN travel_bookings.id IS NOT NULL THEN 1 END) as bookings_converted,
                ROUND((COUNT(CASE WHEN travel_bookings.id IS NOT NULL THEN 1 END) / COUNT(call_logs.id)) * 100, 2) as conversion_percentage,
                SUM(COALESCE(travel_bookings.gross_value, 0)) as revenue,
                SUM(COALESCE(travel_bookings.net_value, 0)) as net_profit
            ')
            ->get();
            
        // 4. Product Based Data
        $productData = [];
        $products = ['Flight', 'Hotel', 'Cruise', 'Car', 'Train'];
        
        foreach($products as $product) {
            $data = DB::table('travel_bookings')
                ->join('travel_booking_types', 'travel_bookings.id', '=', 'travel_booking_types.booking_id')
                ->join('users', 'travel_bookings.user_id', '=', 'users.id')
                ->where('travel_booking_types.type', $product)
                ->where('users.lob', $userLob)
                ->whereIn('travel_bookings.booking_status_id', [19, 20])
                ->selectRaw('
                    COUNT(*) as bookings,
                    SUM(gross_value) as gross_revenue,
                    SUM(net_value) as net_revenue
                ')
                ->first();
                
            $productData[$product] = $data;
        }
        
        // Call counts for backward compatibility
        $flight = CallLog::whereHas('user', function($q) use ($userLob) {
            $q->where('lob', $userLob);
        })->where('chkflight', 1)->count();
        
        $hotel = CallLog::whereHas('user', function($q) use ($userLob) {
            $q->where('lob', $userLob);
        })->where('chkhotel', 1)->count();
        
        $cruise = CallLog::whereHas('user', function($q) use ($userLob) {
            $q->where('lob', $userLob);
        })->where('chkcruise', 1)->count();
        
        $car = CallLog::whereHas('user', function($q) use ($userLob) {
            $q->where('lob', $userLob);
        })->where('chkcar', 1)->count();
        
        // Today's scores by booking type (net_value) - filtered by LOB
        $flight_score = DB::table('travel_bookings')
            ->join('travel_booking_types', 'travel_bookings.id', '=', 'travel_booking_types.booking_id')
            ->join('users', 'travel_bookings.user_id', '=', 'users.id')
            ->where('travel_booking_types.type', 'Flight')
            ->where('users.lob', $userLob)
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->whereDate('travel_bookings.created_at', date('Y-m-d'))
            ->sum('travel_bookings.net_value') ?? 0;
            
        $hotel_score = DB::table('travel_bookings')
            ->join('travel_booking_types', 'travel_bookings.id', '=', 'travel_booking_types.booking_id')
            ->join('users', 'travel_bookings.user_id', '=', 'users.id')
            ->where('travel_booking_types.type', 'Hotel')
            ->where('users.lob', $userLob)
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->whereDate('travel_bookings.created_at', date('Y-m-d'))
            ->sum('travel_bookings.net_value') ?? 0;
            
        $cruise_score = DB::table('travel_bookings')
            ->join('travel_booking_types', 'travel_bookings.id', '=', 'travel_booking_types.booking_id')
            ->join('users', 'travel_bookings.user_id', '=', 'users.id')
            ->where('travel_booking_types.type', 'Cruise')
            ->where('users.lob', $userLob)
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->whereDate('travel_bookings.created_at', date('Y-m-d'))
            ->sum('travel_bookings.net_value') ?? 0;
            
        $car_score = DB::table('travel_bookings')
            ->join('travel_booking_types', 'travel_bookings.id', '=', 'travel_booking_types.booking_id')
            ->join('users', 'travel_bookings.user_id', '=', 'users.id')
            ->where('travel_booking_types.type', 'Car')
            ->where('users.lob', $userLob)
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->whereDate('travel_bookings.created_at', date('Y-m-d'))
            ->sum('travel_bookings.net_value') ?? 0;
            
        $train_score = DB::table('travel_bookings')
            ->join('travel_booking_types', 'travel_bookings.id', '=', 'travel_booking_types.booking_id')
            ->join('users', 'travel_bookings.user_id', '=', 'users.id')
            ->where('travel_booking_types.type', 'Train')
            ->where('users.lob', $userLob)
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->whereDate('travel_bookings.created_at', date('Y-m-d'))
            ->sum('travel_bookings.net_value') ?? 0;
            
        // Today's total net_value score - filtered by LOB
        $today_score = DB::table('travel_bookings')
            ->join('users', 'travel_bookings.user_id', '=', 'users.id')
            ->where('users.lob', $userLob)
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->whereDate('travel_bookings.created_at', date('Y-m-d'))
            ->sum('travel_bookings.net_value') ?? 0;
            
        $weekly_score = DB::table('travel_bookings')
            ->join('users', 'travel_bookings.user_id', '=', 'users.id')
            ->where('users.lob', $userLob)
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->whereBetween('travel_bookings.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('travel_bookings.net_value') ?? 0;
            
        $monthly_score = DB::table('travel_bookings')
            ->join('users', 'travel_bookings.user_id', '=', 'users.id')
            ->where('users.lob', $userLob)
            ->whereIn('travel_bookings.booking_status_id', [19, 20])
            ->whereYear('travel_bookings.created_at', date('Y'))
            ->whereMonth('travel_bookings.created_at', date('m'))
            ->sum('travel_bookings.net_value') ?? 0;

        return view('web.lob-dashboard', compact(
            'flight', 'hotel', 'cruise', 'car',
            'today_score','weekly_score','monthly_score',
            'flight_score','hotel_score','cruise_score','car_score','train_score',
            'profitData', 'bookingReports', 'campaignData', 'productData',
            'totalCalls', 'rpc', 'conversion', 'refundPercentage', 'chargebackPercentage', 'bookingReportsDaily'
        ));
    }
    
    
    public function profitLoss(Request $request)
    {
        $userLob = Auth::user()->lob;
        
        $query = DB::table('travel_bookings as b')
            ->leftJoin('call_logs as cl', 'b.user_id', '=', 'cl.user_id')
            ->leftJoin('users as u', 'b.user_id', '=', 'u.id')
            ->where('u.lob', $userLob)
            ->whereIn('b.booking_status_id', [19, 20])
            ->select(
                DB::raw('DATE(b.created_at) as date'),
                DB::raw('SUM(b.gross_value) as gross_mco'),
                DB::raw('SUM(b.merchant_fee) as merchant_fee'),
                DB::raw('CASE 
                    WHEN b.selected_company = 1 THEN "FlyDreamz"
                    WHEN b.selected_company = 2 THEN "FareTicketsUS"
                    WHEN b.selected_company = 3 THEN "FareTicketsLLC"
                    WHEN b.selected_company = 4 THEN "CruiseLineService"
                    ELSE "Unknown"
                END as company_name'),
                'b.selected_company',
                DB::raw('SUM(b.net_value) as insurance_fee'),
                DB::raw('0 as fxl_insurance_fee'),
                DB::raw('SUM(b.net_value) as net_mco'),
                DB::raw('SUM(CASE WHEN b.payment_status_id = 3 THEN b.net_value ELSE 0 END) as refund'),
                DB::raw('SUM(CASE WHEN b.payment_status_id = 4 THEN b.net_value ELSE 0 END) as chargeback'),
                DB::raw('COUNT(DISTINCT cl.id) as number_of_calls'),
                DB::raw('COUNT(DISTINCT cl.id) * 0.05 as calls_cost'),
                DB::raw('0 as total_salary'),
                DB::raw('0 as monthly_incentive'),
                DB::raw('0 as transport_cost')
            );

        if ($request->company_card) {
            $query->where('b.selected_company', $request->company_card);
        }

        if ($request->start_date) {
            $query->whereDate('b.created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('b.created_at', '<=', $request->end_date);
        }

        $profitLossData = $query->groupBy('date', 'b.selected_company')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function($item) {
                $totalBookings = DB::table('travel_bookings')
                    ->whereDate('created_at', $item->date)
                    ->where('selected_company', $item->selected_company)
                    ->count();
                
                $item->refund_percentage = $item->gross_mco > 0 ? ($item->refund / $item->gross_mco) * 100 : 0;
                $item->chargeback_percentage = $item->gross_mco > 0 ? ($item->chargeback / $item->gross_mco) * 100 : 0;
                $item->net_profit = $item->net_mco - $item->refund - $item->chargeback - $item->calls_cost - $item->transport_cost;
                $item->rpc = $item->number_of_calls > 0 ? $item->net_mco / $item->number_of_calls : 0;
                $item->conversion = $totalBookings > 0 ? ($item->number_of_calls / $totalBookings) * 100 : 0;
                
                return $item;
            });

        return view('web.lob-profit-loss', compact('profitLossData'));
    }
    
    public function bookingReports(Request $request)
    {
        $userLob = Auth::user()->lob;
        
        $query = DB::table('travel_bookings as b')
            ->leftJoin('call_logs as cl', 'b.user_id', '=', 'cl.user_id')
            ->leftJoin('users as u', 'b.user_id', '=', 'u.id')
            ->where('u.lob', $userLob)
            ->whereIn('b.booking_status_id', [19, 20])
            ->select(
                DB::raw('DATE(b.created_at) as date'),
                DB::raw('COUNT(DISTINCT b.id) as total_bookings'),
                DB::raw('COUNT(DISTINCT cl.id) as total_calls'),
                DB::raw('COUNT(CASE WHEN b.payment_status_id = 3 THEN 1 END) as refunded_bookings'),
                DB::raw('COUNT(CASE WHEN b.payment_status_id = 4 THEN 1 END) as chargeback_bookings'),
                DB::raw('SUM(b.net_value) as total_revenue')
            );

        if ($request->company_card) {
            $query->where('b.selected_company', $request->company_card);
        }

        if ($request->start_date) {
            $query->whereDate('b.created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('b.created_at', '<=', $request->end_date);
        }

        $bookingReportsData = $query->groupBy('date')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function($item) {
                $item->refunded_percentage = $item->total_bookings > 0 ? ($item->refunded_bookings / $item->total_bookings) * 100 : 0;
                $item->chargeback_percentage = $item->total_bookings > 0 ? ($item->chargeback_bookings / $item->total_bookings) * 100 : 0;
                $item->actual_conversion = $item->total_calls > 0 ? ($item->total_bookings / $item->total_calls) * 100 : 0;
                $item->rpc = $item->total_calls > 0 ? $item->total_revenue / $item->total_calls : 0;
                
                return $item;
            });

        return view('web.lob-booking-reports', compact('bookingReportsData'));
    }
    
    public function campaigns(Request $request)
    {
        $userLob = Auth::user()->lob;
        
        $campaigns = DB::table('campaigns')->get();
        
        $query = DB::table('call_logs as cl')
            ->join('users as u', 'cl.user_id', '=', 'u.id')
            ->join('campaigns as c', 'cl.campaign_id', '=', 'c.id')
            ->leftJoin('travel_bookings as b', function($join) {
                $join->on('cl.user_id', '=', 'b.user_id')
                     ->whereIn('b.booking_status_id', [19, 20]);
            })
            ->where('u.lob', $userLob)
            ->select(
                'c.name',
                DB::raw('COUNT(DISTINCT cl.id) as total_calls'),
                DB::raw('COUNT(DISTINCT b.id) as bookings_converted'),
                DB::raw('SUM(COALESCE(b.gross_value, 0)) as revenue'),
                DB::raw('SUM(COALESCE(b.net_value, 0)) as net_profit')
            );

        if ($request->campaign_name) {
            $query->where('c.id', $request->campaign_name);
        }

        if ($request->start_date) {
            $query->whereDate('cl.created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('cl.created_at', '<=', $request->end_date);
        }

        $campaignData = $query->groupBy('c.id', 'c.name')
            ->orderBy('total_calls', 'desc')
            ->get()
            ->map(function($item) {
                $item->conversion_percentage = $item->total_calls > 0 ? ($item->bookings_converted / $item->total_calls) * 100 : 0;
                return $item;
            });

        return view('web.lob-campaigns', compact('campaignData', 'campaigns'));
    }
    
    public function products(Request $request)
    {
        $userLob = Auth::user()->lob;
        $products = ['Flight', 'Car', 'Train', 'Cruise', 'Hotel'];
        
        $productData = collect();
        
        foreach($products as $product) {
            if ($request->product_type && $request->product_type !== $product) {
                continue;
            }
            
            $query = DB::table('travel_bookings as b')
                ->join('travel_booking_types as bt', 'b.id', '=', 'bt.booking_id')
                ->join('users as u', 'b.user_id', '=', 'u.id')
                ->leftJoin('call_logs as cl', 'b.user_id', '=', 'cl.user_id')
                ->where('bt.type', $product)
                ->where('u.lob', $userLob)
                ->whereIn('b.booking_status_id', [19, 20]);
                
            if ($request->start_date) {
                $query->whereDate('b.created_at', '>=', $request->start_date);
            }
            
            if ($request->end_date) {
                $query->whereDate('b.created_at', '<=', $request->end_date);
            }
            
            $data = $query->selectRaw('
                COUNT(DISTINCT b.id) as total_bookings,
                SUM(b.gross_value) as gross_revenue,
                SUM(b.net_value) as net_revenue,
                COUNT(DISTINCT cl.id) as total_calls
            ')->first();
            
            $conversion_rate = $data->total_calls > 0 ? ($data->total_bookings / $data->total_calls) * 100 : 0;
            
            $productData->push((object)[
                'product_type' => $product,
                'total_bookings' => $data->total_bookings ?? 0,
                'gross_revenue' => $data->gross_revenue ?? 0,
                'net_revenue' => $data->net_revenue ?? 0,
                'total_calls' => $data->total_calls ?? 0,
                'conversion_rate' => $conversion_rate
            ]);
        }
        
        return view('web.lob-products', compact('productData'));
    }
    
    public function exportProfitLoss(Request $request)
    {
        $userLob = Auth::user()->lob;
        
        $query = DB::table('travel_bookings as b')
            ->leftJoin('call_logs as cl', 'b.user_id', '=', 'cl.user_id')
            ->leftJoin('users as u', 'b.user_id', '=', 'u.id')
            ->where('u.lob', $userLob)
            ->whereIn('b.booking_status_id', [19, 20])
            ->select(
                DB::raw('DATE(b.created_at) as date'),
                DB::raw('SUM(b.gross_value) as gross_mco'),
                DB::raw('SUM(b.merchant_fee) as merchant_fee'),
                DB::raw('CASE 
                    WHEN b.selected_company = 1 THEN "FlyDreamz"
                    WHEN b.selected_company = 2 THEN "FareTicketsUS"
                    WHEN b.selected_company = 3 THEN "FareTicketsLLC"
                    WHEN b.selected_company = 4 THEN "CruiseLineService"
                    ELSE "Unknown"
                END as company_name'),
                'b.selected_company',
                DB::raw('SUM(b.net_value) as insurance_fee'),
                DB::raw('0 as fxl_insurance_fee'),
                DB::raw('SUM(b.net_value) as net_mco'),
                DB::raw('SUM(CASE WHEN b.payment_status_id = 3 THEN b.net_value ELSE 0 END) as refund'),
                DB::raw('SUM(CASE WHEN b.payment_status_id = 4 THEN b.net_value ELSE 0 END) as chargeback'),
                DB::raw('COUNT(DISTINCT cl.id) as number_of_calls'),
                DB::raw('COUNT(DISTINCT cl.id) * 0.05 as calls_cost'),
                DB::raw('0 as total_salary'),
                DB::raw('SUM(b.daily_incentive) as daily_incentive'),
                DB::raw('SUM(b.monthly_incentive) as monthly_incentive'),
                DB::raw('SUM(u.transport_allowance / 30) as transport_cost')
            );

        if ($request->company_card) {
            $query->where('b.selected_company', $request->company_card);
        }

        if ($request->start_date) {
            $query->whereDate('b.created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('b.created_at', '<=', $request->end_date);
        }

        $data = $query->groupBy('date', 'b.selected_company')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function($item) {
                $totalBookings = DB::table('travel_bookings')
                    ->whereDate('created_at', $item->date)
                    ->where('selected_company', $item->selected_company)
                    ->count();
                
                $item->refund_percentage = $item->gross_mco > 0 ? ($item->refund / $item->gross_mco) * 100 : 0;
                $item->chargeback_percentage = $item->gross_mco > 0 ? ($item->chargeback / $item->gross_mco) * 100 : 0;
                $item->net_profit = $item->net_mco - $item->refund - $item->chargeback - $item->calls_cost - $item->transport_cost;
                $item->rpc = $item->number_of_calls > 0 ? $item->net_mco / $item->number_of_calls : 0;
                $item->conversion = $totalBookings > 0 ? ($item->number_of_calls / $totalBookings) * 100 : 0;
                
                return $item;
            });

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="profit-loss-' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Date', 'Gross MCO', 'Merchant Fee', 'Company Card', 'Insurance Fee', 'FXL Insurance Fee', 'Net MCO', 'Refund', 'Refund%', 'Chargeback', 'Chargeback%', 'Number of Calls', 'Calls Cost', 'Total Salary', 'Daily Incentive', 'Monthly Incentive', 'Transport Cost', 'Net Profit', 'RPC', 'Conversion']);
            
            foreach ($data as $row) {
                fputcsv($file, [
                    $row->date,
                    number_format($row->gross_mco, 2),
                    number_format($row->merchant_fee, 2),
                    $row->company_name,
                    number_format($row->insurance_fee, 2),
                    number_format($row->fxl_insurance_fee, 2),
                    number_format($row->net_mco, 2),
                    number_format($row->refund, 2),
                    number_format($row->refund_percentage, 2) . '%',
                    number_format($row->chargeback, 2),
                    number_format($row->chargeback_percentage, 2) . '%',
                    $row->number_of_calls,
                    number_format($row->calls_cost, 2),
                    number_format($row->total_salary, 2),
                    0,
                    number_format($row->monthly_incentive, 2),
                    number_format($row->transport_cost, 2),
                    number_format($row->net_profit, 2),
                    number_format($row->rpc, 2),
                    number_format($row->conversion, 2) . '%'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    
    public function exportBookingReports(Request $request)
    {
        $userLob = Auth::user()->lob;
        
        $query = DB::table('travel_bookings as b')
            ->leftJoin('call_logs as cl', 'b.user_id', '=', 'cl.user_id')
            ->leftJoin('users as u', 'b.user_id', '=', 'u.id')
            ->where('u.lob', $userLob)
            ->whereIn('b.booking_status_id', [19, 20])
            ->select(
                DB::raw('DATE(b.created_at) as date'),
                DB::raw('COUNT(DISTINCT b.id) as total_bookings'),
                DB::raw('COUNT(DISTINCT cl.id) as total_calls'),
                DB::raw('COUNT(CASE WHEN b.payment_status_id = 3 THEN 1 END) as refunded_bookings'),
                DB::raw('COUNT(CASE WHEN b.payment_status_id = 4 THEN 1 END) as chargeback_bookings'),
                DB::raw('SUM(b.net_value) as total_revenue')
            );

        if ($request->company_card) {
            $query->where('b.selected_company', $request->company_card);
        }

        if ($request->start_date) {
            $query->whereDate('b.created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('b.created_at', '<=', $request->end_date);
        }

        $data = $query->groupBy('date')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function($item) {
                $item->refunded_percentage = $item->total_bookings > 0 ? ($item->refunded_bookings / $item->total_bookings) * 100 : 0;
                $item->chargeback_percentage = $item->total_bookings > 0 ? ($item->chargeback_bookings / $item->total_bookings) * 100 : 0;
                $item->actual_conversion = $item->total_calls > 0 ? ($item->total_bookings / $item->total_calls) * 100 : 0;
                $item->rpc = $item->total_calls > 0 ? $item->total_revenue / $item->total_calls : 0;
                
                return $item;
            });

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="booking-reports-' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Date', 'Total Bookings', 'Total No. Calls', 'No. Booking Refunded', 'No. Booking Refunded%', 'No. Booking Chargeback', 'No. Booking Chargeback%', 'Actual Conversion', 'RPC']);
            
            foreach ($data as $row) {
                fputcsv($file, [
                    $row->date,
                    $row->total_bookings,
                    $row->total_calls,
                    $row->refunded_bookings,
                    number_format($row->refunded_percentage, 2) . '%',
                    $row->chargeback_bookings,
                    number_format($row->chargeback_percentage, 2) . '%',
                    number_format($row->actual_conversion, 2) . '%',
                    number_format($row->rpc, 2)
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    
    public function exportCampaigns(Request $request)
    {
        $userLob = Auth::user()->lob;
        
        $campaigns = DB::table('campaigns')->get();
        
        $query = DB::table('call_logs as cl')
            ->join('users as u', 'cl.user_id', '=', 'u.id')
            ->join('campaigns as c', 'cl.campaign_id', '=', 'c.id')
            ->leftJoin('travel_bookings as b', function($join) {
                $join->on('cl.user_id', '=', 'b.user_id')
                     ->whereIn('b.booking_status_id', [19, 20]);
            })
            ->where('u.lob', $userLob)
            ->select(
                'c.name',
                DB::raw('COUNT(DISTINCT cl.id) as total_calls'),
                DB::raw('COUNT(DISTINCT b.id) as bookings_converted'),
                DB::raw('SUM(COALESCE(b.gross_value, 0)) as revenue'),
                DB::raw('SUM(COALESCE(b.net_value, 0)) as net_profit')
            );

        if ($request->campaign_name) {
            $query->where('c.id', $request->campaign_name);
        }

        if ($request->start_date) {
            $query->whereDate('cl.created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('cl.created_at', '<=', $request->end_date);
        }

        $data = $query->groupBy('c.id', 'c.name')
            ->orderBy('total_calls', 'desc')
            ->get()
            ->map(function($item) {
                $item->conversion_percentage = $item->total_calls > 0 ? ($item->bookings_converted / $item->total_calls) * 100 : 0;
                return $item;
            });

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="campaigns-' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Campaign Name', 'Total Calls', 'Booking Converted', 'Percentage Converted', 'Revenue', 'Net Profit']);
            
            foreach ($data as $row) {
                fputcsv($file, [
                    $row->name,
                    $row->total_calls,
                    $row->bookings_converted,
                    number_format($row->conversion_percentage, 2) . '%',
                    number_format($row->revenue, 2),
                    number_format($row->net_profit, 2)
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    
    public function exportProducts(Request $request)
    {
        $userLob = Auth::user()->lob;
        $products = ['Flight', 'Car', 'Train', 'Cruise', 'Hotel'];
        
        $productData = collect();
        
        foreach($products as $product) {
            if ($request->product_type && $request->product_type !== $product) {
                continue;
            }
            
            $query = DB::table('travel_bookings as b')
                ->join('travel_booking_types as bt', 'b.id', '=', 'bt.booking_id')
                ->join('users as u', 'b.user_id', '=', 'u.id')
                ->leftJoin('call_logs as cl', 'b.user_id', '=', 'cl.user_id')
                ->where('bt.type', $product)
                ->where('u.lob', $userLob)
                ->whereIn('b.booking_status_id', [19, 20]);
                
            if ($request->start_date) {
                $query->whereDate('b.created_at', '>=', $request->start_date);
            }
            
            if ($request->end_date) {
                $query->whereDate('b.created_at', '<=', $request->end_date);
            }
            
            $data = $query->selectRaw('
                COUNT(DISTINCT b.id) as total_bookings,
                SUM(b.gross_value) as gross_revenue,
                SUM(b.net_value) as net_revenue,
                COUNT(DISTINCT cl.id) as total_calls
            ')->first();
            
            $conversion_rate = $data->total_calls > 0 ? ($data->total_bookings / $data->total_calls) * 100 : 0;
            
            $productData->push((object)[
                'product_type' => $product,
                'total_bookings' => $data->total_bookings ?? 0,
                'gross_revenue' => $data->gross_revenue ?? 0,
                'net_revenue' => $data->net_revenue ?? 0,
                'total_calls' => $data->total_calls ?? 0,
                'conversion_rate' => $conversion_rate
            ]);
        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="products-' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($productData) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Product Type', 'Total Bookings', 'Gross Revenue', 'Net Revenue', 'Total Calls', 'Conversion Rate']);
            
            foreach ($productData as $row) {
                fputcsv($file, [
                    $row->product_type,
                    $row->total_bookings,
                    number_format($row->gross_revenue, 2),
                    number_format($row->net_revenue, 2),
                    $row->total_calls,
                    number_format($row->conversion_rate, 2) . '%'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}