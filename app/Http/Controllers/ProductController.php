<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = product::all();

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
    public function index_admin(Request $request)
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

        return response()->json(['productData' => $productData]);
    }

    /**
     * Searching products
     */
    public function sales_products($id)
    {
        $products = product::find(Crypt::decryptString($id));

        return view('admin.products.sales',compact('products'));
    }
}
