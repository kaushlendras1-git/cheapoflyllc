<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{
    public function getPaymentStatusesByBooking(Request $request)
    {
        $request->validate([
            'booking_status_id' => 'required|integer',
            'department' => 'required|string',
            'role' => 'required|string'
        ]);

        $paymentStatusIds = DB::table('booking_payment_statuses')
            ->where('booking_status_id', $request->booking_status_id)
            ->where('department', $request->department)
            ->where('role', $request->role)
            ->pluck('payment_status_id')
            ->toArray();

        $paymentStatuses = PaymentStatus::whereIn('id', $paymentStatusIds)
            ->get()
            ->filter(function($status) use ($request) {
                $departments = is_array($status->departments) ? $status->departments : json_decode($status->departments ?? '[]', true);
                $roles = is_array($status->roles) ? $status->roles : json_decode($status->roles ?? '[]', true);
                
                return (empty($departments) || in_array($request->department, $departments)) && 
                       (empty($roles) || in_array($request->role, $roles));
            })
            ->values();

        return response()->json([
            'success' => true,
            'payment_statuses' => $paymentStatuses
        ]);
    }
}