<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use Charts;
use DB;

class ChartController extends Controller
{
    public function index()
    {
    	$products = Product::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $chart = Charts::database($products, 'bar', 'highcharts')
			      ->title("Revenues and Expenses")
			      ->elementLabel("Total Categorys")
			      ->dimensions(1000, 500)
			      ->responsive(true)
			      ->groupByMonth(date('Y'), true);

        return view('charts',compact('chart'));
    }
}