@extends('layouts.app')
@section('title', 'Jobayer Academy - Course Detail')

@section('content')
    {{--course header--}}
    <div class="as-bg-primary as-color-white as-m-b-20px">
        <div class="as-w-95 dt:as-mw-1280px as-m-0-auto as-p-t-b-40px">
            <div>
                @if($course->course_fee != $course->course_selling_fee)
                    <span class="as-color-secondary as-f-40px">৳{{$course->course_selling_fee}}</span>
                    <span class=""><s>৳{{$course->course_fee}}</s></span>
                @else
                    <span class="as-color-secondary as-f-40px">৳{{$course->course_fee}}</span>
                @endif
            </div>
            <div class="as-f-30px">{{$course->course_name}}</div>
        </div>
    </div>

    {{--course content--}}
    <div class="as-w-95 dt:as-mw-1280px as-m-0-auto as-flex md:as-block">

        {{--content--}}
        <div class="as-mt-15px as-mr-15px as-w-70 md:as-w-100">

            <div id="video-wrapper" class="video-wrapper" style="display: none">
                <video id="videoPlayer" class="plyr" playsinline autoplay controls>
                    <source src="" type="video/mp4" />
                </video>
            </div>

            <div class="as-card as-p-15px as-mb-15px">
                <div class="as-mb-10px as-f-20px as-f-bold">কোর্স বিবরণ</div>
                {!! $course->course_description !!}
            </div>

            {{-- question and answer --}}
            @if($is_qsn_ans > 0)
                <div class="as-card as-p-15px as-mb-15px">
                    <div class="as-mb-10px as-f-20px as-f-bold">কিছু প্রশ্ন ও উত্তর</div>

                    <div id="qsnansdiv">
                        {{--loop--}}
                        <h3 style="text-align: center; color: grey; padding: 20px;"><i class="fas fa-spinner fa-spin"></i>
                            প্রশ্ন ও উত্তর লোডিং হচ্ছে...</h3>
                    </div>

                    <div class="as-mt-10px as-text-center">
                        <button id="see-all-qnsans" class="as-f-bengali as-app-cursor as-bg-white as-p-10px as-br-0px">
                            সবগুলো দেখুন <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                </div>
            @endif

            @if($is_course_curriculum > 0)
                <div class="as-card as-p-15px as-mb-15px">
                    <div class="as-mb-10px as-f-20px as-f-bold">কোর্স কারিকুলাম</div>

                    <div id="course-curriculum-container">
                        <!-- loop -->
                        <h3 style="text-align: center; color: grey; padding: 20px;">
                            <i class="fas fa-spinner fa-spin"></i> কোর্স কারিকুলাম লোডিং হচ্ছে...
                        </h3>
                    </div>
                </div>
            @endif

            <!-- Course Reviews Section -->
            @if($is_course_review > 0)
                <div class="as-card as-p-15px as-mb-15px">
                    <div class="as-mb-10px as-f-20px as-f-bold">কোর্স রিভিউ</div>

                    <div class="as-mb-20px">
                        <div class="as-f-35px" id="rating-number"></div>
                        <div class="">
                            <div class="as-color-yellow" id="rating-star">
                                <!-- loop -->
                            </div>
                            <div id="total-review"></div>
                        </div>
                    </div>

                    <div id="review-list">
                        <div class="review-container" id="review-container">
                            <!-- loop here -->
                            <h3 style="text-align: center; color: grey; padding: 20px;"><i class="fas fa-spinner fa-spin"></i>
                                রিভিউ লোডিং হচ্ছে...</h3>
                        </div>

                        <div class="as-text-center">
                            <button id="load-more-review" class="as-f-bengali as-app-cursor as-bg-white as-p-10px as-br-0px">
                                আরও দেখুন <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{--side bar--}}
        <div class="as-mt-15px as-w-30 md:as-w-100">
            <div class="as-card as-p-15px as-text-center">
                <img class="as-w-100px as-h-100px as-brr-50"
                    src="/image/instructor/{{$course->instructor['instructor_photo']}}" alt="Instructor">
                <h3>{{$course->instructor['instructor_name']}}</h3>
                <p>{{$course->instructor['instructor_designation']}}</p>
            </div>

            <div class="as-card as-p-15px as-mt-15px md:as-mb-76px">
                <div class="as-mb-10px as-f-20px as-f-bold">কোর্স হাইলাইটস</div>
                <div>
                    <div class="as-mb-10px"><i class="fas fa-clock"></i> সময়কাল : {{$course->course_duration}}</div>
                    <div class="as-mb-10px"><i class="fas fa-video"></i> ভিডিও সংখ্যা : {{$video_number}} টি</div>
                    <div class="as-mb-10px"><i class="fas fa-users"></i> শিক্ষার্থী সংখ্যা : {{$student_number}} জন</div>
                    <div><i class="fas fa-star"></i> কোর্স রেটিং : &nbsp <span id="rating-number2"></span> /5.00</div>
                </div>
            </div>

            <div class="course-cta md:as-none as-mt-15px">
                @if($is_student_enrolled > 0)
                    <a rel="nofollow" href="{{ url('tutorial/' . $course_id . '/' . $course_slug) }}"
                        class="as-mb-15px as-app-cursor as-shadow-lw as-btn as-flex as-align-center as-justify-center">
                        কোর্স দেখুন <i class="as-ml-10px fas fa-arrow-right"></i>
                    </a>
                @else
                    <div>
                        <a rel="nofollow" href="{{ url('checkout/' . $course_id . '/' . $course_slug) }}"
                            class="as-mb-15px as-app-cursor as-shadow-lw as-btn as-flex as-align-center as-justify-center">
                            ভর্তি হন <i class="as-ml-10px fas fa-arrow-right"></i>
                        </a>
                    </div>
                @endif
            </div>

            {{--enroll div mobile--}}
            <div
                class="as-none md:as-block md:as-fixed as-bottom-0 as-left-0 as-w-100 as-p-10px as-bg-white as-shadow-lw-up">
                @if($is_student_enrolled > 0)
                    <a rel="nofollow" href="{{ url('tutorial/' . $course_id . '/' . $course_slug) }}"
                        class="as-app-cursor as-shadow-lw as-btn as-flex as-align-center as-justify-center">
                        কোর্স দেখুন <i class="as-ml-10px fas fa-arrow-right"></i>
                    </a>
                @else
                    <div class="as-flex as-space-between">
                        <div class="as-mr-10px">
                            @if($course->course_fee != $course->course_selling_fee)
                                <span class="as-color-secondary as-f-30px">৳{{$course->course_selling_fee}}</span>
                                <span class=""><s>৳{{$course->course_fee}}</s></span>
                            @else
                                <span class="as-color-secondary as-f-30px">৳{{$course->course_fee}}</span>
                            @endif
                        </div>
                        <div>
                            <a rel="nofollow" href="{{ url('checkout/' . $course_id . '/' . $course_slug) }}"
                                class="as-app-cursor as-w-100 as-shadow-lw as-btn as-flex as-align-center as-justify-center">
                                ভর্তি হন <i class="as-ml-10px fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection

