<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingStatus;

class BookingStatusController extends Controller
{
    public function index()
    {
        $bookingStatuses = BookingStatus::paginate(10);
        return view('masters.booking-statuses.index', compact('bookingStatuses'));
    }

    public function create()
    {
        return view('masters.booking-statuses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        BookingStatus::create($request->all());

        return redirect()->route('booking-status.index')
            ->with('success', 'Booking status created successfully.');
    }

    public function edit(BookingStatus $bookingStatus)
    {
        return view('masters.booking-statuses.edit', compact('bookingStatus'));
    }

    public function update(Request $request, BookingStatus $bookingStatus)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $bookingStatus->update($request->all());

        return redirect()->route('booking-status.index')
            ->with('success', 'Booking status updated successfully.');
    }

    public function destroy(BookingStatus $bookingStatus)
    {
        $bookingStatus->delete();

        return redirect()->route('booking-status.index')
            ->with('success', 'Booking status deleted successfully.');
    }
}
