<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\EnrolledCourse;
use App\Models\Student;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    //student comment operations
    function get_student_comment_option_data()
    {
        return DB::table('student_comment_option')->orderBy('id', 'DESC')->get();
    }

    function add_student_comment_option(Request $request)
    {
        $student_comment_option_title = strip_tags(trim($request->input('student_comment_option_title')));

        $result = DB::table('student_comment_option')->insert([
            'student_comment_option_title' => $student_comment_option_title,
        ]);

        if ($result) {
            return response()->json(['status' => 200, "message" => 'Student comment option added successfully']);
        } 
        else {
            return response()->json(['status' => 404, "message" => 'Student comment option could not be added']);
        }
    }

    function delete_student_comment_option(Request $request)
    {
        $id = strip_tags(trim($request->input('id')));

        $result = DB::table('student_comment_option')->where('id', $id)->delete();

        if ($result) {
            return response()->json(['status' => 200, "message" => 'Student comment option deleted successfully']);
        } 
        else {
            return response()->json(['status' => 404, "message" => 'Student comment option could not be deleted']);
        }
    }

    //chapter operations
    function get_chapter_topic($course_id, $chapter_id)
    {
        return DB::table('chapter_topic')->where('chapter_id', $chapter_id)->where('course_id', $course_id)->get();
    }

    function get_chapter($course_id)
    {
        return DB::table('course_chapter')->where('course_id', $course_id)->orderBy('id', 'DESC')->get();
    }
    function add_chapter(Request $request)
    {
        $course_id = strip_tags(trim($request->input('course_id')));
        $chapter_name = strip_tags(trim($request->input('chapter_name')));
        $is_chapter = DB::table('course_chapter')->where('chapter_name', $chapter_name)->where('course_id', $course_id)->count();

        if ($is_chapter > 0) {
            return response()->json(['status' => 404, "message" => 'Chapter already exists']);
        } else {
            try {
                $result = DB::table('course_chapter')->insert([
                    'chapter_name' => $chapter_name,
                    'course_id' => $course_id,
                ]);
                if ($result) {
                    return response()->json(['status' => 200, "message" => 'Chapter added successfully']);
                } else {
                    return response()->json(['status' => 404, "message" => 'Chapter could not be added']);
                }
            } catch (\Exception $e) {
                return response()->json(['status' => 404, "message" => $e->getMessage()]);
            }
        }
    }

    function delete_chapter(Request $request)
    {
        $chapter_id = strip_tags(trim($request->input('chapter_id')));
        $result = DB::table('course_chapter')->where('id', $chapter_id)->delete();

        if ($result) {
            return response()->json(['status' => 200, "message" => 'Chapter deleted successfully']);
        } else {
            return response()->json(['status' => 404, "message" => 'Chapter could not be deleted']);
        }
    }

    //chapter topic operations
    function add_chapter_topic(Request $request)
    {
        $course_id = strip_tags(trim($request->input('course_id')));
        $chapter_id = strip_tags(trim($request->input('chapter_id')));
        $topic_name = strip_tags(trim($request->input('topic_name')));
        $topic_video = strip_tags(trim($request->input('topic_video')));
        $topic_is_free = strip_tags(trim($request->input('topic_is_free')));

        $result = DB::table('chapter_topic')->insert([
            'course_id' => $course_id,
            'chapter_id' => $chapter_id,
            'topic_name' => $topic_name,
            'topic_video' => $topic_video,
            'topic_is_free' => $topic_is_free,
        ]);

        if ($result) {
            return response()->json(['status' => 200, "message" => 'Topic added successfully']);
        } else {
            return response()->json(['status' => 404, "message" => 'Topic could not be added']);
        }
    }

    function delete_chapter_topic(Request $request)
    {
        $topic_id = strip_tags(trim($request->input('topic_id')));

        $result = DB::table('chapter_topic')->where('id', $topic_id)->delete();

        if ($result) {
            return response()->json(['status' => 200, "message" => 'Topic deleted successfully']);
        } else {
            return response()->json(['status' => 404, "message" => 'Topic could not be deleted']);
        }
    }

    function edit_chapter_topic(Request $request)
    {
        $topic_id = strip_tags(trim($request->input('topic_id')));
        $topic_name = strip_tags(trim($request->input('topic_name')));
        $topic_video = strip_tags(trim($request->input('topic_video')));
        $topic_status = strip_tags(trim($request->input('topic_status')));

        try {
            $result = DB::table('chapter_topic')->where('id', $topic_id)->update([
                'topic_name' => $topic_name,
                'topic_video' => $topic_video,
                'topic_is_free' => $topic_status,
            ]);

            if ($result) {
                return response()->json(['status' => 200, "message" => 'Topic updated successfully']);
            } else {
                return response()->json(['status' => 404, "message" => 'Topic could not be updated']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 404, "message" => $e->getMessage()]);
        }
    }

    //course operations
    function course_info($course_id)
    {
        $course_data = Course::with('course_category')->with('instructor')->where('id', $course_id)->first();
        return view('admin.admin_course_info', compact('course_data'));
    }

    function add_course_thumbnail(Request $request)
    {
        $path = $request->file('course_thumbnail')->store('course', 'public');
        return $path;
    }

    function add_course(Request $request)
    {
        $course_name = strip_tags(trim($request->input('course_name')));
        $course_thumbnail = strip_tags(trim($request->input('course_thumbnail')));
        $course_slug = strip_tags(trim($request->input('course_slug')));
        $course_tagline = strip_tags(trim($request->input('course_tagline')));
        $course_regular_fee = strip_tags(trim($request->input('course_regular_fee')));
        $course_selling_fee = strip_tags(trim($request->input('course_selling_fee')));
        $course_duration = strip_tags(trim($request->input('course_duration')));
        $course_level = strip_tags(trim($request->input('course_level')));
        $course_status = strip_tags(trim($request->input('course_status')));
        $course_category = strip_tags(trim($request->input('course_category')));
        $course_instructor = strip_tags(trim($request->input('course_instructor')));
        $course_description = $request->input('course_description');

        $is_course = DB::table('course')->where('course_name', $course_name)->count();

        if ($is_course > 0) {
            return response()->json(['status' => 404, "message" => 'Course already exists']);
        } else {
            try {
                $result = DB::table('course')->insert([
                    'course_name' => $course_name,
                    'course_slug' => $course_slug,
                    'course_status' => $course_status,
                    'category_id' => $course_category,
                    'instructor_id' => $course_instructor,
                    'course_description' => $course_description,
                    'course_thumbnail' => $course_thumbnail,
                    'course_tagline' => $course_tagline,
                    'course_fee' => $course_regular_fee,
                    'course_selling_fee' => $course_selling_fee,
                    'course_duration' => $course_duration,
                    'course_level' => $course_level,
                    'created_at' => Carbon::now(),
                ]);

                if ($result) {
                    return response()->json(['status' => 200, "message" => 'Course added successfully']);
                } else {
                    return response()->json(['status' => 404, "message" => 'Course could not be added']);
                }
            } catch (\Exception $e) {
                return response()->json(['status' => 404, "message" => $e->getMessage()]);
            }
        }
    }

    function get_course_data2()
    {
        return Course::with('course_category')->with('instructor')->withCount('enrolled_course')->get();
        //return EnrolledCourse::with('course')->get();
    }

    function delete_course(Request $request)
    {
        $course_id        = strip_tags(trim($request->input('course_id')));
        $course_thumbnail = strip_tags(trim($request->input('course_thumbnail')));

        $result = DB::table('course')->where('id', $course_id)->delete();

        Storage::disk('public')->delete($course_thumbnail);

        if ($result) {
            return response()->json(['status' => 200, "message" => 'Course deleted successfully']);
        } else {
            return response()->json(['status' => 404, "message" => 'Course could not be deleted']);
        }
    }

    function edit_course(Request $request)
    {
        $course_id = strip_tags(trim($request->input('course_id')));
        $course_name = strip_tags(trim($request->input('edited_course_name')));
        $course_slug = strip_tags(trim($request->input('edited_course_slug')));
        $course_thumbnail = strip_tags(trim($request->input('edited_course_thumbnail')));
        $course_tagline = strip_tags(trim($request->input('edited_course_tagline')));
        $course_description = $request->input('edited_course_description');
        $course_regular_fee = strip_tags(trim($request->input('edited_course_regular_fee')));
        $course_selling_fee = strip_tags(trim($request->input('edited_course_selling_fee')));
        $course_duration = strip_tags(trim($request->input('edited_course_duration')));
        $course_level = strip_tags(trim($request->input('edited_course_level')));
        $course_status = strip_tags(trim($request->input('edited_course_status')));
        $course_category = strip_tags(trim($request->input('edited_course_category')));
        $course_instructor = strip_tags(trim($request->input('edited_course_instructor')));

        try {
            $result = DB::table('course')->where('id', $course_id)->update([
                'course_name' => $course_name,
                'course_slug' => $course_slug,
                'course_thumbnail' => $course_thumbnail,
                'course_tagline' => $course_tagline,
                'course_description' => $course_description,
                'course_fee' => $course_regular_fee,
                'course_selling_fee' => $course_selling_fee,
                'course_duration' => $course_duration,
                'course_level' => $course_level,
                'course_status' => $course_status,
                'category_id' => $course_category,
                'instructor_id' => $course_instructor,
                'created_at' => Carbon::now(),
            ]);

            if ($result) {
                return response()->json(['status' => 200, "message" => 'Course updated successfully']);
            } else {
                return response()->json(['status' => 404, "message" => 'Course could not be updated']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 404, "message" => $e->getMessage()]);
        }
    }

    //instructor operations
    function get_instructor_data()
    {
        return DB::table('instructor')->get();
    }

    //category operations
    function add_category(Request $request)
    {
        $category_name = strip_tags(trim($request->input('category_name')));
        $is_category = DB::table('course_category')->where('category_name', $category_name)->count();

        if ($is_category > 0) {
            return response()->json(['status' => 404, "message" => 'Category already exists']);
        } else {
            $result = DB::table('course_category')->insert([
                'category_name' => $category_name,
                'category_slug' => Str::slug($category_name),
                'category_image' => '',
                'created_at' => Carbon::now(),
            ]);

            if ($result) {
                return response()->json(['status' => 200, "message" => 'Category added successfully']);
            } else {
                return response()->json(['status' => 404, "message" => 'Category could not be added']);
            }
        }
    }

    function get_category_data()
    {
        return DB::table('course_category')->get();
    }

    function delete_category(Request $request)
    {
        $category_id = strip_tags(trim($request->input('category_id')));
        $result = DB::table('course_category')->where('id', $category_id)->delete();

        if ($result) {
            return response()->json(['status' => 200, "message" => 'Category deleted successfully']);
        } else {
            return response()->json(['status' => 404, "message" => 'Category could not be deleted']);
        }
    }

    function edit_category(Request $request)
    {
        $category_id = strip_tags(trim($request->input('category_id')));
        $category_name = strip_tags(trim($request->input('category_name')));
        $category_slug = Str::slug($category_name);

        $result = DB::table('course_category')->where('id', $category_id)->update([
            'category_name' => $category_name,
            'category_slug' => $category_slug,
            'category_image' => '',
        ]);

        if ($result) {
            return response()->json(['status' => 200, "message" => 'Category updated successfully']);
        } else {
            return response()->json(['status' => 404, "message" => 'Category could not be updated']);
        }
    }

    //student operations
    function get_student_data()
    {
        $student_data = DB::table('student')->orderBy('id', 'desc')->get();
        return response()->json($student_data);
    }

    function search_student_data($search_data)
    {
        $search_data2 = strip_tags(trim($search_data));

        if (is_numeric($search_data2)) {
            $student_data = DB::table('student')->where('student_number', 'like', '%' . $search_data2 . '%')->get();
            return response()->json($student_data);
        } else {
            $student_data = DB::table('student')->where('student_name', 'like', '%' . $search_data2 . '%')->get();
            return response()->json($student_data);
        }
    }

    //filter student
    function filter_student($course_value, $filter_date_start = null, $filter_date_end = null)
    {
        if ($course_value == 'enrolled') {
            return DB::table('student')->where('student_enrolled_course', '!=', 0)->get();
        } 
        else if ($course_value == 'unenrolled') {
            return DB::table('student')->where('student_enrolled_course', 0)->get();
        } 
        else if ($course_value != '' && $filter_date_start != '' && $filter_date_end != '') {
            $results = DB::select("
                        SELECT enrolled_course.*, student.*
                        FROM enrolled_course
                        JOIN student ON student.id = enrolled_course.student_id
                        WHERE enrolled_course.course_id = ?
                        AND enrolled_course.enrolled_date > ?
                        AND enrolled_course.enrolled_date < ?
                        ORDER BY enrolled_course.id DESC
                    ", [$course_value, $filter_date_start, $filter_date_end]);
            return $results;
        } 
        else {
            try {
                return EnrolledCourse::with('student')->where('course_id', $course_value)->orderBy('enrolled_course.id', 'DESC')->get();
            } catch (\Exception $e) {
                return response()->json(['status' => 404, "message" => $e->getMessage()]);
            }
        }
    }

    //download student data
    function download_course_student_data($course_id)
    {
        $data = EnrolledCourse::with('student')->where('course_id', $course_id)->get();

        $filename = 'course_students_' . $data[0]->course->course_slug . '_' . date('Y-m-d') . '.csv';

        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"$filename\""];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Number',
                'Address',
                'Division',
                'District',
                'Profession',
                'Note',
                'Birthday',
                'Page',
                'Profile',
                'Enrolled Course',
                'Enrollment Date'
            ]);

            foreach ($data as $enrollment) {
                fputcsv($file, [
                    $enrollment->student->id,
                    $enrollment->student->student_name,
                    $enrollment->student->student_email,
                    $enrollment->student->student_number,
                    $enrollment->student->student_address,
                    $enrollment->student->student_division,
                    $enrollment->student->student_district,
                    $enrollment->student->student_profession,
                    $enrollment->student->student_note,
                    $enrollment->student->student_birthday,
                    $enrollment->student->student_page_url,
                    $enrollment->student->student_profile_url,
                    $enrollment->student->student_enrolled_course,
                    $enrollment->student->created_at
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    function download_unenrolled_student_data()
    {
        $data = DB::table('student')->where('student_enrolled_course', 0)->get();

        $filename = 'unenrollments_' . date('Y-m-d') . '.csv';

        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"$filename\""];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Number',
                'Address',
                'Division',
                'District',
                'Profession',
                'Note',
                'Birthday',
                'Page',
                'Profile',
                'Enrolled Course',
                'Enrollment Date'
            ]);

            foreach ($data as $enrollment) {
                fputcsv($file, [
                    $enrollment->id,
                    $enrollment->student_name,
                    $enrollment->student_email,
                    $enrollment->student_number,
                    $enrollment->student_address,
                    $enrollment->student_division,
                    $enrollment->student_district,
                    $enrollment->student_profession,
                    $enrollment->student_note,
                    $enrollment->student_birthday,
                    $enrollment->student_page_url,
                    $enrollment->student_profile_url,
                    $enrollment->student_enrolled_course,
                    $enrollment->created_at
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    function download_enrolled_student_data()
    {
        // Get the data with relationships
        $data = EnrolledCourse::with(['student', 'course'])->get();

        // Define CSV filename
        $filename = 'enrollments_' . date('Y-m-d') . '.csv';

        // Set CSV headers
        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"$filename\""];

        // Create CSV content
        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Number',
                'Division',
                'District',
                'Profession',
                'Course Name',
                'Note',
                'Birthday',
                'Page',
                'Profile',
                'Enrolled Course',
                'Enrollment Date'
            ]);

            // Add data rows
            foreach ($data as $enrollment) {
                fputcsv($file, [
                    $enrollment->student_id,
                    $enrollment->student->student_name,
                    $enrollment->student->student_email,
                    $enrollment->student->student_number,
                    $enrollment->student->student_division,
                    $enrollment->student->student_district,
                    $enrollment->student->student_profession,
                    $enrollment->course->course_slug,
                    $enrollment->student_note,
                    $enrollment->student_birthday,
                    $enrollment->student_page_url,
                    $enrollment->student_profile_url,
                    $enrollment->student_enrolled_course,
                    $enrollment->enrolled_date
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    function download_student_data()
    {
        $data = DB::table('student')->get();

        $filename = 'students_' . date('Y-m-d') . '.csv';

        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"$filename\""];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Number',
                'Address',
                'Division',
                'District',
                'Profession',
                'Note',
                'Birthday',
                'Page',
                'Profile',
                'Enrolled Course',
                'Enrollment Date'
            ]);

            foreach ($data as $enrollment) {
                fputcsv($file, [
                    $enrollment->id,
                    $enrollment->student_name,
                    $enrollment->student_email,
                    $enrollment->student_number,
                    $enrollment->student_address,
                    $enrollment->student_division,
                    $enrollment->student_district,
                    $enrollment->student_profession,
                    $enrollment->student_note,
                    $enrollment->student_birthday,
                    $enrollment->student_page_url,
                    $enrollment->student_profile_url,
                    $enrollment->student_enrolled_course,
                    $enrollment->created_at
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    //enroll student
    function enroll_student(Request $request)
    {
        $student_id = strip_tags(trim($request->input('student_id')));
        $course_id = strip_tags(trim($request->input('course_id')));
        $enrolled_course = DB::table('enrolled_course')->where('student_id', $student_id)->where('course_id', $course_id)->count();

        if ($enrolled_course > 0) {
            return response()->json(['status' => 404, "message" => 'Student already enrolled']);
        } else {
            try {
                $result = DB::table('enrolled_course')->insert([
                    'student_id' => $student_id,
                    'course_id' => $course_id,
                    'is_new' => 1,
                    'enrolled_date' => Carbon::now(),
                ]);

                $enrolled_course = DB::table('enrolled_course')->where('student_id', $student_id)->count();
                DB::table('student')->where('id', $student_id)->update(['student_enrolled_course' => $enrolled_course]);

                if ($result) {
                    return response()->json(['status' => 200, "message" => 'Student enrolled successfully']);
                } else {
                    return response()->json(['status' => 404, "message" => 'Student could not be enrolled']);
                }
            } catch (\Exception $e) {
                return response()->json(['status' => 404, "message" => $e->getMessage()]);
            }
        }
    }

    function unenroll_student(Request $request)
    {
        $enrolled_course_id = strip_tags(trim($request->input('enrolled_course_id')));
        $student_id = strip_tags(trim($request->input('student_id')));

        $result = DB::table('enrolled_course')->where('id', $enrolled_course_id)->delete();

        $enrolled_course = DB::table('enrolled_course')->where('student_id', $student_id)->count();
        DB::table('student')->where('id', $student_id)->update(['student_enrolled_course' => $enrolled_course]);

        if ($result) {
            return response()->json(['status' => 200, "message" => 'Enrollment cancelled']);
        } else {
            return response()->json(['status' => 404, "message" => 'Enrollment could not be cancelled']);
        }
    }

    function delete_student_info(Request $request)
    {
        $student_id = strip_tags(trim($request->input('student_id')));
        $result = DB::table('student')->where('id', $student_id)->delete();

        if ($result) {
            return response()->json(['status' => 200, "message" => 'শিক্ষার্থী তথ্য মুছে ফেলা হয়েছে']);
        } else {
            return response()->json(['status' => 404, "message" => 'শিক্ষার্থী তথ্য মুছে ফেলা যায়নি']);
        }
    }

    function add_student_info(Request $request)
    {
        $student_name = strip_tags(trim($request->input('student_name')));
        $student_email = strip_tags(trim($request->input('student_email')));
        $student_number = strip_tags(trim($request->input('student_number')));
        $student_address = strip_tags(trim($request->input('student_address')));
        $student_note = strip_tags(trim($request->input('student_note')));
        $student_division = strip_tags(trim($request->input('student_division')));
        $student_district = strip_tags(trim($request->input('student_district')));
        $student_page_url = strip_tags(trim($request->input('student_page_url')));
        $student_birthday = strip_tags(trim($request->input('student_birthday')));
        $student_profession = strip_tags(trim($request->input('student_profession')));
        $student_profile_url = strip_tags(trim($request->input('student_profile_url')));
        $student_password = strip_tags(trim($request->input('student_password')));
        $encrypted_password = Crypt::encrypt($student_password);

        try {
            $result = DB::table('student')->insert([
                "student_name" => $student_name,
                "student_email" => $student_email,
                "student_number" => $student_number,
                "student_address" => $student_address,
                "student_division" => $student_division,
                "student_page_url" => $student_page_url,
                "student_birthday" => $student_birthday,
                "student_profession" => $student_profession,
                "student_profile_url" => $student_profile_url,
                "student_district" => $student_district,
                "student_note" => $student_note,
                "student_password" => $encrypted_password,
                "created_at" => Carbon::now(),
            ]);

            if ($result) {
                return response()->json(['status' => 200, "message" => 'Information added successfully']);
            } else {
                return response()->json(['status' => 404, "message" => 'Information could not be added']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 404, "message" => $e->getMessage()]);
        }

    }

    function get_course_data()
    {
        return DB::table('course')->where('course_status', 1)->get();
    }
}
