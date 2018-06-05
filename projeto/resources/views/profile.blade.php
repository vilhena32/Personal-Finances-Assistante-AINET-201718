<!DOCTYPE html>
<html>
<head>
    @include('partials.index.top')
</head>
<body>
    @include('partials.index.nav')
    

   
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Photo</th>
            <th>Group</th>
          
        </tr>
    </thead>
    
    <tbody>
   
        <tr>
            <td>{{ $user->name }}</a></td>
            <td>
                <img src="{{ $user->getPhoto() }}">
            </td>

            @foreach($associates as $assosciate)
                @if($assosciate->id == $user->id)

                    <td>Associated</td>
                @else
                    <td></td>
                @endif
            @endforeach

            
          
       
        </tr>
    </table>
  
</body>
</html>

