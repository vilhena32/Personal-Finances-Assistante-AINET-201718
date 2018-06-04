<!DOCTYPE html>
<html>
<head>
	@include('partials.index.top')

</head>
<body>
	@include('partials.index.nav')
	


    @if (count($accounts))
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
                    @endif
                </td>

            </tr>
            @endforeach
        </table>

        @else
        <h2>No Accounts found</h2>
        @endif




        {{-- $accounts->links() --}}

    </body>
    </html>

