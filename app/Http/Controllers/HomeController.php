<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\product;
use App\Models\salesOrder;
use Carbon\Carbon;
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

        $firstDayThisMonth = Carbon::now()->startOfMonth();
        $lastDayThisMonth = Carbon::now()->endOfMonth();

        $firstDayLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $lastDayLastMonth = Carbon::now()->subMonth()->endOfMonth();

        // Calculate Sales Orders
        $totalSalesThisMonth = SalesOrder::whereBetween('created_at', [$firstDayThisMonth, $lastDayThisMonth])->count();

        $totalSalesLastMonth = SalesOrder::whereBetween('created_at', [$firstDayLastMonth, $lastDayLastMonth])->count();

        $percentageDifference = 0;

        if ($totalSalesLastMonth > 0) {
            $percentageDifference = (($totalSalesThisMonth - $totalSalesLastMonth) / $totalSalesLastMonth) * 100;
        }

        // Calculate Customers
        $totalSalesThisMonthCust = customer::whereBetween('created_at', [$firstDayThisMonth, $lastDayThisMonth])->count();

        $totalSalesLastMonthCust = customer::whereBetween('created_at', [$firstDayLastMonth, $lastDayLastMonth])->count();

        $percentageDifferenceCust = 0;

        if ($totalSalesLastMonthCust > 0) {
            $percentageDifferenceCust = (($totalSalesThisMonthCust - $totalSalesLastMonthCust) / $totalSalesLastMonthCust) * 100;
        }

        // Product active or non active

        $productActive = product::where('status',1)->count();

        $productNonActive = product::where('status',0)->count();

        return view('admin.home',compact('totalProducts','totalSalesOrder','totalCustomers','percentageDifference','percentageDifferenceCust','productActive','productNonActive'));
    }
}
