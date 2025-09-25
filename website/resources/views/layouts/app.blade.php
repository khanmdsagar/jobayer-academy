<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-T5ZVWPBG');</script>
    <!-- End Google Tag Manager -->

    <meta name="description"
        content="@yield('description', 'Jobayer Academy is a leading online skill development platform in Bangladesh. We offer courses on skincare product formulation, handmade soap art, resin art, product sourcing, and more.')">
    <meta name="keywords"
        content="Jobayer Academy, online course, skincare training, handmade soap, resin art, product sourcing, Bangladesh, skill development, learn online">

    {{-- Open Graph (Facebook) --}}
    <meta property="og:title" content="@yield('og_title', 'Jobayer Academy')" />
    <meta property="og:description"
        content="@yield('og_description', 'Jobayer Academy is a leading online skill development platform in Bangladesh. We offer courses on skincare product formulation, handmade soap art, resin art, product sourcing, and more.')" />
    <meta property="og:image" content="@yield('og_image', asset('image/icon/favicon.png'))" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="@yield('og_type', 'website')" />

    <link rel="stylesheet" href="{{ asset('css/asteroid.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/splide.min.css') }}" />
    <link rel="icon" href="{{ url('image/icon/favicon.png') }}" type="image/png">
    @yield('styles')
</head>

<body>
    <!-- oncontextmenu="return false;" -->

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T5ZVWPBG" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    {{--app sidebar--}}
    <div class="as-app-sidebar-background"></div>
    <div class="as-app-sidebar">
        <div class="as-app-sidebar-content">
            <div class="as-app-sidebar-header">
                <a href="/"><img width="138px" src="/image/icon/{{$site_data[0]->site_logo}}" alt="{{$site_data[0]->site_name}}"></a>
            </div>
            <hr>
            <div class="as-app-sidebar-menu">
                <div class="as-p-10px"><a href="{{url('/')}}" class="as-app-cursor"><i class="fas fa-house"></i>হোম</a></div>

                <div class="as-p-10px"><a href="/#featured-course" class="as-app-cursor"><i class="fas fa-book"></i>কোর্সসমূহ</a></div>

                @if(Route::currentRouteName() != 'about')
                    <div class="as-p-10px"><a href="{{url('/page/about-us')}}" class="as-app-cursor"><i class="fas fa-circle-question"></i>আমাদের সম্পর্কে</a></div>
                @endif

                @if(!Session::has('user_id') && Route::currentRouteName() != 'login')
                    <div class="as-p-10px"><a href="{{ url('login') }}" class="as-app-cursor"><i
                                class="fas fa-circle-user"></i>লগইন</a></div>
                @endif

                @if(Session::has('user_id'))
                    @if(Route::currentRouteName() != 'dashboard')
                        <div class="as-p-10px"><a href="{{ url('dashboard') }}" class="as-app-cursor"><i class="fas fa-square"></i>ড্যাশবোর্ড</a></div>
                    @endif
                    @if(Route::currentRouteName() != 'profile')
                        <div class="as-p-10px"><a href="{{ url('/profile') }}" class="as-app-cursor"><i class="fas fa-user"></i>প্রোফাইল</a></div>
                    @endif
                    @if(Route::currentRouteName() != 'settings')
                        <div class="as-p-10px"><a href="{{ url('/settings') }}" class="as-app-cursor"><i class="fas fa-gear"></i>সেটিংস</a></div>
                    @endif
                    <div class="as-p-10px">
                        <div class="logout as-app-cursor as-color-primary" onclick="logout()"><i class="fas fa-arrow-alt-circle-left"></i>লগআউট</div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{--main application--}}
    <div class="as-app-container">
        {{--navigation bar--}}
        <div class="as-app-navbar">
            <div class="as-app-navbar-content">
                <div>
                    <a rel="dofollow" href="/" class="as-app-cursor as-flex as-align-center as-justify-center">
                        <img width="120px" src="/image/icon/{{$site_data[0]->site_logo}}"
                            alt="{{$site_data[0]->site_name}}">
                    </a>
                </div>

                <div class="as-flex as-align-center">
                    @if(!Session::has('user_id') && Route::currentRouteName() != 'login')
                        <div>
                            <a href="/login" class="as-btn as-bg-secondary app-cursor as-mr-10px as-none md:as-block"
                                style="line-height: 1; color: var(--primary-color) !important;">লগইন</a>
                        </div>
                    @else
                        <div>
                            @if(Route::currentRouteName() != 'dashboard' && Route::currentRouteName() != 'login')
                                <a href="/dashboard" class="as-btn as-bg-secondary app-cursor as-mr-10px as-none md:as-block"
                                    style="line-height: 1; color: var(--primary-color) !important;">ড্যাশবোর্ড</a>
                            @endif
                        </div>
                    @endif
                    <div id="menu-icon" class="as-btn as-none as-app-cursor">
                        <i class="fas fa-bars" style="display: block"></i>
                    </div>
                </div>

                <div id="menu-desktop" class="as-flex as-list-style-none">
                    @if(Session::has('user_id'))
                        @if(Route::currentRouteName() != 'dashboard' && Route::currentRouteName() != 'profile' && Route::currentRouteName() != 'settings')
                            <div class="as-p-10px as-f-16px"><a href="/">হোম</a></div>

                            <div class="as-p-10px as-f-16px"><a href="/#featured-course">কোর্সসমূহ</a></div>

                            @if(Route::currentRouteName() != 'about')
                                <div class="as-p-10px as-f-16px"><a href="/page/about-us">আমাদের সম্পর্কে</a></div>
                            @endif
                            @if(Route::currentRouteName() != 'dashboard')
                                <div class="as-p-10px as-f-16px"><a href="/dashboard" class="as-btn app-cursor">ড্যাশবোর্ড</a></div>
                            @endif
                        @endif
                    @else
                        <div class="as-p-10px as-f-16px"><a href="/">হোম</a></div>

                        <div class="as-p-10px as-f-16px"><a href="/#featured-course">কোর্সসমূহ</a></div>

                        @if(Route::currentRouteName() != 'about')
                            <div class="as-p-10px as-f-16px"><a href="/page/about-us">আমাদের সম্পর্কে</a></div>
                        @endif
                        @if(Route::currentRouteName() != 'login')
                            <div class="as-p-10px as-f-16px"><a href="/login" class="as-btn app-cursor">লগইন</a></div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        {{--content section--}}
        <div class="as-app-body" id="as-app-body">
            <div class="as-app-body-content-full" id="as-app-body-content-full">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        const menuIcon = document.querySelector('#menu-icon');
        const appSidebar = document.querySelector('.as-app-sidebar');
        const appSidebarBackground = document.querySelector('.as-app-sidebar-background');

        appSidebarBackground.addEventListener('click', () => {
            appSidebar.style.left = '-250px';
            appSidebarBackground.style.display = 'none';
        });

        menuIcon.addEventListener('click', () => {
            appSidebar.style.left = '0px';
            appSidebarBackground.style.display = 'block';
        });

        document.getElementById('copyright').innerHTML = `&copy; Copyright ${new Date().getFullYear()} {{$site_data[0]->site_name}}`;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/videojs-youtube/dist/Youtube.min.js"></script>
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/splide.min.js') }}"></script>

    @yield('scripts')
</body>

</html>