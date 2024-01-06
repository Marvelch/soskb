<?php

namespace App\Http\Controllers;

use App\Models\profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile.index');
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
    public function show(profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(profile $profile)
    {
        return view('profile.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, profile $profile)
    {
        DB::beginTransaction();

        try {
            $phoneNumber = $request->phone; // Nomor telepon yang ingin diganti

            // Periksa apakah nomor telepon dimulai dengan '0'
            if (Str::startsWith($phoneNumber, '0')) {
                $phoneNumber = '62' . substr($phoneNumber, 1); // Ganti '0' dengan '62' pada karakter pertama
            }

            $phoneFilter = User::where('phone',$phoneNumber)->first();

            if($phoneFilter) {
                if($phoneFilter->id == Auth::user()->id) {
                    if($request->password) {
                        User::find(Auth::user()->id)->update([
                            'phone' => $phoneNumber,
                            'password' => Hash::make($request->password)
                        ]);
                    }else{
                        User::find(Auth::user()->id)->update([
                            'phone' => $phoneNumber,
                        ]);
                    }
                }else{
                    toast('The phone number has been used by another user','error');

                    return back();
                }
            }else{
                if($request->password) {
                    User::find(Auth::user()->id)->update([
                        'phone' => $phoneNumber,
                        'password' => Hash::make($request->password)
                    ]);
                }else{
                    User::find(Auth::user()->id)->update([
                        'phone' => $phoneNumber,
                    ]);
                }
            }



            DB::commit();

            toast('Transaction Has Been Successful','success');

            return redirect()->route('index_profile');
        } catch (\Throwable $th) {
            DB::rollback();

            toast($th->getMessage(),'error');

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(profile $profile)
    {
        //
    }
}
