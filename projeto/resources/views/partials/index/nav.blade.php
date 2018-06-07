<div class="d-flex flex-column flex-md-row align-items-csenter p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal" ><a class="p-2 text-dark" href="{{ route('home') }}">Personal Finances App</a></h5>
    <nav class="my-2 my-md-0 mr-md-3"> </nav>
    @if(!Auth::user())
        <a class="btn btn-outline-primary" href="{{ route('register') }}">Sign up</a>
        <a class="btn btn-outline-primary" href="{{ route('login') }}">Login</a>
    @else
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
            </button>
            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item id" id ="accounts" href="{{ route('accounts',Auth::user()) }}">My Accounts</a>
              <a class="dropdown-item" href="{{ route('showProfile') }}">MyProfile
              <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div> 
        </div>
    @endif
</div>




