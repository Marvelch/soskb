<?php

namespace App\Charts;

use Illuminate\Support\Facades\DB; // Import DB facade
use ArielMejiaDev\LarapexCharts\PieChart; // Import the correct namespace for PieChart
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlySalesOrdersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): PieChart // Use the correct return type
    {
         // Calculate the start and end dates for the last 3 months
        $lastThreeMonths = now()->subMonths(3);
        $currentMonth = now();

        $data = DB::table('sales_orders')
            ->select(
                DB::raw('EXTRACT(YEAR FROM so_date) as year'),
                DB::raw('EXTRACT(MONTH FROM so_date) as month'),
                DB::raw('COUNT(*) as total_transactions')
            )
            ->where('status', 3)
            ->whereBetween('so_date', [$lastThreeMonths, $currentMonth])
            ->groupBy(DB::raw('EXTRACT(YEAR FROM so_date)'), DB::raw('EXTRACT(MONTH FROM so_date)'))
            ->get();

        // Process $data to build the chart dynamically
        $labels = [];
        $values = [];

        foreach ($data as $row) {
            $labels[] = date("M", mktime(0, 0, 0, $row->month, 1));
            $values[] = $row->total_transactions;
        }

        return $this->chart->pieChart()
            ->setTitle('Laporan Transaksi Sales')
            ->setSubtitle('Season 2024.')
            ->addData($values)
            ->setLabels($labels);
    }
}
