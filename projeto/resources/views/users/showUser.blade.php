<!DOCTYPE html>
<html>
<head>
	@include('partials.index.top')
    <link rel="stylesheet" href="css/styles.css">
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

            </tr>
        </thead>

        <tbody>           
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{$user->name}}</td>
                <td>{{ $user->getType() }}</td>
                <td>{{ $user->getStatus() }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>



            </tr>
        </tbody>
    </table>


</body>
</html>

