<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BoatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all boats with their level information
        $boats = DB::table('boats')
            ->leftJoin('levels', 'boats.level_id', '=', 'levels.id') // Join with levels table using level_id
            ->select('boats.*', 'levels.id as level_id', 'levels.name as level_name', 'boats.image as image_url') // Select columns from boats and levels
            ->get();

        // Pass boats data to the index view
        return view('boats.index', [
            'boats' => $boats,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('Store method called'); // Log for debugging if method is hit

        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'level_id' => 'required|exists:levels,id', // Ensure level_id exists in levels table
            'min_cap' => 'required|integer|min:1',
            'max_cap' => 'required|integer|min:2',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:20000', // Optional image validation
        ]);

        $boatData = $request->except('image'); // Exclude image from main data array

        // Handle image upload if image is provided
        if ($request->hasFile('image')) {
            \Log::info('Image file received: '.$request->file('image')->getClientOriginalName());
            $imagePath = $request->file('image')->store('boats', 'public'); // Store image in 'boats' directory

            if (! $imagePath) { // Check if image upload was successful
                \Log::error('Image upload failed.');

                return back()->withErrors(['image' => 'Image upload failed.']); // Return error if upload fails
            }
            $boatData['image'] = $imagePath; // Add image path to boat data
        } else {
            \Log::warning('No image file received.');
        }

        DB::table('boats')->insert($boatData); // Insert boat data into the database

        // Redirect back to index with success message
        return redirect()->route('boats.index')->with('success', 'Boat created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Retrieve boat by ID, including level information
        $boat = DB::table('boats')
            ->leftJoin('levels', 'boats.level_id', '=', 'levels.id') // Join with levels table
            ->select('boats.*', 'levels.id as level_id', 'levels.name as level_name', 'boats.image as image_url')
            ->where('boats.id', $id)
            ->first();

        // Check if boat exists
        if (! $boat) {
            return redirect()->route('boats.index')->with('error', 'Boat not found'); // Redirect if not found
        }

        // Pass boat data to the show view
        return view('boats.show', [
            'boat' => $boat,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
