@extends('admin.layout')
@section('title', 'Admin - Course Info')

@section('content')
    <div class="as-flex">
        <!--sidebar-->
        <div id="admin-sidebar" class="as-w-200px as-bg-white as-h-100vh">
            @include('admin.sidebar')
        </div>
    </div>

    <div class="as-w-100" style="overflow-y: auto; height: 100vh;">
        <!-- navbar -->
        <div class="as-p-10px">
            <div>
                <i onclick="toggleAdminSidebar()" class="fas fa-bars as-app-cursor as-f-20px as-mr-10px"></i>
                <span class="as-f-bold as-f-20px">Course Information</span>
            </div>
        </div>

        <!--list-->
        <div id="" class="as-p-10px">
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

            <div class="actions as-flex as-space-between as-align-center as-mt-20px as-mb-10px">
                <div class="as-f-bold">Course Curriculum</div>
                <button onclick="showModal('add-chapter')" class="as-btn as-app-cursor"><i
                        class="fa-solid fa-plus as-app-cursor as-f-20px"></i> Add chapter</button>
            </div>

            <div id="chapter-list-div">
                <i class="fa-solid fa-spinner fa-spin"></i>
            </div>
        </div>

    </div>

    <!-- chapter modal -->
    <div class="as-modal" id="add-chapter" style="display: none">
        <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

            <div class="as-modal-child">
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

    {{-- topic edit modal --}}
    <div class="as-modal" id="edit-topic-modal" style="display: none">
        <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

            <div class="as-modal-child">
                <div class="as-mt-10px as-none">
                    <div class="as-mb-5px"><b>Topic ID</b></div>
                    <input type="text" id="edit-topic-id" class="as-input" placeholder="Enter Topic ID">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Topic name</b></div>
                    <input type="text" id="edit-topic-name" class="as-input" placeholder="Enter Topic name">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Topic Video URL</b></div>
                    <input type="text" id="edit-topic-video" class="as-input" placeholder="Enter Topic Video URL">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Topic Status</b></div>
                    <select id="edit-topic-status" class="as-select">
                        <option value="0">Paid</option>
                        <option value="1">Free</option>
                    </select>
                </div>
            </div>
            <div class="as-mt-10px as-text-right">
                <button class="as-btn as-app-cursor as-bg-cancel"
                    onclick="hideModal('edit-topic-modal')">Cancel</button>
                <button id="edit-topic-btn" class="as-btn as-app-cursor"
                    onclick="editChapterTopic()">Add</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        getChapterData();

        function addChapter() {
            var chapterName   = document.getElementById('chapter-name').value;
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
                            addChapterBtn.disabled = false;
                            addChapterBtn.innerHTML = 'Add';
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
                                            <div class="as-card as-mb-10px as-p-10px">
                                                <div>
                                                    <div class="as-flex as-space-between as-align-center as-f-bold">
                                                        <div>${chapter.chapter_name}</div>
                                                        <div>
                                                            <span><i onclick="showModal('add-topic${chapter.id}')" class="fa-solid fa-plus as-app-cursor as-p-10px"></i></span>
                                                            <span><i onclick="deleteChapter(${chapter.id})" class="fa-solid fa-trash as-app-cursor as-p-10px"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="as-divider"></div>
                                                    <div id="chapter-topic-div${chapter.id}"></div>
                                                </div>
                                            </div>
                                            <div class="as-modal" id="add-topic${chapter.id}" style="display: none">
                                                <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

                                                    <div class="as-modal-child">
                                                        <div class="as-mt-10px">
                                                            <div class="as-mb-5px"><b>Topic name</b></div>
                                                            <input type="text" id="topic-name${chapter.id}" class="as-input" placeholder="Enter Topic name">
                                                        </div>
                                                        <div class="as-mt-10px">
                                                            <div class="as-mb-5px"><b>Topic Video URL</b></div>
                                                            <input type="text" id="topic-video${chapter.id}" class="as-input" placeholder="Enter Topic Video URL">
                                                        </div>
                                                        <div class="as-mt-10px">
                                                            <div class="as-mb-5px"><b>Topic Status</b></div>
                                                            <select id="topic-isFree${chapter.id}" class="as-select">
                                                                <option value="0">Paid</option>
                                                                <option value="1">Free</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="as-mt-10px as-text-right">
                                                        <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('add-topic${chapter.id}')">Cancel</button>
                                                        <button id="add-chapter-btn" class="as-btn as-app-cursor" onclick="addChapterTopic(${chapter.id})">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        `;

                        getChapterTopicData(chapter.id);
                    });

                });
        }

        // function showEditCategoryModal(categoryId, categoryName) {
        //     var body = document.getElementsByTagName('body');
        //     body[0].innerHTML += ``

        //     showModal('edit-category');
        // }

        // function editCategory(categoryId) {
        //     var editedCategoryName = document.getElementById('edited-category-name').value;

        //     if (editedCategoryName == '') {
        //         alert('ক্যাটাগরির নাম দিন');
        //     }
        //     else {
        //         axios.post('/admin/category/edit', { category_id: categoryId, category_name: editedCategoryName })
        //             .then(function (response) {
        //                 alert(response.data.message);

        //                 if (response.data.status == 200) {
        //                     location.reload();
        //                 }
        //                 else {
        //                     hideModal('edit-category');
        //                 }
        //             });
        //     }
        // }

        function deleteChapter(chapterId) {
            var confirm = window.confirm('Do you want to delete the Chapter?');

            if (confirm) {
                axios.post('/admin/chapter/delete', { chapter_id: chapterId })
                    .then(function (response) {
                        alert(response.data.message);
                        getChapterData();
                    });
            }
        }


        //chapter topic
        function showEditTopicModal(topicId, topicName, topicVideo, topicStatus) {
            document.getElementById('edit-topic-id').value = topicId;
            document.getElementById('edit-topic-name').value = topicName;
            document.getElementById('edit-topic-video').value = topicVideo;
            document.getElementById('edit-topic-status').value = topicStatus;

            showModal('edit-topic-modal');
        }

        function editChapterTopic() {
            var topicId     = document.getElementById('edit-topic-id').value;
            var topicName   = document.getElementById('edit-topic-name').value;
            var topicVideo  = document.getElementById('edit-topic-video').value;
            var topicStatus = document.getElementById('edit-topic-status').value;
            var editTopicBtn = document.getElementById('edit-topic-btn');

            editTopicBtn.disabled = true;
            editTopicBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

            axios.post('/admin/chapter/topic/edit', {
                topic_id: parseInt(topicId),
                topic_name: topicName,
                topic_video: topicVideo,
                topic_status: parseInt(topicStatus)
            })
            .then(function (response) {
                alert(response.data.message);

                if (response.data.status == 200) {
                    location.reload();
                }
                else {
                    hideModal('edit-topic-modal');
                    editTopicBtn.disabled = false;
                    editTopicBtn.innerHTML = 'Add';
                }
            });
        }

        function getChapterTopicData(chapterId) {
            axios.get(`/admin/chapter/topic/get/{{$course_data->id}}/${chapterId}`)
                .then(function (response) {
                    var chapterTopicDiv = document.getElementById(`chapter-topic-div${chapterId}`);
                    chapterTopicDiv.innerHTML = '';

                    response.data.forEach(function (topic) {
                        chapterTopicDiv.innerHTML += `
                                    <div class="as-flex as-align-center as-mb-5px">
                                        <div class="as-flex as-space-between as-w-100">
                                            <div>${topic.topic_name}</div>
                                            <div>
                                                <span><i onclick="showEditTopicModal(${topic.id}, '${topic.topic_name}', '${topic.topic_video}', ${topic.topic_is_free})" class="fa-solid fa-edit as-app-cursor as-p-10px"></i></span>
                                                <span><i style="color: red" onclick="deleteChapterTopic(${topic.id}, ${chapterId})" class="fa-solid fa-trash as-app-cursor as-p-10px"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="as-divider"></div>
                                `;
                    });
                });
        }

        function addChapterTopic(chapterId) {
            var courseId = {{$course_data->id}};
            var topicName = document.getElementById('topic-name' + chapterId).value;
            var topicVideo = document.getElementById('topic-video' + chapterId).value;
            var topicIsFree = document.getElementById('topic-isFree' + chapterId).value;

            if (topicName == '') {
                alert('Enter topic name');
            }
            else if (topicVideo == '') {
                alert('Enter topic video URL');
            }
            else {
                var data = {
                    course_id: courseId,
                    chapter_id: chapterId,
                    topic_name: topicName,
                    topic_video: topicVideo,
                    topic_is_free: parseInt(topicIsFree)
                }
                axios.post('/admin/chapter/topic/add', data)
                    .then(function (response) {
                        alert(response.data.message);
                        getChapterTopicData(chapterId);
                    });
            }
        }

        function deleteChapterTopic(topicId, chapterId) {
            var confirm = window.confirm('Do you want to delete the topic?');

            if (confirm) {
                axios.post('/admin/chapter/topic/delete', { topic_id: topicId })
                    .then(function (response) {
                        alert(response.data.message);
                        getChapterTopicData(chapterId);
                    });
            }
        }
    </script>
@endsection