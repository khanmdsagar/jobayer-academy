@extends('layouts.app')
@section('title', 'Jobayer Academy')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div>
            <div class="as-f-40px">{{$site_data[0]->site_hero_title}}</div>
            <div class="as-f-20px as-mb-40px">{{$site_data[0]->site_slogan}}</div>
            <a href="#courses" class="as-btn">এক্সপ্লোর <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <section class="dt:as-mw-1280px as-m-0-auto">
        <!-- why we us -->
        <section>
            <div class="as-w-95 as-m-0-auto">
                <div class="as-section-title">কেনো জোবায়ের একাডেমী?</div>
                <div class="as-grid-250px">
                    @foreach($why_we_us as $wwu)
                        <div class="as-card as-p-20px as-text-center as-flex as-flex-center as-flex-col">
                            <div class="as-h-50px as-w-50px as-bg-primary as-color-white as-brr-50 as-flex as-flex-center as-mb-10px">
                                {!! $wwu->wwu_icon !!}
                            </div>
                            <h3>{{$wwu->wwu_title}}</h3>
                            <p>{{$wwu->wwu_description}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Featured Courses Section -->
        <section id="featured-course">
            <div class="as-w-95 as-m-0-auto">
                <div class="as-section-title">আমাদের কোর্স সমূহ</div>

                @if($course->count() == 1)
                    <div class="featured-course-box">
                        @foreach($course as $item)
                            <div class="as-responsive-card">
                                <div>
                                    <a style="display: inline-block" href="/course/{{$item->course_slug}}" class="as-app-cursor">
                                        <img class="image as-w-400px as-brr-5px as-image-fit" src="/image/course/{{$item->course_thumbnail}}" alt="image">
                                    </a>
                                </div>
                                <div class="as-p-10px as-flex as-flex-col as-space-between as-w-100">
                                    <div class="as-mb-10px as-p-10px">
                                        <div class="as-flex as-space-between as-align-center">
                                            <div>
                                                @if($item->course_fee != $item->course_selling_fee)
                                                    <span class="as-color-primary as-f-25px as-f-bold">৳{{$item->course_selling_fee}}</span>
                                                    <span class="as-f-bold"><s>৳{{$item->course_fee}}</s></span>
                                                @else
                                                    <span class="as-color-primary as-f-25px as-f-bold">৳{{$item->course_fee}}</span>
                                                @endif
                                            </div>
                                            <div>
                                                @if($item->course_level == 'Beginner')
                                                    <i class="fas fa-seedling"></i> Beginner
                                                @elseif($item->course_level == 'Intermediate')
                                                    <i class="fas fa-level-up-alt"></i> Intermediate
                                                @elseif($item->course_level == 'Advanced')
                                                    <i class="fas fa-rocket"></i> Advanced
                                                @endif
                                            </div>
                                        </div>
                                        <a style="display: inline-block" href="/course/{{$item->course_slug}}" class="as-app-cursor">
                                            <div class="as-lineclamp-2 as-f-20px">{{$item->course_name}}</div>
                                        </a>
                                    </div>
                                    <div class="as-text-right">
                                        <a style="display: inline-block" href="/course/{{$item->course_slug}}" class="as-btn as-app-cursor">
                                            বিস্তারিত <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="featured-course-grid">
                        @foreach($course as $item)
                            <div class="as-card">
                                <div>
                                    <a style="display: inline-block" href="/course/{{$item->course_slug}}" class="as-app-cursor">
                                        <img class="image as-w-100 as-brr-5px as-image-fit" src="/image/course/{{$item->course_thumbnail}}" alt="Course Image">
                                    </a>
                                </div>
                                <div class="as-p-10px as-flex as-flex-col as-space-between as-w-100">
                                    <div class="as-mb-10px">
                                        <div class="as-flex as-space-between as-align-center">
                                            <div>
                                                @if($item->course_fee != $item->course_selling_fee)
                                                    <span class="as-color-primary as-f-25px as-f-bold">৳{{$item->course_selling_fee}}</span>
                                                    <span class="as-f-bold"><s>৳{{$item->course_fee}}</s></span>
                                                @else
                                                    <span class="as-color-primary as-f-25px as-f-bold">৳{{$item->course_fee}}</span>
                                                @endif
                                            </div>
                                            <div>
                                                @if($item->course_level == 'Beginner')
                                                    <i class="fas fa-seedling"></i> Beginner
                                                @elseif($item->course_level == 'Intermediate')
                                                    <i class="fas fa-level-up-alt"></i> Intermediate
                                                @elseif($item->course_level == 'Advanced')
                                                    <i class="fas fa-rocket"></i> Advanced
                                                @endif
                                            </div>
                                        </div>
                                        <a style="display: inline-block" href="/course/{{$item->course_slug}}" class="as-app-cursor">
                                            <div class="as-lineclamp-1 as-f-20px">{{$item->course_name}}</div>
                                        </a>
                                    </div>
                                    <div class="as-text-right">
                                        <a style="display: inline-block" href="/course/{{$item->course_slug}}" class="as-btn as-app-cursor">
                                            বিস্তারিত <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <!-- Student Reviews Section -->
        <section>
            <div class="as-w-95 as-m-0-auto">
                <h2 class="as-section-title">শিক্ষার্থীদের মতামত</h2>

                <div class="splide" id="review-slider">
                    <div class="splide__track">
                        <ul class="splide__list" id="splide__list">
                            <!-- Slides will be appended here -->
                        </ul>
                    </div>
                </div>

            </div>
        </section>

        <!-- Gallery Section -->
        <section>
            <div class="as-w-95 as-m-0-auto">
                <h2 class="as-section-title">আমাদের গ্যালারি</h2>
                <div>
                    <div class="splide" id="gallery-slider">
                        <div class="splide__track">
                            <ul class="splide__list" id="splide__list2">
                                <!-- Slides will be appended here -->

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div id="lightbox" class="lightbox" onclick="closeLightbox()" style="display: none">
                <img id="lightbox-img" src="" alt="Expanded View">
            </div>
        </section>

        <!-- Blog Section -->
        <section class="as-mb-20px">
            <div class="as-w-95 as-m-0-auto">
                <h2 class="as-section-title">নতুন ব্লগ</h2>
                <div class="splide" id="blog-slider">
                    <div class="splide__track">
                        <ul class="splide__list" id="splide__list3">
                            <!-- Slides will be appended here -->
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <!-- Footer -->
    <footer class="footer as-bg-text as-color-white">
        <div class="footer-content">
            <div class="footer-section">
                <h3>{{$site_data[0]->site_name}}</h3>
                <p>{{$site_data[0]->site_slogan}}</p>
            </div>
            <div class="footer-section">
                <h3>যোগাযোগ</h3>
                <div class="footer-contact-info">
                    <div class="footer-info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>{{$site_data[0]->site_address}}</p>
                    </div>
                    <div class="footer-info-item">
                        <i class="fas fa-phone"></i>
                        <p>{{$site_data[0]->site_phone}}</p>
                    </div>
                    <div class="footer-info-item">
                        <i class="fas fa-envelope"></i>
                        <p>{{$site_data[0]->site_email}}</p>
                    </div>
                </div>
            </div>
            <div class="footer-section">
                <h3>লিঙ্কসমূহ</h3>
                <ul>
                    <li><a class="as-app-cursor" href="/">হোম</a></li>
                    <li><a class="as-app-cursor" href="#featured-course">কোর্সসমূহ</a></li>
                    <li><a class="as-app-cursor" href="{{url('/about')}}">আমাদের সম্পর্কে</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>আমাদের ফলো করুন</h3>
                <div class="social-links">
                    @foreach($social_link as $link)
                        <a class="as-app-cursor" href="{{$link->link}}" target="_blank"><i class="{{ $link->link_logo }}"></i></a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="footer-bottom" style="text-align: center; font-size: 14px">
            <span id="copyright" style="font-family: sans-serif"></span>
            <span>সর্বস্বত্ব সংরক্ষিত।</span>
        </div>
        <div style="text-align: center; font-family: sans-serif; font-size: 14px">Developed by Nobogram Technologies</div>
    </footer>

    <!-- Loading Spinner -->
    <div id="loader-wrapper">
        <div>
            <img width="138px" src="/image/icon/{{$site_data[0]->site_logo}}" alt="{{$site_data[0]->site_name}}">
        </div>
    </div>
@endsection

@section('styles')
<style>
/* Loader Wrapper */
#loader-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: white;
    z-index: 99999;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: opacity 0.5s ease, visibility 0.5s;
}

