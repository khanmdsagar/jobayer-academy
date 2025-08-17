<div class="as-p-15px">
    <a href="/admin/dashboard">
        <img width="138px" src="/image/icon/{{$site_data[0]->site_logo}}" alt="{{$site_data[0]->site_name}}">
    </a>
</div>

<div style="line-height: 1; font-size: 17px;" class="as-p-10px">
    <div onclick="window.location.href='/admin/dashboard'" class="as-flex as-align-center as-list-hover as-p-10px as-app-cursor as-mb-10px as-brr-5px">
        <ion-icon name="home-outline" class="as-mr-10px"></ion-icon> Dashboard
    </div>
    <div onclick="window.location.href='/admin/category'" class="as-flex as-align-center as-list-hover as-p-10px as-app-cursor as-mb-10px as-brr-5px">
        <ion-icon name="list-outline" class="as-mr-10px"></ion-icon> Category
    </div>
    <div onclick="window.location.href='/admin/course'" class="as-flex as-align-center as-list-hover as-p-10px as-app-cursor as-mb-10px as-brr-5px">
        <ion-icon name="book-outline" class="as-mr-10px"></ion-icon> Course
    </div>
    <div onclick="window.location.href='/admin/student'" class="as-flex as-align-center as-list-hover as-p-10px as-app-cursor as-mb-10px as-brr-5px">
        <ion-icon name="person-outline" class="as-mr-10px"></ion-icon> Student
    </div>
    <div onclick="adminLogout()" class="as-flex as-align-center as-list-hover as-p-10px as-app-cursor as-mb-10px as-brr-5px">
        <ion-icon name="log-out-outline" class="as-mr-10px"></ion-icon> Logout
    </div>
</div>
