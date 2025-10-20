@extends('layouts.app')

@section('title', 'Jobayer Academy - Dashboard')

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
                        <i class="fas fa-box as-mr-10px"></i>ড্যাশবোর্ড</div>
                </div>
                <div>
                    <div class="as-app-cursor as-hover as-p-10px as-brr-5px" onclick="window.location.href = '/profile'"><i
                            class="fas fa-user as-mr-10px"></i>প্রোফাইল</div>
                </div>
                <div>
                    <div class="as-app-cursor as-hover as-p-10px as-brr-5px"
                        onclick="window.location.href = '/question-answer'"><i class="fas fa-question as-mr-10px"></i>প্রশ্ন
                        ও উত্তর</div>
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

            <div class="container as-card">
                <!-- Header -->
                <div class="header">
                    <div class="logo">{{ $site_data[0]->site_name }}</div>
                    <div class="user-info">
                        <div class="user-name">{{ $student_name }}</div>
                        <p>শীক্ষার্থী</p>
                    </div>
                </div>

                <!-- Welcome Screen -->
                <div id="welcome-screen" class="screen active">
                    <div class="welcome-screen" id="welcome-screen1" style="display: none;">
                        <h2>কুইজ চ্যালেঞ্জে স্বাগতম</h2>
                        <p>কুইজের মাধ্যমে আপনার জ্ঞান পরীক্ষা করুন! প্রতিটি প্রশ্নের উত্তর দিতে আপনার কাছে থাকবে
                            নির্দিষ্ট সময়, অথবা আপনি "পরবর্তী" বোতামে ক্লিক করে এগিয়ে যেতে পারেন।
                            আপনি একবারই পরীক্ষা দিতে পারবেন। পরীক্ষায় উত্তীর্ণ হতে কমপক্ষে ৭০% মার্কস পেতে হবে। 
                            পরীক্ষা চলাকালীন সময়ে পেজ রিলোড নেয়া, অন্য ট্যাব বা অ্যাপ ওপেন করলে পরীক্ষা বাতিল হবে।</p>
                        <p>মোট <span id="total-questions"></span>টি প্রশ্ন রয়েছে। শুভকামনা!</p>
                        <button id="start-btn" class="btn">কুইজ শুরু করুন</button>
                    </div>
                    <div id="welcome-screen2" style="text-align: center; display: none;">
                        <h2>নোটিশ</h2>
                        <p>
                            আপনি ইতমধ্যে পরীক্ষায় অংশগ্রহণ করেছেন। পুনরায় পরীক্ষা দিতে চাইলে কর্তৃপক্ষের অনুমতি নিন। 
                        </p>
                        <button id="dashboard-btn" class="btn as-mt-10px">ড্যাশবোর্ডে যান</button>
                    </div>
                </div>

                <!-- Quiz Screen -->
                <div id="quiz-screen" class="screen">
                    <div class="quiz-content">
                        <div class="question-section">
                            <div class="question-number">প্রশ্ন <span id="current-q">1</span> মোট <span
                                    id="total-q">5</span> টির মধ্যে</div>
                            <div id="question" class="question">প্রশ্ন এখানে প্রদর্শিত হবে</div>
                            <div id="options" class="options">
                                <!-- বিকল্পগুলো স্বয়ংক্রিয়ভাবে এখানে যুক্ত হবে -->
                            </div>
                            <div class="button-container">
                                <button id="next-btn" class="btn" disabled>পরবর্তী</button>
                            </div>
                        </div>
                        <div class="timer-section">
                            <div class="timer-label">অবশিষ্ট সময়</div>
                            <div class="timer-circle">
                                <div id="timer" class="timer"></div>
                            </div>
                            <div class="progress-section">
                                <div class="progress-label">
                                    <span>অগ্রগতি</span>
                                    <span><span id="progress-percent">0</span>%</span>
                                </div>
                                <div class="progress-bar">
                                    <div id="progress" class="progress"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Result Screen -->
                <div id="result-screen" class="screen">
                    <div class="result-screen">
                        <h2>কুইজ সম্পন্ন হয়েছে!</h2>
                        <div class="score-circle">
                            <div id="score" class="score">0/5</div>
                        </div>
                        <div class="feedback" id="feedback">দারুন করেছেন!</div>
                        <div class="question-review" id="question-review">
                            <!-- প্রশ্নগুলো এখানে স্বয়ংক্রিয়ভাবে যুক্ত হবে -->
                        </div>
                        <button id="dashboard-btn" class="btn">ড্যাশবোর্ডে যান</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .container {
            background-color: white;
            border-radius: 5px;
            overflow: hidden;
        }

        .header {
            background: var(--primary-color);
            color: white;
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .user-title {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .screen {
            display: none;
            padding: 30px;
        }

        .active {
            display: block;
        }

        .welcome-screen {
            text-align: center;
        }

        .welcome-screen h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.8rem;
        }

        .welcome-screen p {
            color: #555;
            margin-bottom: 25px;
            line-height: 1.6;
            font-size: 1.1rem;
        }

        .btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 35px;
            font-size: 1.1rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
        }

        .btn:hover {
            transform: translateY(-3px);
            background: var(--secondary-color);
            color: var(--primary-color)
        }

        .btn:disabled {
            background: #cccccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .quiz-content {
            display: flex;
            gap: 30px;
        }

        .question-section {
            flex: 1;
        }

        .question-number {
            color: #1a2a6c;
            font-size: 1rem;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .question {
            font-size: 1.4rem;
            color: #333;
            margin-bottom: 25px;
            line-height: 1.4;
        }

        .options {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 25px;
        }

        .option {
            background-color: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .option:hover {
            background-color: #e9ecef;
            transform: translateX(5px);
        }

        .option.selected {
            background-color: #d1e7ff;
            border-color: #1a2a6c;
        }

        .option.correct {
            background-color: #d4edda;
            border-color: #28a745;
        }

        .option.wrong {
            background-color: #f8d7da;
            border-color: #dc3545;
        }

        .timer-section {
            width: 200px;
            text-align: center;
        }

        .timer-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
            position: relative;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .timer {
            font-size: 2.5rem;
            font-weight: bold;
            color: white;
        }

        .timer-label {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .progress-section {
            margin-top: 20px;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 0.9rem;
            color: var(--primary-color);
        }

        .progress-bar {
            height: 8px;
            background-color: #e9ecef;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: var(--primary-color);
            width: 0%;
            transition: width 0.5s;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .result-screen {
            text-align: center;
        }

        .result-screen h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .score-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .score {
            font-size: 2.5rem;
            font-weight: bold;
            color: white;
        }

        .feedback {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .question-review {
            text-align: left;
            margin-top: 30px;
            max-height: 300px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .review-item {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .review-question {
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .correct-answer {
            color: #28a745;
            font-weight: bold;
        }

        .wrong-answer {
            color: #dc3545;
            text-decoration: line-through;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .pulse {
            animation: pulse 1s infinite;
        }

        @media (max-width: 768px) {
            .quiz-content {
                flex-direction: column;
            }

            .timer-section {
                width: 100%;
                order: -1;
                margin-bottom: 20px;
            }

            .timer-circle {
                width: 120px;
                height: 120px;
            }

            .timer {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .header {
                padding: 20px;
                flex-direction: column;
                text-align: center;
            }

            .user-info {
                text-align: center;
                margin-top: 10px;
            }

            .screen {
                padding: 20px;
            }

            .question {
                font-size: 1.2rem;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Quiz questions array - will be populated from API
        let quizData = [];

        // DOM elements
        const welcomeScreen = document.getElementById('welcome-screen');
        const quizScreen = document.getElementById('quiz-screen');
        const resultScreen = document.getElementById('result-screen');
        const startBtn = document.getElementById('start-btn');
        const nextBtn = document.getElementById('next-btn');
        const dashboardBtn = document.getElementById('dashboard-btn');
        const questionElement = document.getElementById('question');
        const optionsElement = document.getElementById('options');
        const timerElement = document.getElementById('timer');
        const progressElement = document.getElementById('progress');
        const progressPercent = document.getElementById('progress-percent');
        const currentQElement = document.getElementById('current-q');
        const totalQElement = document.getElementById('total-q');
        const totalQuestionsElement = document.getElementById('total-questions');
        const scoreElement = document.getElementById('score');
        const feedbackElement = document.getElementById('feedback');
        const questionReviewElement = document.getElementById('question-review');

        // Quiz state variables
        let currentQuestion = 0;
        let score = 0;
        let timer;
        let timeLeft;
        let userAnswers = [];
        let answerSelected = false;
        let quizInitialized = false;

        isUserAlreadyParticipated();
        function isUserAlreadyParticipated() {
            axios.get('/api/check-exam-participation/' + {{$course_id}})
                .then(response => {
                    const participated = response.data.has_participated;
                    console.log('User participation status:', participated);

                    if (participated) {
                        document.getElementById('welcome-screen1').style.display = 'none';
                        document.getElementById('welcome-screen2').style.display = 'block';
                    }
                    else {
                        document.getElementById('welcome-screen1').style.display = 'block';
                        document.getElementById('welcome-screen2').style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error checking exam participation:', error);
                });
        }

        // Fetch quiz data from API
        function fetchQuizData() {
            // Show loading state
            startBtn.disabled = true;
            startBtn.textContent = 'ডেটা লোড হচ্ছে...';

            axios.get('/api/get-exam-quiz/' + {{$course_id}})
                .then(response => {
                    const apiData = response.data;
                    if (apiData && apiData.length > 0) {
                        quizData = apiData;
                        initializeQuiz();
                        startBtn.disabled = false;
                        startBtn.textContent = 'কুইজ শুরু করুন';
                    } else {
                        // No data from API
                        startBtn.disabled = true;
                        startBtn.textContent = 'কোনো প্রশ্ন পাওয়া যায়নি';
                        console.error('No quiz data received from API');
                    }
                })
                .catch(error => {
                    console.error('Error fetching quiz data:', error);
                    // API failed
                    startBtn.disabled = true;
                    startBtn.textContent = 'ডেটা লোড করতে সমস্যা হয়েছে';
                });
        }

        // Initialize the quiz with dynamic question count from quizData.length
        function initializeQuiz() {
            if (quizData.length === 0) {
                console.error('No quiz data available');
                return;
            }

            const totalQuestions = quizData.length;
            totalQElement.textContent = totalQuestions;
            totalQuestionsElement.textContent = totalQuestions;
            scoreElement.textContent = `0/${totalQuestions}`;

            quizInitialized = true;
            //console.log('Quiz initialized with', totalQuestions, 'questions');
        }

        // Start the quiz
        startBtn.addEventListener('click', function () {
            if (!quizInitialized || quizData.length === 0) {
                alert('কুইজ ডেটা লোড হচ্ছে, অনুগ্রহ করে অপেক্ষা করুন...');
                return;
            }
            startQuiz();

            axios.post('/api/mark-exam-started/' + {{$course_id}})
                .then(response => {
                    console.log('Exam started marked successfully');
                })
                .catch(error => {
                    console.error('Error marking exam started:', error);
                });
        });

        // Next question button
        nextBtn.addEventListener('click', nextQuestion);

        // Restart quiz button - redirect to dashboard
        dashboardBtn.addEventListener('click', function () {
            window.location.href = '/dashboard';
        });

        function startQuiz() {
            if (quizData.length === 0) {
                alert('কোনো প্রশ্ন পাওয়া যায়নি!');
                return;
            }

            welcomeScreen.classList.remove('active');
            quizScreen.classList.add('active');
            currentQuestion = 0;
            score = 0;
            userAnswers = [];
            answerSelected = false;
            showQuestion();
            startTimer();
        }

        function showQuestion() {
            if (currentQuestion >= quizData.length) {
                showResults();
                return;
            }

            // Get current question data
            const question = quizData[currentQuestion];

            // Set timer for current question
            timeLeft = question.duration || 15; // Default to 15 seconds if not specified
            timerElement.textContent = timeLeft;
            timerElement.classList.remove('pulse');

            // Update progress
            const progressValue = (currentQuestion / quizData.length) * 100;
            progressElement.style.width = `${progressValue}%`;
            progressPercent.textContent = Math.round(progressValue);
            currentQElement.textContent = currentQuestion + 1;

            // Display question
            questionElement.textContent = question.question;

            // Clear previous options
            optionsElement.innerHTML = '';

            // Create options using the specified data structure
            for (let i = 1; i <= 4; i++) {
                const optionKey = `option${i}`;
                if (question[optionKey]) {
                    const optionElement = document.createElement('div');
                    optionElement.classList.add('option');
                    optionElement.textContent = question[optionKey];
                    optionElement.dataset.option = optionKey;
                    optionElement.addEventListener('click', () => selectOption(optionKey));
                    optionsElement.appendChild(optionElement);
                }
            }

            // Reset selection state and disable next button
            answerSelected = false;
            nextBtn.disabled = true;
        }

        function selectOption(selectedOption) {
            if (answerSelected) return; // Prevent multiple selections

            answerSelected = true;

            // Remove selected class from all options
            const options = document.querySelectorAll('.option');
            options.forEach(option => option.classList.remove('selected'));

            // Add selected class to clicked option
            const selectedElement = document.querySelector(`[data-option="${selectedOption}"]`);
            if (selectedElement) {
                selectedElement.classList.add('selected');
            }

            // Store user's answer
            userAnswers[currentQuestion] = selectedOption;

            // Check if answer is correct and apply appropriate styling
            const correctAnswer = quizData[currentQuestion].correct;
            if (selectedOption === correctAnswer) {
                if (selectedElement) {
                    selectedElement.classList.add('correct');
                }
            } else {
                if (selectedElement) {
                    selectedElement.classList.add('wrong');
                }
                // Also show the correct answer
                const correctElement = document.querySelector(`[data-option="${correctAnswer}"]`);
                if (correctElement) {
                    correctElement.classList.add('correct');
                }
            }

            // Enable next button
            nextBtn.disabled = false;

            // Stop the timer since user has answered
            clearInterval(timer);
        }

        function startTimer() {
            // Clear any existing timer
            if (timer) {
                clearInterval(timer);
            }

            timer = setInterval(() => {
                timeLeft--;
                timerElement.textContent = timeLeft;

                // Add pulse animation when time is running out
                if (timeLeft <= 3) {
                    timerElement.classList.add('pulse');
                }

                if (timeLeft <= 0) {
                    clearInterval(timer);

                    // If no answer selected, mark as unanswered
                    if (userAnswers[currentQuestion] === undefined) {
                        userAnswers[currentQuestion] = null;
                    }

                    // Move to next question after a brief delay to show the answer
                    setTimeout(nextQuestion, 1000);
                }
            }, 1000);
        }

        function nextQuestion() {
            // Check if answer is correct
            if (userAnswers[currentQuestion] === quizData[currentQuestion].correct) {
                score++;
            }

            // Move to next question or show results
            currentQuestion++;
            if (currentQuestion < quizData.length) {
                showQuestion();
                startTimer();
            } else {
                showResults();
            }
        }

        function showResults() {
            quizScreen.classList.remove('active');
            resultScreen.classList.add('active');

            // Display score
            scoreElement.textContent = `${score}/${quizData.length}`;

            // Display feedback based on score
            const percentage = (score / quizData.length) * 100;

            axios.post('/api/submit-exam-result/' + {{$course_id}}, {
                score: percentage,
            })

            if (percentage === 100) {
                feedbackElement.textContent = "অসাধারণ! পারফেক্ট স্কোর! আপনি বিষয়টি সম্পূর্ণরূপে আয়ত্ত করেছেন।";
            } else if (percentage >= 70) {
                feedbackElement.textContent = "দারুন কাজ করেছেন! আপনার বিষয়বস্তুর উপর ভালো ধারণা রয়েছে।";
            } else if (percentage >= 50) {
                feedbackElement.textContent = "ভালো চেষ্টা! বিষয়বস্তুটি আবার রিভিউ করুন এবং আবার চেষ্টা করুন।";
            } else {
                feedbackElement.textContent = "চেষ্টা চালিয়ে যান! পরেরবার আরও ভালো করবেন।";
            }

            // Display question review
            questionReviewElement.innerHTML = '';
            quizData.forEach((question, index) => {
                const reviewItem = document.createElement('div');
                reviewItem.classList.add('review-item');

                const questionText = document.createElement('div');
                questionText.classList.add('review-question');
                questionText.textContent = `${index + 1}. ${question.question}`;
                reviewItem.appendChild(questionText);

                const userAnswer = userAnswers[index];
                const correctAnswer = question.correct;

                // Show correct answer
                const correctAnswerElement = document.createElement('div');
                correctAnswerElement.classList.add('correct-answer');
                correctAnswerElement.textContent = `সঠিক উত্তর: ${question[correctAnswer]}`;
                reviewItem.appendChild(correctAnswerElement);

                // Show user's answer if different from correct answer
                if (userAnswer !== correctAnswer) {
                    const userAnswerElement = document.createElement('div');
                    userAnswerElement.classList.add('wrong-answer');
                    if (userAnswer === null || userAnswer === undefined) {
                        userAnswerElement.textContent = "আপনার উত্তর: কোনো উত্তর দেওয়া হয়নি (সময় শেষ)";
                    } else {
                        userAnswerElement.textContent = `আপনার উত্তর: ${question[userAnswer]}`;
                    }
                    reviewItem.appendChild(userAnswerElement);
                }

                questionReviewElement.appendChild(reviewItem);
            });
        }

        // Initialize the quiz when page loads
        document.addEventListener('DOMContentLoaded', function () {
            fetchQuizData();
        });
    </script>
@endsection