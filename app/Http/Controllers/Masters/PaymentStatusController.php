<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentStatus;
use App\Models\Department;
use App\Models\Role;

class PaymentStatusController extends Controller
{
    public function index()
    {   

        $clientIp = request()->ip();
        $serverIp = getHostByName(getHostName());

        // dd([
        //     'client_ip' => $clientIp,
        //     'server_ip' => $serverIp,
        // ]);

        $roles = Role::pluck('name','id');
        $departments = Department::pluck('name','id');
        $paymentStatuses = PaymentStatus::paginate(30);
        return view('masters.payment-statuses.index', compact('paymentStatuses','roles','departments'));
    }

    public function create()
    {   
        $departments = Department::all();
        $roles = Role::all();
        return view('masters.payment-statuses.create',compact('departments','roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'departments' => 'required|array',
            'roles' => 'required|array'
        ]);

        PaymentStatus::create($request->all());

        return redirect()->route('payment-status.index')
            ->with('success', 'Payment status created successfully.');
    }

    public function edit(PaymentStatus $paymentStatus)
    {   
        $departments = Department::all();
        $roles = Role::all();
        return view('masters.payment-statuses.edit', compact('paymentStatus','departments','roles'));
    }

    public function update(Request $request, PaymentStatus $paymentStatus)
    {   
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'departments' => 'required|array',
            'roles' => 'required|array'
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