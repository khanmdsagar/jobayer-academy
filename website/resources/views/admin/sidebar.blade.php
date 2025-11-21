<!-- Sidebar -->
<div class="overlay" id="overlay"></div>
<div class="sidebar" id="sidebar">
    <div class="logo">
        <i class="fas fa-graduation-cap"></i>
        <h1>{{$site_data[0]->site_name}}</h1>
    </div>
    <ul class="nav-links">
        <li>
        <div class="a as-app-cursor" onclick="window.location.href='/admin/dashboard'">
            <i class="fas fa-home"></i> <span>Dashboard</span>
        </div>
        </li>

        <li>
        <div class="a as-app-cursor" onclick="window.location.href='/admin/asked-question'">
            <i class="fas fa-question"></i> <span>Asked Question</span>
        </div>
        </li>

        <li>
        <div class="a as-app-cursor" onclick="window.location.href='/admin/category'">
            <i class="fas fa-list"></i> <span>Category</span>
        </div>
        </li>

        <li>
        <div class="a as-app-cursor" onclick="window.location.href='/admin/course'">
            <i class="fas fa-book-open"></i> <span>Course</span>
        </div>
        </li>

        <li>
        <div class="a as-app-cursor" onclick="window.location.href='/admin/student'">
            <i class="fas fa-user-graduate"></i> <span>Student</span>
        </div>
        </li>

        <li>
        <div class="a as-app-cursor" onclick="window.location.href='/admin/comment'">
            <i class="fas fa-comments"></i> <span>Comment</span>
        </div>
        </li>

        <li>
        <div class="a as-app-cursor" onclick="window.location.href='/admin/interest'">
            <i class="fas fa-star"></i> <span>Interest</span>
        </div>
        </li>

        <li>
        <div class="a as-app-cursor" onclick="window.location.href='/download-database'">
            <i class="fas fa-database"></i> <span>Backup DB</span>
        </div>
        </li>

        <li>
        <div class="a as-app-cursor" onclick="adminLogout()">
            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
        </div>
        </li>

    </ul>
</div>