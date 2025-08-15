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
        <div style="height: 15vh;" class="as-p-10px">
            <div>
                <i onclick="toggleAdminSidebar()" class="fas fa-bars as-app-cursor as-f-20px as-mr-10px"></i>
                <span class="as-f-bold as-f-20px">কোর্স</span>
            </div>

            <div class="actions as-flex as-justify-end">
                <button onclick="showModal('add-course')" class="as-btn as-app-cursor"><i
                        class="fa-solid fa-plus as-app-cursor as-f-20px"></i></button>
            </div>
        </div>

        <!-- course list -->
        <div style="height: 85vh; overflow-y: auto;" id="course-data" class="as-p-10px">
            <i style="font-size: 25px;" class="fa-solid fa-spinner fa-spin as-w-100 as-text-center"></i>
        </div>

    </div>

    <!-- add course modal -->
    <div class="as-modal" id="add-course" style="display: none">
        <div class="info-section as-bg-white as-shadow-lw as-p-15px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

            <div class="as-text-center">
                <h2>কোর্সের তথ্য</h2>
            </div>

            <div class="as-modal-child as-p-10px">
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>থাম্বনেল</b></div>
                    <input type="file" id="course-thumbnail" class="as-input" placeholder="কোর্সের থাম্বনেল">
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
                <button id="add-course-btn" class="as-btn as-app-cursor" onclick="addCourse()">যুক্ত করুন</button>
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
                alert('কোর্সের থাম্বনেল দিন');
            }
            else if (courseName == '') {
                alert('কোর্সের নাম দিন');
            }
            else if (courseSlug == '') {
                alert('কোর্সের স্লাগ দিন');
            }
            else if (courseDescription == '<p><br></p>') {
                alert('কোর্সের বিস্তারিত দিন');
            }
            else if (courseTagline == '') {
                alert('কোর্সের ট্যাগলাইন দিন');
            }
            else if (courseRegularFee == '') {
                alert('কোর্সের রেগুলার ফি দিন');
            }
            else if (courseSellingFee == '') {
                alert('কোর্সের সেলিং ফি দিন');
            }
            else if (courseRegularFee < courseSellingFee) {
                alert('সেলিং ফি রেগুলার ফি অপেক্ষা বেশি হবে না');
            }
            else if (courseDuration == '') {
                alert('কোর্সের ডিউরেশন দিন');
            }
            else if (courseLevel == '') {
                alert('কোর্সের লেভেল দিন');
            }
            else if (courseStatus == '') {
                alert('কোর্সের স্ট্যাটাস দিন');
            }
            else if (courseCategory == '') {
                alert('কোর্সের ক্যাটাগরি দিন');
            }
            else if (courseInstructor == '') {
                alert('কোর্সের ইনসট্রাক্টর দিন');
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
                                    document.getElementById('add-course-btn').innerHTML = 'যুক্ত করুন';
                                    document.getElementById('add-course-btn').disabled = false;

                                    alert(res.data.message);

                                    if (res.data.status == 200) {
                                        location.reload();
                                    }
                                    else {
                                        hideModal('add-course');
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
                    console.log(response.data);

                    if (response.data.length == 0) {
                        courseDataDiv.innerHTML = '<div class="as-text-center as-f-20px">কোনো কোর্স নেই</div>';
                        return;
                    }

                    response.data.forEach(function (course) {
                        courseDataDiv.innerHTML += `
                                <div class="as-card as-mb-10px as-flex as-space-between as-p-10px">
                                    <div>
                                        <div class="as-flex as-align-center">${course.course_name}</div>
                                        <div class="as-f-fade">ভর্তি ${course.enrolled_course_count} জন</div>
                                    </div>
                                    <div>
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
                            <h2>কোর্সের তথ্য</h2>
                        </div>

                        <div class="as-modal-child as-p-10px">
                            <div class="as-mt-10px as-none">
                                <div class="as-mb-5px"><b>থাম্বনেল</b></div>
                                <input value="${courseThumbnail}" type="text" id="edited-course-thumbnail" class="as-input" placeholder="কোর্সের থাম্বনেল">
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>থাম্বনেল</b></div>
                                <input type="file" id="edited-course-thumbnail-new" class="as-input" placeholder="কোর্সের থাম্বনেল">
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>নাম</b></div>
                                <input value="${courseName}" type="text" id="edited-course-name" class="as-input" placeholder="কোর্সের নাম">
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>স্লাগ</b></div>
                                <input value="${courseSlug}" type="text" id="edited-course-slug" class="as-input" placeholder="কোর্সের স্লাগ">
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>বিস্তারিত</b></div>
                                <div id="edited-course-editor"></div>
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>ট্যাগলাইন</b></div>
                                <input value="${courseTagline}" type="text" id="edited-course-tagline" class="as-input" placeholder="কোর্সের ট্যাগলাইন">
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>রেগুলার ফি</b></div>
                                <input value="${courseRegularFee}" type="number" id="edited-course-regular-fee" class="as-input" placeholder="কোর্সের রেগুলার ফি">
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>সেলিং ফি</b></div>
                                <input value="${courseSellingFee}" type="number" id="edited-course-selling-fee" class="as-input" placeholder="কোর্সের সেলিং ফি">
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>ডিউরেশন</b></div>
                                <input value="${courseDuration}" type="text" id="edited-course-duration" class="as-input" placeholder="কোর্সের ডিউরেশন">
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>লেভেল</b></div>
                                <select id="edited-course-level" class="as-select">
                                    <option value="${courseLevel}" selected hidden>${courseLevel}</option>
                                    <option value="Beginner">বিগিনার</option>
                                    <option value="Intermediate">ইন্টারমিডিয়েট</option>
                                    <option value="Advance">এডভান্স</option>
                                </select>
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>স্ট্যাটাস</b></div>
                                <select id="edited-course-status" class="as-select">
                                    <option value="${courseStatus}" selected hidden>${courseStatus}</option>
                                    <option value="1">পাবলিশড</option>
                                    <option value="0">আনপাবলিশড</option>
                                </select>
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>ক্যাটাগরি</b></div>
                                <select class="as-select" id="edited-course-category">
                                    <option value="${courseCategory}" selected hidden>${courseCategoryName}</option>
                                    <optgroup id="edited-course-category2"></optgroup>
                                </select>
                            </div>
                            <div class="as-mt-10px">
                                <div class="as-mb-5px"><b>ইনসট্রাক্টর</b></div>
                                <select class="as-select" id="edited-course-instructor">
                                    <option value="${courseInstructor}" selected hidden>${courseInstructorName}</option>
                                    <optgroup  id="edited-course-instructor2"></optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="as-mt-10px as-text-right">
                            <button class="as-btn as-app-cursor as-bg-cancel" onclick="removeModal('edit-course')">বাতিল করুন</button>
                            <button id="edit-course-btn" class="as-btn as-app-cursor" onclick="editCourse(${courseId})">সম্পাদন করুন</button>
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
                option.textContent = 'বিগিনার';
            }
            else if (selectedValue === 'Intermediate') {
                option.textContent = 'ইন্টারমিডিয়েট';
            }
            else {
                option.textContent = 'এডভান্স';
            }
            courseLevel2.appendChild(option);


            var courseStatusEl = document.getElementById('edited-course-status');
            var selectedStatus = courseStatusEl.value;
            var option = document.createElement('option');
            option.value = selectedStatus;
            option.selected = true;
            option.hidden = true;
            if (selectedStatus === '1') {
                option.textContent = 'পাবলিশড';
            }
            else if (selectedStatus === '0') {
                option.textContent = 'আনপাবলিশড';
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
                placeholder: 'কোর্সের বিস্তারিত',
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
                alert('কোর্সের থাম্বনেল দিন');
            }
            else if (editedCourseName == '') {
                alert('কোর্সের নাম দিন');
            }
            else if (editedCourseSlug == '') {
                alert('কোর্সের স্লাগ দিন');
            }
            else if (editedCourseDescription == '<p><br></p>') {
                alert('কোর্সের বিস্তারিত দিন');
            }
            else if (editedCourseTagline == '') {
                alert('কোর্সের ট্যাগলাইন দিন');
            }
            else if (editedCourseRegularFee == '') {
                alert('কোর্সের রেগুলার ফি দিন');
            }
            else if (editedCourseSellingFee == '') {
                alert('কোর্সের সেলিং ফি দিন');
            }
            else if (editedCourseDuration == '') {
                alert('কোর্সের ডিউরেশন দিন');
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

                            axios.post('/admin/course/edit', data)
                                .then(function (response) {
                                    alert(response.data.message);

                                    if (response.data.status == 200) {
                                        location.reload();
                                    }
                                    else {
                                        editCourseBtn.innerHTML = 'সম্পাদন করুন';
                                        editCourseBtn.disabled = false;
                                        hideModal('edit-course');
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
                                editCourseBtn.innerHTML = 'সম্পাদন করুন';
                                editCourseBtn.disabled = false;
                                hideModal('edit-course');
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