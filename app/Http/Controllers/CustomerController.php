<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\customer;
use App\Models\customerTemp;
use App\Models\customerType;
use App\Models\product;
use App\Models\region;
use App\Models\salesCustomer;
use App\Models\subCustomerType;
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
        $level = @Auth::user()->positions->level;
        $region_id = @Auth::user()->region_id;
        $customer_id = @Auth::user()->customer_type_id;
        $sub_customer_id = @Auth::user()->sub_customer_type_id;
        $city_id = @Auth::user()->city_id;
        $user_id = @Auth::user()->id;

        if(@Auth::user()->positions->level == 2) {

            $customers = User::join('positions','users.position_unique','=','positions.unique')
                            ->join('sales_customers','users.id','=','sales_customers.sales_id')
                            ->join('customers','sales_customers.customer_id','=','customers.id')
                            ->where('positions.level','>=',$level)
                            ->select('customers.id as id',
                                     'customers.name as name',
                                     'customers.customer_number as customer_number',
                                     'customers.status as status',
                                     'customers.created_at as created_at')
                            ->groupBy('customers.id')
                            ->get();

        }else if(@Auth::user()->positions->level == 3) {
            if($region_id == null || $customer_id == null || $sub_customer_id == null) {
                toast('Regions, City, Customer and Sub Customer Type Not Found','error');

                return back();
            }

            $customers = User::join('positions','users.position_unique','=','positions.unique')
                            ->join('sales_customers','users.id','=','sales_customers.sales_id')
                            ->join('customers','sales_customers.customer_id','=','customers.id')
                            ->where('positions.level','>=',$level)
                            ->where('customers.customer_type_id','=',$customer_id)
                            ->select('customers.id as id',
                                     'customers.name as name',
                                     'customers.customer_number as customer_number',
                                     'customers.status as status',
                                     'customers.created_at as created_at')
                            ->groupBy('customers.id')
                            ->get();

        }else if(@Auth::user()->positions->level == 4) {
            if($region_id == null || $customer_id == null || $sub_customer_id == null) {
                toast('Regions, City, Customer and Sub Customer Type Not Found','error');

                return back();
            }

            $customers = User::join('positions','users.position_unique','=','positions.unique')
                            ->join('sales_customers','users.id','=','sales_customers.sales_id')
                            ->join('customers','sales_customers.customer_id','=','customers.id')
                            ->where('positions.level','>=',$level)
                            ->where('customers.customer_type_id','=',$customer_id)
                            ->where('customers.sub_customer_type_id','=',$sub_customer_id)
                            ->where('customers.region_id','=',$region_id)
                            ->select('customers.id as id',
                                     'customers.name as name',
                                     'customers.customer_number as customer_number',
                                     'customers.status as status',
                                     'customers.created_at as created_at')
                            ->groupBy('customers.id')
                            ->get();
        }else if(@Auth::user()->positions->level == 5) {
            if($region_id == null || $city_id == null || $customer_id == null || $sub_customer_id == null) {
                toast('Regions, City, Customer and Sub Customer Type Not Found','error');

                return back();
            }

            $customers = User::join('positions','users.position_unique','=','positions.unique')
                            ->join('sales_customers','users.id','=','sales_customers.sales_id')
                            ->join('customers','sales_customers.customer_id','=','customers.id')
                            ->where('positions.level','>=',$level)
                            ->where('customers.customer_type_id','=',$customer_id)
                            ->where('customers.sub_customer_type_id','=',$sub_customer_id)
                            ->where('customers.region_id','=',$region_id)
                            ->where('customers.city_id','=',$city_id)
                            ->select('customers.id as id',
                                     'customers.name as name',
                                     'customers.customer_number as customer_number',
                                     'customers.status as status',
                                     'customers.created_at as created_at')
                            ->groupBy('customers.id')
                            ->get();
        }else{
            $customers = User::join('positions','users.position_unique','=','positions.unique')
                            ->join('sales_customers','users.id','=','sales_customers.sales_id')
                            ->join('customers','sales_customers.customer_id','=','customers.id')
                            ->where('positions.level','=',$level)
                            ->where('users.id','=',Auth::user()->id)
                            ->select('customers.id as id',
                                     'customers.name as name',
                                     'customers.customer_number as customer_number',
                                     'customers.status as status',
                                     'customers.created_at as created_at')
                            ->groupBy('customers.id')
                            ->get();
        }

        return view('customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customerData = customerType::all();

        $regionData = region::all();

        return view('admin.customers.create',compact('customerData','regionData'));
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

            // toast($th->getMessage(),'error');

            // return back();

            return $th;

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

    public function searchingCustomers(Request $request)
    {
        $customerData = customer::where('name', 'ILIKE', '%' . $request->customer . '%')
                                ->where('status', $request->status)
                                ->get();

        $encryptedCustomerData = [];

        // Encrypting IDs in the customer data
        foreach ($customerData as $customer) {
            $encryptedCustomerData[] = [
                'id' => Crypt::encryptString($customer->id),
                'customer_number' => $customer->customer_number,
                'name' => $customer->name,
                'address' => $customer->address,
                'customer_type_id' => $customer->customer_type_id,
                'status' => $customer->status,
                'created_at' => $customer->created_at
                // Add other customer properties as needed
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
