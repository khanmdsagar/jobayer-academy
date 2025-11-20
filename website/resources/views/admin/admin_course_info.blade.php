@extends('admin.layout')
@section('title', 'Admin - Course Info')

@section('content')
    <div class="as-w-100">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h2>Course Information</h2>
            </div>
            <div class="user-info">
                <div class="user-avatar">AD</div>
                <div>
                    <div style="font-weight: 600;">{{ $admin[0]->admin_username }}</div>
                    <div style="font-size: 12px; color: var(--gray);">{{ $admin[0]->admin_role }}</div>
                </div>
            </div>
        </div>

        <!--list-->
        <div class="as-p-10px">
            <div class="as-card as-p-10px">
                <div><b>Id:</b> {{$course_data->id}}</div>
                <div class="as-divider"></div>
                <div><b>Course name:</b> <span class="as-check-language">{{$course_data->course_name}}</span></div>
                <div class="as-divider"></div>
                <div><b>Tagline:</b> <span class="as-check-language">{{$course_data->course_tagline}}</span></div>
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
                <div><b>Description:</b> <span class="as-check-language">{!!$course_data->course_description!!}</span></div>
                <div class="as-divider"></div>
                <div><b>Status:</b> {{$course_data->course_status == 1 ? 'Published' : 'Unpublished' }}</div>
                <div class="as-divider"></div>
                <div><b>Instructor:</b> <span class="as-check-language">{{$course_data->instructor->instructor_name}}</span>
                </div>
                <div class="as-divider"></div>
                <div><b>Category:</b> <span
                        class="as-check-language">{{$course_data->course_category->category_name}}</span></div>
                <div class="as-divider"></div>
                <div><b>Created at:</b> {{$course_data->created_at}}</div>
            </div>

            {{-- tab --}}
            <div id="tab-container" class="as-mt-20px">
                <div class="tab-buttons">
                    <button class="tab active as-app-cursor" onclick="showTab(event, 'tab1')">Curriculum</button>
                    <button class="tab as-app-cursor" onclick="showTab(event, 'tab2')">Resource</button>
                    <button class="tab as-app-cursor" onclick="showTab(event, 'tab3')">FAQ</button>
                    <button class="tab as-app-cursor" onclick="showTab(event, 'tab4')">Quiz</button>
                </div>

                <div id="tab1" class="tab-content active">
                    <div id="tab1-content">
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

                <div id="tab2" class="tab-content">
                    <div id="tab2-content">
                        <div class="actions as-flex as-space-between as-align-center as-mt-20px as-mb-10px">
                            <div class="as-f-bold">Course Resources</div>
                            <button onclick="showModal('add-resource')" class="as-btn as-app-cursor"><i
                                    class="fa-solid fa-plus as-app-cursor as-f-20px"></i> Add Resource</button>
                        </div>

                        <div id="resource-list-div">
                            <i class="fa-solid fa-spinner fa-spin"></i>
                        </div>
                    </div>
                </div>
                <div id="tab3" class="tab-content">
                    <div id="tab3-content">
                        <div class="as-flex as-space-between as-align-center as-mt-20px as-mb-10px">
                            <div class="as-f-bold">FAQ</div>
                            <button onclick="showModal('add-faq')" class="as-btn as-app-cursor">
                                <i class="fa-solid fa-plus as-app-cursor as-f-20px"></i> Add FAQ
                            </button>
                        </div>
                        <div id="faq-list-div">
                            <i class="fa-solid fa-spinner fa-spin"></i>
                        </div>
                    </div>
                </div>
                <div id="tab4" class="tab-content">
                    <div id="tab4-content">
                        <div class="actions as-flex as-space-between as-align-center as-mt-20px as-mb-10px">
                            <div class="as-f-bold">Quiz Content - <span id="quiz-count"></span> quizes</div>
                            <button onclick="showModal('add-quiz')" class="as-btn as-app-cursor">
                                <i class="fa-solid fa-plus as-app-cursor as-f-20px"></i> Add Quiz
                            </button>
                        </div>
                        <div id="quiz-list-div">
                            <i class="fa-solid fa-spinner fa-spin"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- faq modal -->
    <div class="as-modal" id="add-faq" style="display: none">
        <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">
            <div class="as-modal-child as-p-10px">
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Question</b></div>
                    <input type="text" id="faq-question" class="as-input" placeholder="Enter FAQ questiion">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Answer</b></div>
                    <input type="text" id="faq-answer" class="as-input" placeholder="Enter FAQ answer">
                </div>
            </div>
            <div class="as-mt-10px as-text-right">
                <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('add-faq')">Cancel</button>
                <button id="add-faq-btn" class="as-btn as-app-cursor" onclick="addFAQ()">Add</button>
            </div>
        </div>
    </div>

    <!-- resource modal -->
    <div class="as-modal" id="add-resource" style="display: none">
        <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">
            <div class="as-modal-child as-p-10px">
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Resource Title</b></div>
                    <input type="text" id="resource-name" class="as-input" placeholder="Enter resource title">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Resource Type</b></div>
                    <select id="resource-type" class="as-select" onchange="getResourceType()">
                        <option value="" hidden>-- Select resource type --</option>
                        <option value="file">File</option>
                        <option value="link">Link</option>
                    </select>
                </div>
                <div class="as-mt-10px" style="display: none">
                    <div class="as-mb-5px"><b>Resource File Path</b></div>
                    <input type="file" id="resource-file" class="as-input" placeholder="Enter resource file path">
                </div>
                <div class="as-mt-10px" style="display: none">
                    <div class="as-mb-5px"><b>Resource URL</b></div>
                    <input type="text" id="resource-url" class="as-input" placeholder="Enter resource URL">
                </div>
            </div>
            <div class="as-mt-10px as-text-right">
                <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('add-resource')">Cancel</button>
                <button id="add-resource-btn" class="as-btn as-app-cursor" onclick="addResource()">Add</button>
            </div>
        </div>
    </div>

    <!-- quiz modal -->
    <div class="as-modal" id="add-quiz" style="display: none">
        <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

            <div class="as-modal-child as-p-10px">
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Question</b></div>
                    <input type="text" id="quiz-question" class="as-input" placeholder="Enter Quiz Question">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Option 1</b></div>
                    <input type="text" id="option-1" class="as-input" placeholder="Enter Option 1">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Option 2</b></div>
                    <input type="text" id="option-2" class="as-input" placeholder="Enter Option 2">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Option 3</b></div>
                    <input type="text" id="option-3" class="as-input" placeholder="Enter Option 3">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Option 4</b></div>
                    <input type="text" id="option-4" class="as-input" placeholder="Enter Option 4">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Correct answer</b></div>
                    <select id="correct" class="as-select">
                        <option value="" hidden>-- Select Correct Answer --</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                        <option value="option4">Option 4</option>
                    </select>
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Duration (in second)</b></div>
                    <input type="text" id="duration" class="as-input" value="45">
                </div>
            </div>
            <div class="as-mt-10px as-text-right">
                <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('add-quiz')">Cancel</button>
                <button id="add-quiz-btn" class="as-btn as-app-cursor" onclick="addQuiz()">Add</button>
            </div>
        </div>
    </div>

    {{-- edit quiz modal --}}
    <div class="as-modal" id="edit-quiz" style="display: none">
        <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

            <div class="as-modal-child as-p-10px">
                <div class="as-mt-10px" style="display: none">
                    <div class="as-mb-5px"><b>Quiz id</b></div>
                    <input type="text" id="quiz-id" class="as-input" placeholder="Enter Quiz Id">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Question</b></div>
                    <input type="text" id="quiz-question2" class="as-input" placeholder="Enter Quiz Question">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Option 1</b></div>
                    <input type="text" id="option-12" class="as-input" placeholder="Enter Option 1">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Option 2</b></div>
                    <input type="text" id="option-22" class="as-input" placeholder="Enter Option 2">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Option 3</b></div>
                    <input type="text" id="option-32" class="as-input" placeholder="Enter Option 3">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Option 4</b></div>
                    <input type="text" id="option-42" class="as-input" placeholder="Enter Option 4">
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Correct answer</b></div>
                    <select id="correct2" class="as-select">
                        <option value="" hidden>-- Select Correct Answer --</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                        <option value="option4">Option 4</option>
                    </select>
                </div>
                <div class="as-mt-10px">
                    <div class="as-mb-5px"><b>Duration (in second)</b></div>
                    <input type="text" id="duration2" class="as-input" value="45">
                </div>
            </div>
            <div class="as-mt-10px as-text-right">
                <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('edit-quiz')">Cancel</button>
                <button id="edit-quiz-btn" class="as-btn as-app-cursor" onclick="editQuiz()">Update</button>
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
                <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('edit-topic-modal')">Cancel</button>
                <button id="edit-topic-btn" class="as-btn as-app-cursor" onclick="editChapterTopic()">Add</button>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /*tab*/
        .tab-buttons {
            display: flex;
            gap: 5px;
        }

        .tab-buttons button {
            border: 1px solid #ddd;
            outline: none !important;
            background: #fff;
        }

        .tab {
            padding: 10px 20px;
            border-radius: 4px;
            transition: 0.3s;
        }

        .tab.active {
            background-color: var(--primary-color);
            color: white;
        }

        .tab-content {
            display: none;
            border-radius: 4px;
        }

        .tab-content.active {
            display: block;
        }

        .topic-list-active {
            background-color: var(--primary-color);
            color: #fff;
        }

        .topic-list-active:hover {
            background-color: var(--primary-color) !important;
            color: #fff !important;
        }
    </style>
