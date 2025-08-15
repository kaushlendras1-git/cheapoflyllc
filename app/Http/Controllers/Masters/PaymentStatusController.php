<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentStatus;

class PaymentStatusController extends Controller
{
    public function index()
    {
        $paymentStatuses = PaymentStatus::paginate(30);
        return view('masters.payment-statuses.index', compact('paymentStatuses'));
    }

    public function create()
    {
        return view('masters.payment-statuses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        PaymentStatus::create($request->all());

        return redirect()->route('payment-status.index')
            ->with('success', 'Payment status created successfully.');
    }

    public function edit(PaymentStatus $paymentStatus)
    {
        return view('masters.payment-statuses.edit', compact('paymentStatus'));
    }

    public function update(Request $request, PaymentStatus $paymentStatus)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $paymentStatus->update($request->all());

        return redirect()->route('payment-status.index')
            ->with('success', 'Payment status updated successfully.');
    }

    public function destroy(PaymentStatus $paymentStatus)
    {
        $paymentStatus->delete();

        return redirect()->route('payment-status.index')
            ->with('success', 'Payment status deleted successfully.');
    }
}