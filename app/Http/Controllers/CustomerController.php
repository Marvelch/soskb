<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\customerTemp;
use App\Models\product;
use App\Models\salesCustomer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;
use Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = customer::join('sales_customers','sales_customers.customer_id','=','customers.id')
                            ->where('sales_id',Auth::user()->id)
                            ->get();

        return view('customers.index',compact('customers'));
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
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
        //
    }

    /*--------------------------------------------- ADMIN PAGE ---------------------------------------------*/

    /**
     * Display a listing of the resource.
     */
    public function index_customer()
    {
        $customers = customer::orderby('name','asc')->paginate(10);

        return view('admin.customers.index',compact('customers'));
    }

    /**
     * Searching products
     */
    public function searchingCustomers(Request $request)
    {
        $productData = customer::join('sales_products','sales_products.product_id','=','products.id')
                                ->where('products.product_name', 'ILIKE', '%' . $request->product . '%')
                                ->where('products.status',$request->status)
                                ->where('sales_id',Auth::user()->id)
                                ->get();

        return response()->json(['productData' => $productData]);
    }

    /**
     * Searching products
     */
    public function sales_customer($id)
    {
        $customers = customer::find(Crypt::decryptString($id));

        $sales = User::where('account_type','USR')->get();

        $salesProducts = salesCustomer::where('customer_id',Crypt::decryptString($id))->get();

        return view('admin.customers.sales',compact('customers','sales','salesProducts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_sales_customer(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            foreach ($request->sales_id as $key => $value) {
                $result = salesCustomer::where('customer_id',Crypt::decryptString($id))
                                        ->where('sales_id',$value)
                                        ->first();

                if(!$result) {
                    salesCustomer::create([
                        'customer_id' => Crypt::decryptString($id),
                        'sales_id' => $value
                    ]);
                }
            }

            DB::commit();

            toast('Transaction Has Been Successful','success');

            return back();
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollback();

            toast($th->getMessage(),'error');

            return back();
        }
    }
}
