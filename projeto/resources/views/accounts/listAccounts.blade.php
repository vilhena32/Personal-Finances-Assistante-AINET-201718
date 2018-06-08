<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/styles.css">
<title>Personal Finnances Application</title>
	@include('partials.index.top')
</head>
<body>
	@include('partials.index.nav')
	


    @if (count($accounts))
        <form action="{{ route('create.account') }}" method="get">
            <button type="submit" class="btn btn-success" name="createNewAccount">Create new account</button>
        </form>
        

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Code</th>
                <th>Type</th>
                <th>Current Balance</th>
                <th>Actions</th>
                
            </tr>
        </thead>

        <tbody>
            @foreach ($accounts as $account)
            <tr>
                <td>{{ $account->code }}</td>
                <td>{{ $account->type->name }}</td>
                <td>{{ $account->current_balance }}</td>
                <td>
                    @if(Auth::user())
                    <form action="{{route('accounts.delete', $account->id)}}" method="post" class="inline">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}

                        <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                        </div>
                    </form>
                   

                    <form action="{{route('change.startbalance', $account->id)}}" method="get" class="inline">
                        

                        <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-success">Change Start</button>
                        </div>
                    </form>


                    <form action="{{route('list.movements', $account->id)}}" method="get" class="inline">
                      

                        <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-info">Show Movements</button>
                        </div>
                    </form>                              

                    @if($account->deleted_at==NULL)
                    
                        <form action="{{route('close.account', $account->id)}}" method="post" class="inline">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}

                        <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-warning">Close Account</button>
                        </div>
                    </form>
                    
                    @else
                    
                        <form action="{{route('reopen.account', $account->id)}}" method="post" class="inline">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}

                        <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-danger">Reopen Account</button>
                        </div>
                    </form>

                    
                    @endif

                    @endif
                </td>

            </tr>
            @endforeach
        </table>

        @else
        <form action="{{ route('create.account') }}" method="get">
        <h2>No Accounts found</h2>
            <button type="submit" class="btn btn-success" name="createNewAccount">Create new account</button>
        </form>
        @endif




        {{-- $accounts->links() --}}

    </body>
    </html>

