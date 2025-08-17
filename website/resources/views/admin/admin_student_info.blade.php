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
   <div style="height: 10vh;">
        <div class="as-p-10px">
            <i onclick="toggleAdminSidebar()" class="fas fa-bars as-app-cursor as-f-20px as-mr-10px"></i>
            <span class="as-f-bold as-f-20px">Student Info</span>
        </div>
        <div class="actions as-flex as-justify-end">
            <!-- <span class="as-p-10px as-app-cursor"><i onclick="editStudent({{$student_data->id}})" class="fa-solid fa-pen-to-square as-app-cursor as-f-20px"></i></span> -->
            <span class="as-p-10px as-app-cursor"><i onclick="deleteStudent({{$student_data->id}})" class="fa-solid fa-trash as-app-cursor as-f-20px"></i></span>
            <span class="as-p-10px as-app-cursor"><i onclick="showModal('enroll-student')" class="fa-solid fa-graduation-cap as-app-cursor as-f-20px"></i></span>
        </div>
   </div> 
    
    <!-- student list -->
    <div style="height: 90vh; overflow-y: auto;" id="student-list" class="as-p-10px">
        <div class="as-card">
            <div class="as-p-10px"><b>Student Id</b>: {{$student_data->id}}</div>
            <div class="as-divider"></div>
            <div class="as-p-10px"><b>Fullname</b>: {{$student_data->student_name == '' ? '...' : $student_data->student_name}}</div>
            <div class="as-divider"></div>
            <div class="as-p-10px"><b>Email</b>: {{$student_data->student_email == '' ? '...' : $student_data->student_email}}</div>
            <div class="as-divider"></div>
            <div class="as-p-10px"><b>Phone</b>: {{$student_data->student_number}}</div>
            <div class="as-divider"></div>
            <div class="as-p-10px"><b>Date of Birth</b>: {{$student_data->student_birthday == '' ? '...' : $student_data->student_birthday}}</div>
            <div class="as-divider"></div>
            <div class="as-p-10px"><b>Address</b>: {{$student_data->student_address == ''? '...' :$student_data->student_address}}</div>
            <div class="as-divider"></div>
            <div class="as-p-10px"><b>Profession</b>: {{$student_data->student_profession == '' ? '...' :$student_data->student_profession}}</div>
            <div class="as-divider"></div>
            <div class="as-p-10px"><b>Division</b>: {{$student_data->student_division == '' ? '...' :$student_data->student_division}}</div>
            <div class="as-divider"></div>
            <div class="as-p-10px"><b>District</b>: {{$student_data->student_district == '' ? '...' :$student_data->student_district}}</div>
            <div class="as-divider"></div>
            <div class="as-p-10px"><b>FB Profile</b>: {{$student_data->student_profile_url == '' ? '...' :$student_data->student_profile_url}}</div>
            <div class="as-divider"></div>
            <div class="as-p-10px"><b>FB Page</b>: {{$student_data->student_page_url == '' ? '...' :$student_data->student_page_url}}</div>
            <div class="as-divider"></div>
            <div class="as-p-10px"><b>Registration Date</b>: {{$student_data->created_at == '' ? '...' : $student_data->created_at}}</div>
            <div class="as-divider"></div>
            <div class="as-p-10px"><b>Note</b>: {{$student_data->student_note == '' ? '...' : $student_data->student_note}}</div>
            <div class="as-divider"></div>
            <div class="as-p-10px"><b>Enrolled Course</b>: {{$student_data->student_enrolled_course}}</div>
        </div>
        <div class="as-card as-mt-10px">
            <div class="as-p-10px"><b>Enrolled Course List</b></div>
            <div>
                @if(count($enrolled_course) > 0)
                    @foreach($enrolled_course as $course)
                        <div class="as-p-10px as-flex as-space-between">
                            <span>
                                <div>{{$course->course->course_name}}</div>
                                <div class="as-date">Enrolled Date: {{$course->enrolled_date}}</div>
                            </span>
                            <span onclick="unenrollCourse({{$course->id}})"><i class="fa-solid fa-xmark as-app-cursor"></i></span>
                        </div>
                    @endforeach
                @else
                    <div class="as-p-10px">No Enrolled Course</div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- enroll modal -->
<div class="as-modal" id="enroll-student" style="display: none">
    <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

        <div class="as-text-center as-w-100">
            <h2>Enroll Course</h2>
        </div>

        <div class="as-modal-child as-p-10px">
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Course name</b></div>
                <select id="course" class="as-select">
                    <option hidden value="" disabled selected>Select course</option>
                    @foreach($site_course as $course)
                        <option value="{{$course->id}}">{{$course->course_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="as-mt-20px as-text-right">
            <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('enroll-student')">Cancel</button>
            <button id="add-info-button" class="as-btn as-app-cursor" onclick="enrollStudent({{$student_data->id}})">Enroll</button>
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
            alert('Select a course');
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

        var confirm = window.confirm('Are you sure you want to unenroll this course?');
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
        var confirm = window.confirm('Are you sure you want to delete this student?');
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