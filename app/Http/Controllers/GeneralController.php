<?php

namespace App\Http\Controllers;

use App\Models\general;
use Illuminate\Http\Request;

class GeneralController extends Controller
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
    public function show(general $general)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(general $general)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, general $general)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(general $general)
    {
        //
    }

    /*------------------------------------- Custome Script -------------------------------------*/

    /**
    * Displays the start page of the website.
    */
    public function setup()
    {
        return view('general.setup');
    }

    /**
    * Displays the start page of the website.
    */
    public function error()
    {
        return view('error');
    }

    /**
    * Displays the start page of the website.
    */
    public function error_mobile()
    {
        return view('error_access_mobile');
    }

    /**
    * Displays the start page of the website.
    */
    public function error_browser()
    {
        return view('error_access_browser');
    }
}
