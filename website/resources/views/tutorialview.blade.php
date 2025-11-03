@extends('layouts.app')

@section('title', 'Jobayer Academy - Course Tutorial')

@section('content')
    <div class="as-w-95 dt:as-mw-1280px as-m-0-auto as-mb-15px">
        <!-- Course Header -->
        <div class="as-card as-mt-15px as-mb-15px as-p-10px">
            <div class="tutorialview-course-info">
                <div class="as-f-25px as-f-bold">{{ $course_name }}</div>
                <p>{{ $course_tagline }}</p>
            </div>
            <div class="as-flex as-justify-end as-align-end">
                <div class="tutorialview-course-progress">
                    <div id="course-progress"></div>
                    <div class="tutorialview-progress-bar">
                        <div class="tutorialview-progress" id="course-progress-bar"></div>
                    </div>
                    <span>
                        <span id="course-topic-completed"></span> টি বিষয় সম্পন্ন / <span id="course-topic"></span> টি
                        বিষয়ের মধ্যে
                    </span>
                </div>
            </div>
        </div>

        <div class="as-flex as-space-between md:as-block as-mt-15px">
            <!-- Main Content Area -->
            <div class="as-card as-w-70 md:as-w-100">
                <!-- Video Container -->
                <div class="tutorialview-video-container">
                    <div class="tutorialview-video-player">
                        <div class="video-wrapper" id="video-wrapper">
                            <video id="videoPlayer" class="plyr" playsinline autoplay controls>
                                <source src="" type="video/mp4" />
                            </video>
                        </div>
                    </div>

                    <div id="video-info-container" style="display: none;">
                        <div class="tutorialview-video-info">
                            <h2 id="course-title" class="as-p-10px"></h2>
                        </div>
                        <div class="as-align-end as-p-10px" id="mark-complete-btn" style="display: none;">
                            <button class="as-btn" onclick="markAsComplete()">
                                <i class="fas fa-check-circle" style="margin-right: 5px;"></i> সম্পন্ন করুন
                            </button>
                        </div>
                    </div>

                </div>

                {{--tab--}}
                <div id="tab-container">
                    <div class="tab-buttons as-p-10px">
                        <button class="tab active app-cursor" onclick="showTab(event, 'tab1')">রিসোর্স ফাইল</button>
                        <button class="tab app-cursor" onclick="showTab(event, 'tab2')">প্রশ্ন জিজ্ঞাসা</button>
                        <button id="review-btn" class="tab app-cursor" onclick="showModal('review-modal')">রিভিউ
                            দিন</button>
                    </div>

                    <div id="tab1" class="tab-content active">
                        <div id="tab1-content">
                            {{--loop--}}
                            <h3 style="text-align: center; color: grey;">
                                <i class="fas fa-spinner fa-spin"></i> লোডিং হচ্ছে...
                            </h3>
                        </div>
                    </div>

                    <div id="tab2" class="tab-content">
                        <div class="as-align-end as-mb-10px">
                            <button class="app-cursor as-btn" onclick="showModal('ask-qsn-modal')">প্রশ্ন করুন</button>
                        </div>
                        <div id="tab2-content">
                            {{--loop--}}
                            <h3 style="text-align: center; color: grey;">
                                <i class="fas fa-spinner fa-spin"></i> লোডিং হচ্ছে...
                            </h3>
                        </div>
                        <div class="as-flex as-justify-center">
                            <button id="load-more-qsn-ans"
                                class="as-none as-f-bengali app-cursor as-bg-white as-p-10px as-br-0px">
                                আরও দেখুন <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Tutorial Sidebar -->
            <div class="as-card as-w-28 md:as-w-100 md:as-mt-15px as-p-10px" style="height: fit-content;">
                <div class="tutorialview-sidebar-header">
                    <h3>কোর্সের বিষয়বস্তু</h3>
                    <div class="as-divider"></div>
                </div>
                <div style="height: 550px" class="tutorialview-lesson-list as-overflow-y-auto" id="course-content">
                    <!-- Course Content will be loaded here -->
                </div>
            </div>
        </div>

    </div>

    {{--Review modal--}}
    <div class="as-modal" id="review-modal" style="display: none">
        <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">
            <div class="as-text-center as-w-100">
                <h2>রিভিউ</h2>
            </div>

            <div class="as-mt-10px">
                <span><b>স্টার</b></span><br>
                <select class="as-select" id="rating">
                    <option>5</option>
                    <option>4</option>
                    <option>3</option>
                    <option>2</option>
                    <option>1</option>
                </select>
            </div>
            <div class="as-mt-10px">
                <span><b>রিভিউ</b></span><br>
                <input id="review" class="as-input" type="text" value="">
            </div>

            <div class="as-mt-20px as-text-right">
                <button class="as-btn app-cursor as-bg-cancel" onclick="hideModal('review-modal')">বাতিল</button>
                <button class="as-btn app-cursor" onclick="submitReview()">জমা দিন</button>
            </div>
        </div>
    </div>

    {{--Question Modal--}}
    <div id="ask-qsn-modal" class="as-modal" style="display: none">
        <div class="as-modal-child as-bg-white as-p-15px as-m-15px as-brr-5px as-w-50 md:as-w-90">
            <h3>প্রশ্ন করুন</h3>
            <div class="as-align-end">
                <input class="as-input" type="text" id="qsnInput" placeholder="আপনার প্রশ্ন লিখুন..." />
                <button class="as-btn app-cursor as-bg-cancel" onclick="hideModal('ask-qsn-modal')">বাতিল</button>
                <button class="as-btn as-mt-10px" onclick="submitQsn()" id="submitQsn">জমা দিন</button>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .tutorialview-lesson-list::-webkit-scrollbar {
            width: 5px !important;
            height: 3px !important;
        }

        .tutorialview-lesson-list::-webkit-scrollbar-thumb {
            background-color: var(--secondary-color) !important;
            border-radius: 5px !important;
        }

        .tutorialview-lesson-list::-webkit-scrollbar-track {
            background-color: var(--primary-color) !important;
        }

        .video-wrapper {
            width: 100%;
            overflow: hidden;
            aspect-ratio: 16/9;
            display: none;
        }

        .video-wrapper iframe {
            width: 300%;
            height: 100%;
            margin-left: -100%;
        }

        /*ask question*/
        .askqsn-card {
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #cbcbcb;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .question {
            margin-top: 5px;
        }

        /*tab*/
        #tab-container {
            display: none
        }

        .tab-buttons {
            display: flex;
            gap: 5px;
            margin-bottom: 10px;
        }

        .tab-buttons button {
            border: 1px solid #ddd;
            outline: none !important;
            background: #fff;
        }

        .tab {
            padding: 10px 20px;
            border-radius: 4px;
            transition: 0.3s;
        }

        .tab.active {
            background-color: var(--primary-color);
            color: white;
        }

        .tab-content {
            display: none;
            padding: 15px;
            border-radius: 4px;
        }

        .tab-content.active {
            display: block;
        }

        .topic-list-active {
            background-color: var(--secondary-color);
            color: var(--primary-color);
        }

        .topic-list-active:hover {
            background-color: var(--primary-color) !important;
            color: #fff !important;
        }
    </style>
