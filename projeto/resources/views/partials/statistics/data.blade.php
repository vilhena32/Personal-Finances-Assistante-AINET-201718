

      <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <!-- foreach-->
        <div class="row">
          <div class="col-lg-4">
            <img class="rounded-circle" <img src="{{ asset('/assets/money.png') }}" alt="Generic placeholder image" width="140" height="140"></img>
            <h2>{{$users}}</h2>
            <p>Númeo de utilizadores registados</p>
             @if(Auth::user())
            <p><a class="btn btn-secondary" href="{{route('listUsers')}}" role="button">View details </a></p></div>
            @else
            <p><a class="btn btn-secondary" href="{{route('publicProfile')}}" role="button">View details </a></p>
          </div><!-- /.col-lg-4 -->
            @endif



          <div class="col-lg-4">
            <img class="rounded-circle" src="C:\Users\Ricardo\Desktop\tmp\users.jpeg" alt="Generic placeholder image" width="140" height="140">
            <h2>{{$movements}}</h2>
            <p>Número de Movimentos</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
          </div><!-- /.col-lg-4 -->



          <div class="col-lg-4">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>{{$accounts}}</h2>
            <p>Número de contas.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->



      