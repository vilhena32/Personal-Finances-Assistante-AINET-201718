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
            <th>Email</th>
            <th>Group</th>
          
        </tr>
    </thead>
    
    <tbody>
     @foreach($users as $user)
        <tr>
            <td>{{$user->name }}</a></td>
            <td><img src="{{$user->getPhoto()}}"></td>
            @foreach($associates as $assosciate)
                @if($assosciate->id == $user->id)

                    <td>Associated</td>
                @else
                    <td></td>
                @endif
            @endforeach

         
            
            <td>
                <form action="{{route('showEdit')}}" method="get" class="inline">
                
                    <div class="form-group">
                        <button type="submit" class="btn btn-xs btn-danger">Edit</button>
                    </div>

                </form>
                
                
                <form action="" method="post" class="inline">
                {{ csrf_field() }}
                    <div class="form-group">
                        <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                    </div>

                </form>
                <form action="" method="post" class="inline">
                    {{ csrf_field() }}
                    <div class="form-group">
                        @if ($user->blocked == 0 || $user->admin == 0)
                        <button type="submit" class="btn btn-xs btn-danger" name="block" >Block User</button>
                        @else
                        <button type="submit" class="btn btn-xs btn-success" name="block" >Unblock User</button>
                        @endif
                    </div>
                </form>

                <form action="" method="post" class="inline">
                    {{ csrf_field() }}
                    <div class="form-group">
                        @if ($user->admin == 0)
                        <button type="submit" class="btn btn-xs btn-danger" name="block" >Assign Admin</button>
                        @else
                        <button type="submit" class="btn btn-xs btn-success" name"block" >Remove Admin</button>
                        @endif
                    </div>
                </form>
            </td>
             @endforeach
        </tr>
    </table>
   {{ $users->links() }}
</body>
</html>

