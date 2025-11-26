@extends('admin.layout')
@section('title', 'Admin - Category')

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
                <h2>Category</h2>
            </div>
            <div class="user-info">
                <div class="user-avatar">AD</div>
                <div>
                    <div style="font-weight: 600;">{{ $admin[0]->admin_username }}</div>
                    <div style="font-size: 12px; color: var(--gray);">{{ $admin[0]->admin_role }}</div>
                </div>
            </div>
        </div>
   </div>

    <!-- Stats Cards -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-layer-group"></i>
            </div>
            <div class="stat-info">
                <h3 id="total-categories">....</h3>
                <p>Total Categories</p>
            </div>
        </div>
    </div>
   
    <!-- Category Table -->
    <div class="content-section">
        <div class="section-header">
            <h3>Category List</h3>
            <div class="actions as-flex as-justify-end">
                <button onclick="showModal('add-category')" class="as-btn as-app-cursor" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                    <i class="fa-solid fa-plus as-app-cursor as-f-20px"></i> Add Category
                </button>
            </div>
        </div>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="category-data-table">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- add category modal -->
<div class="as-modal" id="add-category" style="display: none">
    <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

        <div class="as-modal-child as-p-10px">
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Category name</b></div>
                <input type="text" id="category-name" class="as-input" placeholder="Enter category name">
            </div>
        </div>
        <div class="as-mt-10px as-text-right">
            <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('add-category')">Cancel</button>
            <button id="add-category-btn" class="as-btn as-app-cursor" onclick="addCategory()">Add</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    getCategoryData();

    function addCategory(){
        var categoryName         = document.getElementById('category-name').value;
        var addCategoryBtn       = document.getElementById('add-category-btn');
        addCategoryBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
        addCategoryBtn.disabled  = true;

        if(categoryName == ''){
            alert('Enter Category Name');
        }
        else{
            axios.post('/admin/category/add', {category_name: categoryName})
                .then(function(response){
                    alert(response.data.message);

                    if(response.data.status == 200){
                        getCategoryData();
                        hideModal('add-category');
                        addCategoryBtn.innerHTML = 'Add';
                        addCategoryBtn.disabled = false;
                    }
                    else{
                        hideModal('add-category');
                        addCategoryBtn.innerHTML = 'Add';
                        addCategoryBtn.disabled = false;
                    }
                });
        }
    }

    function getCategoryData(){
        var categoryDataTable = document.getElementById('category-data-table');
        categoryDataTable.innerHTML = '';
        categoryDataTable.innerHTML = `
                    <tr>
                        <td colspan="100%" style="text-align:center; padding:10px;">
                            <i style="font-size:25px;" class="fa-solid fa-spinner fa-spin"></i>
                        </td>
                    </tr>
                `;

        axios.get('/admin/category/data')
            .then(function(response){
                document.getElementById('total-categories').innerText = response.data.length;
                categoryDataTable.innerHTML = '';

                if(response.data.length == 0){
                    categoryDataTable.innerHTML = `<tr>
                                <td colspan="100%" style="text-align:center; padding:10px;">
                                    No category found.
                                </td>
                            </tr>`;
                }

                response.data.forEach(function(category){
                    categoryDataTable.innerHTML += `
                        <tr>
                            <td>${category.category_name}</td>
                            <td>
                                <i onclick="showEditCategoryModal(${category.id}, '${category.category_name}')" class="fa-solid fa-edit as-app-cursor as-p-10px"></i>
                                <i onclick="deleteCategory(${category.id})" class="fa-solid fa-trash as-app-cursor as-p-10px"></i>
                            </td>
                        </tr>
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

    function deleteCategory(category_id){
        var confirm = window.confirm('Do you want to delete category?');

        if(confirm){
            axios.post('/admin/category/delete', {category_id: category_id})
                .then(function(response){
                    alert(response.data.message);
                    getCategoryData();
                });
        }
    }
</script>
@endsection