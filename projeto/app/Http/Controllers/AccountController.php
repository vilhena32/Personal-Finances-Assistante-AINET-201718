<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Account;
use App\Movement;
use Illuminate\Database\Eloquent\SoftDeletes;





class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use SoftDeletes;
    public function index(User $user)
    {   

        //$accounts= $user->accounts;
        $accounts = Account::withTrashed() ->where('owner_id', $user->id)->get();


        return view('accounts.listAccounts', compact('accounts'));
    }



    public function listClosedAccounts()
    {
        $user= Auth::user();
        $aux= $user->accounts;
        $accounts=[];
        foreach($aux as $a)
        {
            if($a->deleted_at !=NULL)
            {   

                array_push($accounts,$a);
            }
        }

        //dd($accounts);

        return view('accounts.listAccounts',compact('accounts'));
    }
    
    public function listOpenAccounts()
    {
        $user= Auth::user();
        $aux= $user->accounts;
        $accounts=[];
        foreach($aux as $a)
        {
            if($a->deleted_at ==NULL)
            {
                array_push($accounts,$a);
            }
        }
         

        //dd($accounts);

        return view('accounts.listAccounts',compact('accounts'));
    }

    public function updateStartAmount($id)
    {   
        $account = Account::find($id);
        return view('accounts.editStart',compact('account'));
    }

    public function storeStartAmount($id, Request $request)
    {   

        $account = Account::find($id);
        $movements = $account->movements;
        
       


        if($movements->count()==0)
        {
            $account->start_balance = $request->input('balance');
            $account->current_balance = $request->input('balance');
        
        }
        if($movements->count()>0)
        {
            foreach ($movements as $m)
            {
                $m->end_balance = $m->end_balance + $request->input('balance');
                $m->start_balance = $m->start_balance + $request->input('balance');
                //$account->current_balance = 
                

                $m->save();
            }

            $account->start_balance = $request->input('balance');
            $account->current_balance = $account->current_balance + $request->input('balance');
        }
        
        

      
        
            
            
            $account->save();

        

        


        return view('welcome');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('accounts.addAccount');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $account= Account::find($id);
        //$account->movements()->forceDelete();
        $account->forceDelete();
      
        $userid = Auth::user()->id;
        return redirect('accounts/'.$userid);
    }

    public function closeAccount($id)
    {
        

        $account = Account::find($id);


        foreach ($account->movements as $m) {
            $m->delete();
         }
        $account->delete();
       // dd($account);
      
        $userid = Auth::user()->id;
        return redirect('accounts/'.$userid);
    }

    public function reopenAccount($id)
    {
        

        $account = Account::find($id);

        $account->restore();
       // dd($account);
        $userid = Auth::user()->id;
        return redirect('accounts/'.$userid);
    }


}
