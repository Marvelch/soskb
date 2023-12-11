<?php

namespace App\Http\Controllers;

use App\Models\group;
use App\Models\groupDetail;
use App\Models\position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use DB;

class GroupController extends Controller
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
        DB::beginTransaction();

        try {
            $unique = uniqueGroup();

            group::create([
                'unique' => $unique,
                'chairman' => $request->chairman,
                'note' => @$request->note,
                'created_by' => Auth::user()->id
            ]);

            foreach ($request->listEmployee as $key => $value) {
                groupDetail::create([
                    'unique' => $unique,
                    'sales_id' => $value['employee_id']
                ]);
            }

            DB::commit();

            toast('Transaction Has Been Successful','success');

            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            DB::rollback();

            toast($th->getMessage(),'error');

            return response()->json(['error' => true]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(group $group)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function group()
    {
        $positions = position::all();

        $users = User::all();

        $codes = uniqueGroup();

        return view('admin.generals.group',compact('positions','users','codes'));
    }

    /**
     * Employee data search for autocomplate.
     */
    public function SearchingEmployee(Request $request,$id)
    {

        $chairmanData = User::join('positions','users.position_unique','=','positions.unique')
                                ->where('users.id',$id)
                                ->first();

        $data = User::join('positions','users.position_unique','=','positions.unique')
                        ->where('positions.level','=',($chairmanData->level + 1))
                        ->where('users.name', 'ILIKE', '%'. $request->get('q'). '%')
                        ->get();

        return response()->json($data);
    }

    /**
     * Employee data search for autocomplate.
     */
    public function SearchingChairman(Request $request)
    {
        $data = User::where('name', 'ILIKE', '%'. $request->get('q'). '%')
                          ->get();

        return response()->json($data);
    }
}
