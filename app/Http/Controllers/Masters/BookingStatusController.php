<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingStatus;
use App\Models\Department;
use App\Models\Role;

class BookingStatusController extends Controller
{
    public function index()
    {
        $bookingStatuses = BookingStatus::paginate(30);
        $roles = Role::pluck('name','id');
        $departments = Department::pluck('name','id');
        return view('masters.booking-statuses.index', compact('bookingStatuses','departments','roles'));
    }
    

    public function create()
    {
        $departments = Department::all();
        $roles = Role::all();
        return view('masters.booking-statuses.create',compact('departments','roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'departments' => 'required|array',
            'roles' => 'required|array'
        ]);

        BookingStatus::create($request->all());

        return redirect()->route('booking-status.index')
            ->with('success', 'Booking status created successfully.');
    }

    public function show(BookingStatus $bookingStatus)
    {
        return view('masters.booking-statuses.show', compact('bookingStatus'));
    }

    public function edit(BookingStatus $bookingStatus)
    {   
        $departments = Department::all();
        $roles = Role::all();
        return view('masters.booking-statuses.edit', compact('bookingStatus','departments','roles'));
    }

    public function update(Request $request, BookingStatus $bookingStatus)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'departments' => 'required|array',
            'roles' => 'required|array'
        ]);

        $bookingStatus->update($request->all());

        return redirect()->route('booking-status.index')
            ->with('success', 'Booking status updated successfully.');
    }

    public function destroy($id)
    {
        \Log::info('Destroy method called with ID: ' . $id);
        
        $bookingStatus = BookingStatus::findOrFail($id);
        $bookingStatus->delete();
        
        \Log::info('BookingStatus deleted successfully');

        return redirect()->route('booking-status.index')
            ->with('success', 'Booking status deleted successfully.');
    }
}
