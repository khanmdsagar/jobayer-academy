@extends('layouts.app')

@section('title', 'Jobayer Academy - Profile')

@section('content')
<section class="as-content-top-margin">
    <div class="as-flex as-space-between as-w-95 dt:as-mw-1280px as-m-0-auto">
        <!-- Sidebar -->
        <div class="as-show-desktop as-mt-15px as-w-28">
            <div class="">
                <img class="as-w-50px" src="https://cdn-icons-png.flaticon.com/512/2436/2436874.png" alt="Logo" class="sidebar-logo">
                <h2>শীক্ষার্থী ড্যাশবোর্ড</h2>
            </div>

            <div class="as-mt-20px">
                <div class="">
                    <div class="as-app-cursor as-hover as-p-10px as-brr-5px" onclick="window.location.href = '/dashboard'"><i class="fas fa-box as-mr-10px"></i>ড্যাশবোর্ড</div>
                </div>
                <div class="">
                    <div class="as-app-cursor as-hover as-p-10px as-brr-5px" onclick="window.location.href = '/question-answer'"><i class="fas fa-question as-mr-10px"></i>প্রশ্ন ও উত্তর</div>
                </div>
                <div class="">
                    <div class="as-app-cursor as-hover as-p-10px as-brr-5px" onclick="window.location.href = '/settings'"><i class="fas fa-gear as-mr-10px"></i>সেটিংস</div>
                </div>
                <div class="">
                    <div class="logout as-app-cursor as-hover as-p-10px as-brr-5px" onclick="logout()"><i class="fas fa-sign-out-alt as-mr-10px"></i>লগআউট</div>
                </div>
            </div>
        </div>


        <!-- Main Content -->
        <div class="as-mt-15px as-w-70 md:as-w-100">
            <div class="as-card as-p-10px as-mb-15px">
                <div class="as-flex as-space-between">
                    <div>
                        <h2>ব্যক্তিগত তথ্য</h2>
                    </div>
                    <div class="as-ml-10px">
                        <button class="as-btn as-app-cursor as-bg-cancel" onclick="showModal('personal-info')">তথ্য এডিট</button>
                    </div>
                </div>
                <div class="as-mt-10px">
                    <span><b>পুরোনাম</b></span>
                    <div class="as-section-bg as-p-10px as-brr-5px" id="fullname-div">...</div>
                </div>
                <div class="as-mt-10px">
                    <span><b>ফোন নাম্বর</b></span>
                    <div class="as-section-bg as-p-10px as-brr-5px" id="number-div">...</div>
                </div>
                <div class="as-mt-10px">
                    <span><b>ই-মেইল</b></span>
                    <div class="as-section-bg as-p-10px as-brr-5px" id="email-div">...</div>
                </div>
                <div class="as-mt-10px">
                    <span><b>জন্মতারিখ</b></span>
                    <div class="as-section-bg as-p-10px as-brr-5px" id="birthday-div">...</div>
                </div>
                <div class="as-mt-10px">
                    <span><b>পেশা</b></span>
                    <div class="as-section-bg as-p-10px as-brr-5px" id="profession-div">...</div>
                </div>
                <div class="as-mt-10px">
                    <span><b>ফেসবুক প্রফাইল ইউআরএল</b></span>
                    <div class="as-section-bg as-p-10px as-brr-5px" id="profile-url-div">...</div>
                </div>
                <div class="as-mt-10px">
                    <span><b>ফেসবুক পেজ ইউআরএল</b></span>
                    <div class="as-section-bg as-p-10px as-brr-5px" id="page-url-div">...</div>
                </div>
                <div class="as-mt-10px">
                    <span><b>বিভাগ</b></span>
                    <div class="as-section-bg as-p-10px as-brr-5px" id="division-div">...</div>
                </div>
                <div class="as-mt-10px">
                    <span><b>জেলা</b></span>
                    <div class="as-section-bg as-p-10px as-brr-5px" id="district-div">...</div>
                </div>
                <div class="as-mt-10px">
                    <span><b>ঠিকানা</b></span>
                    <div class="as-section-bg as-p-10px as-brr-5px" id="address-div">...</div>
                </div>
            </div>
        </div>

        {{--modal--}}
        <div class="as-modal" id="personal-info" style="display: none">
            <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

                <div class="as-text-center as-w-100">
                    <h2>তথ্য ফর্ম</h2>
                </div>

                <div class="as-modal-child as-p-10px">
                    <div class="as-mt-10px">
                        <span><b>পুরোনাম</b></span><br>
                        <input id="fullname" class="as-input" type="text" value="{{$student_info->student_name}}">
                    </div>
                    <div class="as-mt-10px">
                        <span><b>ই-মেইল</b></span><br>
                        <input id="email" class="as-input" type="email" value="{{$student_info->student_email}}">
                    </div>
                    <div class="as-mt-10px">
                        <span><b>জন্মতারিখ</b></span><br>
                        <div class="as-flex">
                            <select id="daySelect" class="as-select as-mr-10px">
                                <option hidden value="{{ isset($day) ? $day : '' }}">
                                    {{ isset($day) && $day ? $day : 'দিন' }}
                                </option>
                            </select>
                            <select id="monthSelect" class="as-select as-mr-10px">
                                <option hidden value="{{ isset($month) ? $month : '' }}">
                                    {{ isset($month) && $month ? $month : 'মাস' }}
                                </option>
                            </select>
                            <select id="yearSelect" class="as-select">
                                <option hidden value="{{ isset($year) ? $year : '' }}">
                                    {{ isset($year) && $year ? $year : 'বছর' }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="as-mt-10px">
                        <span><b>পেশা</b></span><br>
                        <select id="profession" class="as-select">
                            <option hidden value="{{$profession}}">
                                @if($profession != '')
                                    {{$profession}}
                                @else
                                    পেশা নির্বাচন করুন
                                @endif
                            </option>
                            <option value="Government">সরকারি চাকরি</option>
                            <option value="Private">বেসরকারি চাকরি</option>
                            <option value="Student">শীক্ষার্থী</option>
                            <option value="Business">ব্যবসা</option>
                            <option value="Entrepreneur">উদ্যোক্তা</option>
                            <option value="Housewife">গৃহিনী</option>
                        </select>
                    </div>
                    <div class="as-mt-10px">
                        <span><b>ফেসবুক প্রফাইল ইউআরএল</b> (ঐচ্ছিক)</span><br>
                        <input id="fb-profile-url" class="as-input" type="text"
                            value="{{$student_info->student_profile_url}}">
                    </div>
                    <div class="as-mt-10px">
                        <span><b>ফেসবুক পেজ ইউআরএল</b> (ঐচ্ছিক)</span><br>
                        <input id="fb-page-url" class="as-input" type="text" value="{{$student_info->student_page_url}}">
                    </div>
                    <div class="as-mt-10px">
                        <span><b>ঠিকানা</b></span><br>
                        <input id="address" class="as-input" type="text" value="{{$student_info->student_address}}">
                    </div>
                    <div class="as-mt-10px">
                        <span><b>বিভাগ</b></span><br>
                        <select id="division" class="as-select">
                            <option hidden value="{{$division}}" disabled selected>
                                @if($division != '')
                                    {{$division}}
                                @else
                                    বিভাগ নির্বাচন করুন
                                @endif
                            </option>
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
                        <span><b>জেলা</b></span><br>
                        <select id="district" class="as-select">
                            <option hidden value="{{$district}}" disabled selected>
                                @if($district != '')
                                    {{$district}}
                                @else
                                    জেলা নির্বাচন করুন
                                @endif
                            </option>
                            <optgroup id="district2"></optgroup>
                        </select>
                    </div>

                </div>
                <div class="as-mt-20px as-text-right">
                    <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('personal-info')">বাতিল</button>
                    <button id="update-info-button" class="as-btn as-app-cursor" onclick="updateInfo()">আপডেট</button>
                </div>
            </div>
        </div>
    </div>
</section>

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
        getStudentInfo();

        function getStudentInfo() {
            axios.get('/api/get-student-info')
                .then(res => {
                    document.getElementById('email-div').innerText = res.data[0].student_email;
                    document.getElementById('number-div').innerText = res.data[0].student_number;
                    document.getElementById('division-div').innerText = res.data[0].student_division;
                    document.getElementById('address-div').innerText = res.data[0].student_address;
                    document.getElementById('page-url-div').innerText = res.data[0].student_page_url;
                    document.getElementById('fullname-div').innerText = res.data[0].student_name;
                    document.getElementById('birthday-div').innerText = res.data[0].student_birthday;
                    document.getElementById('profession-div').innerText = res.data[0].student_profession;
                    document.getElementById('profile-url-div').innerText = res.data[0].student_profile_url;
                    document.getElementById('district-div').innerText = res.data[0].student_district;
                });
        }

        function updateInfo() {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var studentName = document.getElementById('fullname').value;
            var studentEmail = document.getElementById('email').value;

            var studentProfession = document.getElementById('profession').value;
            var studentFbProfileUrl = document.getElementById('fb-profile-url').value;
            var studentFbPageUrl = document.getElementById('fb-page-url').value;

            var studentDaySelect = document.getElementById('daySelect').value;
            var studentMonthSelect = document.getElementById('monthSelect').value;
            var studentYearSelect = document.getElementById('yearSelect').value;

            var studentAddress = document.getElementById('address').value;
            var studentDivision = document.getElementById('division').value;
            var studentDistrict = document.getElementById('district').value;

            if (studentName == '') {
                alert('পুরোনাম লিখুন');
            }
            else if (studentEmail == '') {
                alert('ইমেইল লিখুন');
            }
            else if (!regex.test(studentEmail)) {
                alert('ইমেইল সঠিক নয়');
            }
            else if (studentDaySelect == '') {
                alert('জন্মদিন নির্বাচন করুন');
            }
            else if (studentMonthSelect == '') {
                alert('জন্মমাস নির্বাচন করুন');
            }
            else if (studentYearSelect == '') {
                alert('জন্মবছর নির্বাচন করুন');
            }
            else if (studentProfession == '') {
                alert('পেশা নির্বাচন করুন');
            }
            else if (studentDivision == '') {
                alert('বিভাগ নির্বাচন লিখুন');
            }
            else if (studentDistrict == '') {
                alert('জেলা নির্বাচন করুন');
            }
            else if (studentAddress == '') {
                alert('ঠিকানা লিখুন');
            }
            else {
                var data = {
                    student_name: studentName,
                    student_email: studentEmail,
                    student_birthday: studentDaySelect + '-' + studentMonthSelect + '-' + studentYearSelect,
                    student_profession: studentProfession,
                    student_page_url: studentFbPageUrl,
                    student_profile_url: studentFbProfileUrl,
                    student_division: studentDivision,
                    student_district: studentDistrict,
                    student_address: studentAddress,
                }

                var updateInfoButton = document.getElementById('update-info-button');
                updateInfoButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> আপডেট হচ্ছে';
                updateInfoButton.disabled = true;

                axios.post('/api/update-student-info', data)
                    .then(res => {
                        if (res.data.status == 200) {
                            updateInfoButton.innerHTML = 'আপডেট করুন';
                            updateInfoButton.disabled = false;

                            alert(res.data.message);
                            hideModal('personal-info');
                            getStudentInfo();
                        }
                        else {
                            updateInfoButton.innerHTML = 'আপডেট করুন';
                            updateInfoButton.disabled = false;

                            alert(res.data.message);
                            hideModal('personal-info');
                            getStudentInfo();
                        }
                    });
            }
        }

        //district on division select
        var studentDivision = document.getElementById('division');

        studentDivision.addEventListener('change', function () {
            var district2 = document.getElementById('district2');
            district2.innerHTML = ``;

            if (studentDivision.value == 'Dhaka') {
                district2.innerHTML = `<option value="Dhaka">ঢাকা</option>
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
            else if (studentDivision.value == 'Chittagong') {
                district2.innerHTML = `<option value="Chittagong">চট্টগ্রাম</option>
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
            else if (studentDivision.value == 'Khulna') {
                district2.innerHTML = `<option value="Khulna">খুলনা</option>
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
            else if (studentDivision.value == 'Rajshahi') {
                district2.innerHTML = `<option value="Rajshahi">রাজশাহী</option>
                <option value="Pabna">পাবনা</option>
                <option value="Bogra">বগুড়া</option>
                <option value="Joypurhat">জয়পুরহাট</option>
                <option value="Naogaon">নওগাঁ</option>
                <option value="Natore">নাটোর</option>
                <option value="Chapainawabganj">চাঁপাইনবাবগঞ্জ</option>
                <option value="Sirajganj">সিরাজগঞ্জ</option>
                `;
            }
            else if (studentDivision.value == 'Barishal') {
                district2.innerHTML = `<option value="Barisal">বরিশাল</option>
                <option value="Patuakhali">পটুয়াখালী</option>
                <option value="Bhola">ভোলা</option>
                <option value="Pirojpur">পিরোজপুর</option>
                <option value="Barguna">বরগুনা</option>
                <option value="Jhalokathi">ঝালকাঠি</option>
                `;
            }
            else if (studentDivision.value == 'Sylhet') {
                district2.innerHTML = `<option value="Sylhet">সিলেট</option>
                <option value="Moulvibazar">মৌলভীবাজার</option>
                <option value="Habiganj">হবিগঞ্জ</option>
                <option value="Sunamganj">সুনামগঞ্জ</option>
                `;
            }
            else if (studentDivision.value == 'Rangpur') {
                district2.innerHTML = `<option value="Rangpur">রংপুর</option>
                <option value="Dinajpur">দিনাজপুর</option>
                <option value="Kurigram">কুড়িগ্রাম</option>
                <option value="Lalmonirhat">লালমনিরহাট</option>
                <option value="Nilphamari">নীলফামারী</option>
                <option value="Panchagarh">পঞ্চগড়</option>
                <option value="Thakurgaon">ঠাকুরগাঁও</option>
                <option value="Gaibandha">গাইবান্ধা</option>
                `;
            }
            else if (studentDivision.value == 'Mymensingh') {
                district2.innerHTML = `<option value="Mymensingh">ময়মনসিংহ</option>
                <option value="Jamalpur">জামালপুর</option>
                <option value="Netrokona">নেত্রকোনা</option>
                <option value="Sherpur">শেরপুর</option>
                `;
            }
        });

        if (`{{$division}}` != '') {
            var district2 = document.getElementById('district2');
            district2.innerHTML = ``;

            if (`{{$division}}` == 'Dhaka') {
                district2.innerHTML = `<option value="Dhaka">ঢাকা</option>
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
            else if (`{{$division}}` == 'Chittagong') {
                district2.innerHTML = `<option value="Chittagong">চট্টগ্রাম</option>
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
            else if (`{{$division}}` == 'Khulna') {
                district2.innerHTML = `<option value="Khulna">খুলনা</option>
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
            else if (`{{$division}}` == 'Rajshahi') {
                district2.innerHTML = `<option value="Rajshahi">রাজশাহী</option>
                <option value="Pabna">পাবনা</option>
                <option value="Bogra">বগুড়া</option>
                <option value="Joypurhat">জয়পুরহাট</option>
                <option value="Naogaon">নওগাঁ</option>
                <option value="Natore">নাটোর</option>
                <option value="Chapainawabganj">চাঁপাইনবাবগঞ্জ</option>
                <option value="Sirajganj">সিরাজগঞ্জ</option>
                `;
            }
            else if (`{{$division}}` == 'Barishal') {
                district2.innerHTML = `<option value="Barisal">বরিশাল</option>
                <option value="Patuakhali">পটুয়াখালী</option>
                <option value="Bhola">ভোলা</option>
                <option value="Pirojpur">পিরোজপুর</option>
                <option value="Barguna">বরগুনা</option>
                <option value="Jhalokathi">ঝালকাঠি</option>
                `;
            }
            else if (`{{$division}}` == 'Sylhet') {
                district2.innerHTML = `<option value="Sylhet">সিলেট</option>
                <option value="Moulvibazar">মৌলভীবাজার</option>
                <option value="Habiganj">হবিগঞ্জ</option>
                <option value="Sunamganj">সুনামগঞ্জ</option>
                `;
            }
            else if (`{{$division}}` == 'Rangpur') {
                district2.innerHTML = `<option value="Rangpur">রংপুর</option>
                <option value="Dinajpur">দিনাজপুর</option>
                <option value="Kurigram">কুড়িগ্রাম</option>
                <option value="Lalmonirhat">লালমনিরহাট</option>
                <option value="Nilphamari">নীলফামারী</option>
                <option value="Panchagarh">পঞ্চগড়</option>
                <option value="Thakurgaon">ঠাকুরগাঁও</option>
                <option value="Gaibandha">গাইবান্ধা</option>
                `;
            }
            else if (`{{$division}}` == 'Mymensingh') {
                district2.innerHTML = `<option value="Mymensingh">ময়মনসিংহ</option>
                <option value="Jamalpur">জামালপুর</option>
                <option value="Netrokona">নেত্রকোনা</option>
                <option value="Sherpur">শেরপুর</option>
                `;
            }
        }

    </script>
@endsection