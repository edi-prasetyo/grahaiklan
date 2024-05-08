<nav class="navbar navbar-expand-lg border-bottom" aria-label="Offcanvas navbar">
    <div class="container">
        <a class="navbar-brand" href="#"><img style="width:200px;"
                src="{{ asset('uploads/logo/' . $option_nav->logo) }}"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
            aria-controls="offcanvasNavbar2">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end " tabindex="-1" id="offcanvasNavbar2"
            aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbar2Label"><img style="width:200px;"
                        src="{{ asset('uploads/logo/' . $option_nav->logo) }}"></h5>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-start flex-grow-1 pe-3 fs-6">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="{{ url('/iklan') }}">Iklan</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="{{ url('/iklan') }}">Ketentuan</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="{{ url('/helps') }}">Bantuan</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="{{ url('/blog') }}">Blog</a>
                    </li>



                </ul>

                <ul class="navbar-nav justify-content-end flex-grow-1">

                    <li class='nav-item dropdown text-muted'>
                        <button aria-expanded='false'
                            class='btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center text-muted'
                            data-bs-toggle='dropdown' type='button'>
                            <i class='bi theme-icon-active' data-theme-icon-active='bi-sun-fill'></i>
                        </button>
                        <ul class='dropdown-menu dropdown-menu-end'>
                            <li>
                                <button class='dropdown-item d-flex align-items-center' data-bs-theme-value='light'
                                    type='button'>
                                    <i class='bi bi-sun-fill me-2 opacity-50' data-theme-icon='bi-sun-fill'></i> Light
                                </button>
                            </li>
                            <li>
                                <button class='dropdown-item d-flex align-items-center' data-bs-theme-value='dark'
                                    type='button'>
                                    <i class='bi bi-moon-fill me-2 opacity-50' data-theme-icon='bi-moon-fill'></i>
                                    Dark
                                </button>
                            </li>
                            <li>
                                <button class='dropdown-item d-flex align-items-center' data-bs-theme-value='auto'
                                    type='button'>
                                    <i class='bi bi-circle-half me-2 opacity-50' data-theme-icon='bi-circle-half'></i>
                                    Auto
                                </button>
                            </li>
                        </ul>
                    </li>

                    @guest

                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link pe-5" href="{{ route('login') }}">
                                    <i class='ti ti-user-square-rounded fs-5'></i> {{ __('Login') }}
                                </a>
                            </li>
                        @endif

                        {{-- @if (Route::has('register'))
                            <li class="nav-item me-2">
                                <a class="nav-link px-5 btn btn-success" href="{{ route('register') }}">
                                    {{ __('Register') }} <i class='bx bxs-user'></i></a>
                            </li>
                        @endif --}}
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                                @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2)
                                    <a class="dropdown-item" href="{{ url('admin/dashboard') }}">
                                        Dashboard
                                    </a>
                                    <a class="dropdown-item" href="{{ url('home') }}">
                                        Member Area
                                    </a>
                                @else
                                    <a class="dropdown-item" href="{{ url('home') }}">
                                        Member Area
                                    </a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest

                    <li class="nav-item me-2">
                        <a class="nav-link px-5 btn btn-success" href="{{ url('pasang-iklan') }}">
                            <i class='ti ti-pencil fs-4'></i> Pasang Iklan</a>
                    </li>


                </ul>

            </div>
        </div>
    </div>
</nav>