@endsection

@section('scripts')
    <script>
        axios.get('/api/check-login-isenrolled/{{$course_id}}')
            .then((response) => {
                if (response.data == 'notEnrolled') {
                    window.location.replace("/dashboard");
                }
            })

        //auto play last video
        window.addEventListener('load', function () {
            const isanytoPlayX = JSON.parse(localStorage.getItem('isanytoPlay' + {{$course_id}}));
            if (isanytoPlayX != null) {
                axios.get(`/api/get-video-data/${isanytoPlayX.topic_id}`)
                    .then(res => {
                        playVideoNow(res.data.topic_video, res.data.topic_name, res.data.id, isanytoPlayX.time);
                    })
            }
        });
        // document.addEventListener('DOMContentLoaded', function () {
        //     const isanytoPlayX = JSON.parse(localStorage.getItem('isanytoPlay' + {{$course_id}}));
        //     if (isanytoPlayX != null) {
        //         axios.get(`/api/get-video-data/${isanytoPlayX.topic_id}`)
        //             .then(res => {
        //                 playVideoNow(res.data.topic_video, res.data.topic_name, res.data.id, isanytoPlayX.time);
        //             })
        //     }
        // })

        getResource();
        getCourseContent();
        getCourseProgress();

        var videoData = [];
        var videoPlayArr = [];

        let topicID = 0;
        var loadQsnAns = 2;
        var qsnAnsLength = 0;
        var currentTopicId = 0;
        var currentTopicIsCompleted = 0;

        var loadMoreQsnAns = document.getElementById('load-more-qsn-ans');
        var markCompleteBtn = document.getElementById('mark-complete-btn');

        const player = new Plyr('#videoPlayer', {
            controls: [
                'play-large', 'play', 'progress', 'current-time',
                'mute',
                'settings', 'fullscreen'
            ],
            autoplay: true,
            muted: false,
            youtube: {
                noCookie: true,
                rel: 0,
                showinfo: 0,
                iv_load_policy: 3,
                modestbranding: 1,
                controls: 0,
            }
        });

        async function getCourseContent() {
            const response = await axios.get('/api/get-course-content/{{ $course_id }}');
            const courseContent = document.getElementById('course-content');

            response.data.course_content.forEach(chapter => {
                chapter.chapter_topic.forEach(topic => {
                    videoData.push(topic);
                });
            });

            let topic_ids = JSON.parse(response.data.topic_completion_ids[0].topic_ids);
            const firstParts = topic_ids.map(item => item.split("-")[0]);

            // if any video to play
            var isanytoPlay = localStorage.getItem('isanytoPlay' + {{$course_id}});
            if (isanytoPlay == null) {
                axios.get(`/api/get-video-data/${firstParts[0]}`)
                    .then(res => {
                        playVideoNow(res.data.topic_video, res.data.topic_name, res.data.id);
                    })
            }

            courseContent.innerHTML = '';
            courseContent.innerHTML = `<h3 id="content-load-indicator" style="text-align: center; color: grey;">
                                                                                                                                        <i class="fas fa-spinner fa-spin"></i>
                                                                                                                                    </h3>`;

            if (response.data) {
                document.getElementById('content-load-indicator').style.display = 'none';

                for (const item of response.data.course_content) {
                    courseContent.innerHTML += `
                                                                                                                <div class="as-mb-10px">
                                                                                                                    <div class="as-flex as-space-between">
                                                                                                                        <h3 class="as-mr-5px">${item.chapter_name}</h3>
                                                                                                                        <span class="as-date as-mr-10px">বিষয়: ${convertToBengali(item.chapter_topic.length)} টি</span>
                                                                                                                    </div>
                                                                                                                    <div>
                                                                                                                        ${item.chapter_topic.map(topic => {
                        const topicKey = `${topic.id}-1`;
                        const isCompleted = topic_ids.includes(topicKey);

                        let iconHtml = '';

                        if (isCompleted) {
                            iconHtml = `<i class="fas fa-check-circle" style="color: green;"></i>`;
                        } else {
                            iconHtml = `<i class="fa-solid fa-video" style="color: grey;"></i>`;
                        }
                        return `<div id="topic-list-${topic.id}" class="completed as-mr-10px as-brr-5px as-app-cursor" onclick="playVideoNow('${topic.topic_video}', '${topic.topic_name}', '${topic.id}')">
                                                                                                                                <div class="as-flex as-align-center as-p-7px">
                                                                                                                                    <div class="as-mr-10px">
                                                                                                                                        ${iconHtml}
                                                                                                                                    </div>
                                                                                                                                    <div>${topic.topic_name}</div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        `;
                    }).join('')}
                                                                                                                    </div>
                                                                                                                </div>`;
                }
            }
        }

        player.on('ready', () => {
            const controls = player.elements.controls;

            // Find the play button
            const playBtn = controls.querySelector('[data-plyr="play"]');

            // Create Prev button
            const prevBtn = document.createElement('button');
            prevBtn.className = 'plyr__control plyr__prev';
            prevBtn.innerText = '⏮';

            // Create Next button
            const nextBtn = document.createElement('button');
            nextBtn.className = 'plyr__control plyr__next';
            nextBtn.innerText = '⏭';

            // Insert Prev before Play
            controls.insertBefore(prevBtn, playBtn);

            // Insert Next after Play
            controls.insertBefore(nextBtn, playBtn.nextSibling);

            // Just console log for now
            prevBtn.addEventListener('click', () => playPreviousVideo());
            nextBtn.addEventListener('click', () => playNextVideo());
        });

        player.on('ended', () => {
            markAsComplete();
            setTimeout(playNextVideo, 500);
        });

        player.on('timeupdate', () => {
            const currentTime = player.currentTime;
            const duration = player.duration;

            if (duration > 0) {
                const percentagePlayed = (currentTime / duration) * 100;
                videoPlayed = percentagePlayed.toFixed(0);

                if (videoPlayed >= 70 && currentTopicIsCompleted == 0) {
                    markCompleteBtn.style.display = 'block';
                }
            }
        });

        loadMoreQsnAns.addEventListener('click', () => {
            loadQsnAns += 2;
            getAskQuestion(topicID);
        });

        function playPreviousVideo() {
            var nextTopicId = parseInt(currentTopicId) - 1;
            let topic = videoData.find(item => item.id == nextTopicId);
            playVideoNow(topic.topic_video, topic.topic_name, topic.id);
        }
        function playNextVideo() {
            var nextTopicId = parseInt(currentTopicId) + 1;
            let topic = videoData.find(item => item.id == nextTopicId);
            playVideoNow(topic.topic_video, topic.topic_name, topic.id);
        }

        function playVideoNow(videoId, courseTitle, topicId, playTime = null) {
            var videoWrapper = document.getElementById('video-wrapper');

            videoWrapper.style.display = 'block';

            var videoInfoContainer = document.getElementById('video-info-container');
            videoInfoContainer.style.display = 'block';

            document.getElementById('as-app-body-content-full').scrollIntoView({
                behavior: 'smooth'
            });

            axios.get('/api/topic-is-completed/' + {{$course_id}} + '/' + topicId)
                .then(res => {
                    currentTopicIsCompleted = res.data;
                });

            videoPlayArr.push(topicId);
            currentTopicId = topicId;

            player.source = {
                type: 'video',
                sources: [
                    {
                        src: videoId,
                        provider: 'youtube',
                    },
                ],
            };

            if (playTime != null) {
                player.once('ready', () => {
                    player.currentTime = playTime;
                    setTimeout(() => {
                        player.pause();
                        setTimeout(() => {
                            var conf = confirm('আপনি কি দেখা চালিয়ে যেতে চান?');
                            if (conf) { 
                                player.play();
                            }
                        }, 500);
                    }, 1000);
                });

                //tracking current video
                setTimeout(() => {
                    player.on('timeupdate', () => {
                        const key = 'isanytoPlay' + {{ $course_id }};
                        const data = {
                            topic_id: currentTopicId,
                            time: player.currentTime
                        };

                        localStorage.setItem(key, JSON.stringify(data));
                    });
                }, 1000);
            }
            else {
                //tracking current video
                setTimeout(() => {
                    player.on('timeupdate', () => {
                        const key = 'isanytoPlay' + {{ $course_id }};
                        const data = {
                            topic_id: currentTopicId,
                            time: player.currentTime
                        };

                        localStorage.setItem(key, JSON.stringify(data));
                    });
                }, 1000);
            }

            document.getElementById('course-title').innerHTML = courseTitle;
            topicID = topicId;

            const tabContainer = document.getElementById('tab-container');

            tabContainer.style.display = 'block';
            markCompleteBtn.style.display = 'none';

            getAskQuestion(topicID);

            var currentTopic = document.getElementById('topic-list-' + topicId);
            var previousTopic = document.getElementById('topic-list-' + videoPlayArr[videoPlayArr.length - 2]);

            currentTopic.classList.add('topic-list-active');
            previousTopic.classList.remove('topic-list-active');
        }

        function markAsComplete() {
            axios.post('/api/mark-as-complete', {
                topic_id: topicID,
                course_id: {{$course_id}}
                                                                                                        })
                .then(response => {
                    if (response.data.status == 'success') {
                        getCourseContent();
                        getCourseProgress();

                        setTimeout(function () {
                            var currentTopic = document.getElementById('topic-list-' + currentTopicId);
                            var previousTopic = document.getElementById('topic-list-' + videoPlayArr[videoPlayArr.length - 2]);

                            currentTopic.classList.add('topic-list-active');
                            previousTopic.classList.remove('topic-list-active');
                        }, 500);
                    }
                    else {
                        alert(response.data.message);
                    }
                });
        }

        function getAskQuestion(topicID) {
            const tab2Content = document.getElementById('tab2-content');

            axios.get('/api/get-ask-question/' + topicID)
                .then(res => {
                    qsnAnsLength = res.data.length;

                    tab2Content.innerHTML = '';

                    if (res.data.length == 0) {
                        tab2Content.innerHTML = `<h3 style="text-align: center; color: grey;">
                                                                                                                        কোন প্রশ্ন নেই!
                                                                                                                    </h3>`
                    }
                    else if (loadQsnAns >= qsnAnsLength) {
                        loadMoreQsnAns.style.display = 'none';
                    }
                    else {
                        loadMoreQsnAns.style.display = 'block';
                    }

                    for (var i = 0; i < loadQsnAns; i++) {
                        tab2Content.innerHTML += `<div class="askqsn-card as-mb-10px">
                                                                                                                                <div class="profile">
                                                                                                                                    <img src="${res.data[i].student_photo !== null && res.data[i].student_photo !== '' ? '/image/student/' + res.data[i].student_photo : '/image/other/profile_avater.webp'}" alt="Profile Picture">
                                                                                                                                    <div class="info as-w-100">
                                                                                                                                        <h3>${res.data[i].student_name}</h3>
                                                                                                                                        <p class="question"><b>প্রশ্ন: </b>${res.data[i].question}?</p>
                                                                                                                                        <p style="background-color: #f1f1f1; padding: 10px; width: 100%" class="answer as-brr-5px"><b>উত্তর: </b>${res.data[i].answer ? res.data[i].answer : '...'}</p>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                           </div>`
                    }
                })
        }

        function submitQsn() {
            var qsnInput = document.getElementById('qsnInput').value

            if (qsnInput == '') {
                alert('প্রশ্ন লিখুন');
            }
            else {
                axios.post('/api/submit-qsn', { question: qsnInput, course_id: {{$course_id}}, topic_id: topicID })
                    .then(res => {
                        if (res.data['success']) {
                            alert(res.data['success']);
                            getAskQuestion(topicID);
                            document.getElementById('qsnInput').value = '';
                            hideModal('ask-qsn-modal');
                        } else {
                            alert(res.data['error']);
                        }
                    })
            }
        }

        function getCourseProgress() {
            axios.post('/api/get-course-progress', { 'course_id': {{ $course_id }}})
                .then(res => {
                    document.getElementById('course-progress').innerHTML = convertToBengali(Math.round(res.data.course_progress)) + ' %';
                    document.getElementById('course-topic-completed').innerHTML = convertToBengali(res.data.course_topic_completed);
                    document.getElementById('course-topic').innerHTML = convertToBengali(res.data.course_topic);

                    document.getElementById('course-progress-bar').style.width = res.data.course_progress + '%';
                })
                .catch(error => {
                    console.log(error);
                });
        }

        function getResource() {
            const tab1Content = document.getElementById('tab1-content');

            axios.get('/api/get-resource/' + {{$course_id}})
                .then(res => {
                    if (res.data.length == 0) {
                        tab1Content.innerHTML = `<h3 style="text-align: center; color: grey;">
                                                                                                                        কোন ফাইল নেই!
                                                                                                                    </h3>`
                    }
                    else {
                        tab1Content.innerHTML = '';

                        for (var i = 0; i < res.data.length; i++) {
                            tab1Content.innerHTML += `<div class="as-flex as-space-between as-br-1px as-p-10px as-mb-5px as-brr-5px">
                                                                                                                        <div class="as-flex as-align-center">
                                                                                                                            ${res.data[i].resource_type == 'file' ?
                                    `<div><i class="fas fa-file"></i></div>`
                                    :
                                    `<div><i class="fas fa-link"></i></div>`
                                }
                                                                                                                            <div class="as-ml-10px">${res.data[i].resource_name}</div>
                                                                                                                        </div>
                                                                                                                        <div class="as-flex as-align-center">
                                                                                                                            ${res.data[i].resource_type == 'file' ?
                                    `<a download rel="nofollow" href="/storage/${res.data[i].resource_url}" class="app-cursor as-btn">
                                                                                                                                    ডাউনলোড
                                                                                                                                </a>`
                                    :
                                    `<a download target="_blank" rel="nofollow" href="${res.data[i].resource_url}" class="app-cursor as-btn">
                                                                                                                                    ভিজিট
                                                                                                                                </a>`
                                }
                                                                                                                        </div>
                                                                                                                    </div>`
                        }
                    }
                })
        }

        function submitReview() {
            var review = document.getElementById("review").value;
            var rating = document.getElementById("rating").value;

            if (review == '') {
                alert('আপনার রিভিউ দিন।');
            }
            else {
                axios.post('/api/submit-review', { 'student_review': review, 'course_id': {{$course_id}}, 'student_rating': rating })
                    .then(res => {
                        if (res.data['status'] == 200) {
                            alert(res.data['message']);
                            hideModal('review-modal');
                            document.getElementById('review-btn').style.display = 'none';
                        }
                        else {
                            alert(res.data['message']);
                            hideModal('review-modal');
                        }
                    });
            }
        }

        isReviewed();
        function isReviewed() {
            axios.post('/api/is-reviewed', { 'course_id': {{$course_id}}})
                .then(res => {
                    if (res.data == 1) {
                        document.getElementById('review-btn').style.display = 'none';
                    }
                });
        }

        function showTab(event, tabId) {
            const tabs = document.querySelectorAll('.tab');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => tab.classList.remove('active'));
            contents.forEach(content => content.classList.remove('active'));

            event.currentTarget.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        }
    </script>
@endsection