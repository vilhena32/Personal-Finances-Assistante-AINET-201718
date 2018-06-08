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

            </thead>

            <tbody>
                
            </tbody>
        </table>

        @if(Auth::user())
       
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
                            <button type="submit" class="btn btn-xs btn-danger">Show Document</button>
                        </div>
                    </form>
                    <div class="inline">
                        <form action="{{ route('show.movements', $movement->id) }}" method="get" class="inline">
                           <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-danger">CreateDocument</button>
                        </div>
                    </form>
                    <div class="inline">
                        <form action="{{ route('edit.movements', $movement->id) }}" method="get" class="inline">
                           <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-danger">Edit Document</button>
                        </div>
                    </form>


                    <form action="{{ route('delete.movements', $movement->id) }}" method="post" class="inline">
                        @csrf
                        {{ method_field('delete') }}

                        <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-danger">Delete Document</button>
                        </div>
                    </form>
                </div>
            </td>



                    </tr>




                 </table>
            @endif
        </body>
        </html>

