<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movement;
use App\Account;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $account = Account::find($id);
        $movements = Movement::where('account_id',$id)->orderBy('date','desc')->paginate(10);
        
        //dd($movements);
        return view('movements.listMovements',compact('movements','account'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //


        return view('movements.addMovement',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        //
        //dd($request);
        
        $movement= new Movement();
        $account = Account::find($id);
        $movement->account_id = $id;
        //$movement->movement_category_id = x;
        $movement->date = $request->input('date');
        $movement->value= $request->input('value');
        $movement->start_balance= $account->current_balance;
        $movement->end_balance = $account->current_balance - $request->input('value');
        //$movement->save();

        if($request->input('type/category')=="Food")
        {
            $movement->type = "expense";
            $movement->category=1;
        }

        if($request->input('type/category')=="Clothes")
        {
            $movement->type = "expense";
            $movement->category=2;
        }

        if($request->input('type/category')=="Services")
        {
            $movement->type = "expense";
            $movement->category=3;
        }

        if($request->input('type/category')=="Electricity")
        {
            $movement->type = "expense";
            $movement->category=4;
        }

        if($request->input('type/category')=="Phone")
        {
            $movement->type = "expense";
            $movement->category=5;
        }

        if($request->input('type/category')=="Fuel")
        {
            $movement->type = "expense";
            $movement->category=6;
        }

        if($request->input('type/category')=="Mortgage Payment")
        {
            $movement->type = "expense";
            $movement->category=7;
        }

        if($request->input('type/category')=="Salary")
        {
            $movement->type = "revenue";
            $movement->category=8;
        }

        if($request->input('type/category')=="Bonus")
        {
            $movement->type = "revenue";
            $movement->category=9;
        }

        if($request->input('type/category')=="Royalties")
        {
            $movement->type = "revenue";
            $movement->category=10;
        }

        if($request->input('type/category')=="Interests")
        {
            $movement->type = "revenue";
            $movement->category=11;
        }

        if($request->input('type/category')=="Gifts")
        {
            $movement->type = "revenue";
            $movement->category=12;
        }

        if($request->input('type/category')=="Dividends")
        {
            $movement->type = "revenue";
            $movement->category=13;
        }

        if($request->input('type/category')=="Product Sales")
        {
            $movement->type = "revenue";
            $movement->category=14;
        }



        //dd($movement);
        $movement->save();
        return redirect('movements/'.$id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movement = Movement::find($id);

        return view('movements.editMovement',compact('movement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movement = Movement::find($id);
        //dd($request);
        //fazer cenas
        return redirect('movements/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movement=Movement::find($id);
        $movement->destroy;

        return redirect('movements/'.$id);
    }
}
