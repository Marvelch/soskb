<?php

namespace App\Http\Controllers;

use App\Charts\MonthlySalesOrdersChart;
use App\Models\customer;
use App\Models\product;
use App\Models\salesOrder;
use App\Models\User;
use Carbon\Carbon;
use DB;
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
    public function admin_home(MonthlySalesOrdersChart $chart)
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

        // Menghitung Total Customer Aktif
        $tatalCustomerActive = customer::count();

        // Menghitung Total Product Aktif
        $totalProductsActive = product::where('status',1)->count();

        // Hitung Total Product Aktif
        $totalProductsInactive = product::where('status',0)->count();

        // Calculate Customers
        $totalSalesThisMonthCust = customer::whereBetween('created_at', [$firstDayThisMonth, $lastDayThisMonth])->count();

        $totalSalesLastMonthCust = customer::whereBetween('created_at', [$firstDayLastMonth, $lastDayLastMonth])->count();

        $percentageDifferenceCust = 0;

        if ($totalSalesLastMonthCust > 0) {
            $percentageDifferenceCust = (($totalSalesThisMonthCust - $totalSalesLastMonthCust) / $totalSalesLastMonthCust) * 100;
        }

        // Data Users
        $users = User::count();

        return view('admin.home', [
            'totalProducts' => $totalProducts,
            'totalSalesOrder' => $totalSalesOrder,
            'totalCustomers' => $totalCustomers,
            'percentageDifference' => $percentageDifference,
            'percentageDifferenceCust' => $percentageDifferenceCust,
            'totalProductsActive' => $totalProductsActive,
            'totalProductsInactive' => $totalProductsInactive,
            'tatalCustomerActive' => $tatalCustomerActive,
            'users' => $users,
            'chart' => $chart->build() // Assuming $chart is the instance of MonthlySalesOrdersChart
        ]);
    }
}
