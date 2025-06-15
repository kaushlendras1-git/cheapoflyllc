<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CallType;

class CallTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = CallType::query();
    
        if ($request->has('keyword') && $request->keyword != '') {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
    
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
    
        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
    
        $call_types = $query->paginate(10);
    
        return view('masters.call-type.index', compact('call_types'));
    }

    public function create()
    {
        return view('masters.call-type.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $validated['value'] =  strtolower(str_replace(' ', '', $request->name));
        CallType::create($validated);

        return redirect()->route('call-types.index')->with('success', 'CallType created successfully!');
    }

    public function show(CallType $call_type)
    {
        return view('masters.call-type.show', compact('call_type'));
    }

    public function edit(CallType $call_type)
    {
        return view('masters.call-type.edit', compact('call_type'));
    }

    public function update(Request $request, CallType $call_type)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $call_type->update($validated);

        return redirect()->route('call-types.index')->with('success', 'CallType updated successfully!');
    }

    public function destroy(CallType $call_type)
    {
        $call_type->delete();

        return redirect()->route('call-types.index')->with('success', 'CallType deleted successfully!');
    }
}
