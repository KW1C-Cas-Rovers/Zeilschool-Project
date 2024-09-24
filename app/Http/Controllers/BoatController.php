<?php

namespace App\Http\Controllers;

use App\Models\Boat;
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
        $boats = DB::table('boats')
            ->leftJoin('level', 'boats.level_id', '=', 'level.id')
            ->select('boats.*', 'level.id as level_id', 'level.name as level_name', 'boats.image as image_url') // Added image_url
            ->get();

        return view('courses', [
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
        \Log::info('Store method called'); // Log to check if method is hit

        $request->validate([
            'name' => 'required|string|max:255',
            'min_cap' => 'required|integer|min:1',
            'max_cap' => 'required|integer|min:2',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:20000',
        ]);

        $boat = new Boat($request->all());

        if ($request->hasFile('image')) {
            \Log::info('Image file received: '.$request->file('image')->getClientOriginalName());
            $imagePath = $request->file('image')->store('boats', 'public');
            if (! $imagePath) {
                \Log::error('Image upload failed.');

                return back()->withErrors(['image' => 'Image upload failed.']);
            }
            $boat->image = $imagePath;
        } else {
            \Log::warning('No image file received.');
        }

        $boat->save();

        return redirect()->route('boats.index')->with('success', 'Boat created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $boat = DB::table('boats')
            ->leftJoin('level', 'boats.level_id', '=', 'level.id')
            ->select('boats.*', 'level.name as level_name')
            ->where('boats.id', $id)
            ->first();

        return view('reserve', compact('boat'));
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
