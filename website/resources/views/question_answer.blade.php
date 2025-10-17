@extends('layouts.app')

@section('title', 'Jobayer Academy - Question & Answer')

@section('content')
    <div class="as-flex as-space-between as-w-95 dt:as-mw-1280px as-m-0-auto">
        <!-- Sidebar -->
        <div class="as-show-desktop as-mt-15px as-w-28">
            <div class="">
                <img class="as-w-50px" src="https://cdn-icons-png.flaticon.com/512/2436/2436874.png" alt="Logo"
                    class="sidebar-logo">
                <h2>শীক্ষার্থী ড্যাশবোর্ড</h2>
            </div>

            <div class="as-mt-20px">
                <div class="">
                    <div class="as-app-cursor as-hover as-p-10px as-brr-5px" onclick="window.location.href = '/dashboard'">
                        <i class="fas fa-box as-mr-10px"></i>ড্যাশবোর্ড
                    </div>
                </div>
                <div>
                    <div class="as-app-cursor as-hover as-p-10px as-brr-5px" onclick="window.location.href = '/profile'"><i
                            class="fas fa-user as-mr-10px"></i>প্রোফাইল</div>
                </div>
                <div>
                    <div class="as-app-cursor as-hover as-p-10px as-brr-5px" onclick="window.location.href = '/settings'"><i
                            class="fas fa-gear as-mr-10px"></i>সেটিংস</div>
                </div>
                <div>
                    <div class="logout as-app-cursor as-hover as-p-10px as-brr-5px" onclick="logout()"><i
                            class="fas fa-sign-out-alt as-mr-10px"></i>লগআউট</div>
                </div>
            </div>
        </div>


        <!-- Main Content -->
        <div class="as-mt-15px as-w-70 md:as-w-100">
            <div class="" id="question-answer-div">
                <!-- loop here -->
                <h3 style="text-align: center; color: grey;"><i class="fas fa-spinner fa-spin"></i></h3>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>

    </style>
@endsection

@section('scripts')
    <script>
        getAskedQuenstion();

        function getAskedQuenstion() {
            let questionAnswerDiv = document.getElementById('question-answer-div');

            axios.get('/api/get-asked-question')
                .then(res => {
                    questionAnswerDiv.innerHTML = '';

                    if (res.data.length === 0) {
                        questionAnswerDiv.innerHTML = `<h3 style="text-align: center; color: grey;">কোনো প্রশ্ন করা হয়নি!</h3>`;
                        return;
                    }
                    res.data.forEach(element => {
                        questionAnswerDiv.innerHTML += `<div class="as-card as-mb-10px as-p-10px">
                                                    <div class="profile">
                                                        <div class="info as-w-100">
                                                            <div class="as-flex as-space-between as-align-center">
                                                                <div>
                                                                    <h4>কোর্স: ${element.course_name}</h4>
                                                                    <h4>বিষয়: ${element.topic_name}</h4>
                                                                </div>
                                                                <div onclick="deleteQuestion(${element.id})">
                                                                    <i class="fas fa-trash as-app-cursor"></i>
                                                                </div>
                                                            </div>
                                                            <div class="as-divider"></div>
                                                            <p class="question"><b>প্রশ্ন: </b>${element.question}?</p>
                                                            <p style="background-color: #fff; padding: 0px; width: 100%" class="answer as-brr-5px"><b>উত্তর: </b>${element.answer ? element.answer : '...'}</p>
                                                        </div>
                                                    </div>
                                                </div>`
                    });
                })
        }

        function deleteQuestion(questionId) {
            if (confirm('আপনি কি নিশ্চিত এই প্রশ্নটি মুছে ফেলতে চান?')) {
                axios.post('/api/asked-question/delete', {
                    question_id: questionId
                }).then(res => {
                    if (res.data.status === 'success') {
                        alert('প্রশ্নটি সফলভাবে মুছে ফেলা হয়েছে।');
                        getAskedQuenstion();
                    } else {
                        alert('কিছু একটা সমস্যা হয়েছে। আবার চেষ্টা করুন।');
                    }
                })
            }
        }
    </script>
@endsection