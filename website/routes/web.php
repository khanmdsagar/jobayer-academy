<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\AdminAuthMiddleware;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Http\Controllers\SiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\bKashController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\DataSeedController;

use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminStudentController;
use App\Http\Controllers\admin\AskedQuestionController;

use App\Models\CourseChapter;
use App\Models\ChapterTopic;
use App\Models\StudentTopic;
use App\Models\Course;
use App\Models\EnrolledCourse;

// bkash payment
Route::get('/bkash/checkout', [bKashController::class, 'create'])->name('bKash-checkout');
Route::get('/bkash/search/{trxId}', [bKashController::class, 'search'])->name('bKash-url-search');
Route::get('/bkash/checkout-url/callback', [bKashController::class, 'callback'])->name('bKash-url-callback');


// website functions
Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/api/get-courses', [SiteController::class, 'getCourses']);
Route::get('/course/{course_slug}', [SiteController::class, 'course_detail'])->name('course-detail');
Route::get('/checkout/{course_id}/{course_slug}', [SiteController::class, 'checkout'])->name('checkout')->middleware(AuthMiddleware::class);

Route::get('/page/{page_slug}', function ($page_slug) {
    $page_content = DB::table('page')->where('page_slug', $page_slug)->first();
    return view('page', compact('page_content'));
});

Route::get('/blog/{blog_slug}', function ($blog_slug) {
    $blog = DB::table('blog')->where('blog_slug', $blog_slug)->first();
    return view('blog_detail', compact('blog'));
})->name('blog_detail');


// Login functions
Route::get('/login/{course_id?}/{course_slug?}/{course_curriculumn?}', function ($course_id = null, $course_slug = null, $course_curriculumn = null) {
    if (Session::has('user_id')) {
        return redirect()->route('home');
    }
    return view('auth', compact('course_id', 'course_slug', 'course_curriculumn'));
})->name('login');

Route::post('/api/login-student', [AuthController::class, 'loginStudent']);
Route::post('/api/check-student', [AuthController::class, 'checkStudent']);
Route::middleware('throttle:300, 1')->post('/api/send-verification-code', [AuthController::class, 'sendVerificationCode']);
Route::post('/api/reset-password', [AuthController::class, 'resetPassword']);

Route::post('/api/register-student', [AuthController::class, 'registerStudent']);

Route::get('/data-seed', [DataSeedController::class, 'data_seed']);



