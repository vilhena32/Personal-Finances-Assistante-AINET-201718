<!DOCTYPE html>
<html>
<head>
    @include('partials.index.top') 
    <title>Personal Finances App</title>
</head>
<body>
    @include('partials.index.nav')
    
    <form action="{{ route('users.search') }}" method="get" class="form-inline">


        <div class="form-group" style="margin-bottom: 5px\">
            <input type="text" class="form-control selectHeight" name="name" style="margin-left: 5px" id="name"
            value="{{ old('name') }}" placeholder="Insert Name "  size="22">
            <button type="submit" class="btn btn-success" name="search">Search</button>
        </div>
    </form>
    <table class="table table-striped">
        
        <thead>
            <tr>
                <th>Profile Photo</th>                    
                <th>Name</th>
                <th>Associates</th>
            </tr>
        </thead>

        <tbody>
           
            <tr>
                <td><img class="profiles" src="{{ $user->getPhoto() }}"></td>
                <td>{{ $user->name }}</td>
                <td>
                
                @if(count($user->associates))

                @foreach($user->associates as $associate)
                    @if($associate->id == Auth::user()->id)
                       <span>associate</span>
                    @endif

                @endforeach
                @endif
               
                @if(count($user->associatesOf))
                @foreach($user->associatesOf as $associatesOf)
               
                         @if($associatesOf->id == Auth::user()->id)
                            <span>associate-of</span>
                            @endif
                
                  
                @endforeach
               
                @endif
                </td>
            </tr>
       
        </tbody>
    </table>




</body>
</html>