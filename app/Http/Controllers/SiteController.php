<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'url' => 'required|url|max:255',
    ]);

    Site::create($validatedData);

    return redirect()->route('sites.index')->with('success', 'Site registered successfully!');
}

}