/* Hidden State */
#loader-wrapper.hidden {
    opacity: 0;
    visibility: hidden;
}

.featured-course-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 15px;
    margin: 0 auto;
}
.hero {
    height: 100vh;
    background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/image/other/{{$site_data[0]->site_hero_image}}');
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
}
</style>
@endsection


@section('scripts')
<script>
    window.addEventListener('load', function () {
        const loader = document.getElementById('loader-wrapper');
        loader.classList.add('hidden');
    });
</script>

<script>
getCourseReview();
getSiteGallery();
getBlog();

function getBlog(){
    const splideList = document.getElementById('splide__list3');

    axios.get('/api/get-blog')
    .then(response => {
        response.data.forEach(item => {
            const slide = document.createElement('li');
            slide.className = 'splide__slide blog-card';

            slide.innerHTML = `<article class="as-card">
                        <div>
                            <img class="as-w-100 as-brr-5px" src="/image/blog/${item.blog_thumbnail}" alt="Image">
                        </div>
                        <div class="as-p-10px">
                            <div class="as-title as-lineclamp-1">${item.blog_title}</div>
                            <div class="as-lineclamp-2">
                                ${item.blog_detail}
                            </div>
                            <div class="as-mt-10px as-flex as-justify-end">
                                <div class="as-app-cursor as-p-10px as-w-fit as-bg-primary as-brr-5px as-color-white" onclick="window.location.href='/blog/${item.blog_slug}'">
                                    আরো পড়ুন <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </article>`;
            splideList.appendChild(slide);
        });

        new Splide('#blog-slider', {
            type: 'loop',
            perPage: 3,
            gap: '1rem',
            autoplay: true,
            pagination: false,
            breakpoints: {
                1024: {
                    perPage: 2,
                },
                640: {
                    perPage: 1,
                },
            },
        }).mount();
    })
}

