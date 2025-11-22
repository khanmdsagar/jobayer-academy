@extends('admin.layout')
@section('title', 'Admin - student')

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
                    <h2>Course</h2>
                </div>
                <div class="user-info">
                    <div class="user-avatar">AD</div>
                    <div>
                        <div style="font-weight: 600;">{{ $admin[0]->admin_username }}</div>
                        <div style="font-size: 12px; color: var(--gray);">{{ $admin[0]->admin_role }}</div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3 id="total-courses">....</h3>
                        <p>Total Courses</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3 id="total-published">....</h3>
                        <p>Published Courses</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h3 id="total-unpublished">....</h3>
                        <p>Unpublished Courses</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Courses Table -->
        <div class="content-section">
            <div class="section-header">
                <h3>Course List</h3>
                <div class="actions as-flex as-justify-end">
                    <button onclick="showModal('add-course')" class="as-btn as-app-cursor" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                        <i class="fa-solid fa-plus as-app-cursor as-f-20px"></i> Add Course
                    </button>
                </div>
            </div>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th style="white-space: nowrap; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Course Title</th>
                            <th>Category</th>
                            <th>Total Students</th>
                            <th>Selling fee</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="course-data-table">
                        
                    </tbody>
                </table>
            </div>
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
                    <div class="as-mb-5px"><b>Another Title</b></div>
                    <input type="text" id="course-another-name" class="as-input" placeholder="Enter Another Title">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Code</b></div>
                    <input type="text" id="course-code" class="as-input" placeholder="Enter Code">
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
        getCourseStats();

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
                    })
                });
        }

        function getCourseStats() {
            axios.get('/admin/course/get/number')
                .then(function (response) {
                    document.getElementById('total-courses').innerText = response.data.total_courses;
                    document.getElementById('total-published').innerText = response.data.published_courses;
                    document.getElementById('total-unpublished').innerText = response.data.unpublished_courses;
                });
        }

        function addCourse() {
            var courseThumbnail = document.getElementById('course-thumbnail').files[0];
            var courseName = document.getElementById('course-name').value;
            var courseCode = document.getElementById('course-code').value;
            var courseAnotherName = document.getElementById('course-another-name').value;
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
            else if (courseAnotherName == '') {
                alert('Enter course another title');
            }
            else if (courseCode == '') {
                alert('Enter code');
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
                                course_another_name: courseAnotherName,
                                course_code: courseCode,
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
            var courseDataTable = document.getElementById('course-data-table');
            courseDataTable.innerHTML = '';
            courseDataTable.innerHTML = `
                    <tr>
                        <td colspan="100%" style="text-align:center; padding:10px;">
                            <i style="font-size:25px;" class="fa-solid fa-spinner fa-spin"></i>
                        </td>
                    </tr>
                `;

            axios.get('/admin/course/get')
                .then(function (response) {   
                    courseDataTable.innerHTML = '';

                    if (response.data.length === 0) {
                        courseDataTable.innerHTML = `
                            <tr>
                                <td colspan="100%" style="text-align:center; padding:10px;">
                                    No course found.
                                </td>
                            </tr>`;
                        return;
                    }

                    console.log(response.data);

                    response.data.forEach(function (course) {
                        courseDataTable.innerHTML += `
                                <tr>
                                    <td style="white-space: nowrap;">${course.course_name}</td>
                                    <td style="white-space: nowrap;">${course.course_category.category_name}</td>
                                    <td class="as-f-fade">${course.enrolled_course_count} people</td>
                                    <td class="as-f-fade">৳${course.course_selling_fee}</td>
                                    <td class="as-f-fade"><div class="status-badge ${course.course_status == 1 ? 'published' : 'unpublished'}">${course.course_status == 1 ? 'Published' : 'Unpublished'}</div></td>
                            
                                    <td>
                                        <i onclick="window.location.href = '/admin/course/info/${course.id}'" class="fa-solid fa-eye as-app-cursor as-p-10px"></i>
                                        <i onclick="window.location.href = '/admin/course/edit-page/${course.id}'" class="fa-solid fa-edit as-app-cursor as-p-10px"></i>
                                        <i onclick="deleteCourse(${course.id}, '${course.course_thumbnail}')" class="fa-solid fa-trash as-app-cursor as-p-10px"></i>
                                    </td>
                                </tr>
                            `;
                    })

                });
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