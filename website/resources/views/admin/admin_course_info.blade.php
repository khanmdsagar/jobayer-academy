@extends('admin.layout')
@section('title', 'Admin - Course Info')

@section('content')
    <div class="as-flex">
        <!--sidebar-->
        <div id="admin-sidebar" class="as-w-200px as-bg-white as-h-100vh">
            @include('admin.sidebar')
        </div>
    </div>

    <div class="as-w-100">
        <!-- navbar -->
        <div style="height: 7vh;" class="as-p-10px">
            <div>
                <i onclick="toggleAdminSidebar()" class="fas fa-bars as-app-cursor as-f-20px as-mr-10px"></i>
                <span class="as-f-bold as-f-20px">Course Information</span>
            </div>
        </div>

        <!--list-->
        <div style="height: 93vh; overflow-y: auto;" id="" class="as-p-10px">
            <div class="as-card as-p-10px">
                <div><b>Id:</b> {{$course_data->id}}</div>
                <div class="as-divider"></div>
                <div><b>Course name:</b> {{$course_data->course_name}}</div>
                <div class="as-divider"></div>
                <div><b>Tagline:</b> {{$course_data->course_tagline}}</div>
                <div class="as-divider"></div>
                <div><b>Slug:</b> {{$course_data->course_slug}}</div>
                <div class="as-divider"></div>
                <div><b>Regular fee:</b> {{$course_data->course_fee}}</div>
                <div class="as-divider"></div>
                <div><b>Selling fee:</b> {{$course_data->course_selling_fee}}</div>
                <div class="as-divider"></div>
                <div><b>Duration:</b> {{$course_data->course_duration}}</div>
                <div class="as-divider"></div>
                <div><b>Level:</b> {{$course_data->course_level}}</div>
                <div class="as-divider"></div>
                <div><b>Description:</b> {!!$course_data->course_description!!}</div>
                <div class="as-divider"></div>
                <div><b>Status:</b> {{$course_data->course_status == 1 ? 'Published' : 'Unpublished' }}</div>
                <div class="as-divider"></div>
                <div><b>Instructor:</b> {{$course_data->instructor->instructor_name}}</div>
                <div class="as-divider"></div>
                <div><b>Category:</b> {{$course_data->course_category->category_name}}</div>
                <div class="as-divider"></div>
                <div><b>Created at:</b> {{$course_data->created_at}}</div>
            </div>

            <div class="actions as-flex as-justify-end as-mt-20px as-mb-10px">
                <button class="as-btn as-app-cursor"><i onclick="showModal('add-chapter')"
                        class="fa-solid fa-plus as-app-cursor as-f-20px"></i> Add chapter</button>
            </div>

            <div id="chapter-list-div">
                <i class="fa-solid fa-spinner fa-spin"></i>
            </div>
        </div>

    </div>

    <!--modal -->
    <div class="as-modal" id="add-chapter" style="display: none">
        <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

            <div class="as-modal-child as-p-10px">
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Chapter name</b></div>
                    <input type="text" id="chapter-name" class="as-input" placeholder="Enter chapter name">
                </div>
            </div>
            <div class="as-mt-10px as-text-right">
                <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('add-chapter')">Cancel</button>
                <button id="add-chapter-btn" class="as-btn as-app-cursor" onclick="addChapter()">Add</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        getChapterData();

        function addChapter() {
            var chapterName = document.getElementById('chapter-name').value;
            var addChapterBtn = document.getElementById('add-chapter-btn');

            if (chapterName == '') {
                alert('Enter chapter name');
            }
            else {
                addChapterBtn.disabled = true;
                addChapterBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

                axios.post('/admin/chapter/add', { chapter_name: chapterName, course_id: {{$course_data->id}} })
                    .then(function (response) {
                        alert(response.data.message);

                        if (response.data.status == 200) {
                            location.reload();
                        }
                        else {
                            hideModal('add-category');
                        }
                    });
            }
        }

        function getChapterData() {
            var chapterDataDiv = document.getElementById('chapter-list-div');
            chapterDataDiv.innerHTML = '';

            axios.get('/admin/chapter/get/{{$course_data->id}}')
                .then(function (response) {
                    response.data.forEach(function (chapter) {
                        chapterDataDiv.innerHTML += `
                                    <div class="as-card as-mb-10px as-flex as-space-between as-p-10px">
                                        <div>
                                            <div class="as-flex as-align-center as-f-bold">${chapter.chapter_name}</div>
                                            <div class="as-divider"></div>
                                            <div id="chapter-topic-div${chapter.id}"></div>
                                        </div>
                                        <div>
                                            <span><i onclick="" class="fa-solid fa-plus as-app-cursor as-p-10px"></i></span>
                                            <span><i onclick="showEditCategoryModal('${chapter.id}')" class="fa-solid fa-edit as-app-cursor as-p-10px"></i></span>
                                            <span><i onclick="deleteCategory(${chapter.id})" class="fa-solid fa-trash as-app-cursor as-p-10px"></i></span>
                                        </div>
                                    </div>
                                `;

                        axios.get(`/admin/chapter/topic/get/{{$course_data->id}}/${chapter.id}`)
                            .then(function (response) {                                
                                var chapterTopicDiv = document.getElementById(`chapter-topic-div${chapter.id}`);
                                chapterTopicDiv.innerHTML = '';

                                response.data.forEach(function (topic) {
                                    chapterTopicDiv.innerHTML += `
                                        <div class="as-flex as-align-center as-mb-5px">
                                            <div class="">${topic.topic_name}</div>
                                        </div>
                                        <div class="as-divider"></div>
                                    `;
                                });
                            });
                    });

                });
        }

        function showEditCategoryModal(categoryId, categoryName) {
            var body = document.getElementsByTagName('body');
            body[0].innerHTML += `<div class="as-modal" id="edit-category" style="display: none">
                        <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

                            <div class="as-modal-child as-p-10px">
                                <div class="as-mt-10px">
                                    <div class="as-mb-5px"><b>ক্যাটাগরির নাম</b></div>
                                    <input type="text" id="edited-category-name" class="as-input" value="${categoryName}">
                                </div>
                            </div>
                            <div class="as-mt-10px as-text-right">
                                <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('edit-category')">বাতিল করুন</button>
                                <button class="as-btn as-app-cursor" onclick="editCategory(${categoryId})">সম্পাদনা করুন</button>
                            </div>
                        </div>
                    </div>`

            showModal('edit-category');
        }

        function editCategory(categoryId) {
            var editedCategoryName = document.getElementById('edited-category-name').value;

            if (editedCategoryName == '') {
                alert('ক্যাটাগরির নাম দিন');
            }
            else {
                axios.post('/admin/category/edit', { category_id: categoryId, category_name: editedCategoryName })
                    .then(function (response) {
                        alert(response.data.message);

                        if (response.data.status == 200) {
                            location.reload();
                        }
                        else {
                            hideModal('edit-category');
                        }
                    });
            }
        }

        function deleteCategory(category_id) {
            var confirm = window.confirm('ক্যাটাগরি মুছে ফেলবেন কি?');

            if (confirm) {
                axios.post('/admin/category/delete', { category_id: category_id })
                    .then(function (response) {
                        alert(response.data.message);
                        getCategoryData();
                    });
            }
        }
    </script>
@endsection