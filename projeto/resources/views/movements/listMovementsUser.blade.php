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
                <option value="admin">Admin</option>
                <option value="regular">Regular</option>
                <option value="none">None</option>
            </select>
            <select id="search_status" class="form-control" name="search_status">
                <option value="block">Block</option>
                <option value="unblock">Unblock</option>
                <option value="none">None</option>
            </select>
            <input
            type="text" class="form-control"
            name="name" id="name"
            value="{{old('name')}}" placeholder="Inser Name of search"  size="20"/>
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





@if (count($movements))
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
            <td>{{ $movement->name }}</td>
            <td>{{$user->email}}</td>
            <td>{{ $user->getType() }}</td>
            <td>{{ $user->getStatus() }}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->updated_at }}</td>

            <td>

                







    </td>
</tr>
@endforeach
</table>

@else
<h2>No users found</h2>
@endif

{{ $movements->links() }}

</body>
</html>