// Student Dashboard functions
Route::middleware([AuthMiddleware::class])->group(function(){

    Route::get('/logout', function (Request $request) {
        Session::forget('user_id');
        return redirect()->route('home');
    })->name('logout');

    Route::get('/dashboard', function () {
        $student_id = Session::get('user_id');
        $student_info = DB::table('student')->where('id', $student_id)->first();
        $student_name = $student_info->student_name;

        $expected_fields = [
            'student_name',
            'student_address',
            'student_division',
            'student_email',
            'student_number',
            'student_birthday',
            'student_profession',
            'student_page_url',
            'student_profile_url',
            'student_password'
        ];

        $filled = 0;

        foreach ($expected_fields as $field) {
            if (!empty($student_info->$field)) {
                $filled++;
            }
        }

        $total = count($expected_fields);
        $profile_percentage = ($filled / $total) * 100;

        return view('dashboard', compact('student_name', 'profile_percentage'));
    })->name('dashboard');

    Route::get('/profile', function () {
        $student_id = Session::get('user_id');

        $student_info = DB::table('student')->where('id', $student_id)->first();
        $division     = $student_info->student_division;
        $district     = $student_info->student_district;
        $profession   = $student_info->student_profession;

        $day   = null;
        $month = null;
        $year  = null;

        if($student_info->student_birthday != ''){
            $parts = explode('-', $student_info->student_birthday);
            $day   = $parts[0];
            $month = $parts[1];
            $year  = $parts[2];
        }

        return view('profile', compact('student_info', 'day', 'month', 'year', 'profession', 'division', 'district'));
    })->name('profile');

    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');

    Route::get('/question-answer', function () {
        return view('question_answer');
    })->name('question-answer');

    Route::get('/exam/{course_id}', function ($course_id) {
        $student_id = Session::get('user_id');
        $student_info = DB::table('student')->where('id', $student_id)->first();
        $student_name = $student_info->student_name;

        return view('exam', compact('student_name', 'course_id'));
    })->name('exam');

    Route::get('/api/get-exam-quiz/{course_id}', [ExamController::class, 'get_exam_quiz']);

    Route::get('/api/get-asked-question', [DashController::class, 'get_asked_question']);
    Route::post('/api/asked-question/delete', [DashController::class, 'delete_asked_question']);

    Route::post('/api/enroll-course', [SiteController::class, 'enrollCourse']);
    Route::get('/api/get-enrolled-course', [SiteController::class, 'getEnrolledCourse']);
    Route::get('/api/get-course-content/{id}', [DashController::class, 'get_course_content']);

    Route::get('/tutorial/{course_id}/{slug?}', [DashController::class, 'tutorial_view'])->name('tutorialview');
    Route::get('/api/get-video-data/{topic_id}', [DashController::class, 'get_video_data']);
    Route::post('/api/mark-as-complete', [DashController::class, 'mark_as_complete']);

    Route::post('/api/get-course-progress', [DashController::class, 'get_course_progress']);
    Route::get('/api/get-ask-question/{topic_id}', [DashController::class, 'get_ask_question']);
    Route::get('/api/get-resource/{course_id}', [DashController::class, 'get_resource']);
    Route::post('/api/submit-qsn', [DashController::class, 'submit_qsn']);

    Route::post('/api/update-student-info', [DashController::class, 'update_student_info']);
    Route::get('/api/get-student-info', [DashController::class, 'get_student_info']);
    Route::post('/api/update-password', [DashController::class, 'update_password']);
    Route::get('/api/topic-is-completed/{course_id}/{topic_id}', [DashController::class, 'topic_is_completed']);
    Route::post('/api/submit-review', [DashController::class, 'submit_review']);
    Route::post('/api/is-reviewed', [DashController::class, 'is_reviewed']);

    Route::post('/api/is-student-enrolled', [DashController::class, 'is_student_enrolled']);
});

Route::get('/api/check-login', [SiteController::class, 'check_login']);
Route::get('/api/check-login-isenrolled/{course_id}', [SiteController::class, 'check_login_isenrolled']);
Route::get('/api/get-review/{course_id?}', [SiteController::class, 'get_review']);
Route::get('/api/get-course-curriculum/{course_id}', [SiteController::class, 'get_course_curriculum']);
Route::get('/api/get-site-gallery', [SiteController::class, 'get_site_gallery']);
Route::get('/api/get-blog', [SiteController::class, 'get_blog']);
Route::post('/api/update-payment-amount', [SiteController::class, 'update_payment_amount']);
Route::post('/api/check-coupon', [SiteController::class, 'check_coupon']);
Route::get('/api/get-question-answer/{course_id}', [SiteController::class, 'get_question_answer']);
Route::post('/api/get-device-info', [AuthController::class, 'getDeviceInfo']);





// admin functions
Route::get('/admin', function () {
    $is_admin = DB::table('admin')->where('admin_role', 'admin')->count();
    if (Session::has('admin_id')) {
        return redirect()->route('admin.dashboard');
    }
    return view('admin.admin_auth', compact('is_admin'));
})->name('admin');

Route::post('/admin/login', [AdminAuthController::class, 'admin_login']);
Route::post('/admin/register', [AdminAuthController::class, 'admin_register']);


