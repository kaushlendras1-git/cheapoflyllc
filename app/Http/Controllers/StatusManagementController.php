<?php

namespace App\Http\Controllers;

use App\Models\BookingStatus;
use App\Models\PaymentStatus;
use App\Models\Department;
use App\Models\Role;
use App\Models\BookingPaymentStatus;
use App\Models\BookingStatusDependency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusManagementController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $bookingStatuses = BookingStatus::all();
        $paymentStatuses = PaymentStatus::all();
        $departments = Department::all();
        $roles = Role::all();
        
        $bookingPaymentMappings = BookingPaymentStatus::with(['bookingStatus', 'paymentStatus', 'departmentRelation', 'roleRelation'])
            ->orderBy('department')
            ->orderBy('role')
            ->get();
            
        $statusDependencies = BookingStatusDependency::with(['bookingStatus', 'dependentStatus', 'departmentRelation', 'roleRelation'])
            ->orderBy('department')
            ->orderBy('role')
            ->get();

        return view('web.status-management.index', compact(
            'bookingStatuses', 
            'paymentStatuses', 
            'bookingPaymentMappings',
            'statusDependencies',
            'user',
            'departments',
            'roles'
        ));
    }

    public function storeBookingPaymentMapping(Request $request)
    {
        \Log::info('Booking payment mapping request:', $request->all());
        
        try {
            $request->validate([
                'booking_status_id' => 'required|exists:booking_statuses,id',
                'payment_status_id' => 'required|exists:payment_statuses,id',
                'department' => 'required',
                'role' => 'required'
            ]);

            // Check if mapping already exists
            $existing = BookingPaymentStatus::where([
                'booking_status_id' => $request->booking_status_id,
                'payment_status_id' => $request->payment_status_id,
                'department' => $request->department,
                'role' => $request->role
            ])->first();
            
            if ($existing) {
                return response()->json(['success' => false, 'message' => 'Mapping already exists']);
            }

            BookingPaymentStatus::create($request->all());
            \Log::info('Mapping created successfully');

            return response()->json(['success' => true, 'message' => 'Mapping created successfully']);
        } catch (\Exception $e) {
            \Log::error('Error creating mapping:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function storeStatusDependency(Request $request)
    {
        $request->validate([
            'booking_status_id' => 'required|exists:booking_statuses,id',
            'dependent_status_id' => 'required|exists:booking_statuses,id|different:booking_status_id',
            'department' => 'required',
            'role' => 'required'
        ]);

        BookingStatusDependency::create($request->all());

        return response()->json(['success' => true, 'message' => 'Dependency created successfully']);
    }

    public function deleteBookingPaymentMapping($id)
    {
        BookingPaymentStatus::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Mapping deleted successfully']);
    }

    public function deleteStatusDependency($id)
    {
        BookingStatusDependency::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Dependency deleted successfully']);
    }

    public function storePaymentStatus(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:payment_statuses,name']);
        PaymentStatus::create($request->only('name'));
        return response()->json(['success' => true, 'message' => 'Payment status created successfully']);
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255|unique:payment_statuses,name,' . $id]);
        PaymentStatus::findOrFail($id)->update($request->only('name'));
        return response()->json(['success' => true, 'message' => 'Payment status updated successfully']);
    }

    public function deletePaymentStatus($id)
    {
        PaymentStatus::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Payment status deleted successfully']);
    }
}