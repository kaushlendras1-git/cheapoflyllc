<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{

    public function index(Request $request)
    {
        $query = Campaign::query();

        // Filter by keyword (name)
        if ($request->has('keyword') && $request->keyword != '') {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // Filter by start date
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        // Filter by end date
        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Paginate results
        $campaigns = $query->paginate(10);

        return view('masters.campaigns.index', compact('campaigns'));
    }


    public function create()
    {
        return view('masters.campaigns.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        Campaign::create($validated);

        return redirect()->route('campaign.index')->with('success', 'campaign created successfully!');
    }

    public function show(Campaign $campaign)
    {
        return view('masters.campaigns.show', compact('campaign'));
    }

    public function edit(Campaign $campaign)
    {
        return view('masters.campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $campaign->update($validated);

        return redirect()->route('campaign.index')->with('success', 'Campaign updated successfully!');
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return redirect()->route('campaign.index')->with('success', 'Campaign deleted successfully!');
    }
}