@section('styles')
    <style>
        .course-description ul {
            padding: 10px 10px 10px 35px;
        }

        .accordion {
            padding: 15px;
            width: 100%;
            text-align: left;
            border: none;
            outline: none;
            transition: background-color 0.3s;
            margin-bottom: 5px;
            border-radius: 4px;
        }

        .panel {
            display: none;
        }

        .topic-list {
            padding: 10px;
            border-radius: 5px;
        }

        .show {
            display: block;
        }

        .video-wrapper {
            width: 100%;
            overflow: hidden;
            aspect-ratio: 16/9;
        }

        .video-wrapper iframe {
            width: 300%;
            height: 100%;
            margin-left: -100%;
        }
    </style>
@endsection

@section('scripts')
    <script>
        getCourseCurriculum();
        getReview();
        getQuestionAnswer();

        var loadQsnAns = 2;
        var qsnAnsLength = 0;
        var seeAllQsnAns = document.getElementById('see-all-qnsans');

        if ({{$is_qsn_ans}} > 0) {
            seeAllQsnAns.addEventListener('click', () => {
                loadQsnAns = qsnAnsLength;
                getQuestionAnswer();

                if (loadQsnAns == qsnAnsLength || loadQsnAns < 3) {
                    seeAllQsnAns.style.display = 'none';
                }
            });
        }

        function getQuestionAnswer() {

            if ({{$is_qsn_ans}} > 0) {
                var qsnAnsDiv = document.getElementById('qsnansdiv');

                axios.get('/api/get-question-answer/' + {{$course_id}})
                    .then(res => {
                        qsnAnsDiv.innerHTML = '';

                        for (var i = 0; i < loadQsnAns; i++) {
                            qsnAnsLength = res.data.length;

                            qsnAnsDiv.innerHTML += `
                                        <div class="as-mb-10px">
                                            <div><b>প্রশ্ন: ${res.data[i]['question']}</b></div>
                                            <div>
                                                <b>উত্তর:</b> ${res.data[i]['answer']}
                                            </div>
                                        </div>
                                `
                        }
                    });
            }
        }

        const player = new Plyr('#videoPlayer', {
            youtube: {
                noCookie: true,
                rel: 0,
                showinfo: 0,
                iv_load_policy: 3,
                modestbranding: 1,
                controls: 0,
            }
        });

        function playVideoNow(videoId) {
            document.getElementById('video-wrapper').style.display = 'block';

            player.source = {
                type: 'video',
                sources: [
                    {
                        src: videoId,
                        provider: 'youtube',
                    },
                ],
            };

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function getCourseCurriculum() {
            var courseCurriculumContainer = document.getElementById('course-curriculum-container');

            axios.get('/api/get-course-curriculum/' + {{$course_id}})
                .then(function (response) {
                    courseCurriculumContainer.innerHTML = '';

                    response.data.forEach(function (courseChapter) {
                        courseCurriculumContainer.innerHTML += `
                                <div style="border: 1px solid lightgrey" onclick="expand(${courseChapter.id})" class="as-app-cursor as-accordion-hover accordion as-flex as-space-between">
                                    <div>${courseChapter.chapter_name}</div>
                                    <div><i class="fa-solid fa-caret-down"></i></div>
                                </div>

                                <div class="panel panel${courseChapter.id}">
                                    ${courseChapter.chapter_topic.map(function (chapterTopic) {
                            return `
                                            <div ${chapterTopic.topic_is_free ? `class="topic-list as-list-hover app-cursor panel-item as-flex as-space-between"` : `class="topic-list as-list-hover panel-item as-flex as-space-between"`} ${chapterTopic.topic_is_free ? `onclick="checkLogin('${chapterTopic.topic_video}')"` : ''}>
                                                <div>${chapterTopic.topic_name}</div>
                                                <div>
                                                    <i class="fa-solid ${chapterTopic.topic_is_free ? 'fa-eye' : 'fa-lock'}"></i>
                                                </div>
                                            </div>
                                        `;
                        }).join('')}
                                </div>
                            `;
                    })
                })
                .catch(function (error) {
                    console.log(error);
                })
        }

        function checkLogin(videoId) {
            axios.get('/api/check-login')
                .then((response) => {
                    if (response.data == 'loggedIn') {
                        playVideoNow(videoId);
                    }
                    else {
                        var conf = confirm("ফ্রি ভিডিও দেখতে লগইন/রেজিস্ট্রেশন করতে হবে, আপনি কি লগইন করতে চান?");

                        if (conf) {
                            window.location.href = '/login/{{$course_id}}/{{$course_slug}}/curriculumn';
                        }
                    }
                })
        }

        function expand(id) {
            document.querySelector('.panel' + id).classList.toggle('show');
        }

        var loadReview = 3;
        var loadMoreReview = document.getElementById('load-more-review');

        loadMoreReview.addEventListener('click', () => {
            loadReview += 3;
            getReview();
        })

        function getReview() {
            var reviewContainer = document.getElementById('review-container');
            var reviewList = document.getElementById('review-list');
            var totalRating = 0;

            axios.get('/api/get-review/' + {{$course_id}})
                .then(res => {

                    if (res.data.length != 0) {
                        reviewContainer.innerHTML = '';
                        document.getElementById('total-review').innerText = `(${convertToBengali(res.data.length)}  রিভিউ)`;

                        for (var k = 0; k < res.data.length; k++) {
                            var review = res.data[k];
                            totalRating += review.review_rating;
                        }

                        var finalRating = totalRating / res.data.length;

                        document.getElementById('rating-number').innerText = finalRating.toFixed(1);
                        document.getElementById('rating-number2').innerText = finalRating.toFixed(1);

                        var ratingStar = document.getElementById('rating-star');

                        ratingStar.innerHTML = '';

                        for (var l = 0; l < Math.floor(finalRating); l++) {
                            ratingStar.innerHTML += `<i class="fas fa-star"></i>`;
                        }

                        const hasHalfStar = finalRating % 1 >= 0.1 && finalRating % 1 < 0.9;

                        if (hasHalfStar) {
                            ratingStar.innerHTML += '<i class="fas fa-star-half-alt"></i>';
                        }

                        for (var i = 0; i < loadReview; i++) {
                            var reviewStar = '';
                            var review = res.data[i];

                            if (i + 1 == res.data.length) {
                                loadMoreReview.style.display = 'none';
                            }

                            for (var j = 0; j < review.review_rating; j++) {
                                reviewStar += '<i class="fas fa-star"></i> ';
                            }

                            reviewContainer.innerHTML += `
                                <div class="as-mb-20px">
                                    <div class="as-mb-10px">
                                        <img class="as-w-50px as-h-50px as-brr-50" src="${res.data[i].student.student_photo ? '/image/student' + res.data[i].student.student_photo : '/image/other/profile_avater.webp'}" alt="User">
                                        <div>
                                            <h4>${review.student.student_name}</h4>
                                            <div class="as-color-yellow">
                                                ${reviewStar}
                                                (${review.review_rating})
                                            </div>
                                        </div>
                                    </div>
                                    <p class="">${review.review}</p>
                                    <div class="as-date">তারিখ: ${review.review_date}</div>
                                </div>`
                        }
                    }
                    else {
                        reviewList.innerHTML = `<h3 style="text-align: center; color: grey; padding: 10px;">কোন রিভিউ নেই</h3>`;
                    }
                })
        }
    </script>
@endsection