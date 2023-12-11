<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\sales;
use App\Models\salesProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use DB;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usersRegions = @Auth::user()->regions->code;

        if(Auth::user()->positions->level == 5) { // Supervisor
            $products = product::join('sales_products','sales_products.product_id','=','products.id')
                                ->where('sales_id',Auth::user()->id)
                                ->get();
        }else{
            $products = product::join('sales_products','sales_products.product_id','=','products.id')
                            ->where('sales_id',Auth::user()->id)
                            ->get();
        }


        return view('products.index',compact('products'));
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
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        //
    }

    /*------------------------------------- ADMIN PAGE -------------------------------------*/
    /**
     * Remove the specified resource from storage.
     */
    public function index_product(Request $request)
    {
        $products = product::paginate(30);

        return view('admin.products.index',compact('products'));
    }

    /**
     * Searching products
     */
    public function searchingProducts(Request $request)
    {
        $productData = product::join('sales_products','sales_products.product_id','=','products.id')
                                ->where('products.product_name', 'ILIKE', '%' . $request->product . '%')
                                ->where('products.status',$request->status)
                                ->where('sales_id',Auth::user()->id)
                                ->get();

        return response()->json(['productData' => $productData]);
    }

    /**
     * Searching products
     */
    public function sales_products($id)
    {
        $products = product::find(Crypt::decryptString($id));

        $sales = User::where('account_type','USR')->get();

        $salesProducts = salesProduct::where('product_id',Crypt::decryptString($id))->get();

        return view('admin.products.sales',compact('products','sales','salesProducts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeSalesProducts(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            foreach ($request->sales_id as $key => $value) {
                $result = salesProduct::where('product_id',Crypt::decryptString($id))
                                        ->where('sales_id',$value)
                                        ->first();

                if(!$result) {
                    salesProduct::create([
                        'product_id' => Crypt::decryptString($id),
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
