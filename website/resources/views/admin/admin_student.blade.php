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
                    <h2>Student Dashboard</h2>
                </div>
                <div class="user-info">
                    <div class="user-avatar">AD</div>
                    <div>
                        <div style="font-weight: 600;">{{ $admin[0]->admin_username }}</div>
                        <div style="font-size: 12px; color: var(--gray);">{{ $admin[0]->admin_role }}</div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3 id="total-students">....</h3>
                        <p>Total Students</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon success">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="stat-info">
                        <h3 id="total-enrolled-students">....</h3>
                        <p>Total Enrolled Students</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon warning">
                        <i class="fas fa-user-minus"></i>
                    </div>
                    <div class="stat-info">
                        <h3 id="total-unenrolled-students">....</h3>
                        <p>Total Unenrolled Students</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-info">
                        <h3 id="total-payments">....</h3>
                        <p>Total Payments</p>
                    </div>
                </div>
            </div>

            <div class="as-flex as-space-between as-mb-10px">
                <div class="as-flex">
                    <input type="text" id="search-value" class="as-input as-mr-10px" placeholder="Enter name or phone">
                    <button onclick="getStudentData()" id="search-student-button" class="as-btn as-btn-primary as-app-cursor as-mr-5px"><i class="fas fa-search"></i></button>
                    <button onclick="getStudentData()" class="as-btn as-btn-primary as-app-cursor as-mr-5px"><i class="fas fa-refresh"></i></button>
                </div>
            </div>
        </div>

        <!-- student list -->
        <div class="content-section">
            <div class="section-header">
                <h3>Student List</h3>
                <div class="section-actions as-flex">
                    <div id="filter-student-button" class="as-p-10px as-app-cursor" onclick="showModal('student-filter')">
                        <i class="fas fa-filter"></i> Filter
                    </div>
                    <a id="download-student-button" class="as-p-10px as-app-cursor as-mr-10px" href="/admin/download-student-data">
                        <i class="fas fa-download"></i> Download
                    </a>
                    <div id="add-student-button" onclick="showModal('student-info')" class="as-btn as-p-10px as-app-cursor">
                        <i class="fas fa-plus" style="margin-right: 5px;"></i> Add Student
                    </div>
                </div>
            </div>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Registration Date</th>
                            <th>Enrolled Courses</th>
                            <th>Paid Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="student-list">
                        
                    </tbody>
                </table>
            </div>
            
            <div class="pagination">
                <div class="pagination-info" id="paginationInfo">
                    Showing 0 to 0 of 0 entries
                </div>
                <div class="pagination-controls" id="paginationControls">
                    <!-- Pagination buttons will be generated by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- filter modal -->
    <div class="as-modal" id="student-filter" style="display: none">
        <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

            <div class="as-text-center as-w-100">
                <h2>Filter</h2>
            </div>

            <div class="as-modal-child">
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Filter Options</b></div>
                    <select id="filter-option" class="as-select" onchange="showOrHideFilterOptionDiv()">
                        <option hidden value="" disabled selected>Seelect Filter Option</option>
                        <option value="enrolled">Enrolled</option>
                        <option value="unenrolled">Unenrolled</option>
                        <optgroup id="course-div"></optgroup>
                        <optgroup id="comment-div"></optgroup>
                        <optgroup id="interest-div"></optgroup>
                    </select>
                    <div id="filter-option-div" style="display: none">
                        <input type="date" class="as-date-input as-mt-10px" id="filter-date-start" value="">
                        <input type="date" class="as-date-input as-mt-10px" id="filter-date-end" value="">
                        <button onclick="resetFilter()" style="background: none; border: none; margin-left: 10px"><i class="fa fa-undo"></i></button>
                    </div>
                </div>

            </div>
            <div class="as-mt-20px as-text-right">
                <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('student-filter')">Cancel</button>
                <button id="filter-button" class="as-btn as-app-cursor" onclick="filterStudent()">Filter</button>
            </div>
        </div>
    </div>

    <!-- add student info modal -->
    <div class="as-modal" id="student-info" style="display: none">
        <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

            <div class="as-text-center as-w-100">
                <h2>Student Form</h2>
            </div>

            <div class="as-modal-child as-p-10px">
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Fullname</b></div>
                    <input id="fullname" class="as-input" type="text" placeholder="Enter fullname">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Email</b></div>
                    <input id="email" class="as-input" type="email" placeholder="Enter email">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Phone number</b></div>
                    <input id="number" class="as-input" type="number" placeholder="Enter phone number">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Date of Birth</b></div>
                    <div class="as-flex">
                        <select id="daySelect" class="as-select as-mr-10px">
                            <option hidden value="" disabled selected>Day</option>
                        </select>
                        <select id="monthSelect" class="as-select as-mr-10px">
                            <option hidden value="" disabled selected>Month</option>
                        </select>
                        <select id="yearSelect" class="as-select">
                            <option hidden value="" disabled selected>Year</option>
                        </select>
                    </div>
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Profession</b></div>
                    <select id="profession" class="as-select">
                        <option hidden value="" disabled selected>Select professioin</option>
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
                    <input id="fb-profile-url" class="as-input" type="text" placeholder="Enter fb profile url">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Fb page url</b></div>
                    <input id="fb-page-url" class="as-input" type="text" placeholder="Enter fb page url">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Address</b></div>
                    <input id="address" class="as-input" type="text" placeholder="Enter address">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Note</b></div>
                    <input id="note" class="as-input" type="text" placeholder="Enter note">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Division</b></div>
                    <select id="division" class="as-select">
                        <option hidden value="" disabled selected>Select a division</option>
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
                        <option hidden value="" disabled selected>Select District</option>
                        <optgroup id="district-div"></optgroup>
                    </select>
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Paid Amount</b></div>
                    <input id="paid-amount" class="as-input" type="text" placeholder="Enter paid amount">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Comment</b></div>
                    <select id="comment-option" class="as-select">
                        <option hidden value="" disabled selected>Select a Comment option</option>
                    </select>
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Interest</b></div>
                    <select id="interest-option" class="as-select">
                        <option hidden value="" disabled selected>Select a Interest option</option>
                    </select>
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Password</b></div>
                    <input id="password" class="as-input" type="text" placeholder="Enter password">
                </div>
            </div>
            <div class="as-mt-20px as-text-right">
                <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('student-info')">Cancel</button>
                <button id="add-info-button" class="as-btn as-app-cursor" onclick="addStudentInfo()">Add</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function resetFilter() {
        document.getElementById('filter-date-start').value = '';
        document.getElementById('filter-date-end').value = '';
    }

    getCourseData();
    getCommentOptionData();
    getInterestOptionData();

    function getCommentOptionData(){
        var commentOptionData = document.getElementById('comment-option');

        axios.get('/admin/comment-option/data')
            .then(function(response){
                document.getElementById('comment-div').innerHTML  = response.data.map(item => `<option value="${item.comment_option_title}">${item.comment_option_title}</option>`).join('');

                response.data.forEach(function(item){
                    commentOptionData.innerHTML += `
                        <option value="${item.comment_option_title}">${item.comment_option_title}</option>
                    `;
                })
                
            });
    }

    function getInterestOptionData(){
        var interestOptionData = document.getElementById('interest-option');

        axios.get('/admin/interest-option/data')
            .then(function(response){
                
                document.getElementById('interest-div').innerHTML = response.data.map(item => `<option value="${item.interest_option_title}">${item.interest_option_title}</option>`).join('');

                response.data.forEach(function(item){
                    interestOptionData.innerHTML += `
                        <option value="${item.interest_option_title}">${item.interest_option_title}</option>
                    `;
                })
                
            });
    }

    function getCourseData() {
        axios.get('/admin/course/data').then(response => {
            var courseDiv = document.getElementById('course-div');
            courseDiv.innerHTML = response.data.map(course => `<option value="${course.course_name}">${course.course_name}</option>`).join('');
        });
    }
    
    // Pagination variables
    var studentData = [];
    let currentPage = 1;
    const itemsPerPage = 10;
    let filteredData = [];
    var filterValue = 0;

    async function getStudentData() {
        var searchStudent = document.getElementById('search-value').value;
        const studentList = document.getElementById('student-list');

        studentList.innerHTML = `
                <tr>
                    <td colspan="100%" style="text-align:center; padding:10px;">
                        <i style="font-size:25px;" class="fa-solid fa-spinner fa-spin"></i>
                    </td>
                </tr>
            `;

        if (searchStudent == '') {
            await axios.get('/admin/student/data').then(response => {
                filterValue = 0;

                studentData = response.data.student_data;

                document.getElementById('total-students').innerText = response.data.student_data.length;
                document.getElementById('total-enrolled-students').innerText = response.data.enrolled_students;
                document.getElementById('total-unenrolled-students').innerText = response.data.unenrolled_students;
                document.getElementById('total-payments').innerText = response.data.total_payments;
                
                filteredData = [...studentData];
                initializePagination();
            });
        }
        else {
            await axios.get('/admin/student/search/' + searchStudent)
                .then(response => {
                    filterValue = 0;

                    document.getElementById('search-value').value = '';
                    document.getElementById('total-students').innerText = response.data.length;

                    studentData = response.data;
                    filteredData = [...studentData];
                    initializePagination();

                    console.log(searchStudent);
                });
        }
    }

    function showOrHideFilterOptionDiv() {  
        var filterOption = document.getElementById('filter-option').value;

        axios.get('/admin/is-course/' + filterOption).then(res => {
            console.log(res.data);
            if(res.data == 1){
                document.getElementById('filter-option-div').style.display = 'block';
            }
            else{
                document.getElementById('filter-option-div').style.display = 'none';
            }
        });
    }

    async function filterStudent() {
        var filterOption    = document.getElementById('filter-option').value;
        var filterDateStart = document.getElementById('filter-date-start').value;
        var filterDateEnd   = document.getElementById('filter-date-end').value;

        if (filterOption == '') {
            alert('Select a Filter option');
        }
        else {            
            var filterButton       = document.getElementById('filter-button');
            filterButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            filterButton.disabled  = true;

            const studentList = document.getElementById('student-list');

            await axios.get('/admin/filter-student/' + filterOption + '/' + filterDateStart + '/' + filterDateEnd)
                .then(response => {
                    filterButton.innerHTML = 'Filter';
                    filterButton.disabled = false;

                    document.getElementById('total-students').innerText = response.data.length;

                    if (filterOption == 'enrolled' || filterOption == 'unenrolled') {
                        filterValue = 0;
                        hideModal('student-filter');

                        if (filterOption == 'unenrolled') {
                            document.getElementById('download-student-button').href = '/admin/download-unenrolled-student-data';
                        }
                        else {
                            document.getElementById('download-student-button').href = '/admin/download-enrolled-student-data';
                        }

                        studentData = response.data;
                        filteredData = [...studentData];
                        initializePagination();
                    }
                    else if(filterDateStart != '' && filterDateEnd != ''){
                        filterValue = 0;
                        hideModal('student-filter');
                        //document.getElementById('download-student-button').href = '/admin/download-course-student-data/' + filterOption;
                        document.getElementById('download-student-button').style.display = 'none';

                        studentData = response.data;
                        filteredData = [...studentData];
                        initializePagination();
                    }
                    else {
                        // finding whether the filter option is course or not (comment or interest)
                        axios.get('/admin/is-course/' + filterOption).then(res => {
                            if(res.data == 1){
                                filterValue = 1;
                                hideModal('student-filter');
                                //document.getElementById('download-student-button').href = '/admin/download-course-student-data/' + filterOption;
                                studentData = response.data;
                                filteredData = [...studentData];
                                initializePagination();
                            }
                            else{
                                filterValue = 0;
                                hideModal('student-filter');
                                //document.getElementById('download-student-button').href = '/admin/download-course-student-data/' + filterOption;
                                studentData = response.data;
                                filteredData = [...studentData];
                                initializePagination();
                            }
                        });
                    }
                });
        }
    }

    // Function to render the table with current page data
    function renderTable() {
        // Calculate start and end indices for current page
        const startIndex   = (currentPage - 1) * itemsPerPage;
        const endIndex     = Math.min(startIndex + itemsPerPage, filteredData.length);
        const currentItems = filteredData.slice(startIndex, endIndex);
        
        // Clear the table body
        const tableBody     = document.getElementById('student-list');
        tableBody.innerHTML = '';
        
        // Populate the table with current page data
        if(filterValue == 0) {
            currentItems.forEach(item => {
                const row = document.createElement('tr');
                // Add your row content here based on your data structure
                row.innerHTML = `
                    <tr>
                        <td style="white-space: nowrap;">${item.student_name != null ? item.student_name : 'Anonymous'}</td>
                        <td>${item.student_number}</td>
                        <td>${item.created_at}</td>
                        <td>${item.student_enrolled_course}</td>
                        <td>${item.student_paid_amount != null ? item.student_paid_amount : '0'}</td>
                        <td><span class="status-badge ${item.student_enrolled_course == 0 ? 'not-enrolled' : 'enrolled'}">${item.student_enrolled_course == 0 ? 'UnEnrolled' : 'Enrolled'}</span></td>
                        <td>
                            <i onclick="window.location.href='/admin/student/info/${item.id}'" class="fa-solid fa-eye as-app-cursor"></i>
                        </td>
                    </tr>
                `;
                tableBody.appendChild(row);
            });
        }
        else{
            currentItems.forEach(item => {
                const row = document.createElement('tr');
                // Add your row content here based on your data structure
                row.innerHTML = `
                    <tr>
                        <td style="white-space: nowrap;">${item.student.student_name != null ? item.student.student_name : 'Anonymous'}</td>
                        <td>${item.student.student_number}</td>
                        <td>${item.student.created_at}</td>
                        <td>${item.student.student_enrolled_course}</td>
                        <td>${item.student_paid_amount != null ? item.student_paid_amount : '0'}</td>
                        <td><span class="status-badge ${item.student.student_enrolled_course == 0 ? 'not-enrolled' : 'enrolled'}">${item.student.student_enrolled_course == 0 ? 'UnEnrolled' : 'Enrolled'}</span></td>
                        <td>
                            <i onclick="window.location.href='/admin/student/info/${item.student.id}'" class="fa-solid fa-eye as-app-cursor"></i>
                        </td>
                    </tr>
                `;
                tableBody.appendChild(row);
            });
        }
        
        // Update pagination info
        const paginationInfo = document.getElementById('paginationInfo');
        const start = filteredData.length > 0 ? startIndex + 1 : 0;
        const end = endIndex;
        paginationInfo.textContent = `Showing ${start} to ${end} of ${filteredData.length} entries`;
    }

    // Function to setup pagination controls
    function setupPagination() {
        const paginationControls = document.getElementById('paginationControls');

        // Clear existing pagination controls
        paginationControls.innerHTML = '';

        const totalPages = Math.ceil(filteredData.length / itemsPerPage);

        // Previous button
        const prevButton = document.createElement('button');
        prevButton.innerHTML = '<i class="fas fa-chevron-left"></i>';
        prevButton.disabled = currentPage === 1;
        prevButton.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
                setupPagination();
            }
        });
        paginationControls.appendChild(prevButton);

        // Page buttons
        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

        // Adjust start page if we're near the end
        if (endPage - startPage + 1 < maxVisiblePages) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }

        // First page button if needed
        if (startPage > 1) {
            const firstPageButton = document.createElement('button');
            firstPageButton.textContent = '1';
            firstPageButton.addEventListener('click', () => {
                currentPage = 1;
                renderTable();
                setupPagination();
            });
            paginationControls.appendChild(firstPageButton);

            // Ellipsis if needed
            if (startPage > 2) {
                const ellipsis = document.createElement('button');
                ellipsis.textContent = '...';
                ellipsis.disabled = true;
                paginationControls.appendChild(ellipsis);
            }
        }

        // Page number buttons
        for (let i = startPage; i <= endPage; i++) {
            const pageButton = document.createElement('button');
            pageButton.textContent = i;
            if (i === currentPage) {
                pageButton.classList.add('active');
            }
            pageButton.addEventListener('click', () => {
                currentPage = i;
                renderTable();
                setupPagination();
            });
            paginationControls.appendChild(pageButton);
        }

        // Last page button if needed
        if (endPage < totalPages) {
            // Ellipsis if needed
            if (endPage < totalPages - 1) {
                const ellipsis = document.createElement('button');
                ellipsis.textContent = '...';
                ellipsis.disabled = true;
                paginationControls.appendChild(ellipsis);
            }

            const lastPageButton = document.createElement('button');
            lastPageButton.textContent = totalPages;
            lastPageButton.addEventListener('click', () => {
                currentPage = totalPages;
                renderTable();
                setupPagination();
            });
            paginationControls.appendChild(lastPageButton);
        }

        // Next button
        const nextButton = document.createElement('button');
        nextButton.innerHTML = '<i class="fas fa-chevron-right"></i>';
        nextButton.disabled = currentPage === totalPages;
        nextButton.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
                setupPagination();
            }
        });
        paginationControls.appendChild(nextButton);
    }

    // Function to reset pagination (call this when filters change)
    function resetPagination() {
        currentPage = 1;
        renderTable();
        setupPagination();
    }

    // Function to update data and refresh pagination
    function updateData(newData) {
        filteredData = [...newData];
        resetPagination();
    }

    function initializePagination() {
        renderTable();
        setupPagination();
    }

    // Initialize pagination on page load
    document.addEventListener('DOMContentLoaded', function() {
        getStudentData();
    });

    // Populate day, month, year selects
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

    function addStudentInfo() {
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
        var studentInterest     = document.getElementById('interest-option').value;
        var studentComment      = document.getElementById('comment-option').value;
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
        else if (studentPaidAmount == "") {
            alert('Enter paid amount');
        }
        else if (studentPassword == "") {
            alert('Enter a password');
        }
        else if (studentPassword.length < 6) {
            alert('Password must be at least 6 characters long');
        }
        else {
            var data = {
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
                student_interest    : studentInterest,
                student_comment     : studentComment
            }

            var addInfoButton = document.getElementById('add-info-button');
            addInfoButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            addInfoButton.disabled = true;

            axios.post('/admin/student/add', data)
                .then(res => {
                    if (res.data.status == 200) {
                        addInfoButton.innerHTML = 'Add';
                        addInfoButton.disabled = false;

                        alert(res.data.message);
                        hideModal('student-info');

                        getStudentData();
                        
                        document.getElementById('fullname').value        = '';
                        document.getElementById('email').value           = '';
                        document.getElementById('number').value          = '';
                        document.getElementById('profession').value      = '';
                        document.getElementById('fb-profile-url').value  = '';
                        document.getElementById('fb-page-url').value     = '';
                        document.getElementById('daySelect').value       = '';
                        document.getElementById('monthSelect').value     = '';
                        document.getElementById('yearSelect').value      = '';
                        document.getElementById('address').value         = '';
                        document.getElementById('division').value        = '';
                        document.getElementById('district').value        = '';
                        document.getElementById('note').value            = '';
                        document.getElementById('interest-option').value = '';
                        document.getElementById('comment-option').value  = '';
                        document.getElementById('paid-amount').value     = '';
                        document.getElementById('password').value        = '';
                    }
                    else {
                        addInfoButton.innerHTML = 'Add';
                        addInfoButton.disabled = false;

                        alert(res.data.message);
                        hideModal('student-info');

                        getStudentData();

                        document.getElementById('fullname').value        = '';
                        document.getElementById('email').value           = '';
                        document.getElementById('number').value          = '';
                        document.getElementById('profession').value      = '';
                        document.getElementById('fb-profile-url').value  = '';
                        document.getElementById('fb-page-url').value     = '';
                        document.getElementById('daySelect').value       = '';
                        document.getElementById('monthSelect').value     = '';
                        document.getElementById('yearSelect').value      = '';
                        document.getElementById('address').value         = '';
                        document.getElementById('division').value        = '';
                        document.getElementById('district').value        = '';
                        document.getElementById('note').value            = '';
                        document.getElementById('interest-option').value = '';
                        document.getElementById('comment-option').value  = '';
                        document.getElementById('paid-amount').value     = '';
                        document.getElementById('password').value        = '';  
                    }
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