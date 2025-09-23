<div class="as-p-15px">
    <a href="/admin/dashboard">
        <img width="138px" src="/image/icon/{{$site_data[0]->site_logo}}" alt="{{$site_data[0]->site_name}}">
    </a>
</div>

<div style="line-height: 1; font-size: 17px;" class="as-p-10px">
    <div onclick="window.location.href='/admin/dashboard'" class="as-flex as-align-center as-list-hover as-p-10px as-app-cursor as-brr-5px">
        <svg width="22px" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M80 212v236a16 16 0 0016 16h96V328a24 24 0 0124-24h80a24 24 0 0124 24v136h96a16 16 0 0016-16V212" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M480 256L266.89 52c-5-5.28-16.69-5.34-21.78 0L32 256M400 179V64h-48v69" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg> <div class="as-ml-10px">Dashboard</div>
    </div>
    <div onclick="window.location.href='/admin/category'" class="as-flex as-align-center as-list-hover as-p-10px as-app-cursor as-brr-5px">
        <svg width="22px" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M160 144h288M160 256h288M160 368h288"/><circle cx="80" cy="144" r="16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><circle cx="80" cy="256" r="16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><circle cx="80" cy="368" r="16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg> <div class="as-ml-10px">Category</div>
    </div>
    <div onclick="window.location.href='/admin/course'" class="as-flex as-align-center as-list-hover as-p-10px as-app-cursor as-brr-5px">
        <svg width="22px" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M256 160c16-63.16 76.43-95.41 208-96a15.94 15.94 0 0116 16v288a16 16 0 01-16 16c-128 0-177.45 25.81-208 64-30.37-38-80-64-208-64-9.88 0-16-8.05-16-17.93V80a15.94 15.94 0 0116-16c131.57.59 192 32.84 208 96zM256 160v288" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg> <div class="as-ml-10px">Course</div>
    </div>
    <div onclick="window.location.href='/admin/student'" class="as-flex as-align-center as-list-hover as-p-10px as-app-cursor as-brr-5px">
        <svg width="22px" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg> <div class="as-ml-10px">Student</div>
    </div>
    <div onclick="adminLogout()" class="as-flex as-align-center as-list-hover as-p-10px as-app-cursor as-brr-5px">
        <svg width="22px" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M304 336v40a40 40 0 01-40 40H104a40 40 0 01-40-40V136a40 40 0 0140-40h152c22.09 0 48 17.91 48 40v40M368 336l80-80-80-80M176 256h256" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg> <div class="as-ml-10px">Logout</div>
    </div>
</div>
