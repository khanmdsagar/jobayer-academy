@extends('admin.layout')
@section('title', 'Admin - Student Comment Option')

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
                <h2>Comment Option</h2>
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
                    <i class="fas fa-comments"></i>
                </div>
                <div class="stat-info">
                    <h3 id="total-comment-options">....</h3>
                    <p>Total Comment Options</p>
                </div>
            </div>
        </div>

   </div>

   <!-- Comment option Table -->
    <div class="content-section">
        <div class="section-header">
            <h3>Comment Options List</h3>
            <div class="actions as-flex as-justify-end">
                <button onclick="showModal('add-comment-option')" class="as-btn as-app-cursor" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                    <i class="fa-solid fa-plus as-app-cursor as-f-20px"></i> Add Comment Option
                </button>
            </div>
        </div>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Comment Option Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="comment-option-data-table">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- add student comment Option modal -->
<div class="as-modal" id="add-comment-option" style="display: none">
    <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

        <div class="as-modal-child as-p-10px">
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Comment Option Title</b></div>
                <input type="text" id="comment-option-title" class="as-input" placeholder="Enter Comment Option Title">
            </div>
        </div>
        <div class="as-mt-10px as-text-right">
            <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('add-comment-option')">Cancel</button>
            <button id="add-comment-option-btn" class="as-btn as-app-cursor" onclick="addCommentOption()">Add</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    getCommentOptionData();

    function addCommentOption(){
        var commentOptionTitle  = document.getElementById('comment-option-title').value;
        var addCommentOptionBtn = document.getElementById('add-comment-option-btn');

        if(commentOptionTitle == ''){
            alert('Enter Comment Option Title');
        }
        else{
            addCommentOptionBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
            addCommentOptionBtn.disabled  = true;

            axios.post('/admin/comment-option/add', {comment_option_title: commentOptionTitle})
                .then(function(response){
                    alert(response.data.message);

                    if(response.data.status == 200){
                        getCommentOptionData();
                        hideModal('add-comment-option');
                        addCommentOptionBtn.innerHTML = 'Add';
                        addCommentOptionBtn.disabled = false;
                    }
                    else{
                        hideModal('add-comment-option');
                        addCommentOptionBtn.innerHTML = 'Add';
                        addCommentOptionBtn.disabled = false;
                    }
                })
        }
    }

    function getCommentOptionData(){
        var commentOptionData = document.getElementById('comment-option-data-table');
        commentOptionData.innerHTML = `
                    <tr>
                        <td colspan="100%" style="text-align:center; padding:10px;">
                            <i style="font-size:25px;" class="fa-solid fa-spinner fa-spin"></i>
                        </td>
                    </tr>
                `;

        axios.get('/admin/comment-option/data')
            .then(function(response){
                document.getElementById('total-comment-options').innerText = response.data.length;
                commentOptionData.innerHTML = '';

                if(response.data.length == 0){
                    commentOptionData.innerHTML = `<tr>
                                <td colspan="100%" style="text-align:center; padding:10px;">
                                    No comment option found.
                                </td>
                            </tr>`;
                }

                response.data.forEach(function(item){
                    commentOptionData.innerHTML += `
                    <tr>
                        <td>${item.comment_option_title}</td>
                        <td>
                            <i onclick="showEditCommentOptionModal(${item.id}, '${item.comment_option_title}')" class="fa-solid fa-edit as-app-cursor as-p-10px"></i>
                            <i onclick="deleteCommentOption(${item.id})" class="fa-solid fa-trash as-app-cursor as-p-10px"></i>
                        </td>
                    </tr>
                    `;
                })
                   
            });
    }

    function showEditCommentOptionModal(commentOptionId, commentOptionTitle){
        var body = document.getElementsByTagName('body');
        body[0].innerHTML += `<div class="as-modal" id="edit-comment-option-modal" style="display: none">
            <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

                <div class="as-modal-child as-p-10px">
                    <div class="as-mt-10px">
                        <div class="as-mb-5px"><b>Comment Option Title</b></div>
                        <input type="text" id="edited-comment-option-title" class="as-input" value="${commentOptionTitle}">
                    </div>
                </div>
                <div class="as-mt-10px as-text-right">
                    <button class="as-btn as-app-cursor as-bg-cancel" onclick="removeModal('edit-comment-option-modal')">Cancel</button>
                    <button id="edit-comment-option-btn" class="as-btn as-app-cursor" onclick="editCommentOption(${commentOptionId}, '${commentOptionTitle}')">Edit</button>
                </div>
            </div>
        </div>`

        showModal('edit-comment-option-modal');
    }

    function editCommentOption(commentOptionId, commentOptionTitle){
        var editedCommentOptionTitle= document.getElementById('edited-comment-option-title').value;
        var editCommentOptionBtn = document.getElementById('edit-comment-option-btn');

        editCommentOptionBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
        editCommentOptionBtn.disabled  = true;

        if(editedCommentOptionTitle == ''){
            alert('Enter Comment Option Title');
        }
        else{
            axios.post('/admin/comment-option/edit', {comment_option_id: commentOptionId, comment_option_title: editedCommentOptionTitle})
                .then(function(response){
                    alert(response.data.message);

                    if(response.data.status == 200){
                        getCommentOptionData();
                        removeModal('edit-comment-option-modal');
                        editCommentOptionBtn.innerHTML = 'Edit';
                        editCommentOptionBtn.disabled = false;
                    }
                    else{
                        removeModal('edit-comment-option-modal');
                        editCommentOptionBtn.innerHTML = 'Edit';
                        editCommentOptionBtn.disabled = false;
                    }
                });
        }
    }

    function deleteCommentOption(commentOptionId){
        var confirm = window.confirm('Do you want to delete Comment Option?');

        if(confirm){
            axios.post('/admin/comment-option/delete', {comment_option_id: commentOptionId})
                .then(function(response){
                    alert(response.data.message);
                    getCommentOptionData();
                });
        }
    }
</script>
@endsection