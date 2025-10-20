@extends('layouts.app')

@section('title', 'Jobayer Academy - Dashboard')

@section('content')
    <div class="as-flex as-space-between as-w-95 dt:as-mw-1280px as-m-0-auto">
        <!-- Sidebar -->
        <div class="as-show-desktop as-mt-15px as-w-28">
            <div class="">
                <img class="as-w-50px" src="https://cdn-icons-png.flaticon.com/512/2436/2436874.png" alt="Logo" class="sidebar-logo">
                <h2>শীক্ষার্থী ড্যাশবোর্ড</h2>
            </div>

            <div class="as-mt-20px">
                <div>
                    <div class="as-app-cursor as-hover as-p-10px as-brr-5px" onclick="window.location.href = '/profile'"><i class="fas fa-user as-mr-10px"></i>প্রোফাইল</div>
                </div>
                <div>
                    <div class="as-app-cursor as-hover as-p-10px as-brr-5px" onclick="window.location.href = '/question-answer'"><i class="fas fa-question as-mr-10px"></i>প্রশ্ন ও উত্তর</div>
                </div>
                <div>
                    <div class="as-app-cursor as-hover as-p-10px as-brr-5px" onclick="window.location.href = '/settings'"><i class="fas fa-gear as-mr-10px"></i>সেটিংস</div>
                </div>
                <div>
                    <div class="logout as-app-cursor as-hover as-p-10px as-brr-5px" onclick="logout()"><i class="fas fa-sign-out-alt as-mr-10px"></i>লগআউট</div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="as-mt-15px as-w-70 md:as-w-100">
            <div>
                <div class="as-mb-20px">
                    <div class="as-f-20px as-f-bold">স্বাগতম <span style="color: var(--secondary-color);">{{ $student_name }}</span></div>
                    <div class="as-f-16px">আপনার শিক্ষার প্রগতি চালিয়ে যান</div>
                </div>

                {{-- @if($profile_percentage != 100)
                    <div class="pc-notification as-bg-red as-color-white as-p-10px as-brr-5px as-mb-20px as-flex as-space-between">
                        <div class="as-flex as-align-center">
                            <i class="fas fa-bell"></i> <p class="as-ml-10px">আপনার প্রফাইল {{100 - $profile_percentage}}% অসম্পূর্ণ</p>
                        </div>
                        <div>
                            <button class="as-app-cursor" style="background: white; color: black; padding: 5px; border: 0px; border-radius: 3px" onclick="window.location.href = '/profile'">
                                প্রফাইল সম্পূর্ণ করুন
                            </button>
                        </div>
                    </div>
                @endif --}}

                <!-- Current Courses -->
                <div class="">
                    <div class="as-f-20px as-f-bold">ভর্তি কোর্সসমূহ</div>
                    <div class="" id="dashboard-course-field">
                        <!-- loop here -->
                        <h3 style="text-align: center; color: grey;"><i class="fas fa-spinner fa-spin"></i> কোর্স লোডিং হচ্ছে...</h3>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('styles')
<style>
    .dashboard-courses-section h2{
        margin-bottom: 10px;
    }
    .dashboard-course-card{
        display: flex; background-color: #fff; border-radius: 5px; padding: 10px; margin-bottom: 10px;
        box-shadow: var(--shadow);
    }
    .dashboard-course-info{
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .dashboard-course-image img{
        width: 300px;
        height: 100%;
        object-fit: cover;
        border-radius: 5px;
    }
</style>
@endsection

@section('scripts')
<script>
    getEnrolledCourses();

    function getEnrolledCourses() {
        axios.get('/api/get-enrolled-course')
            .then(response => {

                let courses = response.data;
                let courseField = document.getElementById('dashboard-course-field');

                if(courses.length > 0){
                    courseField.innerHTML = ``;
                    courses.forEach(course => {
                        courseField.innerHTML += `
                            <div class="dashboard-course-card as-responsive-card">
                                <div class="dashboard-course-image">
                                    <img onclick="window.location.href = '/tutorial/${course.course.id}/${course.course.course_slug}'" class="image as-app-cursor" src="/storage/${course.course.course_thumbnail}" alt="image">
                                </div>
                                <div class="dashboard-course-info">
                                    <div class="as-ml-10px">
                                        <h3 onclick="window.location.href = '/tutorial/${course.course.id}/${course.course.course_slug}'" class="as-app-cursor">${course.course.course_name}</h3>
                                        <p>${course.course.course_tagline}</p>
                                        <div class="as-mt-10px as-mb-20px">
                                            <div id="course-progress-${course.course.id}">লোডিং...</div>
                                            <div class="tutorialview-progress-bar">
                                                <div class="tutorialview-progress" id="course-progress-bar-${course.course.id}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="as-text-right">
                                        <button onclick="window.location.href = '/exam/course/${course.course.id}'" class="as-btn as-app-cursor">
                                            পরীক্ষা দিন
                                        </button>
                                        <button onclick="window.location.href = '/certificate/course/${course.course.id}'" class="as-btn as-app-cursor">
                                            সার্টিফিকেট নিন
                                        </button>
                                        <button onclick="window.location.href = '/tutorial/${course.course.id}/${course.course.course_slug}'" class="as-btn as-app-cursor">
                                            ${course.is_new ? 'শুরু করুন' : 'চালিয়ে যান'}
                                            <i class="fas fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;

                        axios.post('/api/get-course-progress', {'course_id': course.course.id})
                            .then(res => {
                                const progress = Math.round(res.data.course_progress);
                                document.getElementById(`course-progress-${course.course.id}`).innerText = convertToBengali(progress) + ' %';
                                document.getElementById(`course-progress-bar-${course.course.id}`).style.width = progress + '%';
                            })
                            .catch(error => {
                                document.getElementById(`course-progress-${course.course.id}`).innerText = 'প্রগ্রেস পাওয়া যায়নি';
                            });
                    });

                }
                else{
                    courseField.innerHTML = `<h3 style="text-align: center; color: grey;">কোন কোর্সে ভর্তি নেই</h3>`;
                }
            })
            .catch(error => {});
    }
</script>
@endsection
