<?php

namespace App\Http\Controllers;

use App\Models\salesOrder;
use App\Models\salesOrderDetail;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class TransactionController extends Controller
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
    public function show($id)
    {
        $id = Crypt::decryptString($id);

        $transactions = salesOrder::where('id_transaction',$id)->first();
        $transactionDetails = salesOrderDetail::where('id_transaction',$id)->get();

        return view('transaction.show',compact('transactions','transactionDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaction $transaction)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function on_progress()
    {
        $onProgress = salesOrder::where('status',1)->get();

        return view('transaction.on_progress',compact('onProgress'));
    }

    /**
     * Display a listing of the resource.
     */
    public function complete()
    {
        $completes = salesOrder::where('status',2)->get();

        return view('transaction.complete',compact('completes'));
    }

    /**
     * Display a listing of the resource.
     */
    public function canceled()
    {
        $canceled = salesOrder::where('status',3)->get();

        return view('transaction.canceled',compact('canceled'));
    }
}