Route::middleware([AdminAuthMiddleware::class])->group(function(){
    Route::get('/admin/dashboard', function () {
        return view('admin.admin_dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/student', function () {
        return view('admin.admin_student');
    });

    Route::get('/admin/category', function () {
        return view('admin.admin_category');
    });

    Route::get('/admin/course', function () {
        return view('admin.admin_course');
    });

    Route::get('/admin/asked-question', function () {
        return view('admin.admin_asked_question');
    });

    Route::get('/admin/student/data', [AdminController::class, 'get_student_data']);
    Route::post('/admin/student/add', [AdminController::class, 'add_student_info']);
    Route::post('/admin/student/delete', [AdminController::class, 'delete_student_info']);
    Route::get('/admin/student/info/{student_id}', [AdminStudentController::class, 'student_info']);
    Route::post('/admin/student/edit', [AdminStudentController::class, 'edit_student_info']);
    Route::post('/admin/student/enroll', [AdminController::class, 'enroll_student']);
    Route::post('/admin/student/unenroll', [AdminController::class, 'unenroll_student']);
    Route::get('/admin/student/search/{search_data}', [AdminController::class, 'search_student_data']);

    Route::get('/admin/download-enrolled-student-data', [AdminController::class, 'download_enrolled_student_data']);
    Route::get('/admin/download-unenrolled-student-data', [AdminController::class, 'download_unenrolled_student_data']);

    Route::get('/admin/course/data', [AdminController::class, 'get_course_data']);
    Route::get('/admin/filter-student/{course_value}', [AdminController::class, 'filter_student']);
    Route::get('/admin/download-student-data', [AdminController::class, 'download_student_data']);
    Route::get('/admin/download-course-student-data/{course_id}', [AdminController::class, 'download_course_student_data']);

    Route::post('/admin/category/add', [AdminController::class, 'add_category']);
    Route::get('/admin/category/data', [AdminController::class, 'get_category_data']);
    Route::post('/admin/category/delete', [AdminController::class, 'delete_category']);
    Route::post('/admin/category/edit', [AdminController::class, 'edit_category']);

    Route::get('/admin/instructor', function () {
        return view('admin.admin_instructor');
    });
    Route::get('/admin/instructor/get', [AdminController::class, 'get_instructor_data']);
    Route::post('/admin/instructor/add', [AdminController::class, 'add_instructor']);
    Route::post('/admin/instructor/delete', [AdminController::class, 'delete_instructor']);
    Route::post('/admin/instructor/edit', [AdminController::class, 'edit_instructor']);

    Route::get('/admin/course', function () {
        return view('admin.admin_course');
    });
    Route::post('/admin/course/add', [AdminController::class, 'add_course']);
    Route::post('/admin/course/add/thumbnail', [AdminController::class, 'add_course_thumbnail']);
    Route::get('/admin/course/get', [AdminController::class, 'get_course_data2']);
    Route::post('/admin/course/delete', [AdminController::class, 'delete_course']);
    Route::post('/admin/course/edit', [AdminController::class, 'edit_course']);
    Route::get('/admin/course/info/{course_id}', [AdminController::class, 'course_info']);

    Route::post('/admin/chapter/add', [AdminController::class, 'add_chapter']);
    Route::get('/admin/chapter/get/{course_id}', [AdminController::class, 'get_chapter']);
    Route::post('/admin/chapter/delete', [AdminController::class, 'delete_chapter']);
    Route::post('/admin/chapter/edit', [AdminController::class, 'edit_chapter']);
    
    Route::get('/admin/chapter/topic/get/{course_id}/{chapter_id}', [AdminController::class, 'get_chapter_topic']);
    Route::post('/admin/chapter/topic/add', [AdminController::class, 'add_chapter_topic']);
    Route::post('/admin/chapter/topic/delete', [AdminController::class, 'delete_chapter_topic']);
    Route::post('/admin/chapter/topic/edit', [AdminController::class, 'edit_chapter_topic']);

    //question and answer
    Route::get('/admin/get-asked-question', [AskedQuestionController::class, 'get_asked_question']);
    Route::post('/admin/asked-question/delete', [AskedQuestionController::class, 'delete_asked_question']);
    Route::post('/admin/asked-question/reply', [AskedQuestionController::class, 'reply_asked_question']);


    Route::get('/admin/logout', function (Request $request) {
        Session::forget('admin_id');
        return redirect()->route('admin');
    })->name('admin.logout');
});