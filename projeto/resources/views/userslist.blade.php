<!DOCTYPE html>
<html>
<head>
	@include('partials.index.top')   
</head>
<body>
	@include('partials.index.nav')
	
    <form action="{{ route('users.search') }}" method="get" class="form-inline">
        @csrf

        <div class="form-group" style="margin-bottom: 5px\">
            <input type="text" class="form-control selectHeight" name="name" style="margin-left: 5px" id="name"
                value="{{ old('name') }}" placeholder="Insert Name "  size="22">

            <select id="type" class="form-control" name="type" style="height: 35px">
                <option value="">--Type--</option>
                <option value="normal">Normal</option>
                <option value="admin">Admin</option>
            </select>

            <select id="status" class="form-control" name="status" style="height: 35px">
                <option value="">--Status--</option>
                <option value="blocked">Blocked</option>
                <option value="unblocked">Unblocked</option>
            </select>

            <button type="submit" class="btn btn-success" name="search">Search</button>            
        </div>
    </form>

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
                        <td><img src="{{ $user->getPhoto() }}"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getType() }}</td>
                        <td>{{ $user->getStatus() }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <div class="inline">
                                @if(Auth::user()->admin==1 && $user->blocked==0 && Auth::user()->id != $user->id)
                                    <form action="{{ route('block', $user->id) }}" method="post" class="inline">
                                        @csrf
                                        @method('patch')

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-xs btn-danger">Block</button>
                                        </div>
                                    </form>
                                @endif

                                @if(Auth::user()->admin==1 && $user->blocked==1 && Auth::user()->id != $user->id)
                                    <form action="{{ route('unblock', $user->id) }}" method="post" class="inline">
                                        @csrf
                                        @method('patch')

                                        <div class="form-group">
                                                <button type="submit" class="btn btn-xs btn-danger">Unblock</button>
                                        </div>
                                    </form>
                                @endif

                                @if(Auth::user()->admin==1 && $user->admin==0 && Auth::user()->id != $user->id)
                                    <form action="{{ route('assignAdmin', $user->id) }}" method="post" class="inline">
                                        @csrf
                                        @method('patch')

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-xs btn-danger">Assign Admin</button>
                                        </div>
                                    </form>
                                @endif

                                @if(Auth::user())                                
                                    <form action="{{ route('showUser', $user) }}" method="get" class="inline">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-xs btn-danger">Show User</button>
                                        </div>
                                    </form>
                                @endif

                                @if(Auth::user()->admin==1 && $user->admin==1 && Auth::user()->id != $user->id)
                                    <form action="{{ route('removeAdmin', $user->id) }}" method="post" class="inline">
                                        @csrf
                                        @method('patch')

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-xs btn-danger">Remove Admin</button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h2>No users found</h2>
    @endif

    {{ $users->links() }}

</body>
</html>

