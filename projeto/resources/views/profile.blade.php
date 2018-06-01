<!DOCTYPE html>
<html>
<head>
    @include('partials.index.top')
</head>
<body>
    @include('partials.index.nav')
    


   
        @if (count($associates))
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Associated Member</th>
                    <th>Email</th>
                    

                </tr>
            </thead>

        <tbody>
            @foreach ($associates as $associate)

            <tr>
                <td>
                   <a href="{{route('showAssociate',$associate->getUser($associate->associated_user_id))}}"> {{$associate->getUser($associate->associated_user_id)->name}}</a>
                </td>
                <td>{{$associate->getUser($associate->associated_user_id)->email}}</td>
            </tr>
            @endforeach
        </table>

    @else
        <h2>No users found</h2>
    @endif
     



    </body>
    </html>

