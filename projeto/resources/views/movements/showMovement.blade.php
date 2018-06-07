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
                    </tr>
                 </table>
            @endif
        </body>
        </html>

