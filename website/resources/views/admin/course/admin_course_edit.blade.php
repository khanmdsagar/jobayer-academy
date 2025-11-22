@extends('admin.layout')
@section('title', 'Admin - Course Edit')

@section('content')
<div class="as-w-100">
    <!-- navbar -->
   <div>
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <button class="sidebar-toggle as-app-cursor as-flex as-align-center" id="sidebarToggle" style="display: inline-flex">
                    <i style="font-size: 24px" class="fas fa-bars"></i>
                </button>
                <h2>Course Edit</h2>
            </div>
            <div class="user-info">
                <div class="user-avatar">AD</div>
                <div>
                    <div style="font-weight: 600;">{{ $admin[0]->admin_username }}</div>
                    <div style="font-size: 12px; color: var(--gray);">{{ $admin[0]->admin_role }}</div>
                </div>
            </div>
        </div>
   </div>

    <div>
        <div>
            <div class="as-mt-10px as-none">
                <div class="as-mb-5px"><b>Thumbnail</b></div>
                <input value="{{$course_data->course_thumbnail}}" type="text" id="edited-course-thumbnail" class="as-input" placeholder="Enter Thumbnail">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Thumbnail</b></div>
                <input type="file" id="edited-course-thumbnail-new" class="as-input" placeholder="Enter Thumbnail">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Course Title</b></div>
                <input value="{{$course_data->course_name}}" type="text" id="edited-course-name" class="as-input" placeholder="Enter Course Title">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Slug</b></div>
                <input value="{{$course_data->course_slug}}" type="text" id="edited-course-slug" class="as-input" placeholder="Enter Slug">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Description</b></div>
                <div id="edited-course-editor">{!!$course_data->course_description!!}</div>
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Tagline</b></div>
                <input value="{{$course_data->course_tagline}}" type="text" id="edited-course-tagline" class="as-input" placeholder="Enter tagline">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Regular fee</b></div>
                <input value="{{$course_data->course_fee}}" type="number" id="edited-course-regular-fee" class="as-input" placeholder="Enter regular fee" onmousewheel="this.blur()">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Selling fee</b></div>
                <input value="{{$course_data->course_selling_fee}}" type="number" id="edited-course-selling-fee" class="as-input" placeholder="Enter selling fee" onmousewheel="this.blur()">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Duration</b></div>
                <input value="{{$course_data->course_duration}}" type="text" id="edited-course-duration" class="as-input" placeholder="Enter duration">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Level</b></div>
                <select id="edited-course-level" class="as-select">
                    <option value="{{$course_data->course_level}}" selected hidden>{{$course_data->course_level}}</option>
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advance">Advance</option>
                </select>
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Status</b></div>
                <select id="edited-course-status" class="as-select">
                    <option value="{{$course_data->course_status}}" selected hidden>{{$course_data->course_status}}</option>
                    <option value="1">Published</option>
                    <option value="0">Unpublished</option>
                </select>
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Category</b></div>
                <select class="as-select" id="edited-course-category">
                    <option value="{{$course_data->course_category['id']}}" selected hidden>{{$course_data->course_category['category_name']}}</option>
                    <optgroup id="edited-course-category-group"></optgroup>
                </select>
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Instructor</b></div>
                <select class="as-select" id="edited-course-instructor">
                    <option value="{{$course_data->instructor['id']}}" selected hidden>{{$course_data->instructor['instructor_name']}}</option>
                    <optgroup  id="edited-course-instructor-group"></optgroup>
                </select>
            </div>
        </div>
        <div class="as-mt-10px as-text-right">
            <button id="edit-course-btn" class="as-btn as-app-cursor" onclick="editCourse({{$course_data->id}})">Update</button>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
    var courseLevel2 = document.getElementById('edited-course-level');
    var selectedValue = courseLevel2.value;
    var option = document.createElement('option');
    option.value = selectedValue;
    option.selected = true;
    option.hidden = true;
    if (selectedValue === 'Beginner') {
    option.textContent = 'Beginner';
    }
    else if (selectedValue === 'Intermediate') {
    option.textContent = 'Intermediate';
    }
    else {
    option.textContent = 'Advance';
    }
    courseLevel2.appendChild(option);


    var courseStatusEl = document.getElementById('edited-course-status');
    var selectedStatus = courseStatusEl.value;
    var option = document.createElement('option');
    option.value = selectedStatus;
    option.selected = true;
    option.hidden = true;
    if (selectedStatus === '1') {
    option.textContent = 'Published';
    }
    else if (selectedStatus === '0') {
    option.textContent = 'Unpublished';
    }
    else {
    option.textContent = selectedStatus;
    }
    courseStatusEl.appendChild(option);

    getCategoryData();
    getInstructorData();

    function getCategoryData() {
        axios.get('/admin/category/data')
            .then(function (response) {
                response.data.forEach(function (category) {
                    document.getElementById('edited-course-category-group').innerHTML += `<option value="${category.id}">${category.category_name}</option>`;
                })
            });
    }

    function getInstructorData() {
        axios.get('/admin/instructor/get')
            .then(function (response) {
                response.data.forEach(function (instructor) {
                    document.getElementById('edited-course-instructor-group').innerHTML += `<option value="${instructor.id}">${instructor.instructor_name}</option>`;
                })
            });
    }

    var quill3 = new Quill('#edited-course-editor', {
        theme: 'snow',
        placeholder: 'Course Description',
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

    function editCourse(courseId) {
        var editedCourseThumbnail    = document.getElementById('edited-course-thumbnail').value;
        var editedCourseThumbnailNew = document.getElementById('edited-course-thumbnail-new').files[0];
        var editedCourseName         = document.getElementById('edited-course-name').value;
        var editedCourseSlug         = document.getElementById('edited-course-slug').value;
        var editedCourseTagline      = document.getElementById('edited-course-tagline').value;
        var editedCourseDescription  = quill3.root.innerHTML;
        var editedCourseRegularFee   = document.getElementById('edited-course-regular-fee').value;
        var editedCourseSellingFee   = document.getElementById('edited-course-selling-fee').value;
        var editedCourseDuration     = document.getElementById('edited-course-duration').value;
        var editedCourseLevel        = document.getElementById('edited-course-level').value;
        var editedCourseStatus       = parseInt(document.getElementById('edited-course-status').value);
        var editedCourseCategory     = parseInt(document.getElementById('edited-course-category').value);
        var editedCourseInstructor   = parseInt(document.getElementById('edited-course-instructor').value);

        if (editedCourseThumbnail == '') {
            alert('Enter course Thumbnail');
        }
        else if (editedCourseName == '') {
            alert('Enter course name');
        }
        else if (editedCourseSlug == '') {
            alert('Enter course slug');
        }
        else if (editedCourseDescription == '<p><br></p>') {
            alert('Enter course description');
        }
        else if (editedCourseTagline == '') {
            alert('Enter course tagline');
        }
        else if (editedCourseRegularFee == '') {
            alert('Enter course regular fee');
        }
        else if (editedCourseSellingFee == '') {
            alert('Enter course selling fee');
        }
        else if (editedCourseDuration == '') {
            alert('Enter course duration');
        }
        else {
            var editCourseBtn = document.getElementById('edit-course-btn');
            editCourseBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            editCourseBtn.disabled = true;

            if (editedCourseThumbnailNew != undefined) {
                var formData = new FormData();
                formData.append('course_thumbnail', editedCourseThumbnailNew);
                var config = { headers: { 'content-type': 'multipart/form-data' } }

                axios.post('/admin/course/add/thumbnail', formData, config)
                    .then(function (response) {
                        var data = {
                            course_id: courseId,
                            edited_course_thumbnail: response.data,
                            edited_course_name: editedCourseName,
                            edited_course_slug: editedCourseSlug,
                            edited_course_tagline: editedCourseTagline,
                            edited_course_description: editedCourseDescription,
                            edited_course_regular_fee: editedCourseRegularFee,
                            edited_course_selling_fee: editedCourseSellingFee,
                            edited_course_duration: editedCourseDuration,
                            edited_course_level: editedCourseLevel,
                            edited_course_status: editedCourseStatus,
                            edited_course_category: editedCourseCategory,
                            edited_course_instructor: editedCourseInstructor
                        }

                        console.log(data);

                        axios.post('/admin/course/edit', data)
                            .then(function (response) {
                                alert(response.data.message);

                                if (response.data.status == 200) {
                                    location.reload();
                                }
                                else {
                                    location.reload();
                                }
                            });
                    });

            }
            else {
                var data = {
                    course_id: courseId,
                    edited_course_thumbnail: editedCourseThumbnail,
                    edited_course_name: editedCourseName,
                    edited_course_slug: editedCourseSlug,
                    edited_course_tagline: editedCourseTagline,
                    edited_course_description: editedCourseDescription,
                    edited_course_regular_fee: editedCourseRegularFee,
                    edited_course_selling_fee: editedCourseSellingFee,
                    edited_course_duration: editedCourseDuration,
                    edited_course_level: editedCourseLevel,
                    edited_course_status: editedCourseStatus,
                    edited_course_category: editedCourseCategory,
                    edited_course_instructor: editedCourseInstructor
                }

                console.log(data);

                axios.post('/admin/course/edit', data)
                    .then(function (response) {
                        alert(response.data.message);

                        if (response.data.status == 200) {
                            location.reload();
                        }
                        else {
                            location.reload();
                        }
                    });
            }
        }
    }
</script>
@endsection