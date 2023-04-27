<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Afkary') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto ms-2 mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link me-5 ms-5 mb-3 mb-lg-0" aria-current="page" href="/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link me-5 ms-5 mb-3 mb-lg-0" href="/about">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link me-5 ms-5 mb-3  mb-lg-0" href="/services">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link me-5 ms-5 mb-3  mb-lg-0" href="/posts">posts</a>
              </li>
            </ul>

            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                        <li class="dropdown"  onclick="handleDropdownClick(event)">

                        <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a> --}}

                        {{-- <ul class="dropdown-menu" role="menu"> THIS IS NOT WORKING, SOLVE IT LATER --}}
                          <li><a class="nav-link" href="/dashboard">Dashboard</a></li>
                          <li>
                              <a class="nav-link" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                  Logout
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                          </li>
                          <li>
                            <a class="nav-link" href="/posts/create">Create Post</a>
                          </li>
                      {{-- </ul> --}}
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>