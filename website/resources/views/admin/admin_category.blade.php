@extends('admin.layout')
@section('title', 'Admin - student')

@section('content')
<div class="as-flex">
    <!-- sidebar -->
    <div id="admin-sidebar" class="as-w-250px as-bg-black as-h-100vh">
        @include('admin.sidebar')
    </div>
</div>

<div class="as-w-100">
    <!-- navbar -->
   <div style="height: 15vh;" class="as-p-10px">
        <div>
            <i onclick="toggleAdminSidebar()" class="fas fa-bars as-app-cursor as-f-20px as-mr-10px"></i>
            <span class="as-f-bold as-f-20px">ক্যাটাগরি</span>
        </div>
        <div class="actions as-flex as-justify-end">
            <button class="as-btn as-app-cursor"><i onclick="showModal('add-category')" class="fa-solid fa-plus as-app-cursor as-f-20px"></i></button>
        </div>
   </div> 
    
   
</div>

<!-- enroll modal -->
<div class="as-modal" id="add-category" style="display: none">
    <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

        <div class="as-modal-child as-p-10px">
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>ক্যাটাগরির নাম</b></div>
                <input type="text" id="category-name" class="as-input" placeholder="ক্যাটাগরির নাম দিন">
            </div>
        </div>
        <div class="as-mt-10px as-text-right">
            <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('add-category')">বাতিল করুন</button>
            <button class="as-btn as-app-cursor" onclick="addCategory()">যুক্ত করুন</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    getCategoryData();

    function addCategory(){
        var categoryName = document.getElementById('category-name').value;

        if(categoryName == ''){
            alert('ক্যাটাগরির নাম দিন');
        }
        else{
            axios.post('/admin/category/add', {category_name: categoryName})
                .then(function(response){
                    alert(response.data.message);

                    if(response.data.status == 200){
                        location.reload();
                    }
                    else{
                        hideModal('add-category');
                    }
                });
        }
    }

    function getCategoryData(){
        axios.get('/admin/category/data')
            .then(function(response){
                console.log(response.data);
            });
    }

    function editCategory(category_id){
        
    }

    function deleteCategory(category_id){
        var confirm = window.confirm('ক্যাটাগরি মুছে ফেলবেন কি?');

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