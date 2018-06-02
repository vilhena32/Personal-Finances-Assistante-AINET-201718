<div class="d-flex flex-column flex-md-row align-items-csenter p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal" >Company name</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="{{route('home')}}">Home Page</a>
        @if(Auth::user())
        <a class="p-2 text-dark" href="{{route('accounts',Auth::user())}}">Accounts</a>
        @endif
        <a class="p-2 text-dark" href="#">Support</a>
        <a class="p-2 text-dark" href="#">Pricing</a>
      </nav>

      @if(!Auth::user())
        <a class="btn btn-outline-primary" href="{{route('register')}}">Sign up</a>
        <a class="btn btn-outline-primary" href="{{route('login')}}">Login</a>
      @else
        <a class="btn btn-outline-primary" href="{{route('showProfile')}}">MyProfile</a>
        <a class="btn btn-outline-primary" href="{{route('logout')}}">Logout</a>
      @endif
    </div>




 
