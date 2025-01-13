<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PropertyController extends Controller
{
    public function index()
    {
        return Inertia::render('Properties/Index');
    }

    public function search(Request $request)
    {
        // Add a sleep to simulate network delay
        sleep(1); // Delays for 1 second
        
        $properties = Property::search($request->all())->get();
        return response()->json($properties);
    }
}