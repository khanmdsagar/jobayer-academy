@extends('admin.layout')
@section('title', 'Admin - student')

@section('content')
<div class="as-flex">
    <!-- sidebar -->
    <div id="admin-sidebar" class="as-w-250px as-bg-black as-h-100vh">
        @include('admin.sidebar')
    </div>
</div>

<div class="as-w-100">
    <!-- navbar -->
   <div style="height: 15vh;" class="as-p-10px">
        <div>
            <i onclick="toggleAdminSidebar()" class="fas fa-bars as-app-cursor as-f-20px as-mr-10px"></i>
            <span class="as-f-bold as-f-20px">কোর্স</span>
        </div>

        <div class="actions as-flex as-justify-end">
            <button onclick="showModal('add-course')" class="as-btn as-app-cursor"><i class="fa-solid fa-plus as-app-cursor as-f-20px"></i></button>
        </div>
   </div>

    <!-- course list -->
    <div style="height: 85vh; overflow-y: auto;" id="course-data" class="as-p-10px">
        <i style="font-size: 25px;" class="fa-solid fa-spinner fa-spin as-w-100 as-text-center"></i>
    </div>
   
</div>

<!-- add course modal -->
<div class="as-modal" id="add-course" style="display: none">
    <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

        <div class="as-text-center">
            <h2>কোর্সের তথ্য</h2>
        </div>

        <div class="as-modal-child as-p-10px">
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>থাম্বনেল</b></div>
                <input type="text" id="course-thumbnail" class="as-input" placeholder="কোর্সের থাম্বনেল">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>নাম</b></div>
                <input type="text" id="course-name" class="as-input" placeholder="কোর্সের নাম">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>স্লাগ</b></div>
                <input type="text" id="course-slug" class="as-input" placeholder="কোর্সের স্লাগ">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>বিস্তারিত</b></div>
                <div id="course-editor"></div>
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>ট্যাগলাইন</b></div>
                <input type="text" id="course-tagline" class="as-input" placeholder="কোর্সের ট্যাগলাইন">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>রেগুলার ফি</b></div>
                <input type="number" id="course-regular-fee" class="as-input" placeholder="কোর্সের রেগুলার ফি">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>সেলিং ফি</b></div>
                <input type="number" id="course-selling-fee" class="as-input" placeholder="কোর্সের সেলিং ফি">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>ডিউরেশন</b></div>
                <input type="text" id="course-duration" class="as-input" placeholder="কোর্সের ডিউরেশন">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>লেভেল</b></div>
                <select id="course-level" class="as-select">
                    <option value="Beginner">বিগিনার</option>
                    <option value="Intermediate">ইন্টারমিডিয়েট</option>
                    <option value="Advance">এডভান্স</option>
                </select>
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>স্ট্যাটাস</b></div>
                <select id="course-status" class="as-select">
                    <option value="1">পাবলিশড</option>
                    <option value="0">আনপাবলিশড</option>
                </select>
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>ক্যাটাগরি</b></div>
                <select id="course-category" class="as-select">
        
                </select>
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>ইনসট্রাক্টর</b></div>
                <select id="course-instructor" class="as-select">
              
                </select>
            </div>
        </div>
        <div class="as-mt-10px as-text-right">
            <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('add-course')">বাতিল করুন</button>
            <button class="as-btn as-app-cursor" onclick="addCourse()">যুক্ত করুন</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    getCourseData();
    getCategoryData();
    getInstructorData();

    function getCategoryData(){
        axios.get('/admin/category/data')
            .then(function(response){
                response.data.forEach(function(category){
                    document.getElementById('course-category').innerHTML += `<option value="${category.id}">${category.category_name}</option>`;
                })
            });
    }

    function getInstructorData(){
        axios.get('/admin/instructor/get')
            .then(function(response){
                response.data.forEach(function(instructor){
                    document.getElementById('course-instructor').innerHTML += `<option value="${instructor.id}">${instructor.instructor_name}</option>`;
                })
            });
    }

    function addCourse(){
        var courseThumbnail = document.getElementById('course-thumbnail').value;
        var courseName = document.getElementById('course-name').value;
        var courseSlug = document.getElementById('course-slug').value;
        var courseTagline = document.getElementById('course-tagline').value;
        var courseRegularFee = document.getElementById('course-regular-fee').value;
        var courseSellingFee = document.getElementById('course-selling-fee').value;
        var courseDuration = document.getElementById('course-duration').value;
        var courseLevel = document.getElementById('course-level').value;
        var courseStatus = document.getElementById('course-status').value;
        var courseCategory = document.getElementById('course-category').value;
        var courseInstructor = document.getElementById('course-instructor').value;
        var courseDescription = quill.root.innerHTML;

        if(courseThumbnail == ''){
            alert('কোর্সের থাম্বনেল দিন');
        }
        else if(courseName == ''){
            alert('কোর্সের নাম দিন');
        }
        else if(courseSlug == ''){
            alert('কোর্সের স্লাগ দিন');
        }
        else if(courseDescription == '<p><br></p>'){
            alert('কোর্সের বিস্তারিত দিন');
        }
        else if(courseTagline == ''){
            alert('কোর্সের ট্যাগলাইন দিন');
        }
        else if(courseRegularFee == ''){
            alert('কোর্সের রেগুলার ফি দিন');
        }
        else if(courseSellingFee == ''){
            alert('কোর্সের সেলিং ফি দিন');
        }
        else if(courseDuration == ''){
            alert('কোর্সের ডিউরেশন দিন');
        }
        else if(courseLevel == ''){
            alert('কোর্সের লেভেল দিন');
        }
        else if(courseStatus == ''){
            alert('কোর্সের স্ট্যাটাস দিন');
        }
        else if(courseCategory == ''){
            alert('কোর্সের ক্যাটাগরি দিন');
        }
        else if(courseInstructor == ''){
            alert('কোর্সের ইনসট্রাক্টর দিন');
        }
        else{
            var data = {
                course_thumbnail: courseThumbnail,
                course_name: courseName,
                course_slug: courseSlug,
                course_tagline: courseTagline,
                course_regular_fee:  parseInt(courseRegularFee),
                course_selling_fee: parseInt(courseSellingFee),
                course_duration: courseDuration,
                course_level: courseLevel,
                course_status: parseInt(courseStatus),
                course_category: parseInt(courseCategory),
                course_instructor: parseInt(courseInstructor),
                course_description: courseDescription,
            }

            axios.post('/admin/course/add', data)
                .then(function(response){
                    alert(response.data.message);

                    if(response.data.status == 200){
                        location.reload();
                    }
                    else{
                        hideModal('add-course');
                    }
                });
        }
    }

    function getCourseData(){
        var courseDataDiv = document.getElementById('course-data');
        courseDataDiv.innerHTML = '';

        axios.get('/admin/course/get')
            .then(function(response){
                response.data.forEach(function(course){
                    courseDataDiv.innerHTML += `
                        <div class="as-card as-mb-10px as-flex as-space-between as-p-10px">
                            <div class="as-flex as-align-center">${course.course_name}</div>
                            <div>
                                <span><i onclick="showEditCourseModal('${course.id}', '${course.course_name}')" class="fa-solid fa-edit as-app-cursor as-p-10px"></i></span>
                                <span><i onclick="deleteCourse(${course.id})" class="fa-solid fa-trash as-app-cursor as-p-10px"></i></span>
                            </div>
                        </div>
                    `;
                })
                   
            });
    }

    function showEditCourseModal(courseId, courseName){
        var body = document.getElementsByTagName('body');
        body[0].innerHTML += `<div class="as-modal" id="edit-course" style="display: none">
            <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

                <div class="as-modal-child as-p-10px">
                    <div class="as-mt-10px">
                        <div class="as-mb-5px"><b>কোর্সের নাম</b></div>
                        <input type="text" id="edited-course-name" class="as-input" value="${courseName}">
                    </div>
                </div>
                <div class="as-mt-10px as-text-right">
                    <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('edit-course')">বাতিল করুন</button>
                    <button class="as-btn as-app-cursor" onclick="editCourse(${courseId})">সম্পাদনা করুন</button>
                </div>
            </div>
        </div>`

        showModal('edit-course');
    }

    function editCourse(courseId){
        var editedCourseName = document.getElementById('edited-course-name').value;

        if(editedCourseName == ''){
            alert('কোর্সের নাম দিন');
        }
        else{
            axios.post('/admin/course/edit', {course_id: courseId, course_name: editedCourseName})
                .then(function(response){
                    alert(response.data.message);

                    if(response.data.status == 200){
                        location.reload();
                    }
                    else{
                        hideModal('edit-course');
                    }
                });
        }
    }

    function deleteCourse(course_id){
        var confirm = window.confirm('কোর্স মুছে ফেলবেন কি?');

        if(confirm){
            axios.post('/admin/category/delete', {category_id: category_id})
                .then(function(response){
                    alert(response.data.message);
                    getCategoryData();
                });
        }
    }
</script>
@endsection