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
use App\Models\marketingArea;
use App\Models\salesCustomer;
use DB;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marketingAreaData = marketingArea::where('user_id',Auth::user()->id)->get();

        $customerType = @Auth::user()->customers->customer_type_id;
        $subCustomerType = @Auth::user()->subCustomers->sub_customer_type_id;

        $level = @Auth::user()->positions->level;

        if(@Auth::user()->positions->level == 2) {
            $productData = product::all();
        }else if(@Auth::user()->positions->level == 3) {
            foreach ($marketingAreaData as $key => $value) {
                if($value->island_id == null || $customerType == null) {
                    toast('Island, Regions and Customer Not Found','error');
                    return back();
                }
            }

            $positionUsers = User::select('users.id')
                    ->join('positions', 'users.position_unique', '=', 'positions.unique')
                    ->join('customer_groups', 'users.id', '=', 'customer_groups.user_id')
                    ->where('positions.level', '>', auth()->user()->positions->level)
                    ->where('customer_groups.customer_type_id', $customerType)
                    ->groupBy('users.id')
                    ->get();

            $marketingDataFilter = [];

            foreach ($positionUsers as $key => $item) {
                $userId = $item->id; // Accessing the 'id' property of the $item object

                $marketingAreaData = marketingArea::where('user_id', $userId)
                                                    ->select('island_id','region_id','city_id','user_id')
                                                    ->first();

                array_push($marketingDataFilter, $marketingAreaData);
            }

            $userMarketingData = marketingArea::where('user_id', Auth::user()->id)->get();

            $userChildData = [];

            foreach ($marketingDataFilter as $key => $item) {
                foreach($userMarketingData as $value) {
                    if($value->island_id == $item->island_id) {
                        array_push($userChildData,$item->user_id);
                    }
                }
            }

            array_push($userChildData, Auth::user()->id);

            $productData = [];

            foreach ($userChildData as $key => $item) {
                $userProductData = salesProduct::join('products','sales_products.product_id','=','products.id')
                                                ->where('sales_products.sales_id', $item)
                                                ->where('products.status',1)
                                                ->select('products.id','products.code','products.product_name','products.status','products.created_at','products.updated_at')
                                                ->get();

                foreach ($userProductData as $product) {
                    // Check if the product ID already exists in the $products array
                    $existingProduct = array_column($productData, 'id', 'id');

                    if (!isset($existingProduct[$product->id])) {
                        $productDetail = [
                            'id' => $product->id,
                            'code' => $product->code,
                            'product_name' => $product->product_name,
                            'status' => $product->status,
                            'created_at' => $product->created_at,
                            'updated_at' => $product->updated_at
                        ];

                        $productData[] = $productDetail;
                    }
                }
            }
        }else if(@Auth::user()->positions->level == 4) {
            foreach ($marketingAreaData as $key => $value) {
                if($value->island_id == null || $customerType == null) {
                    toast('Island, Regions and Customer Not Found','error');
                    return back();
                }
            }

            $positionUsers = User::select('users.id')
                    ->join('positions', 'users.position_unique', '=', 'positions.unique')
                    ->join('customer_groups', 'users.id', '=', 'customer_groups.user_id')
                    ->where('positions.level', '>', auth()->user()->positions->level)
                    ->where('customer_groups.customer_type_id', $customerType)
                    ->groupBy('users.id')
                    ->get();

            $marketingDataFilter = [];

            foreach ($positionUsers as $key => $item) {
                $userId = $item->id; // Accessing the 'id' property of the $item object

                $marketingAreaData = marketingArea::where('user_id', $userId)
                                                    ->select('island_id','region_id','city_id','user_id')
                                                    ->first();

                array_push($marketingDataFilter, $marketingAreaData);
            }

            $userMarketingData = marketingArea::where('user_id', Auth::user()->id)->get();

            $userChildData = [];

            foreach ($marketingDataFilter as $key => $item) {
                foreach($userMarketingData as $value) {
                    if($value->island_id == $item->island_id) {
                        array_push($userChildData,$item->user_id);
                    }
                }
            }

            array_push($userChildData, Auth::user()->id);

            $productData = [];

            foreach ($userChildData as $key => $item) {
                $userProductData = salesProduct::join('products','sales_products.product_id','=','products.id')
                                                ->where('sales_products.sales_id', $item)
                                                ->where('products.status',1)
                                                ->select('products.id','products.code','products.product_name','products.status','products.created_at','products.updated_at')
                                                ->get();

                foreach ($userProductData as $product) {
                    // Check if the product ID already exists in the $products array
                    $existingProduct = array_column($productData, 'id', 'id');

                    if (!isset($existingProduct[$product->id])) {
                        $productDetail = [
                            'id' => $product->id,
                            'code' => $product->code,
                            'product_name' => $product->product_name,
                            'status' => $product->status,
                            'created_at' => $product->created_at,
                            'updated_at' => $product->updated_at
                        ];

                        $productData[] = $productDetail;
                    }
                }
            }
        }else if(@Auth::user()->positions->level == 5) { // Supervisor
            foreach ($marketingAreaData as $key => $value) {
                if($value->island_id == null || $value->region_id == null || $customerType == null) {
                    toast('Island, Regions and Customer Not Found','error');
                    return back();
                }
            }


            $positionUsers = User::select('users.id')
                    ->join('positions', 'users.position_unique', '=', 'positions.unique')
                    ->join('customer_groups', 'users.id', '=', 'customer_groups.user_id')
                    ->where('positions.level', '>', auth()->user()->positions->level)
                    ->where('customer_groups.customer_type_id', $customerType)
                    ->groupBy('users.id')
                    ->get();

            $marketingDataFilter = [];

            foreach ($positionUsers as $key => $item) {
                $userId = $item->id; // Accessing the 'id' property of the $item object

                $marketingAreaData = marketingArea::where('user_id', $userId)
                                                    ->select('island_id','region_id','city_id','user_id')
                                                    ->first();

                array_push($marketingDataFilter, $marketingAreaData);
            }

            $userMarketingData = marketingArea::where('user_id', Auth::user()->id)->get();

            $userChildData = [];

            foreach ($marketingDataFilter as $key => $item) {
                foreach($userMarketingData as $value) {
                    if($value->island_id == $item->island_id && $value->region_id == $item->region_id) {
                        array_push($userChildData,$item->user_id);
                    }
                }
            }

           array_push($userChildData, Auth::user()->id);

           $productData = [];

            foreach ($userChildData as $key => $item) {
                $userProductData = salesProduct::join('products','sales_products.product_id','=','products.id')
                                                ->where('sales_products.sales_id', $item)
                                                ->where('products.status',1)
                                                ->select('products.id','products.code','products.product_name','products.status','products.created_at','products.updated_at')
                                                ->get();

                foreach ($userProductData as $product) {
                    // Check if the product ID already exists in the $products array
                    $existingProduct = array_column($productData, 'id', 'id');

                    if (!isset($existingProduct[$product->id])) {
                        $productDetail = [
                            'id' => $product->id,
                            'code' => $product->code,
                            'product_name' => $product->product_name,
                            'status' => $product->status,
                            'created_at' => $product->created_at,
                            'updated_at' => $product->updated_at
                        ];

                        $productData[] = $productDetail;
                    }
                }
            }
        }else{
            foreach ($marketingAreaData as $key => $value) {
                if($value->island_id == null || $value->region_id == null || $customerType == null) {
                    toast('Island, Regions and Customer Not Found','error');
                    return back();
                }
            }

            $productData = salesProduct::where('sales_id',Auth::user()->id)
                                        ->join('products','sales_products.product_id','products.id')
                                        ->select('products.id as id',
                                                'products.code as code',
                                                'products.product_name as product_name',
                                                'products.status as status',
                                                'products.created_at as created_at',
                                                'products.updated_at as updated_at')
                                        ->get();
        }

        return view('products.index',compact('productData'));
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
        $productName = $request->product;

        if($productName) {
            $productData = product::where('product_name', 'ILIKE', '%' . $productName . '%')
                                    ->where('status',$request->status)
                                    ->get();
        }else{
            $productData = product::where('product_name', 'ILIKE', '%' . $productName . '%')
                                ->where('status',$request->status)
                                ->take(10)
                                ->get();
        }

        $encryptedProductData = [];

        // Encrypting IDs in the customer data
        foreach ($productData as $item) {
            $encryptedProductData[] = [
                'idEncrypt' => Crypt::encryptString($item->id),
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroySalesProduct($id)
    {
        salesProduct::find($id)->delete();

        toast('Delete Has Been Successful','success');

        return back();
    }
}
