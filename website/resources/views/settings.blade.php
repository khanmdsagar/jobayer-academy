@extends('layouts.app')

@section('title', 'Jobayer Academy - Settings')

@section('content')
    <div class="as-flex as-space-between as-w-95 dt:as-mw-1280px as-m-0-auto">
        <!-- Sidebar -->
        <div class="as-show-desktop as-mt-15px as-w-28">
            <div class="">
                <img class="as-w-50px" src="https://cdn-icons-png.flaticon.com/512/2436/2436874.png" alt="Logo"
                    class="sidebar-logo">
                <h2>শীক্ষার্থী ড্যাশবোর্ড</h2>
            </div>

            <div class="as-mt-20px">
                <div>
                    <div class="as-app-cursor as-hover as-p-10px as-brr-5px" onclick="window.location.href = '/dashboard'">
                        <i class="fas fa-box as-mr-10px"></i>ড্যাশবোর্ড</div>
                </div>
                <div>
                    <div class="as-app-cursor as-hover as-p-10px as-brr-5px"
                        onclick="window.location.href = '/question-answer'"><i class="fas fa-question as-mr-10px"></i>প্রশ্ন
                        ও উত্তর</div>
                </div>
                <div>
                    <div class="as-app-cursor as-hover as-p-10px as-brr-5px" onclick="window.location.href = '/profile'"><i
                            class="fas fa-gear as-mr-10px"></i>প্রফাইল</div>
                </div>
                <div>
                    <div class="logout as-app-cursor as-hover as-p-10px as-brr-5px" onclick="logout()"><i
                            class="fas fa-sign-out-alt as-mr-10px"></i>লগআউট</div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="as-mt-15px as-w-70 md:as-w-100">
            <div class="as-card as-p-10px">
                <div class="as-flex as-space-between">
                    <div>
                        <h2>পাসওয়ার্ড পরিবর্তন</h2>
                    </div>
                </div>
                <div class="as-mt-10px">
                    <span><b>নতুন পাসওয়ার্ড</b></span><br>
                    <input class="as-input as-p-10px as-brr-5px" type="password" id="password"
                        placeholder="নতুন পাসওয়ার্ড লিখুন">
                </div>
                <div class="as-mt-10px">
                    <span><b>কনফর্ম পাসওয়ার্ড</b></span><br>
                    <input class="as-input as-p-10px as-brr-5px" type="password" id="confirm-password"
                        placeholder="পাসওয়ার্ড কনফর্ম করুন">
                </div>
                <div class="as-mt-10px">
                    <button id="update-password-button" class="as-btn as-app-cursor" onclick="updatePassword()">আপডেট
                        করুন</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function updatePassword() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm-password').value;
            var updatePasswordButton = document.getElementById('update-password-button');

            if (password == '') {
                alert('পাসওয়ার্ড লিখুন');
            }
            else if (password.length < 6) {
                alert('পাসওয়ার্ড ৬ অক্ষরের হতে হবে');
            }
            else if (confirmPassword == '') {
                alert('পাসওয়ার্ড কনফর্ম করুন');
            }
            else if (password != confirmPassword) {
                alert('পাসওয়ার্ড মেলেনি');
            }
            else {
                updatePasswordButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> আপডেট হচ্ছে';
                updatePasswordButton.disabled = true;

                axios.post('/api/update-password', { student_password: password })
                    .then(res => {
                        if (res.data.status == 200) {
                            document.getElementById('password').value = ''
                            document.getElementById('confirm-password').value = ''
                            updatePasswordButton.innerHTML = 'আপডেট করুন';
                            updatePasswordButton.disabled = false;
                            alert(res.data.message);
                            window.location.href = '/dashboard';
                        }
                        else {
                            document.getElementById('password').value = ''
                            document.getElementById('confirm-password').value = ''
                            updatePasswordButton.innerHTML = 'আপডেট করুন';
                            updatePasswordButton.disabled = false;
                            alert(res.data.message);
                        }
                    });
            }
        }
    </script>
@endsection