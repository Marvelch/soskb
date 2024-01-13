<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\report;
use App\Models\salesOrder;
use App\Models\salesOrderDetail;
use Illuminate\Http\Request;
use Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reports.index');
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
    public function reportData(Request $request)
    {
        $totalProductSalesOrderData = salesOrder::where('created_by',Auth::user()->id)
                                    ->whereBetween('so_date',[date('Y-m-d',strtotime($request->start)),date('Y-m-d',strtotime($request->end))])
                                    ->where('status',2)
                                    ->count();

        return response()->json($totalProductSalesOrderData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $productSalesOrderData = salesOrder::where('created_by',Auth::user()->id)
                                    ->whereBetween('so_date',[date('Y-m-d',strtotime($request->start)),date('Y-m-d',strtotime($request->end))])
                                    ->where('status',2)
                                    ->get();
        $productListId = [];

        foreach ($productSalesOrderData as $item) {
            foreach ($item->salesOrderDetails as $value) {
                $productId = $value->product_id;
                $qty = $value->qty;
                $unit = $value->unit_id;

                // Check if the product_id exists in $productListId
                if(array_key_exists($productId, $productListId)) {
                    // If it exists, update the quantity
                    $productListId[$productId]['qty'] += $qty;
                    $productListId[$productId]['unit'] = $unit;
                } else {
                    // If it doesn't exist, add the product_id as key and quantity as value
                    $productListId[$productId] = [
                        'qty' => $qty,
                        'unit' => $unit,
                    ];
                }
            }
        }

        $products = [];

        $id = 0;

        foreach ($productListId as $key => $value) {

            $productData = product::where('id',$key)->first();

            $productDetail = [
                'id' => $id,
                'product_name' => $productData->product_name,
                'detail' => $value,
            ];

            array_push($products,$productDetail);

            $id++;
        }

        return response()->json($products);
    }

    /**
     * Display the specified resource customer data.
     */
    public function showCustomerData(Request $request)
    {
        $customerSalesOrderData = salesOrder::where('created_by',Auth::user()->id)
                                    ->whereBetween('so_date',[date('Y-m-d',strtotime($request->start)),date('Y-m-d',strtotime($request->end))])
                                    ->where('status',2)
                                    ->get();
        $customerListName = [];

        foreach ($customerSalesOrderData as $key => $item) {
            foreach ($item->salesOrderCustomerDetails as $value) {

                $customerName = $value->name;

                $key = array_search($customerName, $customerListName);

                if ($key !== true) {
                    array_push($customerListName, $value->name);
                }
            }
        }

        return response()->json($customerListName);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(report $report)
    {
        //
    }
}