function getSiteGallery(){
    const splideList = document.getElementById('splide__list2');

    axios.get('/api/get-site-gallery')
    .then(response => {
        response.data.forEach(item => {
            const slide = document.createElement('li');
            slide.className = 'splide__slide';

            slide.innerHTML = `<div class="as-card"><img class="as-w-100 as-h-240px as-brr-5px" src="/image/gallery/${item.gallery_image}" alt="Image" onclick="openLightbox(this)"></div>`;
            splideList.appendChild(slide);
        });

        new Splide('#gallery-slider', {
            type: 'loop',
            perPage: 3,
            gap: '1rem',
            autoplay: true,
            pagination: false,
            breakpoints: {
                1024: {
                    perPage: 2,
                },
                640: {
                    perPage: 1,
                },
            },
        }).mount();
    })
}

function getCourseReview(){
    const splideList = document.getElementById('splide__list');

    axios.get('/api/get-review')
    .then(response => {
        response.data.forEach(item => {
            const slide = document.createElement('li');
            slide.className = 'splide__slide review-card';

            let stars = '';
            for (let i = 0; i < item.review_rating; i++) {
                stars += '<i class="fas fa-star"></i>';
            }

            var studentImage = ''

            if(item.student.student_photo == ''){
                studentImage = 'profile_avater.webp'
            }else{
                studentImage = item.student.student_photo
            }

            slide.innerHTML = `
                <div class="as-card as-text-center as-p-10px">
                    <div class="as-mb-10px">
                        <img class="as-w-50px as-h-50px as-brr-50 as-mb-10px" src="${studentImage == 'profile_avater.webp'? '/image/other/profile_avater.webp' : '/image/student/' + studentImage}" alt="Student">
                        <div class="">
                            <h3>${item.student.student_name}</h3>
                            <p class="as-f-fade">${item.course.course_name}</p>
                        </div>
                    </div>
                    <div class="as-mb-10px as-color-yellow">
                        ${stars}
                    </div>
                    <p class="">${item.review}</p>
                </div>
            `;
            splideList.appendChild(slide);
        });

        new Splide('#review-slider', {
            type: 'loop',
            perPage: 3,
            gap: '1rem',
            autoplay: true,
            pagination: false,
            breakpoints: {
                1024: {
                    perPage: 2,
                },
                640: {
                    perPage: 1,
                },
            },
        }).mount();
    })
  }

</script>
@endsection
