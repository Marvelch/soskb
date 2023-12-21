<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\sales;
use App\Models\salesProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
Use Alert;
use DB;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = @Auth::user()->region_id;
        $city = @Auth::user()->city_id;
        $customerType = @Auth::user()->customer_type_id;
        $subCustomerType = @Auth::user()->sub_customer_type_id;
        $level = @Auth::user()->positions->level;

        if(@Auth::user()->positions->level == 2) {
            //  $products = User::join('sales_products', 'users.id', '=', 'sales_products.sales_id')
            //     ->join('products', 'sales_products.product_id', '=', 'products.id')
            //     ->where('products.status',1)
            //     ->select('products.id as id',
            //              'products.product_name as product_name',
            //              'products.code as code',
            //              'products.status as status')
            //     ->groupBy('products.id')
            //     ->get();

            $products = product::all();
        }else if(@Auth::user()->positions->level == 3) {
            //  if($customerType == null) {
            //     toast('Regions & City Not Found','error');

            //     return back();
            //  }

             $products = User::join('sales_products', 'users.id', '=', 'sales_products.sales_id')
                ->join('products', 'sales_products.product_id', '=', 'products.id')
                ->join('positions','users.position_unique','=','positions.unique')
                ->where('users.customer_type_id','=',$customerType)
                ->where('positions.level','>=',$level)
                ->where('products.status',1)
                ->select('products.id as id',
                         'products.product_name as product_name',
                         'products.code as code',
                         'products.status as status')
                ->groupBy('products.id')
                ->get();
        }else if(@Auth::user()->positions->level == 4) {
            if($regions == null || $customerType == null  || $subCustomerType == null) {
                toast('Regions, City & Customer Type Not Found','error');

                return back();
             }

            $products = User::join('regions', 'users.region_id', '=', 'regions.id')
                ->join('cities', 'regions.id', '=', 'cities.region_id')
                ->join('sales_products', 'users.id', '=', 'sales_products.sales_id')
                ->join('products', 'sales_products.product_id', '=', 'products.id')
                ->join('positions','users.position_unique','=','positions.unique')
                ->where('users.customer_type_id','=',$customerType)
                ->where('users.sub_customer_type_id','=',$subCustomerType)
                ->where('positions.level','>=',$level)
                ->where('users.region_id', '=', $regions)
                ->where('products.status',1)
                ->select('products.id as id',
                         'products.product_name as product_name',
                         'products.code as code',
                         'products.status as status')
                ->groupBy('products.id')
                ->get();
        }else if(@Auth::user()->positions->level == 5) { // Supervisor
            if($regions == null || $city == null || $customerType == null || $subCustomerType == null) {
                toast('Regions, City, Customer and Sub Customer Type Not Found','error');

                return back();
             }

            $products = User::join('regions', 'users.region_id', '=', 'regions.id')
                ->join('cities', 'regions.id', '=', 'cities.region_id')
                ->join('sales_products', 'users.id', '=', 'sales_products.sales_id')
                ->join('products', 'sales_products.product_id', '=', 'products.id')
                ->join('positions','users.position_unique','=','positions.unique')
                ->where('users.customer_type_id','=',$customerType)
                ->where('users.sub_customer_type_id','=',$subCustomerType)
                ->where('positions.level','>=',$level)
                ->where('users.region_id', '=', $regions)
                ->where('users.city_id', '=', $city)
                ->where('products.status',1)
                ->select('products.id as id',
                         'products.product_name as product_name',
                         'products.code as code',
                         'products.status as status')
                ->groupBy('products.id')
                ->get();
        }else{
            $products = product::join('sales_products','sales_products.product_id','=','products.id')
                            ->where('sales_id',Auth::user()->id)
                            ->where('products.status',true)
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
        $productData = product::where('product_name', 'ILIKE', '%' . $request->product . '%')
                                ->where('status',$request->status)
                                ->get();

        $encryptedProductData = [];

        // Encrypting IDs in the customer data
        foreach ($productData as $item) {
            $encryptedProductData[] = [
                'id' => Crypt::encryptString($item->id),
                'product_name' => $item->product_name,
                'code' => $item->code,
                'status' => $item->status,
                'created_at' => $item->created_at
                // Add other customer properties as needed
            ];
        }

        return response()->json(['productData' => $encryptedProductData]);
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
