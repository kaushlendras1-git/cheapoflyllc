<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    public function index(Request $request)
    {
        $query = Airline::query();
        
        if ($request->has('search') && $request->search) {
            $query->where('airline_code', 'like', '%' . $request->search . '%')
                  ->orWhere('airline_name', 'like', '%' . $request->search . '%');
        }
        
        $airlines = $query->orderBy('id', 'desc')->paginate(10);
        return view('masters.airlines.index', compact('airlines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:10|unique:airlines,airline_code',
            'name' => 'required|string|max:255'
        ]);

        Airline::create([
            'airline_code' => $request->code,
            'airline_name' => $request->name
        ]);

        return redirect()->route('airlines.index')->with('success', 'Airline created successfully');
    }

    public function edit(Airline $airline)
    {
        return view('masters.airlines.edit', compact('airline'));
    }

    public function update(Request $request, Airline $airline)
    {
        $request->validate([
            'code' => 'required|string|max:10|unique:airlines,airline_code,' . $airline->id,
            'name' => 'required|string|max:255'
        ]);

        $airline->update([
            'airline_code' => $request->code,
            'airline_name' => $request->name
        ]);

        return redirect()->route('airlines.index')->with('success', 'Airline updated successfully');
    }

    public function destroy(Airline $airline)
    {
        $airline->delete();
        return redirect()->route('airlines.index')->with('success', 'Airline deleted successfully');
    }
}