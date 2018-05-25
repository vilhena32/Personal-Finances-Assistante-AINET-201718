<!DOCTYPE html>
<html>
<head>
	@include('partials.index.top')
</head>
<body>
	@include('partials.index.nav')
	
        <form action="{{route('users.search')}}" method="post" class="form-inline">
        {{csrf_field()}}
        <div class="form-group">
            <select id="search_field" class="form-control" name="search_field">
                <option value="name">Name</option>
                <option value="email">Email</option>
            </select>
            <input
                type="text" class="form-control"
                name="name" id="name"
                value="{{old('name')}}" size="100"/>
        </div>
        <button type="submit" class="btn btn-success" name="search">Search</button>
    </form>

@if (count($users))
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
    @foreach ($users as $user)
        <tr>
            <td><a href="">{{ $user->name }}</a></td>
            <td><a href=""</a></td>
            <td>{{ $user->getType() }}</td>
            <td>{{ $user->getStatus() }}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->updated_at }}</td>
            
            <td>
                <a class="btn btn-xs btn-primary" href="">Edit</a>
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
                        <button type="submit" class="btn btn-xs btn-success" name"block" >Unblock User</button>
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
    @endforeach
    </table>
   
@else
    <h2>No users found</h2>
@endif

    {{ $users->links() }}
	@include('partials.index.bottom')
</body>
</html>

