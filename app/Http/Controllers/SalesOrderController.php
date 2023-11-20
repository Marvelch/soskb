<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\customerTemp;
use App\Models\product;
use App\Models\productTemp;
use App\Models\salesOrder;
use App\Models\salesOrderDetail;
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

        $products = productTemp::where('user_id',Auth::user()->id)->get();

        return view('sales.index',compact('customers','products'));
    }

    /**
     * Display a listing of the resource.
     */
    public function customer()
    {
        return view('sales.customer');
    }

    /**
     * Display a listing of the resource.
     */
    public function product()
    {
        $products = productTemp::where('user_id',Auth::user()->id)->get();

        return view('sales.product',compact('products'));
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
            $unique = generateUniqueKey(6);

            $customers = customerTemp::where('user_id',Auth::user()->id)->first();

            $products = productTemp::where('user_id',Auth::user()->id)->get();

            salesOrder::create([
                'id_transaction' => $unique,
                'created_by' => Auth::user()->id,
                'customer_id' => $customers->customer_id,
                'so_date' => $request->so_date,
                'information' => $request->information,
                'status' => 1,
            ]);

            foreach($products as $item) {
                salesOrderDetail::create([
                    'id_transaction' => $unique,
                    'product_id' => $item->product_id,
                    'qty' => $item->qty,
                    'unit_id' => 1
                ]);
            }

            customerTemp::where('user_id',Auth::user()->id)->delete();

            productTemp::where('user_id',Auth::user()->id)->delete();

            DB::commit();

            return back();
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollback();

            return $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeTemp(Request $request)
    {
        DB::beginTransaction();
        try {
            $customerTemp = customerTemp::where('user_id',Auth::user()->id)->first();

            if($customerTemp) {
                customerTemp::where('user_id',Auth::user()->id)->update([
                    'customer_id' => $request->customer_id
                ]);
            }else{
                customerTemp::create([
                    'customer_id' => $request->customer_id,
                    'user_id' => Auth::user()->id
                ]);
            }

            DB::commit();

            return redirect()->route('index_sales_orders');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            return $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeProductTemp(Request $request)
    {
        DB::beginTransaction();
        try {
            $productTemp = productTemp::where('user_id',Auth::user()->id)->first();

            productTemp::where('user_id',Auth::user()->id)->delete();

            foreach($request->product_list as $item) {
                productTemp::create([
                    'product_id' => $item['id'],
                    'qty' => $item['qty'],
                    'user_id' => Auth::user()->id
                ]);
            }

            DB::commit();

            return redirect()->route('index_sales_orders');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();

            return $th;
        }
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

    /**
     * Company data search for autocomplate.
     */
    public function searchProducts(Request $request)
    {
        $data = product::where('product_name', 'LIKE', '%'. $request->get('q'). '%')
                        ->orWhere('product_name', 'LIKE', '%'. strtolower($request->get('q')). '%')
                        ->orWhere('product_name', 'LIKE', '%'. strtoupper($request->get('q')). '%')
                        ->orWhere('product_name', 'LIKE', '%'. ucfirst($request->get('q')). '%')
                        ->get();

        return response()->json($data);
    }

    /**
     * Show all transaction sales orders.
     */
    public function transaction(Request $request)
    {
        $transactions = salesOrder::all();

        return view('sales.transaction',compact('transactions'));
    }
}
