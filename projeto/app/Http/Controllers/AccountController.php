<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Account;
use App\Movement;
use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $userid = Auth::user()->id;

        return redirect('accounts/'.$userid);   
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account = new Account;
        
        return view('accounts.add', compact('account'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAccountRequest $request)
    {
        $data = $request->validated();

        $account = new Account($data);

        $account->current_balance = $account->start_balance;

        Auth::user()->accounts()->save($account);

        return redirect()
                    ->route('home')
                    ->with('success', 'Account created successfully.');
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
        $account = Account::findOrFail($id);

        return view('accounts.edit', compact('account'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, $id)
    {
        $account = Account::findOrFail($id);

        $data = $request->validated();

        $account->fill($data);

        $account->save();

        return redirect()
                    ->route('home')
                    ->with('sucess', 'Account updated successfully');
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
        $movements= $account->movements();
        if($movements==null)
        {
          return redirect('accounts/'.$userid);  
        }
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
      
        $userid = Auth::user()->id;
        return redirect('accounts/'.$userid);
    }


    public function reopenAccount($id)
    {
        $account = Account::withTrashed()->where('id', $id)->restore();
        //$account->restore();
       // dd($account);
        $userid = Auth::user()->id;
        return redirect('accounts/'.$userid);
    }
}