@extends('admin.layout')
@section('title', 'Admin - student')

@section('content')
    <div class="as-flex">
        <!-- sidebar -->
        <div id="admin-sidebar" class="as-w-200px as-bg-white as-h-100vh">
            @include('admin.sidebar')
        </div>
    </div>

    <div class="as-w-100" style="overflow-y: auto; height: 100vh;">
        <!-- navbar -->
        <div class="as-p-10px">
            <div>
                <i onclick="toggleAdminSidebar()" class="fas fa-bars as-app-cursor as-f-20px as-mr-10px"></i>
                <span class="as-f-bold as-f-20px">Course</span>
            </div>

            <div class="actions as-flex as-justify-end">
                <button onclick="showModal('add-course')" class="as-btn as-app-cursor"><i
                        class="fa-solid fa-plus as-app-cursor as-f-20px"></i></button>
            </div>
        </div>

        <!-- course list -->
        <div id="course-data" class="as-p-10px">
            <i style="font-size: 25px;" class="fa-solid fa-spinner fa-spin as-w-100 as-text-center"></i>
        </div>

    </div>

    <!-- add course modal -->
    <div class="as-modal" id="add-course" style="display: none">
        <div class="info-section as-bg-white as-shadow-lw as-p-15px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

            <div class="as-text-center">
                <h2>Course Info</h2>
            </div>

            <div class="as-modal-child as-p-10px">
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Thumbnail</b></div>
                    <input type="file" id="course-thumbnail" class="as-input" placeholder="Enter Thumbnail">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Title</b></div>
                    <input type="text" id="course-name" class="as-input" placeholder="Enter Title">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Slug</b></div>
                    <input type="text" id="course-slug" class="as-input" placeholder="Enter Slug">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Description</b></div>
                    <div id="course-editor"></div>
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Tagline</b></div>
                    <input type="text" id="course-tagline" class="as-input" placeholder="Enter tagline">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Regular fee</b></div>
                    <input type="number" id="course-regular-fee" class="as-input" placeholder="Enter regular fee" onmousewheel="this.blur()">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Selling fee</b></div>
                    <input type="number" id="course-selling-fee" class="as-input" placeholder="Enter selling fee" onmousewheel="this.blur()">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Duration</b></div>
                    <input type="text" id="course-duration" class="as-input" placeholder="Enter duration">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Level</b></div>
                    <select id="course-level" class="as-select">
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advance">Advance</option>
                    </select>
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Status</b></div>
                    <select id="course-status" class="as-select">
                        <option value="1">Published</option>
                        <option value="0">Unpublished</option>
                    </select>
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Category</b></div>
                    <select id="course-category" class="as-select">

                    </select>
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Instructor</b></div>
                    <select id="course-instructor" class="as-select">

                    </select>
                </div>
            </div>
            <div class="as-mt-10px as-text-right">
                <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('add-course')">Cancel</button>
                <button id="add-course-btn" class="as-btn as-app-cursor" onclick="addCourse()">Add</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        getCourseData();
        getCategoryData();
        getInstructorData();

        function getCategoryData() {
            axios.get('/admin/category/data')
                .then(function (response) {
                    response.data.forEach(function (category) {
                        document.getElementById('course-category').innerHTML += `<option value="${category.id}">${category.category_name}</option>`;
                    })
                });
        }

        function getInstructorData() {
            axios.get('/admin/instructor/get')
                .then(function (response) {
                    response.data.forEach(function (instructor) {
                        document.getElementById('course-instructor').innerHTML += `<option value="${instructor.id}">${instructor.instructor_name}</option>`;
                        document.getElementById('edited-course-instructor').innerHTML += `<option value="${instructor.id}">${instructor.instructor_name}</option>`;
                    })
                });
        }

        function addCourse() {
            var courseThumbnail = document.getElementById('course-thumbnail').files[0];
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

            if (courseThumbnail == undefined) {
                alert('Enter course thumbnail');
            }
            else if (courseName == '') {
                alert('Enter course title');
            }
            else if (courseSlug == '') {
                alert('Enter course slug');
            }
            else if (courseDescription == '<p><br></p>') {
                alert('Enter course description');
            }
            else if (courseTagline == '') {
                alert('Enter course tagline');
            }
            else if (courseRegularFee == '') {
                alert('Enter course regular fee');
            }
            else if (courseSellingFee == '') {
                alert('Enter course selling fee');
            }
            else if (courseRegularFee < courseSellingFee) {
                alert('Selling fee cannot be more than regular fee');
            }
            else if (courseDuration == '') {
                alert('Enter course duration');
            }
            else if (courseLevel == '') {
                alert('Select course level');
            }
            else if (courseStatus == '') {
                alert('Select course status');
            }
            else if (courseCategory == '') {
                alert('Select course category');
            }
            else if (courseInstructor == '') {
                alert('Select course instructor');
            }
            else {
                document.getElementById('add-course-btn').innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
                document.getElementById('add-course-btn').disabled = true;

                var formData = new FormData();
                formData.append('course_thumbnail', courseThumbnail);
                var config = { headers: { 'content-type': 'multipart/form-data' } }

                axios.post('/admin/course/add/thumbnail', formData, config)
                    .then(function (response) {
                        if (response.data != '') {
                            var data = {
                                course_thumbnail: response.data,
                                course_name: courseName,
                                course_slug: courseSlug,
                                course_tagline: courseTagline,
                                course_regular_fee: parseInt(courseRegularFee),
                                course_selling_fee: parseInt(courseSellingFee),
                                course_duration: courseDuration,
                                course_level: courseLevel,
                                course_status: parseInt(courseStatus),
                                course_category: parseInt(courseCategory),
                                course_instructor: parseInt(courseInstructor),
                                course_description: courseDescription,
                            }

                            axios.post('/admin/course/add', data)
                                .then(function (res) {
                                    document.getElementById('add-course-btn').innerHTML = 'Add';
                                    document.getElementById('add-course-btn').disabled = false;

                                    alert(res.data.message);

                                    if (res.data.status == 200) {
                                        location.reload();
                                    }
                                    else {
                                        location.reload();
                                    }
                                });
                        }
                    });


            }
        }

        function getCourseData() {
            var courseDataDiv = document.getElementById('course-data');
            courseDataDiv.innerHTML = '';

            axios.get('/admin/course/get')
                .then(function (response) {
                    
                    if (response.data.length == 0) {
                        courseDataDiv.innerHTML = '<div class="as-text-center as-f-20px">No Course</div>';
                        return;
                    }

                    response.data.forEach(function (course) {
                        courseDataDiv.innerHTML += `
                                <div class="as-card as-mb-10px as-flex as-space-between as-p-10px">
                                    <div>
                                        <div class="as-flex as-align-center">${course.course_name}</div>
                                        <div class="as-f-fade">Student: ${course.enrolled_course_count} people</div>
                                        <div class="as-f-fade">Selling fee: ৳${course.course_selling_fee}</div>
                                        <div class="as-f-fade">Status: ${course.course_status == 1 ? 'Published' : 'Unpublished'}</div>
                                    </div>
                                    <div>
                                        <div><i onclick="window.location.href = '/admin/course/info/${course.id}'" class="fa-solid fa-eye as-app-cursor as-p-10px"></i></div>
                                        <div><i id="dec${course.id}" data-description="${course.course_description}" onclick="showEditCourseModal('${course.id}', '${course.course_thumbnail}', '${course.course_name}', '${course.course_slug}', '${course.course_tagline}', '${course.course_fee}', '${course.course_selling_fee}', '${course.course_duration}', '${course.course_level}', '${course.course_status}', '${course.category_id}', '${course.course_category.category_name}', '${course.instructor_id}', '${course.instructor.instructor_name}')" class="fa-solid fa-edit as-app-cursor as-p-10px"></i></div>
                                        <div><i onclick="deleteCourse(${course.id}, '${course.course_thumbnail}')" class="fa-solid fa-trash as-app-cursor as-p-10px"></i></div>
                                    </div>
                                </div>
                            `;
                    })

                });
        }

        let quill2;

        function showEditCourseModal(courseId, courseThumbnail, courseName, courseSlug, courseTagline, courseRegularFee, courseSellingFee, courseDuration, courseLevel, courseStatus, courseCategory, courseCategoryName, courseInstructor, courseInstructorName) {
            var body = document.getElementsByTagName('body');
            body[0].innerHTML +=
                `<div class="as-modal" id="edit-course" style="display: none">
                    <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

                        <div class="as-text-center">
                            <h2>Course Information</h2>
                        </div>

                        <div class="as-modal-child as-p-10px">
                            <div class="as-mt-10px as-none">
                                <div class="as-mb-5px"><b>Thumbnail</b></div>
                                <input value="${courseThumbnail}" type="text" id="edited-course-thumbnail" class="as-input" placeholder="Enter Thumbnail">
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>Thumbnail</b></div>
                                <input type="file" id="edited-course-thumbnail-new" class="as-input" placeholder="Enter Thumbnail">
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>Course Title</b></div>
                                <input value="${courseName}" type="text" id="edited-course-name" class="as-input" placeholder="Enter Course Title">
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>Slug</b></div>
                                <input value="${courseSlug}" type="text" id="edited-course-slug" class="as-input" placeholder="Enter Slug">
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>Description</b></div>
                                <div id="edited-course-editor"></div>
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>Tagline</b></div>
                                <input value="${courseTagline}" type="text" id="edited-course-tagline" class="as-input" placeholder="Enter tagline">
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>Regular fee</b></div>
                                <input value="${courseRegularFee}" type="number" id="edited-course-regular-fee" class="as-input" placeholder="Enter regular fee" onmousewheel="this.blur()">
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>Selling fee</b></div>
                                <input value="${courseSellingFee}" type="number" id="edited-course-selling-fee" class="as-input" placeholder="Enter selling fee" onmousewheel="this.blur()">
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>Duration</b></div>
                                <input value="${courseDuration}" type="text" id="edited-course-duration" class="as-input" placeholder="Enter duration">
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>Level</b></div>
                                <select id="edited-course-level" class="as-select">
                                    <option value="${courseLevel}" selected hidden>${courseLevel}</option>
                                    <option value="Beginner">Beginner</option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Advance">Advance</option>
                                </select>
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>Status</b></div>
                                <select id="edited-course-status" class="as-select">
                                    <option value="${courseStatus}" selected hidden>${courseStatus}</option>
                                    <option value="1">Published</option>
                                    <option value="0">Unpublished</option>
                                </select>
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>Category</b></div>
                                <select class="as-select" id="edited-course-category">
                                    <option value="${courseCategory}" selected hidden>${courseCategoryName}</option>
                                    <optgroup id="edited-course-category2"></optgroup>
                                </select>
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>Instructor</b></div>
                                <select class="as-select" id="edited-course-instructor">
                                    <option value="${courseInstructor}" selected hidden>${courseInstructorName}</option>
                                    <optgroup  id="edited-course-instructor2"></optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="as-mt-10px as-text-right">
                            <button class="as-btn as-app-cursor as-bg-cancel" onclick="removeModal('edit-course')">Cancel</button>
                            <button id="edit-course-btn" class="as-btn as-app-cursor" onclick="editCourse(${courseId})">Submit</button>
                        </div>
                    </div>
                </div>`

            var el = document.getElementById('dec' + courseId);
            var description = el.dataset.description;
            document.getElementById('edited-course-editor').innerHTML = description;


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


            axios.get('/admin/category/data')
                .then(function (response) {
                    response.data.forEach(function (category) {
                        document.getElementById('edited-course-category2').innerHTML += `<option value="${category.id}">${category.category_name}</option>`;
                    })
                });

            axios.get('/admin/instructor/get')
                .then(function (response) {
                    response.data.forEach(function (instructor) {
                        document.getElementById('edited-course-instructor2').innerHTML += `<option value="${instructor.id}">${instructor.instructor_name}</option>`;
                    })
                });

            quill2 = new Quill('#edited-course-editor', {
                theme: 'snow',
                placeholder: 'Enter course description',
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
            showModal('edit-course');
        }

        function editCourse(courseId) {
            var editedCourseThumbnail    = document.getElementById('edited-course-thumbnail').value;
            var editedCourseThumbnailNew = document.getElementById('edited-course-thumbnail-new').files[0];
            var editedCourseName         = document.getElementById('edited-course-name').value;
            var editedCourseSlug         = document.getElementById('edited-course-slug').value;
            var editedCourseTagline      = document.getElementById('edited-course-tagline').value;
            var editedCourseDescription  = quill2.root.innerHTML;
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

                console.log(editedCourseDescription);

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

        function deleteCourse(courseId, courseThumbnail) {
            var confirm = window.confirm('কোর্স মুছে ফেলবেন কি?');

            if (confirm) {
                axios.post('/admin/course/delete', { course_id: courseId, course_thumbnail: courseThumbnail })
                    .then(function (response) {
                        alert(response.data.message);
                        getCourseData();
                    });
            }
        }
    </script>
@endsection