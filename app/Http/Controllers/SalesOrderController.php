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
use App\Models\customerGroup;
use App\Models\marketingArea;
use App\Models\salesCustomer;
use App\Models\salesProduct;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Models\unit;
use App\Models\User;
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
            $unique = UniqueSalesOrder();

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
        $level_id = @Auth::user()->positions->level;

        $onCheckMarketing = marketingArea::where('user_id',Auth::user()->id)->get();

        $onCheckCustomerGroup = @customerGroup::where('user_id',Auth::user()->id)->first();

        if(@Auth::user()->positions->level == 2) {

            $data = customer::where('name', 'ILIKE', '%' . $request->get('q') . '%')->get();

        }else if(@Auth::user()->positions->level == 3) {
            $userData = User::join('positions','users.position_unique','=','positions.unique')
                                ->where('positions.level','>=',$level_id)
                                ->select('users.id as id',
                                         'users.name as name',
                                         'positions.level as level',
                                         'positions.unique as unique')
                                ->get();

            $marketingData = [];

            foreach ($userData as $key => $value) {
                $marketingListUser = marketingArea::where('user_id',$value->id)->get();
                $customerGroup = customerGroup::where('user_id',$value->id)->first();

                foreach ($marketingListUser as $key => $item) {
                    $marketingData[] = [
                        'id' => $item->user_id,
                        'name' => $value->name,
                        'island' => $item->island_id,
                        'region' => $item->region_id,
                        'city' => $item->city_id,
                        'customer' => @$customerGroup->customer_type_id,
                        'sub_customer' => @$customerGroup->sub_customer_type_id
                    ];
                }
            }

            // Filtering for island, region and city searches according to criteria
            $filterDataMarketingArea = marketingArea::where('user_id',Auth::user()->id)->get();

            $filterDataMarketing = [];

            foreach ($marketingData as $key => $value) {
                foreach ($filterDataMarketingArea as $key => $filterValue) {
                    if($value['island'] == $filterValue->island_id ) {
                        $filterDataMarketing[] = [
                            'id' => $value['id'],
                            'name' => $value['name'],
                            'island' => $value['island'],
                            'region' => $value['region'],
                            'customer' => $value['customer'],
                            'sub_customer' => $value['sub_customer']
                        ];
                    }
                }
            }

            // return $filterCustomerGroup;

            $customerData = [];

            foreach ($filterDataMarketing as $key => $item) {
                $customer = salesCustomer::where('sales_id', $item['id'])->get();

                foreach ($customer as $key => $value) {
                    if ($value['customer_id']) {
                        $customerData[] = [
                            'customer_id' => $value['customer_id']
                        ];
                    }
                }
            }

            // Extract unique customer_id values
            $uniqueCustomerData = array_unique(array_column($customerData, 'customer_id'));

            // Reformat the data structure to match the original format
            $customerDataWithoutDuplicates = [];
            foreach ($uniqueCustomerData as $customerId) {
                $customerDataWithoutDuplicates[] = ['customer_id' => $customerId];
            }

            $data = [];
            $filterCustomerGroup = customerGroup::where('user_id', Auth::user()->id)->first();

            foreach ($customerDataWithoutDuplicates as $key => $value) {
                $customerDataExisting = customer::where('id', $value['customer_id'])
                    ->where('name', 'ILIKE', '%' . $request->get('q') . '%')
                    ->get();

                $customerGroupFilter = customer::where('id',$value['customer_id'])->first();

                if (
                    $customerGroupFilter['customer_type_id'] == $filterCustomerGroup->customer_type_id)
                    {
                        if ($customerDataExisting->isNotEmpty()) {
                            // Merge the results into the $data array
                            $data = array_merge($data, $customerDataExisting->toArray());
                        }
                    }
            }

            $data = array_filter($data);
        }else if(@Auth::user()->positions->level == 4) {
            $userData = User::join('positions','users.position_unique','=','positions.unique')
                                ->where('positions.level','>=',$level_id)
                                ->select('users.id as id',
                                         'users.name as name',
                                         'positions.level as level',
                                         'positions.unique as unique')
                                ->get();

            $marketingData = [];

            foreach ($userData as $key => $value) {
                $marketingListUser = marketingArea::where('user_id',$value->id)->get();
                $customerGroup = customerGroup::where('user_id',$value->id)->first();

                foreach ($marketingListUser as $key => $item) {
                    $marketingData[] = [
                        'id' => $item->user_id,
                        'name' => $value->name,
                        'island' => $item->island_id,
                        'region' => $item->region_id,
                        'city' => $item->city_id,
                        'customer' => @$customerGroup->customer_type_id,
                        'sub_customer' => @$customerGroup->sub_customer_type_id
                    ];
                }
            }

            // Filtering for island, region and city searches according to criteria
            $filterDataMarketingArea = marketingArea::where('user_id',Auth::user()->id)->get();

            $filterDataMarketing = [];

            foreach ($marketingData as $key => $value) {
                foreach ($filterDataMarketingArea as $key => $filterValue) {
                    if($value['island'] == $filterValue->island_id ) {
                        $filterDataMarketing[] = [
                            'id' => $value['id'],
                            'name' => $value['name'],
                            'island' => $value['island'],
                            'region' => $value['region'],
                            'customer' => $value['customer'],
                            'sub_customer' => $value['sub_customer']
                        ];
                    }
                }
            }

            // return $filterCustomerGroup;

            $customerData = [];

            foreach ($filterDataMarketing as $key => $item) {
                $customer = salesCustomer::where('sales_id', $item['id'])->get();

                foreach ($customer as $key => $value) {
                    if ($value['customer_id']) {
                        $customerData[] = [
                            'customer_id' => $value['customer_id']
                        ];
                    }
                }
            }

            // Extract unique customer_id values
            $uniqueCustomerData = array_unique(array_column($customerData, 'customer_id'));

            // Reformat the data structure to match the original format
            $customerDataWithoutDuplicates = [];
            foreach ($uniqueCustomerData as $customerId) {
                $customerDataWithoutDuplicates[] = ['customer_id' => $customerId];
            }

            $data = [];
            $filterCustomerGroup = customerGroup::where('user_id', Auth::user()->id)->first();

            foreach ($customerDataWithoutDuplicates as $key => $value) {
                $customerDataExisting = customer::where('id', $value['customer_id'])
                    ->where('name', 'ILIKE', '%' . $request->get('q') . '%')
                    ->get();

                $customerGroupFilter = customer::where('id',$value['customer_id'])->first();

                if (
                    $customerGroupFilter['customer_type_id'] == $filterCustomerGroup->customer_type_id)
                    {
                        if ($customerDataExisting->isNotEmpty()) {
                            // Merge the results into the $data array
                            $data = array_merge($data, $customerDataExisting->toArray());
                        }
                    }
            }

            $data = array_filter($data);
        }else if(@Auth::user()->positions->level == 5) {
            $userData = User::join('positions','users.position_unique','=','positions.unique')
                                ->where('positions.level','>=',$level_id)
                                ->select('users.id as id',
                                         'users.name as name',
                                         'positions.level as level',
                                         'positions.unique as unique')
                                ->get();

            $marketingData = [];

            foreach ($userData as $key => $value) {
                $marketingListUser = marketingArea::where('user_id',$value->id)->get();
                $customerGroup = customerGroup::where('user_id',$value->id)->first();

                foreach ($marketingListUser as $key => $item) {
                    $marketingData[] = [
                        'id' => $item->user_id,
                        'name' => $value->name,
                        'island' => $item->island_id,
                        'region' => $item->region_id,
                        'city' => $item->city_id,
                        'customer' => @$customerGroup->customer_type_id,
                        'sub_customer' => @$customerGroup->sub_customer_type_id
                    ];
                }
            }

            // Filtering for island, region and city searches according to criteria
            $filterDataMarketingArea = marketingArea::where('user_id',Auth::user()->id)->get();

            $filterDataMarketing = [];

            foreach ($marketingData as $key => $value) {
                foreach ($filterDataMarketingArea as $key => $filterValue) {
                    if($value['island'] == $filterValue->island_id && $value['region'] == $filterValue->region_id ) {
                        $filterDataMarketing[] = [
                            'id' => $value['id'],
                            'name' => $value['name'],
                            'island' => $value['island'],
                            'region' => $value['region'],
                            'customer' => $value['customer'],
                            'sub_customer' => $value['sub_customer']
                        ];
                    }
                }
            }

            // return $filterCustomerGroup;

            $customerData = [];

            foreach ($filterDataMarketing as $key => $item) {
                $customer = salesCustomer::where('sales_id', $item['id'])->get();

                foreach ($customer as $key => $value) {
                    if ($value['customer_id']) {
                        $customerData[] = [
                            'customer_id' => $value['customer_id']
                        ];
                    }
                }
            }

            // Extract unique customer_id values
            $uniqueCustomerData = array_unique(array_column($customerData, 'customer_id'));

            // Reformat the data structure to match the original format
            $customerDataWithoutDuplicates = [];
            foreach ($uniqueCustomerData as $customerId) {
                $customerDataWithoutDuplicates[] = ['customer_id' => $customerId];
            }

            $data = [];
            $filterCustomerGroup = customerGroup::where('user_id', Auth::user()->id)->first();

            foreach ($customerDataWithoutDuplicates as $key => $value) {
                $customerDataExisting = customer::where('id', $value['customer_id'])
                    ->where('name', 'ILIKE', '%' . $request->get('q') . '%')
                    ->get();

                $customerGroupFilter = customer::where('id',$value['customer_id'])->first();

                if (
                    $customerGroupFilter['customer_type_id'] == $filterCustomerGroup->customer_type_id &&
                    $customerGroupFilter['sub_customer_type_id'] == $filterCustomerGroup->sub_customer_type_id)
                    {
                        if ($customerDataExisting->isNotEmpty()) {
                            // Merge the results into the $data array
                            $data = array_merge($data, $customerDataExisting->toArray());
                        }
                    }
            }

            $data = array_filter($data);

        }else{

            $userData = User::join('sales_customers','users.id','=','sales_customers.sales_id')
                                ->where('users.id','=',Auth::user()->id)
                                ->select('users.id as id')
                                ->get();

            $userData = User::join('sales_customers','users.id','=','sales_customers.sales_id')
                                ->where('users.id','=',Auth::user()->id)
                                ->select('users.id as id')
                                ->get();

            $marketingData = [];

            foreach ($userData as $key => $value) {
                $marketingListUser = marketingArea::where('user_id',$value->id)->get();
                $customerGroup = customerGroup::where('user_id',$value->id)->first();

                foreach ($marketingListUser as $key => $item) {
                    $marketingData[] = [
                        'id' => $item->user_id,
                        'name' => $value->name,
                        'island' => $item->island_id,
                        'region' => $item->region_id,
                        'city' => $item->city_id,
                        'customer' => @$customerGroup->customer_type_id,
                        'sub_customer' => @$customerGroup->sub_customer_type_id
                    ];
                }
            }

            // Filtering for island, region and city searches according to criteria
            $filterDataMarketingArea = marketingArea::where('user_id',Auth::user()->id)->get();

            $filterDataMarketing = [];

            foreach ($marketingData as $key => $value) {
                foreach ($filterDataMarketingArea as $key => $filterValue) {
                    if($value['island'] == $filterValue->island_id && $value['region'] == $filterValue->region_id && $value['city'] == $filterValue->city_id) {
                        $filterDataMarketing[] = [
                            'id' => $value['id'],
                            'name' => $value['name'],
                            'island' => $value['island'],
                            'region' => $value['region'],
                            'city' => $value['city'],
                            'customer' => $value['customer'],
                            'sub_customer' => $value['sub_customer']
                        ];
                    }
                }
            }

            $customerData = [];

            foreach ($filterDataMarketing as $key => $item) {
                $customer = salesCustomer::where('sales_id', $item['id'])->get();

                foreach ($customer as $key => $value) {
                    if ($value['customer_id']) {
                        $customerData[] = [
                            'customer_id' => $value['customer_id']
                        ];
                    }
                }
            }

            // Extract unique customer_id values
            $uniqueCustomerData = array_unique(array_column($customerData, 'customer_id'));

            // Reformat the data structure to match the original format
            $customerDataWithoutDuplicates = [];
            foreach ($uniqueCustomerData as $customerId) {
                $customerDataWithoutDuplicates[] = ['customer_id' => $customerId];
            }

            $data = [];

            $filterCustomerGroup = customerGroup::where('user_id',Auth::user()->id)->first();

            foreach ($customerDataWithoutDuplicates as $key => $value) {
                $customer = customer::where('id',$value['customer_id'])
                                ->where('name', 'ILIKE', '%' . $request->get('q') . '%')
                                ->first();

                if($customer) {
                    $data[] = $customer;
                }
            }
        }

        return response()->json($data);
    }

    /**
     * Company data search for autocomplate.
     */
    public function searchProducts(Request $request)
    {
        $marketingAreaData = marketingArea::where('user_id',Auth::user()->id)->get();

        $customerType = @Auth::user()->customers->customer_type_id;
        $subCustomerType = @Auth::user()->subCustomers->sub_customer_type_id;

        $level = @Auth::user()->positions->level;

        if(@Auth::user()->positions->level == 2) {
            $productData = product::all();
        }else if(@Auth::user()->positions->level == 3) {
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
                                                ->where('products.product_name', 'ILIKE', '%' . $request->get('q') . '%')
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
                                                ->where('products.product_name', 'ILIKE', '%' . $request->get('q') . '%')
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
        }else if(@Auth::user()->positions->level == 5) {

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
                                                ->where('products.product_name', 'ILIKE', '%' . $request->get('q') . '%')
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
                                        ->where('product_name', 'ILIKE', '%' . $request->get('q') . '%')
                                        ->select('products.id as id',
                                                'products.code as code',
                                                'products.product_name as product_name',
                                                'products.status as status',
                                                'products.created_at as created_at',
                                                'products.updated_at as updated_at')
                                        ->get();
        }

        return response()->json($productData);
    }

    /**
     * Show all transaction sales orders.
     */
    public function transaction(Request $request)
    {
        $transactions = salesOrder::where('created_by',Auth::user()->id)->orderBy('created_at','desc')->get();

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
            salesOrder::where('id_transaction',Crypt::decryptString($id))->update([
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
                                    ->where('customers.name', 'ILIKE', '%' . $request['customer'] . '%')
                                    ->whereBetween('sales_orders.so_date', [$request['start'], $request['end']])
                                    ->where('sales_orders.status',$request['status'])
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

    public function destoryTemporaryProducts(Request $request)
    {
        DB::beginTransaction();

        try {
            productTemp::where('user_id',Auth::user()->id)->delete();

            DB::commit();

            toast('Data deletion Been Successful','success');

            return response()->json([
                'success' => true,
            ]);
        } catch (\Throwable $th) {
            toast('Data deletion was unsuccessful','error');

            return response()->json([
                'error' => false,
            ]);
        }
    }
}
