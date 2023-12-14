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
Use Alert;
use App\Models\salesProduct;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Models\unit;
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

        $units = unit::all();

        return view('sales.product',compact('products','units'));
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
                'send_date' => $request->send_date,
            ]);

            foreach($products as $item) {
                salesOrderDetail::create([
                    'id_transaction' => $unique,
                    'product_id' => $item->product_id,
                    'qty' => $item->qty,
                    'unit_id' => $item->unit_id
                ]);
            }

            customerTemp::where('user_id',Auth::user()->id)->delete();

            productTemp::where('user_id',Auth::user()->id)->delete();

            DB::commit();

            toast('Transaction Has Been Successful','success');

            return redirect()->route('transaction_sales_orders');
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollback();

            toast($th->getMessage(),'error');

            return back();
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
                    'user_id' => Auth::user()->id,
                    'unit_id' => $item['unit_id']
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
        $data = customer::join('sales_customers','sales_customers.customer_id','=','customers.id')
                            ->where('customers.name', 'ILIKE', '%' . $request->get('q') . '%')
                            ->where('sales_id',Auth::user()->id)
                            ->select('customers.id as id',
                                     'customers.name as name')
                            ->get();

        return response()->json($data);
    }

    /**
     * Company data search for autocomplate.
     */
    public function searchProducts(Request $request)
    {
        $data = product::join('sales_products','sales_products.product_id','=','products.id')
                            ->where('products.product_name', 'ILIKE', '%' . $request->get('q') . '%')
                            ->where('sales_id',Auth::user()->id)
                            ->select('products.id as id',
                                     'products.product_name as product_name')
                            ->get();

        return response()->json($data);
    }

    /**
     * Show all transaction sales orders.
     */
    public function transaction(Request $request)
    {
        $transactions = salesOrder::where('created_by',Auth::user()->id)->get();

        return view('sales.transaction',compact('transactions'));
    }

    /*--------------------------------------- ADMIN AREA ---------------------------------------*/

    /**
     * Displays sales order request data
     */
    public function transaction_admin(Request $request)
    {
        $transactions = salesOrder::orderBy('created_at','desc')->paginate(10);

        return view('admin.sales_orders.show',compact('transactions'));
    }

    /**
     * Displays sales order request data
     */
    public function transaction_detail(Request $request, $id)
    {
        $transactions = salesOrder::where('id_transaction',Crypt::decryptString($id))->first();
        $transactionDetails = salesOrderDetail::where('id_transaction',Crypt::decryptString($id))->get();

        return view('admin.sales_orders.detail',compact('transactions','transactionDetails'));
    }

    /**
     * Save update data from sales orders
     */
    public function storeAdmin(Request $request, $id)
    {

        DB::beginTransaction();
        try {

            salesOrder::find($id)->update([
                'note' => $request->note,
                'status' => $request->status,
                'changed_by' => Auth::user()->id
            ]);

            DB::commit();

            toast('Transaction Has Been Successful','success');

            return redirect()->route('admin.transaction');
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollback();

            toast($th->getMessage(),'error');

            return back();
        }
    }

    /**
     * search from sales order transaction data
     */
    public function searchingTransaction(Request $request)
    {
        $salesOrderData = salesOrder::join('customers', 'sales_orders.customer_id', '=', 'customers.id')
                                    ->join('users','sales_orders.created_by','=','users.id')
                                    ->where(function ($query) use ($request) {
                                        $query->where('customers.name', 'ILIKE', '%' . $request->get('customer') . '%')
                                            ->orWhereBetween('sales_orders.so_date', [$request->start, $request->end]);
                                    })
                                    ->where('sales_orders.status',$request->status)
                                    ->select(
                                        'customers.name as customer_name',
                                        'so_date',
                                        'id_transaction',
                                        'users.name as created_by',
                                        'sales_orders.status as status'
                                    )
                                    ->get();

        return response()->json(['salesOrderData' => $salesOrderData]);
    }
}
