<?php

namespace App\Http\Controllers;

use App\Events\TrackingDataUpdated;
use App\Models\Site;
use App\Models\Traffic;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class TrafficController extends Controller
{
    public function index()
    {
        // Retrieve tracking data
        $data = Traffic::all();
        Log::info($data);
        return response()->json($data);
    }
    public function track(Request $request)
    {
        Log::info($request->all());

        $validated = $request->validate([
            'user_ip' => 'required|ip',
            'website_url' => 'required|url',
            'website_title' => 'nullable|string',
            'country' => 'nullable|string',
            'device' => 'required|string',
            'user_agent' => 'required|string',
            'browser' => 'nullable|string'
        ]);

        $siteId = Site::pluck('id')->first(); // Get the first site ID

        if (!$siteId) {
            $defaultSite = Site::create([
                'name' => 'Default Site',
                'url' => 'https://example.com'
            ]);
            $siteId = $defaultSite->id; // Get the ID of the newly created default site record
        }

        $validated['site_id'] = $siteId;


        Traffic::create($validated);

            // Broadcast the event
        broadcast(new TrackingDataUpdated($validated));

        // return response()->json(['message' => 'Data tracked successfully'], 200);

        return response()->json(['status' => 'success'], 200);
    }
}
