<div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <!-- foreach-->
    <div class="row">
        <div class="col-lg-4">
            <img class="rounded-circle" src="{{ asset('storage/profiles/users.png') }}" alt="Generic placeholder image" width="140" height="140"></img>
            <h2>{{$users}}</h2>
            <p>Númeo de utilizadores registados</p>
            @if(Auth::user())
                @if(Auth::user()->admin==1)
                    <p><a class="btn btn-secondary" href="{{ route('users.search') }}" role="button">View details </a></p>
                @else
                    <p><a class="btn btn-secondary" href="{{ route('associates') }}" role="button">View details </a></p>
                @endif
            @endif
        </div><!-- /.col-lg-4 -->

        <div class="col-lg-4">
            <img class="rounded-circle" src="{{ asset('storage/profiles/movimentos.png') }}" alt="Generic placeholder image" width="140" height="140">
            <h2>{{ $movements }}</h2>
            <p>Número de Movimentos</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div><!-- /.col-lg-4 -->

        <div class="col-lg-4">
            <img class="rounded-circle" src="{{ asset('storage/profiles/contas.jpg') }}" alt="Generic placeholder image" width="140" height="140">
            <h2>{{ $accounts }}</h2>
            <p>Número de contas.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div><!-- /.col-lg-4 -->
    </div>
</div><!-- /.row -->



      