<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use App\Movement;
use DB;
use Charts;

class ChartController extends Controller
{
    public function index(Request $request, $id)
    {
            // recebe id da conta  Request $request, $id $request->input('dataI') $request->input('dataF')
      
        $moves = Movement::where('account_id',2)->whereBetween('date', [$request->input('dataI'), $request->input('dataF')])->get();



    	//$products = Product::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $chart = Charts::database($moves, 'bar', 'highcharts')
			      ->title("Revenues and Expenses")
			      ->elementLabel("Number of Expenses/Revenues")
			      ->dimensions(1000, 500)
			      ->responsive(true)
			      ->groupByMonth(date('Y'), true);

        return view('charts',compact('chart'));
    }
}