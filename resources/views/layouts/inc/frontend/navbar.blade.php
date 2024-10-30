<nav class="navbar navbar-expand-lg bg-body border-bottom" aria-label="Offcanvas navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><img style="width:200px;"
                src="{{ asset('uploads/logo/' . $global_option->logo) }}"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
            aria-controls="offcanvasNavbar2">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end " tabindex="-1" id="offcanvasNavbar2"
            aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbar2Label"><img style="width:200px;"
                        src="{{ asset('uploads/logo/' . $global_option->logo) }}"></h5>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-start flex-grow-1 fs-6">


                    <form class="w-100">
                        {{-- <div class="input-group input-group-search mx-auto">
                            <div class="input-group-prepend">
                                <button id="search-btn" class="btn btn-outline-light text-success dropdown-toggle"
                                    type="button" value="ALL" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">ALL</button>
                                <div id="search-dropdown" class="dropdown-menu">
                                    <a class="dropdown-item" href="#">BLOG</a>
                                    <a class="dropdown-item" href="#">DOCS</a>
                                    <a class="dropdown-item" href="#">FORUM</a>
                                    <div role="separator" class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">ALL</a>
                                </div>
                            </div>
                            <input type="search" class="form-control" placeholder="Search..." aria-label="Search"
                                aria-describedby="search-button-addon">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit"
                                    id="search-button-addon">&#128269;</button>
                            </div>
                        </div> --}}


                        <div class="input-group">

                            <button id="search-btn" value="ALL" name="category_id"
                                class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Category</button>
                            <div class="dropdown-menu megamenu" id="search-dropdown">
                                <div class="row g-3">
                                    @foreach ($global_categories as $item)
                                        <div class="col-lg-4 col-6">
                                            <div class="col-megamenu">
                                                <h6 class="title"> <img style="width:20px;"
                                                        src="{{ $item->image_url }}">
                                                    {{ $item->name }}</h6>
                                                <ul class="list-unstyled">

                                                    @foreach (App\Models\Subcategory::where('category_id', $item->id)->get() as $subcat)
                                                        <li><a class="text-decoration-none text-body-emphasis"
                                                                href="{{ url('category/' . $item->slug . '/' . $subcat->slug) }}">{{ $subcat->name }}</a>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div> <!-- col-megamenu.// -->
                                        </div><!-- end col-3 -->
                                    @endforeach


                                </div><!-- end row -->
                            </div>
                            <input type="text" class="form-control" aria-label="Text input with dropdown button">
                            <button class="btn btn-success" type="button" id="button-addon2"><i
                                    class="ti ti-search"></i> </button>
                        </div>


                    </form>



                    {{-- <li class="nav-item active">
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
                    </li> --}}



                </ul>

                <ul class="navbar-nav justify-content-end">

                    <li class="nav-item dropdown has-megamenu">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Category </a>
                        <div class="container">
                            <div class="dropdown-menu megamenu" role="menu">

                                <div class="row g-3">
                                    @foreach ($global_categories as $item)
                                        <div class="col-lg-3 col-6">
                                            <div class="col-megamenu">
                                                <h6 class="title"> <img style="width:40px;"
                                                        src="{{ $item->image_url }}">
                                                    {{ $item->name }}</h6>
                                                <ul class="list-unstyled">

                                                    @foreach (App\Models\Subcategory::where('category_id', $item->id)->get() as $subcat)
                                                        <li><a class="text-decoration-none text-body-emphasis"
                                                                href="{{ url('category/' . $item->slug . '/' . $subcat->slug) }}">{{ $subcat->name }}</a>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div> <!-- col-megamenu.// -->
                                        </div><!-- end col-3 -->
                                    @endforeach


                                </div><!-- end row -->
                            </div><!-- end Container -->
                        </div> <!-- dropdown-mega-menu.// -->
                    </li>

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
                                    <i class='ti ti-logout fs-5'></i> {{ __('Login') }}
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
                        <a class="nav-link px-5 btn btn-success" href="{{ url('add-iklan') }}">
                            <i class='ti ti-pencil fs-4'></i> Pasang Iklan</a>
                    </li>


                </ul>

            </div>
        </div>
    </div>
</nav>

@guest
@else
    <div class="nav-scroller bg-body border-bottom">
        <div class="container">
            <div class="col-md-10 mx-auto">
                <nav class="nav" aria-label="Secondary navigation">
                    <a class="nav-link active text-body-emphasis" aria-current="page"
                        href="{{ url('home') }}">Dashboard</a>
                    <a class="nav-link text-body-emphasis" href="#">
                        Friends
                        <span class="badge text-bg-success rounded-pill align-text-bottom">27</span>
                    </a>
                    <a class="nav-link text-body-emphasis" href="{{ url('my-ads') }}">My Ads</a>
                    <a class="nav-link text-body-emphasis" href="{{ url('packages') }}">Paket Iklan</a>
                    <a class="nav-link text-body-emphasis" href="{{ url('profile') }}">Profile</a>

                </nav>
            </div>
        </div>
    </div>
@endguest
