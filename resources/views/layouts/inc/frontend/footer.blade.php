<!-- Footer 14 - Bootstrap Brain Component -->
<footer class="py-3 py-md-5 py-xl-6 bg-body mt-auto">

    <section class="pb-5 pb-md-6 pb-xl-8">
        <div class="container">
            <div class="row gy-3">


                <div class="col-12 col-sm-5 col-lg-3">
                    <div class="link-wrapper">
                        <h4 class="mb-3 fw-bold fs-6">About</h4>
                        <p>{{ $global_option->description }}</p>

                        <div class="social-media-wrapper">
                            <ul class="m-0 list-unstyled d-flex justify-content-center justify-content-sm-start gap-2">
                                @if ($global_option->facebook == null)
                                @else
                                    <li>
                                        <a href="{{ $global_option->facebook }}"
                                            class="btn btn-dark bsb-btn-circle bsb-btn-circle-sm link-opacity-75-hover link-light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                            </svg>
                                        </a>
                                    </li>
                                @endif

                                @if ($global_option->twitter == null)
                                @else
                                    <li>
                                        <a href="{{ $global_option->twitter }}"
                                            class="btn btn-dark bsb-btn-circle bsb-btn-circle-sm link-opacity-75-hover link-light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                                            </svg>
                                        </a>
                                    </li>
                                @endif

                                @if ($global_option->instagram == null)
                                @else
                                    <li>
                                        <a href="{{ $global_option->instagram }}"
                                            class="btn btn-dark bsb-btn-circle bsb-btn-circle-sm link-opacity-75-hover link-light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                                            </svg>
                                        </a>
                                    </li>
                                @endif

                                @if ($global_option->youtube == null)
                                @else
                                    <li>
                                        <a href="{{ $global_option->youtube }}"
                                            class="btn btn-dark bsb-btn-circle bsb-btn-circle-sm link-opacity-75-hover link-light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z" />
                                            </svg>
                                        </a>
                                    </li>
                                @endif


                            </ul>
                        </div>

                    </div>
                </div>


                <div class="col-12 col-sm-4 col-lg-6">
                    <div class="link-wrapper">
                        <h4 class="mb-3 fw-bold fs-6">Category</h4>
                        <div class="footer-cols">
                            <ul class="m-0 list-unstyled">

                                @foreach ($global_categories as $footer_cat)
                                    <li class="mb-1">
                                        <a href="{{ url('category', $footer_cat->slug) }}"
                                            class="text-decoration-none link-opacity-75-hover link-underline-opacity-100-hover link-offset-1 text-body-emphasis">
                                            <i class="ti ti-chevron-right"></i> {{ $footer_cat->name }}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-3 col-lg-3">
                    <div class="link-wrapper">
                        <h4 class="mb-3 fw-bold fs-6">Links</h4>
                        <div class="footer-colss">
                            <ul class="m-0 list-unstyled">
                                <li class="mb-1">
                                    <a href="{{ url('/') }}"
                                        class="text-decoration-none link-opacity-75-hover link-underline-opacity-100-hover link-offset-1 text-body-emphasis">
                                        <i class="ti ti-chevron-right"></i> Home
                                    </a>
                                </li>
                                @foreach ($global_pages as $page)
                                    <li class="mb-1">
                                        <a href="{{ url('page', $page->slug) }}"
                                            class="text-decoration-none link-opacity-75-hover link-underline-opacity-100-hover link-offset-1 text-body-emphasis">
                                            <i class="ti ti-chevron-right"></i> {{ $page->title }}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Logo & SM - Bootstrap Brain Component -->
    <div class="pb-3">
        <div class="container">
            <div class="row gy-3 align-items-center">
                <div class="col-12 col-sm-6">
                    <div class="footer-logo-wrapper text-center text-sm-start">
                        <a href="#!">

                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-6">

                </div>
            </div>
        </div>
    </div>

    <!-- Copyright & Links - Bootstrap Brain Component -->
    <div>
        <div class="container pt-3 border-top border-light-subtle">
            <div class="row gy-3 align-items-lg-center">
                <div class="col-12 col-lg-6 order-1 order-lg-0">
                    <div class="copyright-wrapper d-block mb-1 fs-8 text-center text-lg-start">
                        {{ $global_option->site_name }} &copy; 2024. All Rights Reserved.
                    </div>

                </div>
                <div class="col-12 col-lg-6 order-0 order-lg-1">
                    <div class="link-wrapper">
                        <div class="credit-wrapper d-block text-secondary fs-8 text-center text-lg-end">
                            Built by<a href="https://grahastudio.com/" class="link-secondary text-decoration-none">
                                GrahaStudio</a> with <span class="text-danger">&#9829;</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
