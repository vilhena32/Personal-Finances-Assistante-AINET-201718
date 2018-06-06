<!DOCTYPE html>
<html>
<head>
	@include('partials.index.top')
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
	@include('partials.index.nav')    

    @if(count($associates))    
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
                        <td>{{ $user->associate()->name }}</td>
                        <td>{{$user->name}}</td>
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
                    </div>
                </td>
            </tr>
            @endif
            </table>
        @endforeach
    @else
        <h2>No users found</h2>
    @endif
</body>
</html>

