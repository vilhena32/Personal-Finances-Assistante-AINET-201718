<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use App\Movement;
use DB;
use Charts;
use Auth;


class ChartController extends Controller
{
    public function index(Request $request, $id)
    {
            // recebe id da conta  Request $request, $id $request->input('dataI') $request->input('dataF')
        $moves = Movement::where('account_id',$id)->whereBetween('date',[$request->input('dataI'), $request->input('dataF')]);

       dd($moves);


    	//$products = Product::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $chart = Charts::database($moves, 'bar', 'highcharts')
			      ->title("Revenues and Expenses")
			      ->elementLabel("Number of Expenses/Revenues")
			      ->dimensions(1000, 500)
			      ->responsive(true)
			      ->groupBy('movement_category_id');

        return view('charts',compact('chart'));
    }
}