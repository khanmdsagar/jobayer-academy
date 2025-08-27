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
        <div class="as-p-10px as-flex as-align-center">
            <i onclick="toggleAdminSidebar()" class="fas fa-bars as-app-cursor as-f-20px as-mr-10px"></i>
            <span class="as-f-bold as-f-20px">Student List</span> &nbsp; <span id="total-student-div"></span>
        </div>

        <div class="as-flex as-space-between as-p-10px">
            <div class="as-flex">
                <input type="text" id="search-student" class="as-input as-mr-10px" placeholder="নাম বা ফোন নাম্বর দিন">
                <button onclick="getStudentData()" id="search-student-button" class="as-btn as-btn-primary as-app-cursor as-mr-5px"><i class="fas fa-search"></i></button>
            </div>
            <div class="as-flex">
                <button id="filter-student-button" class="as-btn as-btn-primary as-app-cursor as-mr-5px" onclick="showModal('student-filter')"><i class="fas fa-filter"></i></button>
                <button id="add-student-button" class="as-btn as-btn-primary as-app-cursor as-mr-5px" onclick="showModal('student-info')"><i class="fas fa-plus"></i></button>
                <a id="download-student-button" class="as-btn as-btn-primary as-app-cursor" href="/admin/download-student-data"><i class="fas fa-download"></i></a>
            </div>
        </div>
   </div> 
    
    <!-- student list -->
    <div style="height: 85vh; overflow-y: auto;" id="student-list" class="as-p-10px">
        <i style="font-size: 25px;" class="fa-solid fa-spinner fa-spin as-w-100 as-text-center"></i>
    </div>
</div>

<!-- filter modal -->
<div class="as-modal" id="student-filter" style="display: none">
    <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

        <div class="as-text-center as-w-100">
            <h2>ফিল্টার</h2>
        </div>

        <div class="as-modal-child">
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>কোর্স</b></div>
                <select id="course" class="as-select">
                    <option hidden value="" disabled selected>কোর্স নির্বাচন করুন</option>
                    <option value="enrolled">এনরোল্ড</option>
                    <option value="unenrolled">আনএনরোল্ড</option>
                    <div id="course-div">

                    </div>
                </select>
            </div>

        </div>
        <div class="as-mt-20px as-text-right">
            <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('student-filter')">বাতিল করুন</button>
            <button id="filter-button" class="as-btn as-app-cursor" onclick="filterStudent()">ফিল্টার করুন</button>
        </div>
    </div>
</div>

<!-- add student info modal -->
<div class="as-modal" id="student-info" style="display: none">
    <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

        <div class="as-text-center as-w-100">
            <h2>শীক্ষার্থী ফর্ম</h2>
        </div>

        <div class="as-modal-child as-p-10px">
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>পুরোনাম</b></div>
                <input id="fullname" class="as-input" type="text">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>ই-মেইল</b></div>
                <input id="email" class="as-input" type="email">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>ফোন নাম্বর</b></div>
                <input id="number" class="as-input" type="number">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>জন্মতারিখ</b></div>
                <div class="as-flex">
                    <select id="daySelect" class="as-select as-mr-10px">
                        <option hidden value="" disabled selected>দিন</option>
                    </select>
                    <select id="monthSelect" class="as-select as-mr-10px">
                        <option hidden value="" disabled selected>মাস</option>
                    </select>
                    <select id="yearSelect" class="as-select">
                        <option hidden value="" disabled selected>বছর</option>
                    </select>
                </div>
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>পেশা</b></div>
                <select id="profession" class="as-select">
                    <option hidden value="" disabled selected>পেশা নির্বাচন করুন</option>
                    <option>সরকারি চাকরি</option>
                    <option>বেসরকারি চাকরি</option>
                    <option>শীক্ষার্থী</option>
                    <option>ব্যবসা</option>
                    <option>উদ্যোক্তা</option>
                    <option>গৃহিনী</option>
                </select>
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>ফেসবুক প্রফাইল ইউআরএল</b></div>
                <input id="fb-profile-url" class="as-input" type="text">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>ফেসবুক পেজ ইউআরএল</b></div>
                <input id="fb-page-url" class="as-input" type="text">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>ঠিকানা</b></div>
                <input id="address" class="as-input" type="text">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>নোট</b></div>
                <input id="note" class="as-input" type="text">
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>বিভাগ</b></div>
                <select id="division" class="as-select">
                    <option hidden value="" disabled selected>বিভাগ নির্বাচন করুন</option>
                    <option value="Dhaka">ঢাকা</option>
                    <option value="Chittagong">চট্টগ্রাম</option>
                    <option value="Khulna">খুলনা</option>
                    <option value="Rajshahi">রাজশাহী</option>
                    <option value="Barishal">বরিশাল</option>
                    <option value="Sylhet">সিলেট</option>
                    <option value="Rangpur">রংপুর</option>
                    <option value="Mymensingh">ময়মনসিংহ</option>
                </select>
            </div>
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>জেলা</b></div>
                <select id="district" class="as-select">
                    <option hidden value="" disabled selected>জেলা নির্বাচন করুন</option>
                    <div id="district-div">

                    </div>
                </select>
            </div>
        </div>
        <div class="as-mt-20px as-text-right">
            <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('student-info')">বাতিল করুন</button>
            <button id="add-info-button" class="as-btn as-app-cursor" onclick="addStudentInfo()">যুক্ত করুন</button>
        </div>
    </div>
