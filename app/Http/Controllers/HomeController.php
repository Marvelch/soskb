<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\product;
use App\Models\salesOrder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin_home()
    {
        $totalProducts = product::count();
        $totalSalesOrder = salesOrder::count();
        $totalCustomers = customer::count();

        return view('admin.home',compact('totalProducts','totalSalesOrder','totalCustomers'));
    }
}
