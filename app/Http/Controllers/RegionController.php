<?php

namespace App\Http\Controllers;

use App\Models\region;
use Illuminate\Http\Request;

class RegionController extends Controller
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
    public function show(region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(region $region)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, region $region)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(region $region)
    {
        //
    }

    /**
     * Data search for regions / province.
     */
    public function searchRegion(Request $request)
    {
        $data = region::where('region_name', 'ILIKE', '%' . $request->input('term') . '%')
                            ->where('island',$request->island_id)
                            ->get();

        return response()->json($data);
    }
}
