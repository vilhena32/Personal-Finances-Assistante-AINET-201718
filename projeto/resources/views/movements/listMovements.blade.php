<!DOCTYPE html>
<html>
<head>
	@include('partials.index.top')
    <title>Personal Finances App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

                        <form action="{{ route('chart.index',$account->id) }}" method="get" class="form-inline">
                            <div class="form-group" style="margin-bottom: 5px\">
                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right"> {{ __('Start date') }} </label>
                                <div class="col-md-6">
                                    <input id="date" type="date" name="dataI" class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">

                                    @if ($errors->has('date'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <label for="date" class="col-md-4 col-form-label text-md-right"> {{ __('End date') }} </label>
                                
                                <div class="col-md-6">
                                    <input id="date" name="dataF" type="date" class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">

                                    @if ($errors->has('date'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                                <button type="submit" class="btn btn-success" name="search">   View Statistics</button>            
                                <div><button type="submit" class="btn btn-success" name="search">View Statistics by Month</button>
                                </div>
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
                            <button type="submit" class="btn btn-xs btn-danger">Show</button>
                            </form>
                        </div>
                    
                    <div class="inline">
                        <form action="{{ route('edit.movements', $movement->id) }}" method="get" class="inline">
                           <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-danger">Edit</button>
                        </div>
                    </form>


                    <form action="{{ route('delete.movements', $movement->id) }}" method="post" class="inline">
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

