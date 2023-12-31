<?php

namespace App\Http\Controllers;

use App\Models\subCustomerType;
use Illuminate\Http\Request;

class SubCustomerTypeController extends Controller
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
    public function show(subCustomerType $subCustomerType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(subCustomerType $subCustomerType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, subCustomerType $subCustomerType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(subCustomerType $subCustomerType)
    {
        //
    }

    /**
     * Data search for sub customer groups.
     */
    public function searchSubCustomerGroup(Request $request)
    {
        $data = subCustomerType::where('name', 'ILIKE', '%' . $request->get('q') . '%')
                            ->where('customer_type_id',$request->customer_group_id)
                            ->get();

        return response()->json($data);
    }
}
