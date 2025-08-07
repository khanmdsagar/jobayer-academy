@extends('admin.layout')
@section('title', 'Jobayer Academy - Admin')

@section('content')
@if($is_admin == 1)
<div class="auth-div as-absolute as-absolute-center as-w-400px md:as-w-95" id="admin-login-container">
    <div class="as-card as-p-15px">
        <div class="as-text-center as-mb-20px">
            <h1>👋 স্বাগতম</h1>
            <p>লগইন করতে, আপনার ইউজার নেম ও পাসওয়ার্ড ব্যবহার করে এগিয়ে যান।</p>
        </div>

        <div>
            <div class="as-mb-10px">
                <label for="username" class="as-f-bold">ইউজার নেম</label>
                <input class="as-input" type="text" id="admin-username" placeholder="আপনার ইউজার নেম লিখুন">
            </div>

            <div class="as-mb-10px">
                <label for="password" class="as-f-bold">পাসওয়ার্ড</label>
                <input class="as-input" type="password" id="admin-password" placeholder="আপনার পাসওয়ার্ড লিখুন">
            </div>

            <div class="as-text-right">
                <button id="login-admin-button" onclick="loginAdmin()" class="as-app-cursor as-w-100 as-btn">
                    এগিয়ে যান <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@else
<div class="auth-div as-absolute as-absolute-center as-w-400px md:as-w-95" id="admin-register-container">
    <div class="as-card as-p-15px">
        <div class="as-text-center as-mb-20px">
            <h1>👋 স্বাগতম</h1>
            <p>রেজিস্টার করতে, ইউজার নেম ও পাসওয়ার্ড ব্যবহার করে এগিয়ে যান।</p>
        </div>

        <div>
            <div class="as-mb-10px">
                <label for="admin-username2" class="as-f-bold">ইউজার নেম</label>
                <input class="as-input" type="text" id="admin-username2" placeholder="ইউজার নেম লিখুন">
            </div>

            <div class="as-mb-10px">
                <label for="admin-password2" class="as-f-bold">পাসওয়ার্ড</label>
                <input class="as-input" type="password" id="admin-password2" placeholder="পাসওয়ার্ড লিখুন">
            </div>
            <div class="as-mb-10px">
                <label for="admin-repassword2" class="as-f-bold">পাসওয়ার্ড পুনরায়</label>
                <input class="as-input" type="password" id="admin-repassword2" placeholder="পাসওয়ার্ড পুনরায় লিখুন">
            </div>

            <div class="as-text-right">
                <button id="register-admin-button" onclick="registerAdmin()" class="as-app-cursor as-w-100 as-btn">
                    এগিয়ে যান <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    function loginAdmin() {
        var adminUsername = document.getElementById('admin-username').value;
        var adminPassword = document.getElementById('admin-password').value;
        var loginAdminButton = document.getElementById('login-admin-button');
        
        if(adminUsername == '' || adminPassword == ''){
            alert('ইউজার নেম ও পাসওয়ার্ড দিন');
        }
        else{
            loginAdminButton.disabled = true;
            loginAdminButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            axios.post('/admin/login', {admin_username: adminUsername, admin_password: adminPassword})
            .then(response => {
                if(response.data.status == 'success'){
                    window.location.replace('/admin/dashboard');
                }else{
                    alert(response.data.message);
                }
            })
            .catch(error => {
                loginAdminButton.disabled = false;
                loginAdminButton.innerHTML = 'এগিয়ে যান <i class="fas fa-arrow-right"></i>';
            })
        }
    }

    function registerAdmin(){
        var adminUsername = document.getElementById('admin-username2').value;
        var adminPassword = document.getElementById('admin-password2').value;
        var adminRepassword = document.getElementById('admin-repassword2').value;
        var registerAdminButton = document.getElementById('register-admin-button');

        if(adminUsername == '' || adminPassword == '' || adminRepassword == ''){
            alert('ইউজার নেম ও পাসওয়ার্ড দিন');
        }
        else if(adminPassword != adminRepassword){
            alert('পাসওয়ার্ড মেলেনি');
        }
        else{
            registerAdminButton.disabled = true;
            registerAdminButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            axios.post('/admin/register', {admin_username: adminUsername, admin_password: adminPassword, admin_role: 'admin'})
            .then(response => {
                alert(response.data.message);
                window.location.reload();
            })
            .catch(error => {
                registerAdminButton.disabled = false;
                registerAdminButton.innerHTML = 'এগিয়ে যান <i class="fas fa-arrow-right"></i>';
            })
        }
    }   

    document.addEventListener('keydown', function(event) {
        if (event.key == 'Enter') {
            var auth_divs = document.querySelectorAll('.auth-div');
            
            auth_divs.forEach((div) => {
                if(div.id == 'admin-login-container'){
                    loginAdmin();
                }
                else{
                    registerAdmin();
                }
            });
        }
    });
</script>
@endsection