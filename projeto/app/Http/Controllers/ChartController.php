<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use App\Movement;
use ConsoleTVs\Charts\Charts;
use DB;

class ChartController extends Controller
{
    public function index()
    {

        // recebe id da conta  Request $request, $id $request->input('dataI) $request->input('dataF')
       

        $moves = Movement::where('account_id',2)->whereBetween('date', ['2018-06-6','2018-06-16' ])->get();



    	//$products = Product::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $chart = Charts::database($moves, 'bar', 'highcharts')
			      ->title("Revenues and Expenses")
			      ->elementLabel("Total Categorys")
			      ->dimensions(1000, 500)
			      ->responsive(true)
			      ->groupByMonth(date('Y'), true);

        return view('charts',compact('chart'));
    }
}