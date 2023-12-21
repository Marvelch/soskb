<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\customer;
use App\Models\customerGroup;
use App\Models\customerTemp;
use App\Models\customerType;
use App\Models\island;
use App\Models\marketingArea;
use App\Models\product;
use App\Models\region;
use App\Models\salesCustomer;
use App\Models\subCustomerType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use DB;
use Auth;

use function PHPUnit\Framework\isEmpty;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $level_id = @Auth::user()->positions->level;

        $onCheckMarketing = marketingArea::where('user_id',Auth::user()->id)->get();

        $onCheckCustomerGroup = @customerGroup::where('user_id',Auth::user()->id)->first();

        if(@Auth::user()->positions->level == 2) {

            $customers = customer::all();

        }else if(@Auth::user()->positions->level == 3) {
            if(count($onCheckMarketing) <= 0 || $onCheckCustomerGroup == null) {
                toast('Data is not complete','error');

                return back();
            }

            foreach ($onCheckMarketing as $key => $item) {
                if(@$item->island_id == null || @$onCheckCustomerGroup->customer_type_id == null) {
                    toast('Island Or Customer Not Found','error');

                    return back();
                }
            }

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
                        'customer' => $customerGroup->customer_type_id,
                        'sub_customer' => $customerGroup->sub_customer_type_id
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

            $customers = [];

            $filterCustomerGroup = customerGroup::where('user_id',Auth::user()->id)->first();

            foreach ($customerDataWithoutDuplicates as $key => $value) {
                $customer = customer::find($value['customer_id']);

                if($customer->customer_type_id == $filterCustomerGroup->customer_type_id)
                {
                    $customers[] = $customer;
                }
            }
        }else if(@Auth::user()->positions->level == 4) {
            if(count($onCheckMarketing) <= 0 || $onCheckCustomerGroup == null) {
                toast('Data is not complete','error');

                return back();
            }

            foreach ($onCheckMarketing as $key => $item) {
                if(@$item->island_id == null || @$onCheckCustomerGroup->customer_type_id == null) {
                    toast('Island Or Customer Not Found','error');

                    return back();
                }
            }

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
                        'customer' => $customerGroup->customer_type_id,
                        'sub_customer' => $customerGroup->sub_customer_type_id
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

            $customers = [];

            $filterCustomerGroup = customerGroup::where('user_id',Auth::user()->id)->first();

            foreach ($customerDataWithoutDuplicates as $key => $value) {
                $customer = customer::find($value['customer_id']);

                if($customer->customer_type_id == $filterCustomerGroup->customer_type_id)
                {
                    $customers[] = $customer;
                }
            }
        }else if(@Auth::user()->positions->level == 5) {
            if(count($onCheckMarketing) <= 0 || $onCheckCustomerGroup == null) {
                toast('Data is not complete','error');

                return back();
            }

            foreach ($onCheckMarketing as $key => $item) {
                if(@$item->island_id == null || @$item->region_id == null || @$onCheckCustomerGroup->customer_type_id == null || @$onCheckCustomerGroup->sub_customer_type_id == null) {
                    toast('Island ,Regions, City, Customer and Sub Customer Group Not Found','error');

                    return back();
                }
            }

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
                        'customer' => $customerGroup->customer_type_id,
                        'sub_customer' => $customerGroup->sub_customer_type_id
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

            $customers = [];

            $filterCustomerGroup = customerGroup::where('user_id',Auth::user()->id)->first();

            foreach ($customerDataWithoutDuplicates as $key => $value) {
                $customer = customer::find($value['customer_id']);

                if($customer->customer_type_id == $filterCustomerGroup->customer_type_id && $customer->sub_customer_type_id == $filterCustomerGroup->sub_customer_type_id)
                {
                    $customers[] = $customer;
                }
            }
        }else{
            if(count($onCheckMarketing) <= 0 || $onCheckCustomerGroup == null) {
                toast('Data is not complete','error');

                return back();
            }

            foreach ($onCheckMarketing as $key => $item) {
                if(@$item->island_id == null || @$item->region_id == null || @$item->city_id == null || @$onCheckCustomerGroup->customer_type_id == null || @$onCheckCustomerGroup->sub_customer_type_id == null) {
                    toast('Island ,Regions, City, Customer and Sub Customer Group Not Found','error');

                    return back();
                }
            }

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
                        'customer' => $customerGroup->customer_type_id,
                        'sub_customer' => $customerGroup->sub_customer_type_id
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

            $customers = [];

            $filterCustomerGroup = customerGroup::where('user_id',Auth::user()->id)->first();

            foreach ($customerDataWithoutDuplicates as $key => $value) {
                $customer = customer::find($value['customer_id']);

                if($customer->customer_type_id == $filterCustomerGroup->customer_type_id && $customer->sub_customer_type_id == $filterCustomerGroup->sub_customer_type_id)
                {
                    $customers[] = $customer;
                }
            }
        }

        // return $customerData;
        return view('customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customerData = customerType::all();

        $regionData = region::all();

        return view('admin.customers.create',compact('customerData','islandData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_number' => 'required',
            'name' => 'required|unique:customers',
            'address' => 'required',
            'customer_type_id' => 'required',
            'sub_customer_type_id' => 'required',
            'region_id' => 'required',
            'city_id' => 'required'
        ]);

        DB::beginTransaction();

        try {
            customer::create([
                'customer_number' => $request->customer_number,
                'name' => $request->name,
                'address' => $request->address,
                'customer_type_id' => $request->customer_type_id,
                'sub_customer_type_id' => $request->customer_type_id,
                'region_id' => $request->region_id,
                'city_id' => $request->city_id,
                'created_by' => Auth::user()->id
            ]);

            DB::commit();

            toast('Transaction Has Been Successful','success');

            return redirect()->route('admin.customers.index');
        } catch (\Throwable $th) {

            DB::rollback();

            toast($th->getMessage(),'error');

            return back();
        }
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

    public function searchingCustomers(Request $request)
    {
        $customerData = customer::where('name', 'ILIKE', '%' . $request->customer . '%')
                                ->where('status', $request->status)
                                ->get();

        $encryptedCustomerData = [];

        foreach ($customerData as $customer) {
            $encryptedCustomerData[] = [
                'idEncrypt' => Crypt::encryptString($customer->id),
                'id' => Crypt::encryptString($customer->id),
                'customer_number' => $customer->customer_number,
                'name' => $customer->name,
                'address' => $customer->address,
                'customer_type_id' => $customer->customer_type_id,
                'status' => $customer->status,
                'created_at' => $customer->created_at
            ];
        }

        return response()->json(['customerData' => $encryptedCustomerData]);
    }

    /**
     * Display a listing of the resource.
     */
    public function searchingSubCustomersType(Request $request)
    {
        $data = subCustomerType::where('name', 'ILIKE', '%' . $request->get('q') . '%')
                                ->where('customer_type_id',$request->customer)
                                ->get();

        return response()->json($data);
    }

     /**
     * City search from area value
     */
    public function searchingCity(Request $request)
    {
        $data = city::where('city_name', 'ILIKE', '%' . $request->get('q') . '%')
                            ->where('region_id',$request->region)
                            ->get();

        return response()->json($data);
    }

    /**
     * City search from area value
     */
    public function searchingRegion(Request $request)
    {
        $data = region::where('region_name', 'ILIKE', '%' . $request->get('q') . '%')
                            ->where('island',$request->island)
                            ->get();

        return response()->json($data);
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

    public function edit_admin(customer $customer, $id)
    {

        $customerDataUsers = customer::where('id',Crypt::decryptString($id))->first();

        $customerData = customerType::all();

        $islandData = island::all();

        $regionData = region::all();

        $sales = user::all();

        return view('admin.customers.edit',compact('customerData','islandData','regionData','customerDataUsers','sales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_admin(Request $request, $id)
    {
        $request->validate([
            'customer_number' => 'required',
            'name' => 'required',
            'address' => 'required',
            'customer_type_id' => 'required',
            'sub_customer_type_id' => 'required',
            'region_id' => 'required',
            'city_id' => 'required'
        ]);

        DB::beginTransaction();

        try {
            customer::find(Crypt::decryptString($id))->update([
                'customer_number' => $request->customer_number,
                'name' => $request->name,
                'address' => $request->address,
                'customer_type_id' => $request->customer_type_id,
                'sub_customer_type_id' => $request->customer_type_id,
                'island_id' => $request->island_id,
                'region_id' => $request->region_id,
                'city_id' => $request->city_id,
                'changed_by' => Auth::user()->id
            ]);

            DB::commit();

            toast('Transaction Has Been Successful','success');

            return redirect()->route('admin.customers.index');
        } catch (\Throwable $th) {

            DB::rollback();

            toast($th->getMessage(),'error');

            return back();
        }
    }
}
