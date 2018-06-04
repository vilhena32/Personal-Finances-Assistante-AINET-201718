<!DOCTYPE html>
<html>
<head>
	@include('partials.index.top')
   
</head>
<body>
	@include('partials.index.nav')
	



    @if(Auth::user())
    @if (count($movements))
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Description</th>
                <th>Balance</th>
           
           
                
         
                
            </tr>
        </thead>

        <tbody>
            @foreach ($movements as $movement)
            <tr>
                
                <td>{{ $movement->description }}</td>
                <td>{{ $movement->end_balance}}</td>
                
                
                <td>

                    <div class="inline">

                 
            </div>
        </td>
    </tr>
    @endforeach
</table>

@else
<h2>No movements found</h2>
@endif
@endif


    {{--$users->links() --}}

</body>
</html>

