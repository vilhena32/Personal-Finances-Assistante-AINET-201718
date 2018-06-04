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
            @if(Auth::user()->admin==1)
            <select id="search_type" class="form-control" name="search_type">
                <option value="none">None</option>
                <option value="regular">Regular</option>
                <option value="admin">Admin</option>
            </select>
            <select id="search_status" class="form-control" name="search_status">
                <option value="node">None</option>
                <option value="unblock">Unblock</option>
                <option value="block">Block</option>
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

        @endif

    </form>




    @if(Auth::user())
    @if (count($users))
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Profile Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                @if(Auth::user()->admin==1)
                <th>Type</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
                @endif
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr>
                <td><img src="{{$user->getPhoto()}}"></td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email}}</td>
                <td>{{ $user->phone}}</td>
                @if(Auth::user()->admin==1)
                <td>{{ $user->getType() }}</td>
                <td>{{ $user->getStatus() }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                 @endif
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
            <td><img src="{{$user->getPhoto()}}"></td>
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