</div>
@endsection 

@section('scripts')
<script>
getCourseData();
function getCourseData(){
    axios.get('/admin/course/data').then(response => {
        const courseDiv = document.getElementById('course-div');
        courseDiv.innerHTML = response.data.map(course => `<option value="${course.id}">${course.course_name}</option>`).join('');
    });
}

function filterStudent(){
    var courseValue = document.getElementById('course').value;
    
    if(courseValue == ''){
        alert('কোর্স নির্বাচন করুন')
    }
    else{
        var filterButton = document.getElementById('filter-button');
        filterButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        filterButton.disabled = true;

        axios.get('/admin/filter-student/' + courseValue)
        .then(response => {
            filterButton.innerHTML = 'ফিল্টার করুন';
            filterButton.disabled = false;

            if(courseValue == 'enrolled' || courseValue == 'unenrolled'){
                const studentList     = document.getElementById('student-list');
                const totalStudentDiv = document.getElementById('total-student-div');

                studentList.innerHTML = ``;
                
                hideModal('student-filter');

                if(courseValue == 'unenrolled'){
                    document.getElementById('download-student-button').href = '/admin/download-unenrolled-student-data';
                    totalStudentDiv.innerHTML = `(আনএনরোলড ${convertToBengali(response.data.length)} জন)`;
                }
                else{
                    document.getElementById('download-student-button').href = '/admin/download-enrolled-student-data';
                    totalStudentDiv.innerHTML = `(এনরোলড ${convertToBengali(response.data.length)} জন)`;
                }

                for(let i = 0; i < response.data.length; i++) {
                    studentList.innerHTML += `
                        <div class="as-p-10px as-card as-mb-10px as-brr-5px as-flex as-align-center as-justify-between as-space-between">
                            <div>
                                <div>${response.data[i].student_name}</div>
                                <div class="as-f-fade">${response.data[i].student_number}</div>
                                <div class="as-f-fade">${convertToBengali(response.data[i].student_enrolled_course)} কোর্সে ভর্তি</div>
                            </div>
                            <div>
                                <span><i onclick="window.location.href='/admin/student/info/${response.data[i].id}'" class="fa-solid fa-eye as-app-cursor"></i></span>
                            </div>
                        </div>
                    `;
                }
            }
            else{
                const studentList = document.getElementById('student-list');
                const totalStudentDiv = document.getElementById('total-student-div');
                totalStudentDiv.innerHTML = `(${convertToBengali(response.data.length)} জন)`;

                studentList.innerHTML = ``;
                hideModal('student-filter');
                document.getElementById('download-student-button').href = '/admin/download-course-student-data/' + courseValue;

                for(let i = 0; i < response.data.length; i++) {
                    studentList.innerHTML += `
                        <div class="as-p-10px as-card as-mb-10px as-brr-5px as-flex as-align-center as-justify-between as-space-between">
                            <div>
                                <div>${response.data[i].student.student_name}</div>
                                <div class="as-f-fade">${response.data[i].student.student_number}</div>
                                <div class="as-f-fade">${convertToBengali(response.data[i].student.student_enrolled_course)} কোর্সে ভর্তি</div>
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

    if(searchStudent == ''){
        axios.get('/admin/student/data').then(response => {
            const studentList = document.getElementById('student-list');
            const totalStudentDiv = document.getElementById('total-student-div');
            totalStudentDiv.innerHTML = `(${convertToBengali(response.data.length)} জন)`;

            studentList.innerHTML = ``;

            for(let i = 0; i < loadStudent; i++) {
                studentList.innerHTML += `
                    <div class="as-p-10px as-card as-mb-10px as-brr-5px as-flex as-align-center as-justify-between as-space-between">
                        <div>
                            <div>${response.data[i].student_name}</div>
                            <div class="as-f-fade">${response.data[i].student_number}</div>
                            <div class="as-f-fade">${convertToBengali(response.data[i].student_enrolled_course)} কোর্সে ভর্তি</div>
                        </div>
                        <div>
                            <span><i onclick="window.location.href='/admin/student/info/${response.data[i].id}'" class="fa-solid fa-eye as-app-cursor"></i></span>
                        </div>
                    </div>
                `;
            }
        });
    }
    else{
        axios.get('/admin/student/search/' + searchStudent)
        .then(response => {
            document.getElementById('search-student').value = '';

            const studentList = document.getElementById('student-list');
            const totalStudentDiv = document.getElementById('total-student-div');
            totalStudentDiv.innerHTML = `(${convertToBengali(response.data.length)} জন)`;

            studentList.innerHTML = ``;

            for(let i = 0; i < response.data.length; i++) {
                studentList.innerHTML += `
                    <div class="as-p-10px as-card as-mb-10px as-brr-5px as-flex as-align-center as-justify-between as-space-between">
                        <div>
                            <div>${response.data[i].student_name}</div>
                            <div class="as-f-fade">${response.data[i].student_number}</div>
                            <div class="as-f-fade">${convertToBengali(response.data[i].student_enrolled_course)} কোর্সে ভর্তি</div>
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
function deleteStudent(studentId){
    var confirm = window.confirm('শিক্ষার্থীর তথ্য মুছে ফেলতে চান?');
    if(confirm){
        axios.post('/admin/student/delete', {student_id: studentId})
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

function addStudentInfo(){
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var studentName   = document.getElementById('fullname').value;
    var studentEmail  = document.getElementById('email').value;
    var studentNumber = document.getElementById('number').value;
    var studentProfession   = document.getElementById('profession').value;
    var studentFbProfileUrl = document.getElementById('fb-profile-url').value;
    var studentFbPageUrl    = document.getElementById('fb-page-url').value;

    var studentDaySelect   = document.getElementById('daySelect').value;
    var studentMonthSelect = document.getElementById('monthSelect').value;
    var studentYearSelect  = document.getElementById('yearSelect').value;

    var studentAddress  = document.getElementById('address').value;
    var studentDivision = document.getElementById('division').value;
    var studentDistrict = document.getElementById('district').value;
    var studentNote     = document.getElementById('note').value;

    if(studentName == ''){
        alert('পুরোনাম লিখুন');
    }
    else if(studentEmail != '' && !regex.test(studentEmail)){
        alert('ই-মেইল সঠিক নয়');
    }
    else if(studentNumber == ''){
        alert('ফোন নাম্বর লিখুন');
    }
    else if(studentNumber.length != 11){
        alert('ফোন নাম্বর সঠিক নয়');
    }
    else{
        var data = {
            student_name: studentName,
            student_email: studentEmail,
            student_number: studentNumber,
            student_profession: studentProfession,
            student_page_url: studentFbPageUrl,
            student_profile_url: studentFbProfileUrl,
            student_birthday: studentDaySelect+'-'+studentMonthSelect+'-'+studentYearSelect,
            student_division: studentDivision,
            student_district: studentDistrict,
            student_address: studentAddress,
            student_note: studentNote,
        }

        var addInfoButton = document.getElementById('add-info-button');
        addInfoButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> যুক্ত করা হচ্ছে';
        addInfoButton.disabled = true;

        console.log(data);

        axios.post('/admin/student/add', data)
            .then(res=>{
                if(res.data.status == 200){
                    addInfoButton.innerHTML = 'যুক্ত করুন';
                    addInfoButton.disabled = false;

                    alert(res.data.message);
                    hideModal('student-info');
                    getStudentData();
                }
                else{
                    addInfoButton.innerHTML = 'যুক্ত করুন';
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
studentDivision.addEventListener('change', function() {
    var districtDiv = document.getElementById('district-div');
    districtDiv.innerHTML = ``;

    if(studentDivision.value == 'Dhaka') {
        districtDiv.innerHTML = `<option value="Dhaka">ঢাকা</option>
        <option value="Gazipur">গাজীপুর</option>
        <option value="Narayanganj">নারায়ণগঞ্জ</option>
        <option value="Tangail">টাঙ্গাইল</option>
        <option value="Manikganj">মানিকগঞ্জ</option>
        <option value="Kishoreganj">কিশোরগঞ্জ</option>
        <option value="Munshiganj">মুন্সিগঞ্জ</option>
        <option value="Rajbari">রাজবাড়ী</option>
        <option value="Faridpur">ফরিদপুর</option>
        <option value="Gopalganj">গোপালগঞ্জ</option>
        <option value="Madaripur">মাদারীপুর</option>
        <option value="Shariatpur">শরীয়তপুর</option>
        <option value="Narsingdi">নরসিংদী</option>
        `;
    }
    else if(studentDivision.value == 'Chittagong') {
        districtDiv.innerHTML = `<option value="Chittagong">চট্টগ্রাম</option>
        <option value="CoxsBazar">কক্সবাজার</option>
        <option value="Comilla">কুমিল্লা</option>
        <option value="Feni">ফেনী</option>
        <option value="Brahmanbaria">ব্রাহ্মণবাড়িয়া</option>
        <option value="Rangamati">রাঙামাটি</option>
        <option value="Noakhali">নোয়াখালী</option>
        <option value="Khagrachari">খাগড়াছড়ি</option>
        <option value="Lakshmipur">লক্ষ্মীপুর</option>
        <option value="Chandpur">চাঁদপুর</option>
        <option value="Bandarban">বান্দরবান</option>
        `;
    }
    else if(studentDivision.value == 'Khulna') {
        districtDiv.innerHTML = `<option value="Khulna">খুলনা</option>
        <option value="Bagerhat">বাগেরহাট</option>
        <option value="Satkhira">সাতক্ষীরা</option>
        <option value="Jessore">যশোর</option>
        <option value="Jhenaidah">ঝিনাইদহ</option>
        <option value="Magura">মাগুরা</option>
        <option value="Narail">নড়াইল</option>
        <option value="Kushtia">কুষ্টিয়া</option>
        <option value="Chuadanga">চুয়াডাঙ্গা</option>
        <option value="Meherpur">মেহেরপুর</option>
        `;
    }
    else if(studentDivision.value == 'Rajshahi') {
        districtDiv.innerHTML = `<option value="Rajshahi">রাজশাহী</option>
        <option value="Pabna">পাবনা</option>
        <option value="Bogra">বগুড়া</option>
        <option value="Joypurhat">জয়পুরহাট</option>
        <option value="Naogaon">নওগাঁ</option>
        <option value="Natore">নাটোর</option>
        <option value="Chapainawabganj">চাঁপাইনবাবগঞ্জ</option>
        <option value="Sirajganj">সিরাজগঞ্জ</option>
        `;
    }
    else if(studentDivision.value == 'Barishal') {
        districtDiv.innerHTML = `<option value="Barisal">বরিশাল</option>
        <option value="Patuakhali">পটুয়াখালী</option>
        <option value="Bhola">ভোলা</option>
        <option value="Pirojpur">পিরোজপুর</option>
        <option value="Barguna">বরগুনা</option>
        <option value="Jhalokathi">ঝালকাঠি</option>
        `;
    }
    else if(studentDivision.value == 'Sylhet') {
        districtDiv.innerHTML = `<option value="Sylhet">সিলেট</option>
        <option value="Moulvibazar">মৌলভীবাজার</option>
        <option value="Habiganj">হবিগঞ্জ</option>
        <option value="Sunamganj">সুনামগঞ্জ</option>
        `;
    }
    else if(studentDivision.value == 'Rangpur') {
        districtDiv.innerHTML = `<option value="Rangpur">রংপুর</option>
        <option value="Dinajpur">দিনাজপুর</option>
        <option value="Kurigram">কুড়িগ্রাম</option>
        <option value="Lalmonirhat">লালমনিরহাট</option>
        <option value="Nilphamari">নীলফামারী</option>
        <option value="Panchagarh">পঞ্চগড়</option>
        <option value="Thakurgaon">ঠাকুরগাঁও</option>
        <option value="Gaibandha">গাইবান্ধা</option>
        `;
    }
    else if(studentDivision.value == 'Mymensingh') {
        districtDiv.innerHTML = `<option value="Mymensingh">ময়মনসিংহ</option>
        <option value="Jamalpur">জামালপুর</option>
        <option value="Netrokona">নেত্রকোনা</option>
        <option value="Sherpur">শেরপুর</option>
        `;
    }
});
</script>
@endsection