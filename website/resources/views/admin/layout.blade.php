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
    <link rel="stylesheet" href="{{ asset('css/splide.min.css') }}"/>
    <!-- Quill Styles -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    
    <link rel="icon" href="{{ url('image/icon/favicon.png') }}" type="image/png">

    <style>
        #course-editor{
            height: 300px;
        }

        #admin-sidebar {
            transition: all 0.3s;
            overflow: hidden;
        }
        .collapsed {
            width: 0px;
        }

        #student-list::-webkit-scrollbar {
            width: 5px !important;
            height: 3px !important;
        }
        #student-list::-webkit-scrollbar-thumb {
            background-color: var(--secondary-color)  !important;
            border-radius: 5px  !important;
        }
        #student-list::-webkit-scrollbar-track {
            background-color: var(--primary-color)  !important;
        }

        @media  screen and (max-width: 768px) {
            #admin-sidebar {
                width: 0px;
            }
            .collapsed {
                width: 250px !important;
            }
            #add-student-button{
                position: fixed;
                bottom: 10px;
                right: 10px;
                z-index: 1000 !important;
            }
        }
    </style>

    @yield('styles')
</head>
<body >
    <!-- oncontextmenu="return false;" -->
    <section class="as-flex"> 
        @yield('content')
    </section>

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
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'image'],
                    ['clean']
                ]
            }
        });
    </script>


    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/splide.min.js') }}"></script>

    @yield('scripts')
</body>
</html>
