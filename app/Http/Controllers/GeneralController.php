<?php

namespace App\Http\Controllers;

use App\Models\general;
use App\Models\jobLevel;
use App\Models\position;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

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

    /**
     * Display a listing of the resource.
     */
    public function structure()
    {
        $listSales = User::where('account_type','USR')->get();

        return view('admin.generals.structure',compact('listSales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_structure(Request $request)
    {
        DB::beginTransaction();

        try {
            $positions = position::orderBy('created_at','desc')->first();

            foreach($request->positions as $item) {
                position::create([
                    'unique' => uniqueGroup(),
                    'level' => @$positions->level == null ? 1 : $positions->level + 1,
                    'title' => $item
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            return $th;
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function group()
    {
        $jobs = position::all();

        $users = User::all();

        $codes = uniqueGroup();

        return view('admin.generals.group',compact('jobs','users','codes'));
    }
}
