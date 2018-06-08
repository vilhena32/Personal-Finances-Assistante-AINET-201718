<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use App\Movement;
use DB;
use Charts;
use Auth;
use App\User;


class ChartController extends Controller
{
    public function index(Request $request, $id)
    {
            // recebe id da conta  Request $request, $id $request->input('dataI') $request->input('dataF')

        $moves = Movement::where('account_id',$id)->whereBetween('date', [$request->input('dataI'), $request->input('dataF')]);

       //dd($moves);


    	//$products = Product::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();   Movement::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
       // $chart = Charts::database('movements', 'bar', 'highcharts')
		//	      ->title("Revenues and Expenses")
		//	      ->elementLabel("Number of Expenses/Revenues")
		//	      ->dimensions(1000, 500)
		//	      ->responsive(true)
		//	      ->groupBy('movement_category_id');


        // $users = Movement::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->whereBetween('date',[$request->input('dataI'), $request->input('dataF')])
        //             ->get();
        // $chart = Charts::database($users, 'bar', 'highcharts')
        //           ->title("Movements")
        //           ->elementLabel("Total Users")
        //           ->dimensions(1000, 500)
        //           ->responsive(false)
        //           ->groupByMonth(date('Y'), true);

        $moves = Movement::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->whereBetween('date',[$request->input('dataI'), $request->input('dataF')])
        ->get();
        $exp= Movement::whereBetween('date',[$request->input('dataI'), $request->input('dataF')])->whereBetween('movement_category_id',[1,7])->get();
        $rev= Movement::whereBetween('date',[$request->input('dataI'), $request->input('dataF')])->whereBetween('movement_category_id',[8,14])->get();
        //d($exp);
        $e=0;
        $r=0;
        foreach($exp as $a)
        {
            
            $e=$e+$a->value;
        }

        foreach($rev as $b)
        {
            
            $r=$r+$b->value;
        }
        //dd($r);
        $chart =Charts::create('pie', 'highcharts')
        ->title('My nice chart')
        ->labels(['Expenses', 'Revenues'])
        ->values([$e,$r])
        ->dimensions(1000,500)
        ->responsive(false);

        return view('charts',compact('chart'));
    }
}