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
            <th>Type</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>
    </thead>
    
    <tbody>
   
        <tr>
            <td>{{ $user->name }}</a></td>
            <td>{{$user->email}}</td>
            <td>{{ $user->getType() }}</td>
            <td>{{ $user->getStatus() }}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->updated_at }}</td>
            
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
        </tr>
    </table>
</body>
</html>

