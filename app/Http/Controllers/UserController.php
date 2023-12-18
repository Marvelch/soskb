<?php

namespace App\Http\Controllers;

use App\Models\customerType;
use App\Models\position;
use App\Models\region;
use App\Models\sales;
use App\Models\subCustomerType;
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
                    'customer_type_id' => strtolower($positions->title) == 'sales' || strtolower($positions->title) == 'spv' || strtolower($positions->title) == 'supervisor' ? $request->customer : null,
                    'sub_customer_type_id' => strtolower($positions->title) == 'sales' || strtolower($positions->title) == 'spv' || strtolower($positions->title) == 'supervisor' ? $request->subCustomer : null,
                    'region_id' => $request->region
                ]);
            }else{
                User::find(Crypt::decryptString($id))->update([
                    'position_unique' => $request->position,
                    'customer_type_id' => strtolower($positions->title) == 'sales' || strtolower($positions->title) == 'spv' || strtolower($positions->title) == 'supervisor' ? $request->customer : null,
                    'sub_customer_type_id' => strtolower($positions->title) == 'sales' || strtolower($positions->title) == 'spv' || strtolower($positions->title) == 'supervisor' ? $request->subCustomer : null,
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
     * Search for users in the users table
     */
    public function searching_users_sales(Request $request)
    {
        if($request->search) {
            $userData = User::join('positions','users.position_unique','=','positions.unique')
                        ->where('users.name', 'ILIKE', '%' . $request->search . '%')
                        ->get();
        }else{
            $userData = User::join('positions','users.position_unique','=','positions.unique')
                        ->where('users.name', 'ILIKE', '%' . $request->search . '%')
                        ->limit(10)
                        ->get();
        }

        $encryptedUserData = [];

        foreach ($userData as $item) {
            $encryptedUserData[] = [
                'idEncrypt' => Crypt::encryptString($item->id),
                'id' => $item->id,
                'name' => $item->name,
                'email' => $item->email,
                'account_type' => $item->account_type,
                'position' => $item->positions->title
            ];
        }

        return response()->json(['userData' => $encryptedUserData]);
    }

    /**
     * Searching sub customer type.
     */
    public function searching_sub_customer_type(Request $request)
    {
        $data = subCustomerType::where('name', 'ILIKE', '%' . $request->get('q') . '%')
                            ->where('customer_type_id',$request->customer_id)
                            ->get();

        return response()->json($data);
    }

}
