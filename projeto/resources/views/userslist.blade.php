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

            <select id="search_type" class="form-control" name="search_field">
                <option value="admin">Admin</option>
                <option value="regular">Regular</option>
                <option value="none">None</option>
            </select>
            <select id="search_status" class="form-control" name="search_field">
                <option value="block">Block</option>
                <option value="unblock">Unblock</option>
                <option value="none">None</option>
            </select>
            <input
            type="text" class="form-control"
            name="name" id="name"
            value="{{old('name')}}" placeholder="Inser Name of search"  size="20"/>
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
                <td><a href=""</a>{{$user->email}}</td>
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
                                <button type="submit" class="btn btn-xs btn-danger">unBlock</button>
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

        {{ $users->links() }}
        @include('partials.index.bottom')
    </body>
    </html>

