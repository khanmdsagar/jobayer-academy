@extends('admin.layout')
@section('title', 'Admin - student')

@section('content')
<div class="as-flex">
    <!-- sidebar -->
    <div id="admin-sidebar" class="as-w-200px as-bg-white as-h-100vh">
        @include('admin.sidebar')
    </div>
</div>

<div class="as-w-100">
    <!-- navbar -->
   <div style="height: 15vh;">
        <div class="as-p-10px">
            <i onclick="toggleAdminSidebar()" class="fas fa-bars as-app-cursor as-f-20px as-mr-10px"></i>
            <span class="as-f-bold as-f-20px">শিক্ষার্থী তথ্য</span>
        </div>
        <div class="actions as-flex as-justify-end">
            <!-- <span class="as-p-10px as-app-cursor"><i onclick="editStudent({{$student_data->id}})" class="fa-solid fa-pen-to-square as-app-cursor as-f-20px"></i></span> -->
            <span class="as-p-10px as-app-cursor"><i onclick="deleteStudent({{$student_data->id}})" class="fa-solid fa-trash as-app-cursor as-f-20px"></i></span>
            <span class="as-p-10px as-app-cursor"><i onclick="showModal('enroll-student')" class="fa-solid fa-graduation-cap as-app-cursor as-f-20px"></i></span>
        </div>
   </div> 
    
    <!-- student list -->
    <div style="height: 85vh; overflow-y: auto;" id="student-list" class="as-p-10px">
        <div class="as-card">
            <div class="as-p-10px"><b>শিক্ষার্থী আইডি</b>: {{$student_data->id}}</div>
            <div class="as-p-10px"><b>নাম</b>: @if($student_data->student_name == '') নাম নেই @else {{$student_data->student_name}} @endif</div>
            <div class="as-p-10px"><b>ইমেইল</b>: @if($student_data->student_email == '') ইমেইল নেই @else {{$student_data->student_email}} @endif</div>
            <div class="as-p-10px"><b>ফোন</b>: @if($student_data->student_number == '') ফোন নেই @else {{$student_data->student_number}} @endif</div>
            <div class="as-p-10px"><b>জন্ম তারিখ</b>: @if($student_data->student_birthday == '') জন্ম তারিখ নেই @else {{$student_data->student_birthday}} @endif</div>
            <div class="as-p-10px"><b>ঠিকানা</b>: @if($student_data->student_address == '') ঠিকানা নেই @else {{$student_data->student_address}} @endif</div>
            <div class="as-p-10px"><b>প্রতিষ্ঠান</b>: @if($student_data->student_profession == '') প্রতিষ্ঠান নেই @else {{$student_data->student_profession}} @endif</div>
            <div class="as-p-10px"><b>বিভাগ</b>: @if($student_data->student_division == '') বিভাগ নেই @else {{$student_data->student_division}} @endif</div>
            <div class="as-p-10px"><b>জেলা</b>: @if($student_data->student_district == '') জেলা নেই @else {{$student_data->student_district}} @endif</div>
            <div class="as-p-10px"><b>ফেসবুক প্রোফাইল</b>: @if($student_data->student_profile_url == '') ফেসবুক প্রোফাইল নেই @else {{$student_data->student_profile_url}} @endif</div>
            <div class="as-p-10px"><b>ফেসবুক পেজ</b>: @if($student_data->student_page_url == '') ফেসবুক পেজ নেই @else {{$student_data->student_page_url}} @endif</div>
            <div class="as-p-10px"><b>নিবন্ধন তারিখ</b>: @if($student_data->created_at == '') নিবন্ধন তারিখ নেই @else {{$student_data->created_at}} @endif</div>
            <div class="as-p-10px"><b>নোট</b>: @if($student_data->student_note == '') নোট নেই @else {{$student_data->student_note}} @endif</div>
            <div class="as-p-10px"><b>ভর্তি কোর্স</b>: {{$student_data->student_enrolled_course}}</div>
        </div>
        <div class="as-card as-mt-10px">
            <div class="as-p-10px"><b>ভর্তি কোর্স তালিকা</b></div>
            <div>
                @if(count($enrolled_course) > 0)
                    @foreach($enrolled_course as $course)
                        <div class="as-p-10px as-flex as-space-between">
                            <span>
                                <div>{{$course->course->course_name}}</div>
                                <div class="as-date">ভর্তি তারিখ: {{$course->enrolled_date}}</div>
                            </span>
                            <span onclick="unenrollCourse({{$course->id}})"><i class="fa-solid fa-xmark as-app-cursor"></i></span>
                        </div>
                    @endforeach
                @else
                    <div class="as-p-10px">কোন কোর্সে ভর্তি নেই</div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- enroll modal -->
<div class="as-modal" id="enroll-student" style="display: none">
    <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

        <div class="as-text-center as-w-100">
            <h2>কোর্স ভর্তি ফর্ম</h2>
        </div>

        <div class="as-modal-child as-p-10px">
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>কোর্স</b></div>
                <select id="course" class="as-select">
                    <option hidden value="" disabled selected>কোর্স নির্বাচন করুন</option>
                    @foreach($site_course as $course)
                        <option value="{{$course->id}}">{{$course->course_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="as-mt-20px as-text-right">
            <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('enroll-student')">বাতিল করুন</button>
            <button id="add-info-button" class="as-btn as-app-cursor" onclick="enrollStudent({{$student_data->id}})">ভর্তি করুন</button>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function enrollStudent(student_id){
        const course_id = document.getElementById('course').value;
        const data = {
            student_id: student_id,
            course_id: course_id
        }

        if(course_id == ''){
            alert('কোর্স নির্বাচন করুন');
        }
        else{
            axios.post('/admin/student/enroll', data)
                .then(function(response){
                    alert(response.data.message);

                    if(response.data.status == 200){
                        location.reload();
                    }
                    else{
                        hideModal('enroll-student');
                    }
                })
                .catch(function(error){
                    console.log(error);
                });
        }

    }

    function unenrollCourse(enrolled_course_id, student_id){
        const data = {
            enrolled_course_id: enrolled_course_id,
        }

        var confirm = window.confirm('কোর্স বাতিল করবেন কি?');
        if(confirm){
            axios.post('/admin/student/unenroll', data)
                .then(function(response){
                    alert(response.data.message);
                    location.reload();
                })
                .catch(function(error){
                    console.log(error);
                });
        }
    }

    function deleteStudent(student_id){
        var confirm = window.confirm('শিক্ষার্থী তথ্য মুছে ফেলবেন কি?');
        if(confirm){
            axios.post('/admin/student/delete', {student_id: student_id})
                .then(function(response){
                    alert(response.data.message);
                    window.location.replace('/admin/student');
                })
                .catch(function(error){
                    console.log(error);
                });
        }
    }
</script>
@endsection