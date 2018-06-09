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

        

       //dd($id);


    	
        // $exp= Movement::whereBetween('date',[$request->input('dataI'), $request->input('dataF')])->whereBetween('movement_category_id',[1,7])
        // ->where('account_id',$id)->get();
        // $rev= Movement::whereBetween('date',[$request->input('dataI'), $request->input('dataF')])->whereBetween('movement_category_id',[8,14])->where('account_id',$id)->get(); 
        // //d($exp);
        // $e=0;
        // $r=0;
        // foreach($exp as $a)
        // {
            
        //     $e=$e+$a->value;
        // }

        // foreach($rev as $b)
        // {
            
        //     $r=$r+$b->value;
        // }
        // //dd($r);
        // $chart =Charts::create('pie', 'highcharts')
        // ->title('My nice chart')
        // ->labels(['Expenses', 'Revenues'])
        // ->values([$e,$r])
        // ->dimensions(1000,500)
        // ->responsive(false);


        // $chart = Charts::database(Account::all(), 'bar', 'highcharts')
        //     ->setElementLabel("id")
        //     ->setDimensions(1000, 500)
        //     ->setResponsive(false)
        //     ->groupBy('account_id');

        $accounts = Auth::user()->accounts;
       // dd($accounts);
               // Percentagem = (Conta/BalancoTotal)*100 
        //users = DB::table('users')
//   ->select(DB::raw("
//   name,
//   surname,  
//   (CASE WHEN (gender = 1) THEN 'M' ELSE 'F' END) as gender_text")
//$users  = DB::select('select * from users where admin = ?', [1])->groupBy('admin');
                     //->where('status', '<>', 1)
                     
 //                    ->get();
    
    $items = DB::table('users')
                     ->select(DB::raw('id,admin'))
                     //->where('admin', '<>', 1)
                     //->groupBy('admin')
                     ->get();
 
           

            $chart = Charts::database($items, 'pie', 'highcharts')

                  ->title("Total Balance")

                  ->elementLabel("Total Accounts")

                  ->dimensions(1000, 500)

                  ->responsive(false)

                  ->groupBy('id', true);
 
                    

       //  $chart = Charts::database($acc, 'bar', 'highcharts')

        //           ->title("Monthly new Register Users")

        //           ->elementLabel("Total Users")

        //           ->dimensions(1000, 500)

        //           ->responsive(false);

        //          // ->groupBy('id', true);

        return view('charts',compact('chart'));
    }



    public function myGlobal(Request $request, $id)
    {
            

        $exp= Movement::whereBetween('date',[$request->input('dataI'), $request->input('dataF')])->whereBetween('movement_category_id',[1,7])
        ->where('account_id',$id)->get();
        $rev= Movement::whereBetween('date',[$request->input('dataI'), $request->input('dataF')])->whereBetween('movement_category_id',[8,14])->where('account_id',$id)->get();     
        //dd($exp);

        
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


    public function myChart($id)
    {
        //total balance of all accounts percentage for each ac
    }
}