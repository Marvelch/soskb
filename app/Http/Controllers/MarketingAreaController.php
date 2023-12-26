<?php

namespace App\Http\Controllers;

use App\Models\marketingArea;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use DB;
use Alert;

class MarketingAreaController extends Controller
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
    public function show(marketingArea $marketingArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, marketingArea $marketingArea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            marketingArea::find(Crypt::decryptString($id))->delete();

            DB::commit();

            toast('Delete Has Been Successful','success');

            return back();
        } catch (\Throwable $th) {
            DB::rollback();

            toast($th->getMessage(),'success');

            return back();
        }
    }
}
