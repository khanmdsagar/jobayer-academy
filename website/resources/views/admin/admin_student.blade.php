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
        <div >
            <div class="as-p-10px as-flex as-align-center">
                <i onclick="toggleAdminSidebar()" class="fas fa-bars as-app-cursor as-f-20px as-mr-10px"></i>
                <span class="as-f-bold as-f-20px">Student List</span> &nbsp; <span id="total-student-div"></span>
            </div>

            <div class="as-flex as-space-between as-p-10px">
                <div class="as-flex">
                    <input type="text" id="search-student" class="as-input as-mr-10px" placeholder="Enter name or phone">
                    <button onclick="getStudentData()" id="search-student-button"
                        class="as-btn as-btn-primary as-app-cursor as-mr-5px"><i class="fas fa-search"></i></button>
                </div>
                <div class="as-flex">
                    <button id="filter-student-button" class="as-btn as-btn-primary as-app-cursor as-mr-5px"
                        onclick="showModal('student-filter')"><i class="fas fa-filter"></i></button>
                    <button id="add-student-button" class="as-btn as-btn-primary as-app-cursor as-mr-5px"
                        onclick="showModal('student-info')"><i class="fas fa-plus"></i></button>
                    <a id="download-student-button" class="as-btn as-btn-primary as-app-cursor"
                        href="/admin/download-student-data"><i class="fas fa-download"></i></a>
                </div>
            </div>
        </div>

        <!-- student list -->
        <div id="student-list" class="as-p-10px">
            <i style="font-size: 25px;" class="fa-solid fa-spinner fa-spin as-w-100 as-text-center"></i>
        </div>
    </div>

    <!-- filter modal -->
    <div class="as-modal" id="student-filter" style="display: none">
        <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

            <div class="as-text-center as-w-100">
                <h2>Filter</h2>
            </div>

            <div class="as-modal-child">
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Course</b></div>
                    <select id="course" class="as-select">
                        <option hidden value="" disabled selected>Seelect Course</option>
                        <option value="enrolled">Enrolled</option>
                        <option value="unenrolled">Unenrolled</option>
                        <div id="course-div">

                        </div>
                    </select>
                </div>

            </div>
            <div class="as-mt-20px as-text-right">
                <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('student-filter')">Cancel</button>
                <button id="filter-button" class="as-btn as-app-cursor" onclick="filterStudent()">Filter</button>
            </div>
        </div>
    </div>

    <!-- add student info modal -->
    <div class="as-modal" id="student-info" style="display: none">
        <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

            <div class="as-text-center as-w-100">
                <h2>Student Form</h2>
            </div>

            <div class="as-modal-child as-p-10px">
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Fullname</b></div>
                    <input id="fullname" class="as-input" type="text">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Email</b></div>
                    <input id="email" class="as-input" type="email">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Phone number</b></div>
                    <input id="number" class="as-input" type="number">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Date of Birth</b></div>
                    <div class="as-flex">
                        <select id="daySelect" class="as-select as-mr-10px">
                            <option hidden value="" disabled selected>Day</option>
                        </select>
                        <select id="monthSelect" class="as-select as-mr-10px">
                            <option hidden value="" disabled selected>Month</option>
                        </select>
                        <select id="yearSelect" class="as-select">
                            <option hidden value="" disabled selected>Year</option>
                        </select>
                    </div>
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Profession</b></div>
                    <select id="profession" class="as-select">
                        <option hidden value="" disabled selected>Select professioin</option>
                        <option>Govt Job</option>
                        <option>Private Job</option>
                        <option>Student</option>
                        <option>Business</option>
                        <option>Entrepreneur</option>
                        <option>House wife</option>
                    </select>
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Fb profile url</b></div>
                    <input id="fb-profile-url" class="as-input" type="text">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Fb page url</b></div>
                    <input id="fb-page-url" class="as-input" type="text">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Address</b></div>
                    <input id="address" class="as-input" type="text">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Note</b></div>
                    <input id="note" class="as-input" type="text">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Division</b></div>
                    <select id="division" class="as-select">
                        <option hidden value="" disabled selected>Select a division</option>
                        <option value="Dhaka">Dhaka</option>
                        <option value="Chittagong">Chittagong</option>
                        <option value="Khulna">Khulna</option>
                        <option value="Rajshahi">Rajshahi</option>
                        <option value="Barishal">Barishal</option>
                        <option value="Sylhet">Sylhet</option>
                        <option value="Rangpur">Rangpur</option>
                        <option value="Mymensingh">Mymensingh</option>
                    </select>
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>District</b></div>
                    <select id="district" class="as-select">
                        <option hidden value="" disabled selected>Select District</option>
                        <div id="district-div">

                        </div>
                    </select>
                </div>
            </div>
            <div class="as-mt-20px as-text-right">
                <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('student-info')">Cancel</button>
                <button id="add-info-button" class="as-btn as-app-cursor" onclick="addStudentInfo()">Add</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        getCourseData();
        function getCourseData() {
            axios.get('/admin/course/data').then(response => {
                const courseDiv = document.getElementById('course-div');
                courseDiv.innerHTML = response.data.map(course => `<option value="${course.id}">${course.course_name}</option>`).join('');
            });
        }

        function filterStudent() {
            var courseValue = document.getElementById('course').value;

            if (courseValue == '') {
                alert('Select a course')
            }
            else {
                var filterButton = document.getElementById('filter-button');
                filterButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                filterButton.disabled = true;

                axios.get('/admin/filter-student/' + courseValue)
                    .then(response => {
                        filterButton.innerHTML = 'Filter';
                        filterButton.disabled = false;

                        if (courseValue == 'enrolled' || courseValue == 'unenrolled') {
                            const studentList = document.getElementById('student-list');
                            const totalStudentDiv = document.getElementById('total-student-div');

                            studentList.innerHTML = ``;

                            hideModal('student-filter');

                            if (courseValue == 'unenrolled') {
                                document.getElementById('download-student-button').href = '/admin/download-unenrolled-student-data';
                                totalStudentDiv.innerHTML = `(Unenrolled ${response.data.length} people)`;
                            }
                            else {
                                document.getElementById('download-student-button').href = '/admin/download-enrolled-student-data';
                                totalStudentDiv.innerHTML = `(Enrolled ${response.data.length} people)`;
                            }

                            for (let i = 0; i < response.data.length; i++) {
                                studentList.innerHTML += `
                            <div class="as-p-10px as-card as-mb-10px as-brr-5px as-flex as-align-center as-justify-between as-space-between">
                                <div>
                                    <div>${response.data[i].student_name}</div>
                                    <div class="as-f-fade">Phone: ${response.data[i].student_number}</div>
                                    <div class="as-f-fade">Registration Date: ${response.data[i].created_at}</div>
                                    <div class="as-f-fade">Enrolled Course: ${response.data[i].student_enrolled_course}</div>
                                </div>
                                <div>
                                    <span><i onclick="window.location.href='/admin/student/info/${response.data[i].id}'" class="fa-solid fa-eye as-app-cursor"></i></span>
                                </div>
                            </div>
                        `;
                            }
                        }
                        else {
                            const studentList = document.getElementById('student-list');
                            const totalStudentDiv = document.getElementById('total-student-div');
                            totalStudentDiv.innerHTML = `(${response.data.length} people)`;

                            studentList.innerHTML = ``;
                            hideModal('student-filter');
                            document.getElementById('download-student-button').href = '/admin/download-course-student-data/' + courseValue;

                            for (let i = 0; i < response.data.length; i++) {
                                studentList.innerHTML += `
                            <div class="as-p-10px as-card as-mb-10px as-brr-5px as-flex as-align-center as-justify-between as-space-between">
                                <div>
                                    <div>${response.data[i].student_name}</div>
                                    <div class="as-f-fade">Phone: ${response.data[i].student_number}</div>
                                    <div class="as-f-fade">Registration Date: ${response.data[i].created_at}</div>
                                    <div class="as-f-fade">Enrolled Course: ${response.data[i].student_enrolled_course}</div>
                                </div>
                                <div>
                                    <span><i onclick="window.location.href='/admin/student/info/${response.data[i].student.id}'" class="fa-solid fa-eye as-app-cursor"></i></span>
                                </div>
                            </div>
                        `;
                            }
                        }
                    });
            }
        }

        getStudentData();
        var loadStudent = 50;
        function getStudentData() {
            var searchStudent = document.getElementById('search-student').value;

            if (searchStudent == '') {
                axios.get('/admin/student/data').then(response => {
                    const studentList = document.getElementById('student-list');
                    const totalStudentDiv = document.getElementById('total-student-div');
                    totalStudentDiv.innerHTML = `(${response.data.length} people)`;

                    studentList.innerHTML = ``;

                    for (let i = 0; i < loadStudent; i++) {
                        studentList.innerHTML += `
                        <div class="as-p-10px as-card as-mb-10px as-brr-5px as-flex as-align-center as-justify-between as-space-between">
                            <div>
                                <div>${response.data[i].student_name}</div>
                                <div class="as-f-fade">Phone: ${response.data[i].student_number}</div>
                                <div class="as-f-fade">Registration Date: ${response.data[i].created_at}</div>
                                <div class="as-f-fade">Enrolled Course: ${response.data[i].student_enrolled_course}</div>
                            </div>
                            <div>
                                <span><i onclick="window.location.href='/admin/student/info/${response.data[i].id}'" class="fa-solid fa-eye as-app-cursor"></i></span>
                            </div>
                        </div>
                    `;
                    }
                });
            }
            else {
                axios.get('/admin/student/search/' + searchStudent)
                    .then(response => {
                        document.getElementById('search-student').value = '';

                        const studentList = document.getElementById('student-list');
                        const totalStudentDiv = document.getElementById('total-student-div');
                        totalStudentDiv.innerHTML = `(${response.data.length} people)`;

                        studentList.innerHTML = ``;

                        for (let i = 0; i < response.data.length; i++) {
                            studentList.innerHTML += `
                        <div class="as-p-10px as-card as-mb-10px as-brr-5px as-flex as-align-center as-justify-between as-space-between">
                            <div>
                                <div>${response.data[i].student_name}</div>
                                <div class="as-f-fade">Phone: ${response.data[i].student_number}</div>
                                <div class="as-f-fade">Registration Date: ${response.data[i].created_at}</div>
                                <div class="as-f-fade">Enrolled Course: ${response.data[i].student_enrolled_course}</div>
                            </div>
                            <div>
                                <span><i onclick="window.location.href='/admin/student/info/${response.data[i].id}'" class="fa-solid fa-eye as-app-cursor"></i></span>
                            </div>
                        </div>
                    `;
                        }
                    });
            }
        }

        //delete student
        function deleteStudent(studentId) {
            var confirm = window.confirm('Do you want to delete the student?');
            if (confirm) {
                axios.post('/admin/student/delete', { student_id: studentId })
                    .then(response => {
                        alert(response.data.message);
                        getStudentData();
                    });
            }
        }

        //birthday select
        for (let i = 1; i <= 31; i++) {
            daySelect.innerHTML += `<option value="${i}">${i}</option>`;
        }

        for (let j = 1; j <= 12; j++) {
            monthSelect.innerHTML += `<option value="${j}">${j}</option>`;
        }

        const currentYear = new Date().getFullYear();
        for (let y = currentYear; y >= 1960; y--) {
            yearSelect.innerHTML += `<option value="${y}">${y}</option>`;
        }

        function addStudentInfo() {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var studentName = document.getElementById('fullname').value;
            var studentEmail = document.getElementById('email').value;
            var studentNumber = document.getElementById('number').value;
            var studentProfession = document.getElementById('profession').value;
            var studentFbProfileUrl = document.getElementById('fb-profile-url').value;
            var studentFbPageUrl = document.getElementById('fb-page-url').value;

            var studentDaySelect = document.getElementById('daySelect').value;
            var studentMonthSelect = document.getElementById('monthSelect').value;
            var studentYearSelect = document.getElementById('yearSelect').value;

            var studentAddress = document.getElementById('address').value;
            var studentDivision = document.getElementById('division').value;
            var studentDistrict = document.getElementById('district').value;
            var studentNote = document.getElementById('note').value;

            if (studentName == '') {
                alert('Enter full name');
            }
            else if (studentEmail != '' && !regex.test(studentEmail)) {
                alert('Invalid email');
            }
            else if (studentNumber == '') {
                alert('Enter phone number');
            }
            else if (studentNumber.length != 11) {
                alert('Enter valid phone number');
            }
            else {
                var data = {
                    student_name: studentName,
                    student_email: studentEmail,
                    student_number: studentNumber,
                    student_profession: studentProfession,
                    student_page_url: studentFbPageUrl,
                    student_profile_url: studentFbProfileUrl,
                    student_birthday: studentDaySelect + '-' + studentMonthSelect + '-' + studentYearSelect,
                    student_division: studentDivision,
                    student_district: studentDistrict,
                    student_address: studentAddress,
                    student_note: studentNote,
                }

                var addInfoButton = document.getElementById('add-info-button');
                addInfoButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                addInfoButton.disabled = true;

                console.log(data);

                axios.post('/admin/student/add', data)
                    .then(res => {
                        if (res.data.status == 200) {
                            addInfoButton.innerHTML = 'Add';
                            addInfoButton.disabled = false;

                            alert(res.data.message);
                            hideModal('student-info');
                            getStudentData();
                        }
                        else {
                            addInfoButton.innerHTML = 'Add';
                            addInfoButton.disabled = false;

                            alert(res.data.message);
                            hideModal('student-info');
                            getStudentData();
                        }
                    });
            }
        }

        //district on division select
        var studentDivision = document.getElementById('division');
        studentDivision.addEventListener('change', function () {
            var districtDiv = document.getElementById('district-div');
            districtDiv.innerHTML = ``;

            if (studentDivision.value == 'Dhaka') {
                districtDiv.innerHTML = `<option value="Dhaka">Dhaka</option>
            <option value="Gazipur">Gazipur</option>
            <option value="Narayanganj">Narayanganj</option>
            <option value="Tangail">Tangail</option>
            <option value="Manikganj">Manikganj</option>
            <option value="Kishoreganj">Kishoreganj</option>
            <option value="Munshiganj">Munshiganj</option>
            <option value="Rajbari">Rajbari</option>
            <option value="Faridpur">Faridpur</option>
            <option value="Gopalganj">Gopalganj</option>
            <option value="Madaripur">Madaripur</option>
            <option value="Shariatpur">Shariatpur</option>
            <option value="Narsingdi">Narsingdi</option>
            `;
            }
            else if (studentDivision.value == 'Chittagong') {
                districtDiv.innerHTML = `<option value="Chittagong">Chittagong</option>
            <option value="CoxsBazar">CoxsBazar</option>
            <option value="Comilla">Comilla</option>
            <option value="Feni">Feni</option>
            <option value="Brahmanbaria">Brahmanbaria</option>
            <option value="Rangamati">Rangamati</option>
            <option value="Noakhali">Noakhali</option>
            <option value="Khagrachari">Khagrachari</option>
            <option value="Lakshmipur">Lakshmipur</option>
            <option value="Chandpur">Chandpur</option>
            <option value="Bandarban">Bandarban</option>
            `;
            }
            else if (studentDivision.value == 'Khulna') {
                districtDiv.innerHTML = `<option value="Khulna">Khulna</option>
            <option value="Bagerhat">Bagerhat</option>
            <option value="Satkhira">Satkhira</option>
            <option value="Jessore">Jessore</option>
            <option value="Jhenaidah">Jhenaidah</option>
            <option value="Magura">Magura</option>
            <option value="Narail">Narail</option>
            <option value="Kushtia">Kushtia</option>
            <option value="Chuadanga">Chuadanga</option>
            <option value="Meherpur">Meherpur</option>
            `;
            }
            else if (studentDivision.value == 'Rajshahi') {
                districtDiv.innerHTML = `<option value="Rajshahi">Rajshahi</option>
            <option value="Pabna">Pabna</option>
            <option value="Bogra">Bogra</option>
            <option value="Joypurhat">Joypurhat</option>
            <option value="Naogaon">Naogaon</option>
            <option value="Natore">Natore</option>
            <option value="Chapainawabganj">Chapainawabganj</option>
            <option value="Sirajganj">Sirajganj</option>
            `;
            }
            else if (studentDivision.value == 'Barishal') {
                districtDiv.innerHTML = `<option value="Barisal">Barisal</option>
            <option value="Patuakhali">Patuakhali</option>
            <option value="Bhola">Bhola</option>
            <option value="Pirojpur">Pirojpur</option>
            <option value="Barguna">Barguna</option>
            <option value="Jhalokathi">Jhalokathi</option>
            `;
            }
            else if (studentDivision.value == 'Sylhet') {
                districtDiv.innerHTML = `<option value="Sylhet">Sylhet</option>
            <option value="Moulvibazar">Moulvibazar</option>
            <option value="Habiganj">Habiganj</option>
            <option value="Sunamganj">Sunamganj</option>
            `;
            }
            else if (studentDivision.value == 'Rangpur') {
                districtDiv.innerHTML = `<option value="Rangpur">Rangpur</option>
            <option value="Dinajpur">Dinajpur</option>
            <option value="Kurigram">Kurigram</option>
            <option value="Lalmonirhat">Lalmonirhat</option>
            <option value="Nilphamari">Nilphamari</option>
            <option value="Panchagarh">Panchagarh</option>
            <option value="Thakurgaon">Thakurgaon</option>
            <option value="Gaibandha">Gaibandha</option>
            `;
            }
            else if (studentDivision.value == 'Mymensingh') {
                districtDiv.innerHTML = `<option value="Mymensingh">Mymensingh</option>
            <option value="Jamalpur">Jamalpur</option>
            <option value="Netrokona">Netrokona</option>
            <option value="Sherpur">Sherpur</option>
            `;
            }
        });
    </script>
@endsection