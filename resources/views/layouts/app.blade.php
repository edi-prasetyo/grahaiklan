<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <script src="https://getbootstrap.com/docs/5.3/assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keyword')">
    <meta name="author" content="@yield('title')">
    <meta property="og:image" content="@yield('image')">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css' rel='stylesheet' />
    <link href="{{ asset('assets/vendor/icons/tabler-icon/tabler-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/offcanvas/offcanvas-navbar.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    {{-- External CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    {!! htmlScriptTagJsApi() !!}
</head>

<body class="d-flex flex-column min-vh-100 bg-body-tertiary">

    @include('sweetalert::alert')

    <div id="app">
        @include('layouts.inc.frontend.navbar')

        <main>
            @yield('content')
        </main>
    </div>
    @include('layouts.inc.frontend.footer')

</body>


<script src="{{ asset('assets/vendor/offcanvas/offcanvas-navbar.js') }}"></script>
<script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
<link href="{{ asset('admin/vendor/summernote/summernote-lite.min.css') }}" rel="stylesheet">
<script src="{{ asset('admin/vendor/summernote/summernote-lite.min.js') }}"></script>

{{-- External JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>

<script src="https://getbootstrap.com/docs/5.3/examples/sidebars/sidebars.js"></script>


<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>


<script type="text/javascript">
    $("img").lazyload({
        effect: "fadeIn"
    });
    jQuery(document).ready(function($) {
        $('#search-dropdown a').click(function() {
            $('#search-btn').html($(this).text()).val($(this).text());
            return false;
        });
    });
</script>

<script>
    (() => {
        "use strict";

        const storedTheme = localStorage.getItem("theme");

        const getPreferredTheme = () => {
            if (storedTheme) {
                return storedTheme;
            }

            return window.matchMedia("(prefers-color-scheme: dark)").matches ?
                "dark" :
                "light";
        };

        const setTheme = function(theme) {
            if (
                theme === "auto" &&
                window.matchMedia("(prefers-color-scheme: dark)").matches
            ) {
                document.documentElement.setAttribute("data-bs-theme", "dark");
            } else {
                document.documentElement.setAttribute("data-bs-theme", theme);
            }
        };

        setTheme(getPreferredTheme());

        const showActiveTheme = (theme) => {
            const activeThemeIcon = document.querySelector(".theme-icon-active");
            const btnToActive = document.querySelector(
                `[data-bs-theme-value="${theme}"]`
            );
            const iconOfActiveBtn = btnToActive.querySelector("i").dataset.themeIcon;

            document.querySelectorAll("[data-bs-theme-value]").forEach((element) => {
                element.classList.remove("active");
            });

            btnToActive.classList.add("active");
            activeThemeIcon.classList.remove(activeThemeIcon.dataset.themeIconActive);
            activeThemeIcon.classList.add(iconOfActiveBtn);
            activeThemeIcon.dataset.iconActive = iconOfActiveBtn;
        };

        window
            .matchMedia("(prefers-color-scheme: dark)")
            .addEventListener("change", () => {
                if (storedTheme !== "light" || storedTheme !== "dark") {
                    setTheme(getPreferredTheme());
                }
            });

        window.addEventListener("DOMContentLoaded", () => {
            showActiveTheme(getPreferredTheme());

            document.querySelectorAll("[data-bs-theme-value]").forEach((toggle) => {
                toggle.addEventListener("click", () => {
                    const theme = toggle.getAttribute("data-bs-theme-value");
                    localStorage.setItem("theme", theme);
                    setTheme(theme);
                    showActiveTheme(theme, true);
                });
            });
        });
    })();
</script>


@yield('scripts')

</html>
