<?php

namespace App\Http\Controllers;

use App\Models\BookingStatus;
use App\Models\PaymentStatus;
use App\Models\Department;
use App\Models\Role;
use App\Models\BookingPaymentStatus;
use App\Models\BookingStatusDependency;
use App\Models\StatusInterdependency;
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
            
        $statusInterdependencies = StatusInterdependency::with(['bookingStatus', 'paymentStatus', 'department', 'role'])
            ->orderBy('department_id')
            ->orderBy('role_id')
            ->get();

        return view('web.status-management.index', compact(
            'bookingStatuses', 
            'paymentStatuses', 
            'bookingPaymentMappings',
            'statusDependencies',
            'statusInterdependencies',
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

    public function storeBookingStatus(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:booking_statuses,name']);
        BookingStatus::create($request->only('name'));
        return response()->json(['success' => true, 'message' => 'Booking status created successfully']);
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255|unique:booking_statuses,name,' . $id]);
        BookingStatus::findOrFail($id)->update($request->only('name'));
        return response()->json(['success' => true, 'message' => 'Booking status updated successfully']);
    }

    public function deleteBookingStatus($id)
    {
        BookingStatus::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Booking status deleted successfully']);
    }

    public function storeStatusInterdependency(Request $request)
    {
        $request->validate([
            'booking_status_id' => 'required|exists:booking_statuses,id',
            'payment_status_id' => 'required|exists:payment_statuses,id',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
            'direction' => 'required|in:booking_to_payment,payment_to_booking,bidirectional'
        ]);

        StatusInterdependency::create($request->all());
        return response()->json(['success' => true, 'message' => 'Status interdependency created successfully']);
    }

    public function deleteStatusInterdependency($id)
    {
        StatusInterdependency::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Status interdependency deleted successfully']);
    }

    public function getAvailableStatuses(Request $request)
    {
        $departmentId = $request->department_id;
        $roleId = $request->role_id;
        $currentBookingStatus = $request->current_booking_status;
        $currentPaymentStatus = $request->current_payment_status;

        $availablePaymentStatuses = [];
        $availableBookingStatuses = [];

        if ($currentBookingStatus) {
            $interdependencies = StatusInterdependency::where('booking_status_id', $currentBookingStatus)
                ->where('department_id', $departmentId)
                ->where('role_id', $roleId)
                ->whereIn('direction', ['booking_to_payment', 'bidirectional'])
                ->pluck('payment_status_id');
            $availablePaymentStatuses = PaymentStatus::whereIn('id', $interdependencies)->get();
        }

        if ($currentPaymentStatus) {
            $interdependencies = StatusInterdependency::where('payment_status_id', $currentPaymentStatus)
                ->where('department_id', $departmentId)
                ->where('role_id', $roleId)
                ->whereIn('direction', ['payment_to_booking', 'bidirectional'])
                ->pluck('booking_status_id');
            $availableBookingStatuses = BookingStatus::whereIn('id', $interdependencies)->get();
        }

        return response()->json([
            'availablePaymentStatuses' => $availablePaymentStatuses,
            'availableBookingStatuses' => $availableBookingStatuses
        ]);
    }
}