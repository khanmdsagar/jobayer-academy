@extends('layouts.app')
@section('title', 'Jobayer Academy - Login')

@section('content')
    <!-- Auth Section -->
    <section>
        <div class="auth-div as-absolute as-absolute-center as-w-400px md:as-w-95" id="auth-container-check"
            style="display: block">
            <div class="as-card as-p-15px ">
                <div class="as-text-center as-mb-20px">
                    <h1>👋 স্বাগতম</h1>
                    <p>লগইন করতে, আপনার মোবাইল নম্বর ব্যবহার করে এগিয়ে যান।</p>
                </div>

                <div>
                    <div class="as-mb-10px">
                        <label for="phone-number" class="as-f-bold">ফোন নম্বর</label>
                        <input class="as-input" type="number" id="phone-number" placeholder="আপনার ফোন নম্বর লিখুন">
                    </div>

                    <div class="as-text-right">
                        <button id="check-student-button" onclick="checkStudent()" class="as-app-cursor as-w-100 as-btn">
                            এগিয়ে যান <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="auth-div as-absolute as-absolute-center as-w-400px md:as-w-95" id="auth-container-verification"
            style="display: none">
            <div class="as-card as-p-15px">
                <div class="as-text-center as-mb-20px">
                    <h1>ফোন নম্বর যাচাই করুন</h1>
                    <p>মোবাইলে নাম্বারে পাঠানো ৪ সংখ্যার কোডটি নিচে লিখুন</p>
                </div>

                <div>
                    <div class="as-mb-10px">
                        <label for="code" class="as-f-bold">যাচাই কোড</label>
                        <input class="as-input" type="number" id="code" placeholder="যাচাই কোড লিখুন">
                    </div>

                    <div class="as-text-right">
                        <button id="register-student-button" onclick="registerStudent()"
                            class="as-app-cursor as-w-100 as-btn">
                            রেজিস্টার করুন <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="auth-div as-absolute as-absolute-center as-w-400px md:as-w-95" id="auth-container-login"
            style="display: none;">
            <div class="as-card as-p-15px">
                <div class="as-text-center as-mb-20px">
                    <h1>লগইন করুন</h1>
                    <p>আপনার পাসওয়ার্ড লিখুন</p>
                </div>

                <div>
                    <div class="as-mb-10px">
                        <label for="password" class="as-f-bold">পাসওয়ার্ড</label>
                        <div style="position: relative;">
                            <i onclick="tooglePassword()"
                                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"
                                class="pass-icon fa-solid fa-eye as-app-cursor"></i>
                            <input class="as-input pass-field" type="password" id="password" placeholder="আপনার পাসওয়ার্ড লিখুন">
                        </div>
                    </div>

                    <div class="as-text-right as-mb-10px as-mt-10px">
                        <div onclick="forgotPassword()" class="as-app-cursor">পাসওয়ার্ড রিসেট করুন</div>
                    </div>

                    <div class="as-text-right">
                        <button id="login-student-button" onclick="loginStudent()" class="as-app-cursor as-w-100 as-btn">
                            লগইন করুন <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Forgot Password Section -->
        <div class="auth-div as-absolute as-absolute-center as-w-400px md:as-w-95" id="auth-container-forget-verification"
            style="display: none;">
            <div class="as-card as-p-15px">
                <div class="as-text-center as-mb-20px">
                    <h1>ফোন নম্বর যাচাই করুন</h1>
                    <p>মোবাইল নাম্বারে পাঠানো ৪ সংখ্যার কোডটি নিচে লিখুন</p>
                </div>

                <div>
                    <div class="as-mb-10px">
                        <label for="reset-code" class="as-f-bold">যাচাই কোড</label>
                        <input class="as-input" type="number" id="reset-code" placeholder="যাচাই কোড লিখুন">
                    </div>

                    <div class="as-text-right">
                        <button id="open-password-reset-container-button" onclick="openPasswordResetContainer()"
                            class="as-app-cursor as-w-100 as-btn">
                            যাচাই করুন <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="auth-div as-absolute as-absolute-center as-w-400px md:as-w-95" id="auth-container-reset-password"
            style="display: none;">
            <div class="as-card as-p-15px">
                <div class="as-text-center as-mb-20px">
                    <h1>পাসওয়ার্ড রিসেট করুন</h1>
                    <p>আপনার নতুন পাসওয়ার্ড লিখুন</p>
                </div>

                <div class="as-mb-10px">
                    <div class="as-mb-10px">
                        <label for="reset-password" class="as-f-bold">পাসওয়ার্ড</label>
                        {{-- <input class="as-input" type="password" id="reset-password"
                            placeholder="আপনার নতুন পাসওয়ার্ড লিখুন"> --}}
                        <div style="position: relative;">
                            <i onclick="tooglePassword()"
                                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"
                                class="pass-icon fa-solid fa-eye as-app-cursor"></i>
                            <input class="as-input pass-field" type="password" id="reset-password"
                                placeholder="আপনার নতুন পাসওয়ার্ড লিখুন">
                        </div>
                    </div>
                    <div class="as-mb-10px">
                        <label for="confirm-reset-password" class="as-f-bold">পুনরায় পাসওয়ার্ড</label>
                        {{-- <input class="as-input" type="password" id="confirm-reset-password"
                            placeholder="পুনরায় নতুন পাসওয়ার্ড লিখুন"> --}}
                        <div style="position: relative;">
                            <i onclick="tooglePassword()"
                                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"
                                class="pass-icon fa-solid fa-eye as-app-cursor"></i>
                            <input class="as-input pass-field" type="password" id="confirm-reset-password"
                                placeholder="পুনরায় নতুন পাসওয়ার্ড লিখুন">
                        </div>
                    </div>

                    <div class="as-text-right">
                        <button id="reset-password-button" onclick="resetPassword()" class="as-app-cursor as-w-100 as-btn">
                            পাসওয়ার্ড রিসেট করুন <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')
    <script>
        function tooglePassword() {
            var passwordField = document.getElementsByClassName('pass-field');
            var passwordIcon  = document.getElementsByClassName('pass-icon');

            for (var i = 0; i < passwordField.length; i++) {
                var passwordFieldType = passwordField[i].getAttribute('type');

                if (passwordFieldType === 'password') {
                    passwordField[i].setAttribute('type', 'text');
                    passwordIcon[i].classList.remove('fa-eye');
                    passwordIcon[i].classList.add('fa-eye-slash');
                }
                else {
                    passwordField[i].setAttribute('type', 'password');
                    passwordIcon[i].classList.remove('fa-eye-slash');
                    passwordIcon[i].classList.add('fa-eye');
                }
            }
        }

        var verification_code = '';

        function forgotPassword() {
            var phone_number = document.getElementById('phone-number').value;
            var open_password_reset_container_button = document.getElementById('open-password-reset-container-button');

            open_password_reset_container_button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> কোড পাঠানো হচ্ছে...';
            open_password_reset_container_button.disabled = true;

            axios.post('/api/send-verification-code', {
                student_number: phone_number
            })
                .then(function (response) {
                    //console.log(response.data.code)

                    if (response.data.status == 'failed') {
                        open_password_reset_container_button.innerHTML = 'দুঃখিত! কোড পাঠানো হয়নি';
                        open_password_reset_container_button.disabled = false;
                        alert(response.data.message);
                    }
                    else {
                        open_password_reset_container_button.innerHTML = 'যাচাই করুন';
                        open_password_reset_container_button.disabled = false;
                        document.getElementById('auth-container-login').style.display = 'none';
                        document.getElementById('auth-container-forget-verification').style.display = 'block';
                        verification_code = response.data.code;
                    }
                })
                .catch(function (error) {
                    alert('আপনি অনেক বার চেষ্টা করেছেন। ৩০ মিনিট পরে আবার চেষ্টা করুন');
                    open_password_reset_container_button.innerHTML = 'দুঃখিত! কোড পাঠানো হয়নি';
                    open_password_reset_container_button.disabled = false;
                });
        }

        function resetPassword() {
            var student_number = document.getElementById('phone-number').value;
            var reset_password = document.getElementById('reset-password').value;
            var confirm_reset_password = document.getElementById('confirm-reset-password').value;
            var reset_password_button = document.getElementById('reset-password-button');

            if (reset_password == '') {
                alert('পাসওয়ার্ড লিখুন');
            }
            else if (confirm_reset_password == '') {
                alert('পুনরায় পাসওয়ার্ড লিখুন');
            }
            else if (reset_password.length < 6) {
                alert('পাসওয়ার্ড কমক্ষে ৬ অক্ষরের হতে হবে');
            }
            else if (reset_password != confirm_reset_password) {
                alert('পাসওয়ার্ড মেলেনি');
            }
            else {
                reset_password_button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> পাসওয়ার্ড রিসেট করা হচ্ছে...';
                reset_password_button.disabled = true;

                axios.post('/api/reset-password', {
                    reset_password: reset_password,
                    student_number: student_number
                })
                    .then(function (response) {
                        if (response.data.status == 'success') {
                            if ('{{$course_id}}' != '') {
                                axios.post('/api/is-student-enrolled', { 'course_id': '{{$course_id}}' })
                                    .then(res => {
                                        if (res.data == 1) {
                                            window.location.replace('/dashboard');
                                        }
                                        else if ('{{$course_id}}' != '' && '{{$course_curriculumn}}' != '') {
                                            window.location.replace('{{ url('/course/' . $course_id . '/' . $course_slug) }}');
                                        }
                                        else if ('{{ $course_id }}' != '') {
                                            window.location.replace('{{ url('/checkout/' . $course_id . '/' . $course_slug) }}');
                                        }
                                        else {
                                            window.location.replace('/dashboard');
                                        }
                                    })
                                    .catch(function (error) { });
                            }
                            else {
                                if ('{{$course_id}}' != '' && '{{$course_curriculumn}}' != '') {
                                    window.location.replace('{{ url('/course/' . $course_id . '/' . $course_slug) }}');
                                }
                                else if ('{{ $course_id }}' != '') {
                                    window.location.replace('{{ url('/checkout/' . $course_id . '/' . $course_slug) }}');
                                }
                                else {
                                    window.location.replace('/dashboard');
                                }
                            }
                        }
                        else {
                            reset_password_button.innerHTML = 'পাসওয়ার্ড রিসেট করুন';
                            reset_password_button.disabled = false;

                            alert(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            }
        }

        function openPasswordResetContainer() {
            var reset_code = document.getElementById('reset-code').value;

            if (reset_code == '') {
                alert('যাচাই কোড লিখুন');
            }
            else if (reset_code.length != 4) {
                alert('যাচাই কোড ৪ সংখ্যার হতে হবে');
            }
            else if (reset_code != verification_code) {
                alert('যাচাই কোড সঠিক নয়');
            }
            else if (reset_code == verification_code) {
                setTimeout(() => {
                    document.getElementById('auth-container-forget-verification').style.display = 'none';
                    document.getElementById('auth-container-reset-password').style.display = 'block';
                }, 500);
            }
        }

        function firstAttempt(action) {
            var phone_number = document.getElementById('phone-number').value;
            document.getElementById('check-student-button').innerHTML = '<i class="fas fa-spinner fa-spin"></i> কোড পাঠানো হচ্ছে...';
            document.getElementById('check-student-button').disabled = true;

            axios.post('/api/send-verification-code', {
                student_number: phone_number
            })
                .then(function (response) {
                    if (response.data.status == 'failed') {
                        alert(response.data.message);
                        document.getElementById('check-student-button').innerHTML = 'দুঃখিত! কোড পাঠানো হয়নি';
                        document.getElementById('check-student-button').disabled = false;
                    }
                    else {
                        document.getElementById('auth-container-check').style.display = 'none';

                        if (action == 'register') {
                            document.getElementById('auth-container-verification').style.display = 'block';
                        }
                        else if (action == 'resetPassword') {
                            document.getElementById('auth-container-forget-verification').style.display = 'block';
                        }

                        verification_code = response.data.code;
                        //console.log(response.data.code)
                    }
                })
                .catch(function (error) {
                    alert('আপনি অনেক বার চেষ্টা করেছেন। ৩০ মিনিট পরে আবার চেষ্টা করুন');
                    document.getElementById('check-student-button').innerHTML = 'দুঃখিত! কোড পাঠানো হয়নি';
                    document.getElementById('check-student-button').disabled = false;
                });
        }


        function checkStudent() {
            var phone_number = document.getElementById('phone-number').value;

            if (phone_number == '') {
                alert('ফোন নম্বর লিখুন');
            }
            else if (phone_number.length != 11) {
                alert('ফোন নম্বর ১১ ডিজিটের হতে হবে');
            }
            else {
                axios.post('/api/check-student', {
                    student_number: phone_number
                })
                    .then(function (response) {
                        if (response.data.status == 'no password') {
                            firstAttempt('resetPassword');
                        }
                        else if (response.data.status == 'success') {
                            document.getElementById('auth-container-check').style.display = 'none';
                            document.getElementById('auth-container-login').style.display = 'block';
                        }
                        else {
                            firstAttempt('register');
                        }
                    })
                    .catch(function (error) { });
            }
        }

        function loginStudent() {
            var password = document.getElementById('password').value;
            var phone_number = document.getElementById('phone-number').value;
            var login_student_button = document.getElementById('login-student-button');

            if (password == '') {
                alert('পাসওয়ার্ড লিখুন');
            }
            else {
                login_student_button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> লগইন করা হচ্ছে...';
                login_student_button.disabled = true;

                axios.post('/api/login-student', {
                    student_password: password,
                    student_number: phone_number
                })
                    .then(function (response) {
                        if (response.data.status == 'success') {
                            if ('{{$course_id}}' != '') {
                                axios.post('/api/is-student-enrolled', { 'course_id': '{{$course_id}}' })
                                    .then(res => {
                                        if (res.data == 1) {
                                            window.location.replace('/dashboard');
                                        }
                                        else if ('{{$course_id}}' != '' && '{{$course_curriculumn}}' != '') {
                                            window.location.replace('{{ url('/course/' . $course_id . '/' . $course_slug) }}');
                                        }
                                        else if ('{{ $course_id }}' != '') {
                                            window.location.replace('{{ url('/checkout/' . $course_id . '/' . $course_slug) }}');
                                        }
                                        else {
                                            window.location.replace('/dashboard');
                                        }
                                    })
                                    .catch(function (error) { });
                            }
                            else {
                                if ('{{$course_id}}' != '' && '{{$course_curriculumn}}' != '') {
                                    window.location.replace('{{ url('/course/' . $course_id . '/' . $course_slug) }}');
                                }
                                else if ('{{ $course_id }}' != '') {
                                    window.location.replace('{{ url('/checkout/' . $course_id . '/' . $course_slug) }}');
                                }
                                else {
                                    window.location.replace('/dashboard');
                                }
                            }
                        }
                        else {
                            login_student_button.innerHTML = 'লগইন করুন';
                            login_student_button.disabled = false;

                            alert(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            }
        }

        function registerStudent() {
            var code = document.getElementById('code').value;
            var phone_number = document.getElementById('phone-number').value;
            var register_student_button = document.getElementById('register-student-button');

            if (code == '') {
                alert('যাচাই কোড লিখুন');
            }
            else if (code != verification_code) {
                alert('যাচাই কোড সঠিক নয়');
            }
            else {
                register_student_button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> রেজিস্টার করা হচ্ছে...';
                register_student_button.disabled = true;

                axios.post('/api/register-student', {
                    student_number: phone_number
                })
                    .then(function (response) {
                        if (response.data.status == 'success') {
                            if ('{{$course_id}}' != '') {
                                axios.post('/api/is-student-enrolled', { 'course_id': '{{$course_id}}' })
                                    .then(res => {
                                        if (res.data == 1) {
                                            window.location.replace('/dashboard');
                                        }
                                        else if ('{{$course_id}}' != '' && '{{$course_curriculumn}}' != '') {
                                            window.location.replace('{{ url('/course/' . $course_id . '/' . $course_slug) }}');
                                        }
                                        else if ('{{ $course_id }}' != '') {
                                            window.location.replace('{{ url('/checkout/' . $course_id . '/' . $course_slug) }}');
                                        }
                                        else {
                                            window.location.replace('/dashboard');
                                        }
                                    })
                                    .catch(function (error) { });
                            }
                            else {
                                if ('{{$course_id}}' != '' && '{{$course_curriculumn}}' != '') {
                                    window.location.replace('{{ url('/course/' . $course_id . '/' . $course_slug) }}');
                                }
                                else if ('{{ $course_id }}' != '') {
                                    window.location.replace('{{ url('/checkout/' . $course_id . '/' . $course_slug) }}');
                                }
                                else {
                                    window.location.replace('/dashboard');
                                }
                            }
                        }
                        else {
                            register_student_button.innerHTML = 'রেজিস্টার করুন';
                            register_student_button.disabled = false;

                            alert(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            }
        }

        document.addEventListener('keydown', function (event) {
            if (event.key == 'Enter') {
                var auth_divs = document.querySelectorAll('.auth-div');

                auth_divs.forEach((div) => {
                    var displayStyle = window.getComputedStyle(div).display;

                    if (displayStyle == 'block') {
                        if (div.id == 'auth-container-check') {
                            checkStudent();
                        }
                        else if (div.id == 'auth-container-verification') {
                            registerStudent();
                        }
                        else if (div.id == 'auth-container-login') {
                            loginStudent();
                        }
                        else if (div.id == 'auth-container-forget-verification') {
                            openPasswordResetContainer();
                        }
                        else if (div.id == 'auth-container-reset-password') {
                            resetPassword();
                        }
                    }
                });
            }
        });

    </script>
@endsection