@endsection

@section('scripts')
    <script>
        function showTab(event, tabId) {
            const tabs = document.querySelectorAll('.tab');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => tab.classList.remove('active'));
            contents.forEach(content => content.classList.remove('active'));

            event.currentTarget.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        }

        //FAQ
        getFAQ();
        function getFAQ() {
            var faqListDiv = document.getElementById('faq-list-div');
            faqListDiv.innerHTML = '';

            axios.get('/admin/faq/get/{{$course_data->id}}')
                .then(function (response) {
                    if (response.data.length == 0) {
                        faqListDiv.innerHTML = '<div class="as-text-center">No FAQ found</div>';
                    }
                    response.data.forEach(function (faq) {
                        faqListDiv.innerHTML += `
                                                <div class="as-card as-mb-10px as-p-10px">
                                                    <div class="as-flex as-space-between">
                                                        <div>
                                                            <div class="as-f-18px as-f-bold as-check-language">${faq.question}</div>
                                                            <div class="as-divider"></div>
                                                            <div><b>Answer:</b> <span class="as-check-language">${faq.answer}</span></div>
                                                        </div>
                                                        <div>
                                                            <div><i onclick="deleteFAQ(${faq.id})" class="fa-solid fa-trash as-app-cursor as-p-10px"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `;
                    });
                });
        }

        function addFAQ() {
            var faqQuestion = document.getElementById('faq-question').value;
            var faqAnswer   = document.getElementById('faq-answer').value;
            var addFAQBtn   = document.getElementById('add-faq-btn');

            if (faqQuestion == '') {
                alert('Select FAQ Question');
            }
            else if (faqAnswer == '') {
                alert('Enter FAQ Answer');
            }
            else {
                addFAQBtn.disabled  = true;
                addFAQBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

                var data = {
                    'course_id': {{$course_data->id}},
                    'faq_question': faqQuestion,
                    'faq_answer'  : faqAnswer
                }

                axios.post('/admin/faq/add', data)
                    .then(function (response) {
                        if(response.data.status == 'success'){
                            addFAQBtn.disabled  = false;
                            addFAQBtn.innerHTML = 'Add';
                            alert('FAQ added successfully');
                            getFAQ();
                            hideModal('add-faq');
                        }
                        else{
                            addFAQBtn.disabled  = false;
                            addFAQBtn.innerHTML = 'Add';
                            alert('Failed to add FAQ');
                            hideModal('add-faq');
                        }
                    })
            }
        }

        function deleteFAQ(faqId) {
            if (confirm('Are you sure you want to delete this FAQ?')) {
                axios.post('/admin/faq/delete', { faq_id: faqId})
                    .then(function (response) {
                        if (response.data.status == 'success') {
                            alert('FAQ deleted successfully');
                            getFAQ();
                        }
                        else {
                            alert('Failed to delete FAQ');
                        }
                    });
            }
        }

        //resource
        getResource();
        function getResource() {
            var resourceListDiv = document.getElementById('resource-list-div');
            resourceListDiv.innerHTML = '';

            axios.get('/admin/resource/get/{{$course_data->id}}')
                .then(function (response) {
                    if (response.data.length == 0) {
                        resourceListDiv.innerHTML = '<div class="as-text-center">No resource found</div>';
                    }
                    response.data.forEach(function (resource) {
                        resourceListDiv.innerHTML += `
                                                                                                        <div class="as-card as-mb-10px as-p-10px">
                                                                                                            <div class="as-flex as-space-between">
                                                                                                                <div>
                                                                                                                    <div class="as-f-18px as-f-bold">${resource.resource_name}</div>
                                                                                                                    <div class="as-divider"></div>
                                                                                                                    <div><b>Type &nbsp&nbsp:</b> &nbsp${resource.resource_type}</div>
                                                                                                                    <div><b>Path &nbsp&nbsp:</b> &nbsp${resource.resource_path}</div>
                                                                                                                </div>
                                                                                                                <div>
                                                                                                                    <div><i onclick="deleteResource(${resource.id}, '${resource.resource_type}', '${resource.resource_path}')" class="fa-solid fa-trash as-app-cursor as-p-10px"></i></div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    `;
                    });
                });
        }

        function getResourceType() {
            var resourceType = document.getElementById('resource-type').value
            var resourceFile = document.getElementById('resource-file')
            var resourceURL = document.getElementById('resource-url')

            if (resourceType == 'file') {
                resourceFile.parentElement.style.display = 'block';
                resourceURL.parentElement.style.display = 'none';
            }
            else if (resourceType == 'link') {
                resourceFile.parentElement.style.display = 'none';
                resourceURL.parentElement.style.display = 'block';
            }
            else {
                resourceFile.parentElement.style.display = 'none';
                resourceURL.parentElement.style.display = 'none';
            }
        }

        function addResource() {
            // Add your resource submission logic here
            var resourceName = document.getElementById('resource-name').value;
            var resourceType = document.getElementById('resource-type').value;
            var resourceFile = document.getElementById('resource-file').files[0];
            var resourceURL = document.getElementById('resource-url').value;
            var addResourceBtn = document.getElementById('add-resource-btn');

            if (resourceType == '') {
                alert('Select resource type');
            }
            else if (resourceType == 'file' && resourceFile == undefined) {
                alert('Select resource file');
            }
            else if (resourceType == 'link' && resourceURL.value == '') {
                alert('Enter resource URL');
            }
            else {
                addResourceBtn.disabled = true;
                addResourceBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

                if (resourceType == 'file') {
                    var formData = new FormData();
                    formData.append('resource_file', resourceFile);
                    var config = { headers: { 'content-type': 'multipart/form-data' } }

                    axios.post('/admin/resource/add', formData, config)
                        .then(function (response) {
                            if (response.data != '') {
                                axios.post('/admin/resource/add/details', {
                                    course_id: {{$course_data->id}},
                                    resource_name: resourceName,
                                    resource_type: resourceType,
                                    resource_path: response.data
                                }).then(function (res) {
                                    if (res.data.status == 'success') {
                                        alert('Resource added successfully');
                                        getResource();
                                        hideModal('add-resource');

                                        addResourceBtn.disabled = false;
                                        addResourceBtn.innerHTML = 'Add';
                                    }
                                    else {
                                        alert('Failed to add resource');
                                        hideModal('add-resource');
                                        addResourceBtn.disabled = false;
                                        addResourceBtn.innerHTML = 'Add';
                                    }
                                });
                            }
                            else {
                                addResourceBtn.disabled = false;
                                addResourceBtn.innerHTML = 'Add';
                                alert('Failed to upload file');
                                hideModal('add-resource');
                            }
                        });
                }
                else {
                    axios.post('/admin/resource/add/details', {
                        course_id: {{$course_data->id}},
                        resource_name: resourceName,
                        resource_type: resourceType,
                        resource_path: resourceURL
                    }).then(function (res) {
                        if (res.data.status == 'success') {
                            alert('Resource added successfully');
                            getResource();
                            hideModal('add-resource');
                            addResourceBtn.disabled = false;
                            addResourceBtn.innerHTML = 'Add';
                        }
                        else {
                            alert('Failed to add resource');
                            hideModal('add-resource');
                            addResourceBtn.disabled = false;
                            addResourceBtn.innerHTML = 'Add';
                        }
                    });
                }
            }
        }

        function deleteResource(resourceId, resourceType, resourcePath) {
            if (confirm('Are you sure you want to delete this resource?')) {
                axios.post('/admin/resource/delete', { resource_id: resourceId, resource_type: resourceType, resource_path: resourcePath })
                    .then(function (response) {
                        if (response.data.status == 'success') {
                            alert('Resource deleted successfully');
                            getResource();
                        }
                        else {
                            alert('Failed to delete resource');
                        }
                    });
            }
        }

        //quiz
        getQuizData();
        function getQuizData() {
            var quizListDiv = document.getElementById('quiz-list-div');
            quizListDiv.innerHTML = '';

            axios.get('/admin/quiz/get/{{$course_data->id}}')
                .then(function (response) {
                    document.getElementById('quiz-count').innerText = response.data.length;

                    if (response.data.length == 0) {
                        quizListDiv.innerHTML = '<div class="as-text-center">No quiz found</div>';
                    }

                    response.data.forEach(function (quiz) {
                        quizListDiv.innerHTML += `
                                                                                                        <div class="as-card as-mb-10px as-p-10px">
                                                                                                            <div>
                                                                                                                <div class="as-flex as-space-between">
                                                                                                                    <div>
                                                                                                                        <div class="as-check-language as-f-18px as-f-bold">${quiz.question}</div>
                                                                                                                        <div class="as-divider"></div>
                                                                                                                        <div class="as-check-language">1. &nbsp${quiz.option1}</div>
                                                                                                                        <div class="as-check-language">2. &nbsp${quiz.option2}</div>
                                                                                                                        <div class="as-check-language">3. &nbsp${quiz.option3}</div>
                                                                                                                        <div class="as-check-language">4. &nbsp${quiz.option4}</div>
                                                                                                                        <div class="as-divider"></div>
                                                                                                                        <div><b>Correct &nbsp&nbsp&nbsp:</b> &nbsp${quiz.correct}</div>
                                                                                                                        <div><b>Duration &nbsp:</b> &nbsp${quiz.duration}sec</div>
                                                                                                                    </div>
                                                                                                                    <div>
                                                                                                                        <div><i onclick="showEditQuizModal(${quiz.id}, '${quiz.question}', '${quiz.option1}', '${quiz.option2}', '${quiz.option3}', '${quiz.option4}', '${quiz.correct}', ${quiz.duration})" class="fa-solid fa-edit as-app-cursor as-p-10px"></i></div>
                                                                                                                        <div><i onclick="deleteQuiz(${quiz.id})" class="fa-solid fa-trash as-app-cursor as-p-10px"></i></div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    `;
                    });

                });
        }

        function addQuiz() {
            var question = document.getElementById('quiz-question').value;
            var option1 = document.getElementById('option-1').value;
            var option2 = document.getElementById('option-2').value;
            var option3 = document.getElementById('option-3').value;
            var option4 = document.getElementById('option-4').value;
            var correct = document.getElementById('correct').value;
            var duration = document.getElementById('duration').value;
            var addQuizBtn = document.getElementById('add-quiz-btn');

            if (question == '') {
                alert('Enter quiz question');
            }
            else if (option1 == '') {
                alert('Enter option 1');
            }
            else if (option2 == '') {
                alert('Enter option 2');
            }
            else if (option3 == '') {
                alert('Enter option 3');
            }
            else if (option4 == '') {
                alert('Enter option 4');
            }
            else if (correct == '') {
                alert('Select correct answer');
            }
            else if (duration == '' || isNaN(duration)) {
                alert('Enter valid duration');
            }
            else {
                var data = {
                    course_id: {{$course_data->id}},
                    question: question,
                    option1: option1,
                    option2: option2,
                    option3: option3,
                    option4: option4,
                    correct: correct,
                    duration: duration
                };
                addQuizBtn.disabled = true;
                addQuizBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

                axios.post('/admin/quiz/add', data)
                    .then(function (response) {
                        alert(response.data.message);
                        hideModal('add-quiz');
                        addQuizBtn.disabled = false;
                        addQuizBtn.innerHTML = 'Add';

                        document.getElementById('quiz-question').value = '';
                        document.getElementById('option-1').value = '';
                        document.getElementById('option-2').value = '';
                        document.getElementById('option-3').value = '';
                        document.getElementById('option-4').value = '';
                        document.getElementById('correct').value = '';
                        document.getElementById('duration').value = '45';

                        if (response.data.status == 'success') {
                            getQuizData();
                        }
                    });
            }
        }

        function showEditQuizModal(quizId, question, option1, option2, option3, option4, correct, duration) {
            document.getElementById('quiz-id').value = quizId;
            document.getElementById('quiz-question2').value = question;
            document.getElementById('option-12').value = option1;
            document.getElementById('option-22').value = option2;
            document.getElementById('option-32').value = option3;
            document.getElementById('option-42').value = option4;
            document.getElementById('correct2').value = correct;
            document.getElementById('duration2').value = duration;

            showModal('edit-quiz');
        }

        function editQuiz() {
            var quizId = document.getElementById('quiz-id').value;
            var question2 = document.getElementById('quiz-question2').value;
            var option12 = document.getElementById('option-12').value;
            var option22 = document.getElementById('option-22').value;
            var option32 = document.getElementById('option-32').value;
            var option42 = document.getElementById('option-42').value;
            var correct2 = document.getElementById('correct2').value;
            var duration2 = document.getElementById('duration2').value;
            var editQuizBtn = document.getElementById('edit-quiz-btn');

            if (question2 == '') {
                alert('Enter quiz question');
            }
            else if (option12 == '') {
                alert('Enter option 1');
            }
            else if (option22 == '') {
                alert('Enter option 2');
            }
            else if (option32 == '') {
                alert('Enter option 3');
            }
            else if (option42 == '') {
                alert('Enter option 4');
            }
            else if (correct2 == '') {
                alert('Select correct answer');
            }
            else if (duration2 == '' || isNaN(duration2)) {
                alert('Enter valid duration');
            }
            else {
                editQuizBtn.disabled = true;
                editQuizBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

                var data = {
                    quiz_id: quizId,
                    question2: question2,
                    option12: option12,
                    option22: option22,
                    option32: option32,
                    option42: option42,
                    correct2: correct2,
                    duration2: duration2
                };

                console.log(data);

                axios.post('/admin/quiz/edit', data)
                    .then(function (response) {
                        alert(response.data.message);
                        hideModal('edit-quiz');
                        editQuizBtn.disabled = false;
                        editQuizBtn.innerHTML = 'Update';

                        document.getElementById('quiz-question2').value = '';
                        document.getElementById('option-12').value = '';
                        document.getElementById('option-22').value = '';
                        document.getElementById('option-32').value = '';
                        document.getElementById('option-42').value = '';
                        document.getElementById('correct2').value = '';
                        document.getElementById('duration2').value = '45';

                        if (response.data.status == 'success') {
                            getQuizData();
                        }
                    });
            }

        }

        function deleteQuiz(quizId) {
            var confirm = window.confirm('Do you want to delete the quiz?');

            if (confirm) {
                axios.post('/admin/quiz/delete', { quiz_id: quizId })
                    .then(function (response) {
                        alert(response.data.message);
                        getQuizData();
                    });
            }
        }

        //chapter
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
                                                                                                                                                            <div class="as-check-language as-f-18px">${chapter.chapter_name}</div>
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
            var topicId = document.getElementById('edit-topic-id').value;
            var topicName = document.getElementById('edit-topic-name').value;
            var topicVideo = document.getElementById('edit-topic-video').value;
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
                                                                                                                    <div class="as-check-language as-flex as-align-center">${topic.topic_name}</div>
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