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
                    <h2>Student Information</h2>
                </div>
                <div class="user-info">
                    <div class="user-avatar">AD</div>
                    <div>
                        <div style="font-weight: 600;">{{ $admin[0]->admin_username }}</div>
                        <div style="font-size: 12px; color: var(--gray);">{{ $admin[0]->admin_role }}</div>
                    </div>
                </div>
            </div>

            <div class="actions as-flex as-mb-10px">
                <span class="as-p-10px as-app-cursor"><i onclick="showModal('edit-student-info-modal')" class="fa-solid fa-pen-to-square as-app-cursor as-f-20px"></i></span>
                <span class="as-p-10px as-app-cursor"><i onclick="deleteStudent({{$student_data->id}})" class="fa-solid fa-trash as-app-cursor as-f-20px"></i></span>
                <span class="as-p-10px as-app-cursor"><i onclick="showModal('enroll-student')" class="fa-solid fa-graduation-cap as-app-cursor as-f-20px"></i></span>
            </div>
        </div>

        <!-- student list -->
        <div id="student-list">
            <div class="as-card">
                <div class="as-p-10px"><b>Student Id</b>: {{$student_data->id}}</div>
                <div class="as-divider"></div>
                <div class="as-p-10px"><b>Fullname</b>:
                    {{$student_data->student_name == '' ? '...' : $student_data->student_name}}
                </div>
                <div class="as-divider"></div>
                <div class="as-p-10px"><b>Email</b>:
                    {{$student_data->student_email == '' ? '...' : $student_data->student_email}}
                </div>
                <div class="as-divider"></div>
                <div class="as-p-10px"><b>Phone</b>: {{$student_data->student_number}}</div>
                <div class="as-divider"></div>
                <div class="as-p-10px"><b>Date of Birth</b>:
                    {{$student_data->student_birthday == '' ? '...' : $student_data->student_birthday}}
                </div>
                <div class="as-divider"></div>
                <div class="as-p-10px"><b>Address</b>:
                    {{$student_data->student_address == '' ? '...' : $student_data->student_address}}
                </div>
                <div class="as-divider"></div>
                <div class="as-p-10px"><b>Profession</b>:
                    {{$student_data->student_profession == '' ? '...' : $student_data->student_profession}}
                </div>
                <div class="as-divider"></div>
                <div class="as-p-10px"><b>Division</b>:
                    {{$student_data->student_division == '' ? '...' : $student_data->student_division}}
                </div>
                <div class="as-divider"></div>
                <div class="as-p-10px"><b>District</b>:
                    {{$student_data->student_district == '' ? '...' : $student_data->student_district}}
                </div>
                <div class="as-divider"></div>
                <div class="as-p-10px"><b>FB Profile</b>:
                    {{$student_data->student_profile_url == '' ? '...' : $student_data->student_profile_url}}
                </div>
                <div class="as-divider"></div>
                <div class="as-p-10px"><b>FB Page</b>:
                    {{$student_data->student_page_url == '' ? '...' : $student_data->student_page_url}}
                </div>
                <div class="as-divider"></div>
                <div class="as-p-10px"><b>Registration Date</b>:
                    {{$student_data->created_at == '' ? '...' : $student_data->created_at}}
                </div>
                <div class="as-divider"></div>
                <div class="as-p-10px"><b>Note</b>:
                    {{$student_data->student_note == '' ? '...' : $student_data->student_note}}
                </div>
                <div class="as-divider"></div>
                <div class="as-p-10px"><b>Enrolled Course</b>: {{$student_data->student_enrolled_course}}</div>
                <div class="as-divider"></div>
                <div class="as-p-10px"><b>Paid Amount</b>: {{$student_data->student_paid_amount}}</div>
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
                                <span onclick="unenrollCourse({{$course->id}})"><i
                                        class="fa-solid fa-xmark as-app-cursor"></i></span>
                            </div>
                        @endforeach
                    @else
                        <div class="as-p-10px">No Enrolled Course</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- edit student info modal -->
    <div class="as-modal" id="edit-student-info-modal" style="display: none">
        <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

            <div class="as-text-center as-w-100">
                <h2>Student Form</h2>
            </div>

            <div class="as-modal-child as-p-10px">
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Fullname</b></div>
                    <input id="fullname" class="as-input" type="text" value="{{$student_data->student_name}}">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Email</b></div>
                    <input id="email" class="as-input" type="email" value="{{$student_data->student_email}}">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Phone number</b></div>
                    <input id="number" class="as-input" type="number" value="{{$student_data->student_number}}">
                </div>
                <div class="as-mt-10px">
                    <span><b>Date of Birth</b></span><br>
                    <div class="as-flex">
                        <select id="daySelect" class="as-select as-mr-10px">
                            <option hidden value="{{ isset($day) ? $day : '' }}">
                                {{ isset($day) && $day ? $day : 'Day' }}
                            </option>
                        </select>
                        <select id="monthSelect" class="as-select as-mr-10px">
                            <option hidden value="{{ isset($month) ? $month : '' }}">
                                {{ isset($month) && $month ? $month : 'Month' }}
                            </option>
                        </select>
                        <select id="yearSelect" class="as-select">
                            <option hidden value="{{ isset($year) ? $year : '' }}">
                                {{ isset($year) && $year ? $year : 'Year' }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Profession</b></div>
                    <select id="profession" class="as-select">
                        <option hidden value="{{$profession}}">
                            @if($profession != '')
                                {{$profession}}
                            @else
                                Select professioin
                            @endif
                        </option>
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
                    <input id="fb-profile-url" class="as-input" type="text" value="{{$student_data->student_profile_url}}">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Fb page url</b></div>
                    <input id="fb-page-url" class="as-input" type="text" value="{{$student_data->student_page_url}}">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Address</b></div>
                    <input id="address" class="as-input" type="text" value="{{$student_data->student_address}}">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Note</b></div>
                    <input id="note" class="as-input" type="text" value="{{$student_data->student_note}}">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Division</b></div>
                    <select id="division" class="as-select">
                        <option hidden value="{{$division}}" disabled selected>
                            @if($division != '')
                                {{$division}}
                            @else
                                Select a division
                            @endif
                        </option>
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
                         <option hidden value="{{$district}}" disabled selected>
                            @if($district != '')
                                {{$district}}
                            @else
                                Select District
                            @endif
                        </option>
                        <optgroup id="district-div"></optgroup>
                    </select>
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Paid Amount</b></div>
                    <input id="paid-amount" class="as-input" type="text" placeholder="Enter paid amount" value="{{$student_data->student_paid_amount}}">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Password</b></div>
                    <input id="password" class="as-input" type="text">
                </div>
            </div>
            <div class="as-mt-20px as-text-right">
                <button class="as-btn as-app-cursor as-bg-cancel"
                    onclick="hideModal('edit-student-info-modal')">Cancel</button>
                <button id="edit-info-button" class="as-btn as-app-cursor" onclick="editStudentInfo()">Submit</button>
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
                <button id="add-info-button" class="as-btn as-app-cursor"
                    onclick="enrollStudent({{$student_data->id}})">Enroll</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
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
    </script>

    <script>
        function editStudentInfo(){
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var studentName         = document.getElementById('fullname').value;
            var studentEmail        = document.getElementById('email').value;
            var studentNumber       = document.getElementById('number').value;
            var studentProfession   = document.getElementById('profession').value;
            var studentFbProfileUrl = document.getElementById('fb-profile-url').value;
            var studentFbPageUrl    = document.getElementById('fb-page-url').value;

            var studentDaySelect    = document.getElementById('daySelect').value;
            var studentMonthSelect  = document.getElementById('monthSelect').value;
            var studentYearSelect   = document.getElementById('yearSelect').value;

            var studentAddress      = document.getElementById('address').value;
            var studentDivision     = document.getElementById('division').value;
            var studentDistrict     = document.getElementById('district').value;
            var studentNote         = document.getElementById('note').value;
            var studentPaidAmount   = document.getElementById('paid-amount').value;
            var studentPassword     = document.getElementById('password').value;

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
            else if (studentPassword != "" && studentPassword.length < 6) {
                alert('Password must be at least 6 characters long');
            }
            else {
                var data = {
                    id                  : {{$student_data->id}},
                    student_name        : studentName,
                    student_email       : studentEmail,
                    student_number      : studentNumber,
                    student_profession  : studentProfession,
                    student_page_url    : studentFbPageUrl,
                    student_profile_url : studentFbProfileUrl,
                    student_birthday    : studentDaySelect + '-' + studentMonthSelect + '-' + studentYearSelect,
                    student_division    : studentDivision,
                    student_district    : studentDistrict,
                    student_address     : studentAddress,
                    student_note        : studentNote,
                    student_paid_amount : studentPaidAmount,
                    student_password    : studentPassword,
                }

                var editInfoButton = document.getElementById('edit-info-button');
                editInfoButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                editInfoButton.disabled = true;

                axios.post('/admin/student/edit', data)
                    .then(res => {
                        if (res.data.status == 200) {
                            editInfoButton.innerHTML = 'Submit';
                            editInfoButton.disabled = false;

                            alert(res.data.message);
                            hideModal('edit-student-info-modal');
                            location.reload();
                        }
                        else {
                            editInfoButton.innerHTML = 'Submit';
                            editInfoButton.disabled = false;

                            alert(res.data.message);
                            hideModal('edit-student-info-modal');
                            location.reload();
                        }
                    })
                    .catch(err => {
                        editInfoButton.innerHTML = 'Submit';
                        editInfoButton.disabled = false;
                    });
            }
        }

        function enrollStudent(student_id) {
            const course_id = document.getElementById('course').value;
            const data = {
                student_id: student_id,
                course_id: course_id
            }

            if (course_id == '') {
                alert('Select a course');
            }
            else {
                axios.post('/admin/student/enroll', data)
                    .then(function (response) {
                        alert(response.data.message);

                        if (response.data.status == 200) {
                            location.reload();
                        }
                        else {
                            hideModal('enroll-student');
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

        }

        function unenrollCourse(enrolled_course_id) {
            const data = {
                enrolled_course_id: enrolled_course_id,
                student_id: {{$student_data->id}}
            }

            var confirm = window.confirm('Are you sure you want to unenroll this course?');
            if (confirm) {
                axios.post('/admin/student/unenroll', data)
                    .then(function (response) {
                        alert(response.data.message);
                        location.reload();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }

        function deleteStudent(student_id) {
            var confirm = window.confirm('Are you sure you want to delete this student?');
            if (confirm) {
                axios.post('/admin/student/delete', { student_id: student_id })
                    .then(function (response) {
                        alert(response.data.message);
                        window.location.replace('/admin/student');
                    })
                    .catch(function (error) {
                        console.log(error);
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