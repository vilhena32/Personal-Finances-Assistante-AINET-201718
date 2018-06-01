<!DOCTYPE html>
<html>
<head>
	@include('partials.index.top')
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
	@include('partials.index.nav')
	
    <form action="{{route('users.search')}}" method="post" class="form-inline">
        {{csrf_field()}}

        <div class="form-group">
            @if(Auth::user()->admin==1)
            <select id="search_type" class="form-control" name="search_type">
                <option value="admin">None</option>
                <option value="regular">Regular</option>
                <option value="none">Admin</option>
            </select>
            <select id="search_status" class="form-control" name="search_status">
                <option value="block">None</option>
                <option value="unblock">Unblock</option>
                <option value="none">Block</option>
            </select>
            <input
            type="text" class="form-control"
            name="name" id="name"
            value="{{old('name')}}" placeholder="Insert Name "  size="20"/>
            <button type="submit" class="btn btn-success" name="search">Search</button>
            @else
            <input
            type="text" class="form-control"
            name="name" id="name"
            value="{{old('name')}}" placeholder="Inser Name of search"  size="20"/>
        </div>
        <button type="submit" class="btn btn-success" name="search">Search</button>

        @endif
    </form>




    @if(Auth::user()->admin==1)
    @if (count($users))
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Profile Photo</th>
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
                <img><td><img src="{{$user->getPhoto()}}"></td></img>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email}}</td>
                <td>{{ $user->getType() }}</td>
                <td>{{ $user->getStatus() }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>

                <td>

                    <div class="inline">

                     @if(Auth::user()->admin==1 && $user->blocked==0 && Auth::user()->id != $user->id)

                     <form action="{{route('block', $user->id)}}" method="post" class="inline">
                        {{ csrf_field() }}
                        {!! method_field('patch') !!}

                        <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-danger">Block</button>
                        </div>
                    </form>
                    @endif

                    @if(Auth::user()->admin==1 && $user->blocked==1 && Auth::user()->id != $user->id)
                    <form action="{{route('unblock', $user->id)}}" method="post" class="inline">
                        {{ csrf_field() }}
                        {!! method_field('patch') !!}
                        <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-danger">Unblock</button>
                        </div>
                    </form>
                    @endif


                    @if(Auth::user()->admin==1 && $user->admin==0 && Auth::user()->id != $user->id)

                    <form action="{{route('assignAdmin', $user->id)}}" method="post" class="inline">
                      {{ csrf_field() }}
                      {!! method_field('patch') !!}
                      <div class="form-group">
                        <button type="submit" class="btn btn-xs btn-danger">Assign Admin</button>
                    </div>
                </form>
                @endif

                @if(Auth::user())

                <form action="{{route('showUser', $user)}}" method="get" class="inline">


                    <div class="form-group">
                        <button type="submit" class="btn btn-xs btn-danger">Show User</button>
                    </div>
                </form>
                @endif


                @if(Auth::user()->admin==1 && $user->admin==1 && Auth::user()->id != $user->id)
                <form action="{{route('removeAdmin', $user->id)}}" method="post" class="inline">
                    {{ csrf_field() }}
                    {!! method_field('patch') !!}
                    <div class="form-group">
                        <button type="submit" class="btn btn-xs btn-danger">Remove Admin</button>
                    </div>
                </form>
                @endif
            </div>
        </td>
    </tr>
    @endforeach
</table>

@else
<h2>No users found</h2>
@endif
@endif

@if(Auth::user()->admin==0)
@if (count($users))
<table class="table table-striped">
    <thead>
        <tr>
            <th>Profile Photo</th>
            <th>Name</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{$user->getPhoto()}}</td>
            <td>{{ $user->name }}</td>
        </tr>
        @endforeach
    </table>

    @else
    <h2>No users found</h2>
    @endif
@endif

    {{ $users->links() }}

</body>
</html>

