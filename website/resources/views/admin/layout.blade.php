<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/asteroid.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/splide.min.css') }}" />
    <!-- Quill Styles -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

    <link rel="icon" href="{{ url('image/icon/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @yield('styles')
</head>

<body>
    <!-- oncontextmenu="return false;" -->
    <div class="overlay" id="overlay"></div>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
                <h1>{{$site_data[0]->site_name}}</h1>
            </div>
            <ul class="nav-links">
                <li>
                <div class="a as-app-cursor" onclick="window.location.href='/admin/dashboard'">
                    <i class="fas fa-home"></i> <span>Dashboard</span>
                </div>
                </li>

                <li>
                <div class="a as-app-cursor" onclick="window.location.href='/admin/asked-question'">
                    <i class="fas fa-question"></i> <span>Asked Question</span>
                </div>
                </li>

                <li>
                <div class="a as-app-cursor" onclick="window.location.href='/admin/category'">
                    <i class="fas fa-list"></i> <span>Category</span>
                </div>
                </li>

                <li>
                <div class="a as-app-cursor" onclick="window.location.href='/admin/course'">
                    <i class="fas fa-book-open"></i> <span>Course</span>
                </div>
                </li>

                <li>
                <div class="a as-app-cursor" onclick="window.location.href='/admin/student'">
                    <i class="fas fa-user-graduate"></i> <span>Student</span>
                </div>
                </li>

                <li>
                <div class="a as-app-cursor" onclick="window.location.href='/admin/comment'">
                    <i class="fas fa-comments"></i> <span>Comment</span>
                </div>
                </li>

                <li>
                <div class="a as-app-cursor" onclick="window.location.href='/admin/interest'">
                    <i class="fas fa-star"></i> <span>Interest</span>
                </div>
                </li>

                <li>
                <div class="a as-app-cursor" onclick="adminLogout()">
                    <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                </div>
                </li>

            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            @yield('content')
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/videojs-youtube/dist/Youtube.min.js"></script>
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>

    <!-- Quill Script -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

    <script>
        const quill = new Quill('#course-editor', {
            theme: 'snow',
            placeholder: 'কোর্সের বিস্তারিত',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'header': 1 }, { 'header': 2 }],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    ['link', 'image'],
                    ['clean']
                ]
            }
        });

    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/splide.min.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>

    @yield('scripts')
</body>

</html>