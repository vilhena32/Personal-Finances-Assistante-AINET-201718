<!DOCTYPE html>
<html>
<head>
    @include('partials.index.top')
</head>
<body>
    @include('partials.index.nav')
    

    @foreach($associates as $associate)
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
            <td>{{ $associate->name }}</a></td>
            <td>{{$associate->email}}</td>
            <td>{{ $associate->getType() }}</td>
            <td>{{ $associate->getStatus() }}</td>
            <td>{{ $associate->created_at }}</td>
            <td>{{ $associate->updated_at }}</td>
            
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
                        @if ($associate->blocked == 0 || $user->admin == 0)
                        <button type="submit" class="btn btn-xs btn-danger" name="block" >Block User</button>
                        @else
                        <button type="submit" class="btn btn-xs btn-success" name="block" >Unblock User</button>
                        @endif
                    </div>
                </form>

                <form action="" method="post" class="inline">
                    {{ csrf_field() }}
                    <div class="form-group">
                        @if ($associate->admin == 0)
                        <button type="submit" class="btn btn-xs btn-danger" name="block" >Assign Admin</button>
                        @else
                        <button type="submit" class="btn btn-xs btn-success" name"block" >Remove Admin</button>
                        @endif
                    </div>
                </form>
            </td>
        </tr>
    </table>
    @endforeach
</body>
</html>

