@extends('admin.layout')
@section('title', 'Admin - Asked Question')

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
                <span class="as-f-bold as-f-20px">Asked Question</span> <span id="total-question"></span>
            </div>
        </div>

        <!-- question list -->
        <div id="question-answer-div" class="as-p-10px">
            <i style="font-size: 25px;" class="fa-solid fa-spinner fa-spin as-w-100 as-text-center"></i>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        getAskedQuenstion();

        function getAskedQuenstion() {
            let questionAnswerDiv = document.getElementById('question-answer-div');

            axios.get('/admin/get-asked-question')
                .then(res => {
                    questionAnswerDiv.innerHTML = '';
                    document.getElementById('total-question').innerText = `(${res.data.length})`;

                    if (res.data.length === 0) {
                        questionAnswerDiv.innerHTML = `<h3 style="text-align: center; color: grey;">No question!</h3>`;
                        return;
                    }
                    res.data.forEach(element => {
                        questionAnswerDiv.innerHTML += `<div class="as-card as-mb-10px">
                                                                <div class="profile">
                                                                    <div class="info as-w-100">
                                                                        <div class="as-flex as-space-between as-p-15px as-color-white as-brr-5px" style="background-color: #605e5c;">
                                                                            <div class="as-mr-10px">
                                                                                <span class="as-flex"><h4>Course &nbsp&nbsp:</h4> &nbsp <span id="coursename${element.id}">${element.course_name}</span></span>
                                                                                <span class="as-flex"><h4>Topic  &nbsp&nbsp&nbsp&nbsp&nbsp:</h4> &nbsp <span id="topicname${element.id}">${element.topic_name}</span></span>
                                                                                <span class="as-flex"><h4>Student &nbsp:</h4> &nbsp <span id="studentname${element.id}">${element.student_name}</span> &nbsp-&nbsp ${element.student_number}</span>
                                                                            </div>
                                                                            <div>
                                                                                <i onclick="showModal('add-reply${element.id}')" class="fas fa-edit as-app-cursor"></i> <br>
                                                                                <i onclick="deleteQuestion(${element.id})" class="fas fa-trash as-app-cursor"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="as-p-15px">
                                                                            <b>Question</b>
                                                                            <p class="question"><span id="question${element.id}">${element.question}</span>?</p>
                                                                            <div class="as-divider"></div>
                                                                            <b>Answer</b>
                                                                            <p style="background-color: #fff; padding: 0px; width: 100%" class="answer as-brr-5px">
                                                                                <span id="answer${element.id}">${element.answer ? element.answer : '...'}</span>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="as-modal" id="add-reply${element.id}" style="display: none">
                                                                <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

                                                                    <div class="as-modal-child">
                                                                        <div class="as-mt-10px">
                                                                            <div class="as-mb-5px"><b>Reply</b></div>
                                                                            <input type="text" id="reply${element.id}" class="as-input" placeholder="Enter question reply">
                                                                        </div>
                                                                    </div>
                                                                    <div class="as-mt-10px as-text-right">
                                                                        <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('add-reply${element.id}')">Cancel</button>
                                                                        <button class="as-btn as-app-cursor" onclick="addReply(${element.id})">Add</button>
                                                                    </div>
                                                                </div>
                                                            </div>`

                        checkLanguageAndReplaceFontFamily(element.course_name, element.topic_name, element.student_name, element.question, element.answer, `coursename${element.id}`, `topicname${element.id}`, `studentname${element.id}`, `question${element.id}`, `answer${element.id}`);
                    });
                })
        }

        function addReply(questionId) {
            let reply = document.getElementById('reply' + questionId).value;
            if (reply === '') {
                alert('Please enter reply');
                return;
            }

            axios.post('/admin/asked-question/reply', {
                question_id: questionId,
                reply: reply
            }).then(res => {
                if (res.data.status === 'success') {
                    alert('Reply added successfully');
                    hideModal('add-reply' + questionId);
                    getAskedQuenstion();
                } else {
                    alert('Something went wrong. Please try again.');
                }
            })
        }

        function deleteQuestion(questionId) {
            if (confirm('Do you want to delete the question?')) {
                axios.post('/admin/asked-question/delete', {
                    question_id: questionId
                }).then(res => {
                    if (res.data.status === 'success') {
                        alert('Question deleted successfully');
                        getAskedQuenstion();
                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                })
            }
        }


        function isMostlyEnglish(text) {
            const englishChars = text.match(/[A-Za-z]/g) || [];
            return englishChars.length / text.length > 0.7;
        }

        function checkLanguageAndReplaceFontFamily(courseName, topicName, studentName, question, answer, cname, tname, sname, qtext, atext) {

            const elements = {
                cname: document.getElementById(cname),
                tname: document.getElementById(tname),
                sname: document.getElementById(sname),
                qtext: document.getElementById(qtext),
                atext: document.getElementById(atext)
            };

            const texts = {
                cname: courseName,
                tname: topicName,
                sname: studentName,
                qtext: question,
                atext: answer
            };

            for (const key in elements) {
                const element = elements[key];
                const text = texts[key];

                if (!element || !text) continue;

                if (!isMostlyEnglish(text)) {
                    element.style.fontFamily = "'Tiro Bangla', serif";
                }

                element.textContent = text;
            }
        }
    </script>
@endsection