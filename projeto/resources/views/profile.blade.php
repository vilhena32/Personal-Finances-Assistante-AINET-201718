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
                <th>Photo</th>
                <th>Group</th>
                <th>Actions</th>

            </tr>
        </thead>

        <tbody>

            <tr>

                <td>{{ $user->name }}</a></td>
                <td><img class="profiles" src="{{ $user->getPhoto() }}"></td>

                @foreach($associates as $assosciate)
                @if($assosciate->id == $user->id)

                <td>Associated</td>
                @endif
                @endforeach
                <td></td>
                
                <td></td>

                @if(Auth::user()->id == $user->id)
                <td>
                    <form action="{{ route('showEdit', $user->id ) }}" method="get" class="inline">

                        <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-danger">Edit User</button>
                        </div>
                    </form>
                </td>
                @endif



            </tr>
     
        </table>

    </body>
    </html>

