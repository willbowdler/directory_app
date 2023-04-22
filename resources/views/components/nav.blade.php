<nav>
  <div class="nav_first_child">
    <img class=" logo" src="{{asset('imgs/logo.png')}}" alt="">
    @auth
    <ul>
      <li><a href="/">Members</a></li>
      <li><a href="/payments/create">Give</a></li>
      <li><a href="/audio/show">Audio</a></li>
    </ul>
    @endauth
  </div>




  <div class="nav_second_child">
    @auth
    <form class='logout_form' action="{{ route('logout') }}" method="POST">
      @csrf
    </form>
    <a onclick="event.preventDefault(); document.querySelector('.logout_form').submit();" class="logout">Logout</a>

    <a>
      <img class="nav_profile" src='{{fake()->imageURL()}}' alt="">
    </a>
    @else
    <a href="/sessions/create">
      Log In
    </a>
    @endauth
  </div>

  <!-- @admin

  @endadmin -->






</nav>