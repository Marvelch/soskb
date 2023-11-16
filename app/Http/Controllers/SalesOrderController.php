<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\customerTemp;
use App\Models\salesOrder;
use App\Models\salesOrderTemp;
use Illuminate\Http\Request;
use DB;
use Auth;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = customerTemp::where('user_id',Auth::user()->id)->first();

        return view('sales.index',compact('customers'));
    }

    /**
     * Display a listing of the resource.
     */
    public function customer()
    {
        return view('sales.customer');
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
    public function show(salesOrder $salesOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(salesOrder $salesOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, salesOrder $salesOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(salesOrder $salesOrder)
    {
        //
    }

    /**
     * Company data search for autocomplate.
     */
    public function searchCustomers(Request $request)
    {
        $data = customer::where('name', 'LIKE', '%'. $request->get('q'). '%')->get();

        return response()->json($data);
    }
}
