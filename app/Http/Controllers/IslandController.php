<?php

namespace App\Http\Controllers;

use App\Models\island;
use Illuminate\Http\Request;

class IslandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(island $island)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(island $island)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, island $island)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(island $island)
    {
        //
    }

    /**
     * Data search for islands.
     */
    public function searchIsland(Request $request)
    {
        $data = island::where('island_name', 'ILIKE', '%' . $request->get('q') . '%')
                            ->get();

        return response()->json($data);
    }

}
