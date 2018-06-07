<!DOCTYPE html>
<html>
<head>
	@include('partials.index.top')
    <title>Personal Finances App</title>

</head>
<body>
	@include('partials.index.nav')
	

    <table>
        <thead>
            <tr>

                <tr><th>Account {{$account->id}}</th></tr>
                <tr><th>Description {{$account->description}}</th></tr>
                
                <tr><th>Current Balance {{ $account->current_balance }}</th></tr>
            </tr>

        </thead>

        <tbody>
            <tr>
                <tr><br></tr>

                <td>
                    <div class="inline">
                        @if(Auth::user()->id == $account->owner_id)

                        <form action="{{ route('create.movements', $account->id) }}" method="get" class="inline">



                            <div class="form-group">
                                <button type="submit" class="btn btn-xs btn-success">Create Movement</button>
                            </div>
                        </form>
                        @endif
                    </td>
                </div>
            </tr>
        </tbody>
    </table>

    @if(Auth::user())
    @if (count($movements))
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Type</th>
                <th>Category</th>
                <th>Date</th>
                <th>Value</th>
                <th>Start Balance</th>
                <th>End Balance</th>
                <th>Actions</th>

            </tr>
        </thead>

        <tbody>

            @foreach ($movements as $movement)
            <tr>

                <td>{{ $movement->type }}</td>
                <td>{{ $movement->category->name }}</td>
                <td>{{ $movement->date }}</td>
                <td>{{ $movement->value }}</td>
                <td>{{ $movement->start_balance }}</td>
                <td>{{ $movement->end_balance}}</td>
                <td>
                    <div class="inline">
                        <form action="{{ route('show.movements', $movement->id) }}" method="get" class="inline">
                           <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-danger">Edit</button>
                        </div>
                    </form>

                    <form action="{{-- route('block', $user->id) --}}" method="post" class="inline">
                        @csrf
                        {{ method_field('delete') }}

                        <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </td>

        </tr>

        @endforeach


    </table>
    @else
    <h2>No movements found</h2>
    @endif
    @endif


    {{$movements->links() }}

</body>
</html>

