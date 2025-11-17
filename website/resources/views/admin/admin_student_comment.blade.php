@extends('admin.layout')
@section('title', 'Admin - Student Comment Option')

@section('content')
<div class="as-flex">
    <!-- sidebar -->
    <div id="admin-sidebar" class="as-w-200px as-bg-white as-h-100vh">
        @include('admin.sidebar')
    </div>
</div>

<div class="as-w-100" style="overflow-y: auto; height: 100vh;">
    <!-- navbar -->
   <div class="as-p-10px">
        <div>
            <i onclick="toggleAdminSidebar()" class="fas fa-bars as-app-cursor as-f-20px as-mr-10px"></i>
            <span class="as-f-bold as-f-20px">Student Comment Option- <span id="student-comment-option-count"></span></span>
        </div>

        <div class="actions as-flex as-justify-end">
            <button class="as-btn as-app-cursor">
                <i onclick="showModal('add-student-comment-option')" class="fa-solid fa-plus as-app-cursor as-f-20px"></i>
            </button>
        </div>
   </div>

    <!-- admin comment Option on student list -->
    <div id="student-comment-option-data" class="as-p-10px">
        <i style="font-size: 25px;" class="fa-solid fa-spinner fa-spin as-w-100 as-text-center"></i>
    </div>
   
</div>

<!-- add student comment Option modal -->
<div class="as-modal" id="add-student-comment-option" style="display: none">
    <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

        <div class="as-modal-child as-p-10px">
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Student Comment Option Title</b></div>
                <input type="text" id="student-comment-option-title" class="as-input" placeholder="Enter Student Comment Option Title">
            </div>
        </div>
        <div class="as-mt-10px as-text-right">
            <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('add-student-comment-option')">Cancel</button>
            <button id="add-student-comment-option-btn" class="as-btn as-app-cursor" onclick="addStudentCommentOption()">Add</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    getStudentCommentOptionData();

    function addStudentCommentOption(){
        var studentCommentOptionTitle = document.getElementById('student-comment-option-title').value;
        var addStudentommentOptionBtn = document.getElementById('add-student-comment-option-btn')

        if(studentCommentOptionTitle == ''){
            alert('Enter Student Comment Option Title');
        }
        else{
            addStudentommentOptionBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
            addStudentommentOptionBtn.disabled  = true;

            axios.post('/admin/student-comment-option/add', {student_comment_option_title: studentCommentOptionTitle})
                .then(function(response){
                    alert(response.data.message);

                    if(response.data.status == 200){
                        getStudentCommentOptionData();
                        hideModal('add-student-comment-option');
                        addStudentommentOptionBtn.innerHTML = 'Add';
                        addStudentommentOptionBtn.disabled = false;
                    }
                    else{
                        hideModal('add-student-comment-option');
                        addStudentommentOptionBtn.innerHTML = 'Add';
                        addStudentommentOptionBtn.disabled = false;
                    }
                });
        }
    }

    function getStudentCommentOptionData(){
        var studentCommentOptionData = document.getElementById('student-comment-option-data');
        studentCommentOptionData.innerHTML = '';

        axios.get('/admin/student-comment-option/data')
            .then(function(response){
                document.getElementById('student-comment-option-count').innerText = response.data.length;
                studentCommentOptionData.innerHTML = '';

                if(response.data.length == 0){
                    studentCommentOptionData.innerHTML = '<div class="as-text-center as-f-20px">No Comment Option</div>';
                }

                response.data.forEach(function(item){
                    studentCommentOptionData.innerHTML += `
                        <div class="as-card as-mb-10px as-flex as-space-between as-p-10px">
                            <div class="as-flex as-align-center as-check-language as-f-18px">${item.student_comment_option_title}</div>
                            <div>
                                <span><i onclick="showEditStudentCommentOptionModal('${item.id}', '${item.student_comment_option_title}')" class="fa-solid fa-edit as-app-cursor as-p-10px"></i></span>
                                <span><i onclick="deleteStudentCommentOption(${item.id})" class="fa-solid fa-trash as-app-cursor as-p-10px"></i></span>
                            </div>
                        </div>
                    `;
                })
                   
            });
    }

    function showEditCategoryModal(categoryId, categoryName){
        var body = document.getElementsByTagName('body');
        body[0].innerHTML += `<div class="as-modal" id="edit-category" style="display: none">
            <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

                <div class="as-modal-child as-p-10px">
                    <div class="as-mt-10px">
                        <div class="as-mb-5px"><b>Category name</b></div>
                        <input type="text" id="edited-category-name" class="as-input" value="${categoryName}">
                    </div>
                </div>
                <div class="as-mt-10px as-text-right">
                    <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('edit-category')">Cancel</button>
                    <button class="as-btn as-app-cursor" onclick="editCategory(${categoryId})">Edit</button>
                </div>
            </div>
        </div>`

        showModal('edit-category');
    }

    function editCategory(categoryId){
        var editedCategoryName = document.getElementById('edited-category-name').value;

        if(editedCategoryName == ''){
            alert('Enter category name');
        }
        else{
            axios.post('/admin/category/edit', {category_id: categoryId, category_name: editedCategoryName})
                .then(function(response){
                    alert(response.data.message);

                    if(response.data.status == 200){
                        location.reload();
                    }
                    else{
                        hideModal('edit-category');
                    }
                });
        }
    }

    function deleteStudentCommentOption(id){
        var confirm = window.confirm('Do you want to delete Student Comment Option?');

        if(confirm){
            axios.post('/admin/student-comment-option/delete', {id: id})
                .then(function(response){
                    alert(response.data.message);
                    getStudentCommentOptionData();
                });
        }
    }
</script>
@endsection