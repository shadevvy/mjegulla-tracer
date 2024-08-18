<?php

namespace App\Http\Controllers;

use App\Models\Traffic;
use Illuminate\Http\Request;

class TrafficController extends Controller
{
    public function track(Request $request)
    {
        $validated = $request->validate([
            'user_ip' => 'required|ip',
            'country' => 'nullable|string',
            'device' => 'required|string',
            'user_agent' => 'required|string',
        ]);

        Traffic::create($validated);

        return response()->json(['status' => 'success'], 200);
    }
}
