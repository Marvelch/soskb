<?php

namespace App\Http\Controllers;

use App\Models\customerType;
use App\Models\position;
use App\Models\region;
use App\Models\sales;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('admin.users.index',compact('users'));
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
    public function show(string $id)
    {
        $users = User::find(Crypt::decryptString($id));

        $positions = position::all();

        $regions = region::where('status',1)->get();

        $customerTypes = customerType::all();

        return view('admin.users.show',compact('users','positions','regions','customerTypes'));
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

        DB::beginTransaction();

        try {
            $positions = position::where('unique',$request->position)->first();

            if($request->password) {
                User::find(Crypt::decryptString($id))->update([
                    'password' => @Hash::make($request->password),
                    'position_unique' => $request->position,
                    'customer_type_id' => strtolower($positions->title) == 'sales' || strtolower($positions->title) == 'spv' ? $request->customer : null,
                    'region_id' => $request->region
                ]);
            }else{
                User::find(Crypt::decryptString($id))->update([
                    'position_unique' => $request->position,
                    'customer_type_id' => strtolower($positions->title) == 'sales' || strtolower($positions->title) == 'spv' ? $request->customer : null,
                    'region_id' => $request->region
                ]);
            }

            DB::commit();

            toast('Transaction Has Been Successful','success');

            return redirect()->route('admin.users');
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollback();

            toast($th->getMessage(),'error');

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /*------------------------------ ADMIN PAGE ------------------------------*/

    /**
     * Searching Sales
     */
    public function searching_users_sales(Request $request)
    {
        $userData = User::where('name', 'ILIKE', '%' . $request->search . '%')
                                ->get();

        return response()->json(['userData' => $userData]);
    }
}
