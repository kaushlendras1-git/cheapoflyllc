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
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = $request->code . '.png';
            $destinationPath = public_path('assets/img/airline-logo/');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $file->move($destinationPath, $filename);
        }

        Airline::create([
            'airline_code' => $request->code,
            'airline_name' => $request->name
        ]);

        return redirect()->route('airlines.index')->with('success', 'Airline created successfully');
    }

    public function edit(Request $request, Airline $airline)
    {
        $page = $request->get('page', 1);
        return view('masters.airlines.edit', compact('airline', 'page'));
    }

    public function update(Request $request, Airline $airline)
    {
        $request->validate([
            'code' => 'required|string|max:10|unique:airlines,airline_code,' . $airline->id,
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            
            if ($file->isValid()) {
                $filename = $request->code . '.png';
                $destinationPath = public_path('assets/img/airline-logo/');
                
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                
                try {
                    $file->move($destinationPath, $filename);
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Failed to upload image: ' . $e->getMessage());
                }
            } else {
                return redirect()->back()->with('error', 'Invalid image file uploaded.');
            }
        }

        $airline->update([
            'airline_code' => $request->code,
            'airline_name' => $request->name
        ]);

        $page = $request->get('page', 1);
        return redirect()->route('airlines.index', ['page' => $page])->with('success', 'Airline updated successfully');
    }

    public function destroy(Airline $airline)
    {
        $airline->delete();
        return redirect()->route('airlines.index')->with('success', 'Airline deleted successfully');
    }
}