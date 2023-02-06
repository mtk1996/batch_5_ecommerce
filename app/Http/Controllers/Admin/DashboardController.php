<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Order;
use App\Models\Outcome;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show()
    {
        $userCount = User::count();
        $currentDay = date('d');
        $currentMonthh = date('m'); //int
        $currentYear = date('Y');
        $currentMonth = date('F');

        $monthArr = [$currentMonth];

        $last6Day = [$currentDay];
        $last6DayArr = [
            [
                'year' => $currentYear,
                'month' => $currentMonthh,
                'day' => $currentDay,
            ]
        ];


        $yearMonth = [
            ['year' => $currentYear, 'month' => $currentMonthh]
        ];


        for ($i = 1; $i <= 5; $i++) { // 1    2    3 ...  5
            $monthArr[] =  date('F', strtotime("-$i month")); //1 feb   2  jan    3Dec

            $yearMonth[] = [
                'year' => date('Y', strtotime("-$i month")),
                'month' => date('m', strtotime("-$i month")),
            ];

            $last6Day[] = date('d', strtotime("-$i day"));

            $last6DayArr[] = [
                'year' => date('Y', strtotime("-$i day")),
                'month' =>  date('m', strtotime("-$i day")),
                'day' => date('d', strtotime("-$i day")),
            ];
        }



        $orderCount = [];
        foreach ($yearMonth as $ym) {
            $orderCount[] = Order::whereYear('created_at', $ym['year'])->whereMonth('created_at', $ym['month'])->count();
        }

        $totalIncome = [];
        $totalOutcome = [];
        foreach ($last6DayArr as $d) {
            $totalIncome[]  =   Income::whereYear('created_at', $d['year'])->whereMonth('created_at', $d['month'])->whereDay('created_at', $d['day'])->sum('amount');
            $totalOutcome[]  =   Outcome::whereYear('created_at', $d['year'])->whereMonth('created_at', $d['month'])->whereDay('created_at', $d['day'])->sum('amount');
        }





        /*
            Income Outcome Sum Price
        */
        $totalIncomeCount = Income::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->whereDay('created_at', $currentDay)
            ->sum('amount');
        $totalOutcomeCount = Outcome::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->whereDay('created_at', $currentDay)
            ->sum('amount');

        $totalProductCount =  Product::count();

        return view('admin.dashboard', compact(
            'userCount',
            'totalIncomeCount',
            'totalOutcomeCount',
            'totalProductCount',
            'monthArr',
            'orderCount',
            'last6Day',
            'totalIncome',
            'totalOutcome',
        ));
    }
}
