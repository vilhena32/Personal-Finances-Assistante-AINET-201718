<!DOCTYPE html>
<html>
<head>
    @include('partials.index.top')
    <link rel="stylesheet" href="css/styles.css">
    <title>Personal Finances App</title>
</head>
<body>
    @include('partials.index.nav')
    
    @if(count($associates))
   
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Group</th>
          
        </tr>
    </thead>
    
    <tbody>
     @foreach($associates as $associate)
        <tr>

            <td><a href="{{ route('accounts',$associate->id) }}">{{$associate->name }}</a></td>
                    <td><img src="{{$associate->getPhoto()}}"></td>
           
                 
                @if($associate->id == $user->id)
                   
                    <td>Associated</td>
                @else
                    <td></td>
                @endif
            @endforeach

        
        </tr>
    </table>
    @else
        <h2>No Associates found </h2>

    @endif
   
</body>
</html>

