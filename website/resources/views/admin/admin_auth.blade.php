@extends('admin.layout2')
@section('title', 'Jobayer Academy - Admin')

@section('content')
@if($is_admin == 1)
<div class="auth-div as-absolute as-absolute-center as-w-400px md:as-w-95" id="admin-login-container">
    <div class="as-card as-p-15px">
        <div class="as-text-center as-mb-20px">
            <h1>👋 Welcome</h1>
            <p>To login proceed by username and password</p>
        </div>

        <div>
            <div class="as-mb-10px">
                <label for="username" class="as-f-bold">User name</label>
                <input class="as-input" type="text" id="admin-username" placeholder="Enter User name">
            </div>

            <div class="as-mb-10px">
                <label for="password" class="as-f-bold">Password</label>
                <input class="as-input" type="password" id="admin-password" placeholder="Enter Password">
            </div>

            <div class="as-text-right">
                <button id="login-admin-button" onclick="loginAdmin()" class="as-app-cursor as-w-100 as-btn">
                    Login <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@else
<div class="auth-div as-absolute as-absolute-center as-w-400px md:as-w-95" id="admin-register-container">
    <div class="as-card as-p-15px">
        <div class="as-text-center as-mb-20px">
            <h1>👋 Welcome</h1>
            <p>To register use username and password</p>
        </div>

        <div>
            <div class="as-mb-10px">
                <label for="admin-username2" class="as-f-bold">Username</label>
                <input class="as-input" type="text" id="admin-username2" placeholder="Enter Username">
            </div>

            <div class="as-mb-10px">
                <label for="admin-password2" class="as-f-bold">Password</label>
                <input class="as-input" type="password" id="admin-password2" placeholder="Enter Password">
            </div>
            <div class="as-mb-10px">
                <label for="admin-repassword2" class="as-f-bold">Re-Password</label>
                <input class="as-input" type="password" id="admin-repassword2" placeholder="Retype Password">
            </div>

            <div class="as-text-right">
                <button id="register-admin-button" onclick="registerAdmin()" class="as-app-cursor as-w-100 as-btn">
                    Register <i class="fas fa-arrow-right"></i>
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
        var adminUsername    = document.getElementById('admin-username').value;
        var adminPassword    = document.getElementById('admin-password').value;
        var loginAdminButton = document.getElementById('login-admin-button');
        
        if(adminUsername == '' || adminPassword == ''){
            alert('Enter username and password');
        }
        else{
            loginAdminButton.disabled = true;
            loginAdminButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

            axios.post('/admin/login', {admin_username: adminUsername, admin_password: adminPassword})
            .then(response => {
                if(response.data.status == 'success'){
                    window.location.replace('/admin/dashboard');
                }
                else{
                    alert(response.data.message);
                }
                loginAdminButton.disabled = false;
                loginAdminButton.innerHTML = 'Login <i class="fas fa-arrow-right"></i>';
                
            })
            .catch(error => {
                loginAdminButton.disabled = false;
                loginAdminButton.innerHTML = 'Login <i class="fas fa-arrow-right"></i>';
            })
        }
    }

    function registerAdmin(){
        var adminUsername       = document.getElementById('admin-username2').value;
        var adminPassword       = document.getElementById('admin-password2').value;
        var adminRepassword     = document.getElementById('admin-repassword2').value;
        var registerAdminButton = document.getElementById('register-admin-button');

        if(adminUsername == '' || adminPassword == '' || adminRepassword == ''){
            alert('Fill all the fields');
        }
        else if(adminPassword != adminRepassword){
            alert('Passwords do not match');
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
                registerAdminButton.innerHTML = 'Register <i class="fas fa-arrow-right"></i>';
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