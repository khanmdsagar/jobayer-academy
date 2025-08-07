<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DataSeedController extends Controller
{
    function data_seed()
    {
        //why we us
        $wwu = [
            [
                'wwu_icon' => '<i class="fas fa-chalkboard-teacher"></i>',
                'wwu_title' => 'ইন্টারেক্টিভ লার্নিং',
                'wwu_description' => 'এডভান্সড সিস্টেমে কোর্স ভিডিও, ট্র্যাকিং ও পরীক্ষা',
            ],
            [
                'wwu_icon' => '<i class="fas fa-user-graduate"></i>',
                'wwu_title' => 'পার্সোনাল মেন্টরশীপ',
                'wwu_description' => 'শেখার যেকোনো সমস্যায় জোবায়ের স্যারের সাথে ফোনে, মেসেজে বা সরাসরি অফিসে এসে ১ টু ১ সমাধানের সুযোগ',
            ],
            [
                'wwu_icon' => '<i class="fas fa-briefcase"></i>',
                'wwu_title' => 'বিজনেস সাপোর্ট',
                'wwu_description' => 'নিজের ব্যবসা শুরুর ক্ষেত্রে, যন্ত্রপাতি, উপাদান সোর্সিং, বিজনেস গাইডলাইনসহ সকল ধরনের সাপোর্ট',
            ],
            [
                'wwu_icon' => '<i class="fas fa-users"></i>',
                'wwu_title' => 'কমিউনিটি সাপোর্ট',
                'wwu_description' => 'ফেসবুক ও হোয়াটসঅ্যাপ গ্রুপে যুক্ত হয়ে সকল স্টুডেন্টদের সাথে যোগাযোগ ও আলোচনার সুযোগ',
            ],
        ];
        foreach ($wwu as $item) {
            $is_data = DB::table('why_we_us')->where('wwu_title', $item['wwu_title'])->first();
            if (!$is_data) {
                DB::table('why_we_us')->insert([
                    'wwu_icon' => $item['wwu_icon'],
                    'wwu_title' => $item['wwu_title'],
                    'wwu_description' => $item['wwu_description'],
                ]);
            }
        }


        // follow us
        $social_links = [
            [
                'link' => 'https://facebook.com/jobayeracademybd',
                'link_logo' => 'fab fa-facebook-f', // FontAwesome class or filename
            ],
            [
                'link' => 'https://www.youtube.com/@jobayeracademybd',
                'link_logo' => 'fab fa-youtube', // FontAwesome class or filename
            ],
            [
                'link' => 'https://www.instagram.com/jobayeracademy/',
                'link_logo' => 'fab fa-instagram', // FontAwesome class or filename
            ]
        ];
        foreach ($social_links as $sl) {
            $is_data = DB::table('social_link')->where('link', $sl['link'])->first();
            if (!$is_data) {
                DB::table('social_link')->insert([
                    'link' => $sl['link'],
                    'link_logo' => $sl['link_logo'],
                ]);
            }
        }


        //settings
        $settings = [
            [
                "site_name" => "Jobayer Academy",
                "site_slogan" => "স্কিল ডেভলপ করে নিজের জীবনকে পরিবর্তন করুন",
                "site_address" => "খিলক্ষেত, লেকসিটি কমপ্লেক্স, ৪র্থ ফ্লোর, ঢাকা ১২২৯",
                "site_phone" => "01719295000",
                "site_email" => "contact@jobayeracademy.com",
                "site_logo" => "logo.webp",
                "site_about" => "জোবায়ের একাডেমিতে, আমরা এমন একটি ভবিষ্যৎ কল্পনা করি যেখানে সমগ্র বাংলাদেশ এবং এর বাইরেও ব্যক্তিরা ক্রমাগত দক্ষতা বিকাশের মাধ্যমে তাদের পূর্ণ সম্ভাবনাকে আনলক করার সুযোগ পাবেন। আমাদের ওয়েবসাইট একটি রূপান্তরমূলক শিক্ষার অভিজ্ঞতার জন্য ডিজিটাল হাব হিসাবে কাজ করে, মানসম্পন্ন শিক্ষা আপনার হাতের নাগালে নিয়ে আসে।",
                "site_hero_image" => "hero.avif",
                "site_hero_title" => "সরাসরি ও অনলাইন কোর্স এর সুবিধা"
            ]
        ];
        foreach ($settings as $st) {
            $is_data = DB::table('settings')->where('site_name', $st['site_name'])->first();

            if (!$is_data) {
                DB::table('settings')->insert([
                    "site_name" => $st['site_name'],
                    "site_slogan" => $st['site_slogan'],
                    "site_address" => $st['site_address'],
                    "site_phone" => $st['site_phone'],
                    "site_email" => $st['site_email'],
                    "site_logo" => $st['site_logo'],
                    "site_about" => $st['site_about'],
                    "site_hero_image" => $st['site_hero_image'],
                    "site_hero_title" => $st['site_hero_title']
                ]);
            }
        }


        //instructor
        $instructor = [
            [
                "instructor_name" => "জোবায়ের রহমান",
                "instructor_photo" => "JobayerRahman.png",
                "instructor_designation" => "প্রশিক্ষক",
                "joined_at" => "2025-05-01"
            ]
        ];
        foreach ($instructor as $i) {
            $is_data = DB::table('instructor')->where('instructor_name', $i['instructor_name'])->first();

            if (!$is_data) {
                DB::table('instructor')->insert([
                    'instructor_name' => $i['instructor_name'],
                    'instructor_photo' => $i['instructor_photo'],
                    'instructor_designation' => $i['instructor_designation'],
                    'joined_at' => $i['joined_at'],
                ]);
            }
        }


        //course category
        $course_category = [
            [
                "category_name" => "সাবান তৈরি",
                "category_slug" => "সাবান-তৈরি",
                "category_image" => "",
                "created_at" => "2025-05-01"
            ],
            [
                "category_name" => "ইকমার্স",
                "category_slug" => "ইকমার্স",
                "category_image" => "",
                "created_at" => "2025-05-01"
            ],
            [
                "category_name" => "ব্যবসা",
                "category_slug" => "ব্যবসা",
                "category_image" => "",
                "created_at" => "2025-05-01"
            ]
        ];
        foreach ($course_category as $cc) {
            $is_data = DB::table('course_category')->where('category_name', $cc['category_name'])->first();

            if (!$is_data) {
                DB::table('course_category')->insert([
                    'category_name' => $cc['category_name'],
                    'category_slug' => $cc['category_slug'],
                    'category_image' => $cc['category_image'],
                    'created_at' => $cc['created_at'],
                ]);
            }
        }


        //course
        $course = [
            [
                "course_name" => "প্রাকৃতিক সাবান তৈরীর প্রশিক্ষণ (বেসিক টু এডভান্সড)",
                "course_tagline" => "প্রাকৃতিক যত্নে নিজের সাবান, হাতে কলমে শেখা বেসিক টু এডভান্সড কৌশল!",
                "course_fee" => "5000",
                "course_selling_fee" => "5000",
                "course_slug" => "natural-soap-making-course",
                "course_duration" => "১১ ঘন্টা",
                "course_level" => "Advanced",
                "course_image" => "advancedsoapmaking.webp",
                "course_description" => "লেখাপড়া, চাকরী, সংসার সামলানো কিংবা বেকার জীবনের পাশাপাশি যদি আপনি উদ্যোক্তা হয়ে সফল হতে চান তাহলে এমন পণ্য নিয়ে কাজ করা উচিৎ যার মার্কেটে প্রচুর ডিমান্ড রয়েছে অথচ কম্পিটেশন কম। এমনই একটি পণ্য প্রাকৃতিক সোপ।
                    <br>
                    সোপ মেকিং শিখে আপনাকে কেবল বিজনেস করতে হবে এমন নয়, নিজের পরিবারের চাহিদা মিটবে, ক্ষতিকারক কেমিক্যাল ফ্রি পণ্য ব্যবহারে নিশ্চিন্তে থাকবে পরিবার। সোপ আর্ট মানুষিক চাপ কমায়।
                    <br>
                    জোবায়ের একাডেমি মূলত ১০০% কোয়ালিটি মেন্টেন করে সোপ মেকিং শেখায়। BSTI সহ বিশ্বের যে কোন ল্যাবে পাশযোগ্য। শুধু দেশীয় মার্কেট নয়, বিদেশে রপ্তানী করে প্রচুর বৈদেশিক মূদ্রা অর্জন করা সম্ভব।
                    <br><br>বিস্তারিত জানতে কল করুন - 01719295000",
                "course_status" => 1,
                "category_id" => 1,
                "instructor_id" => 1,
                "created_at" => "2025-05-01"
            ],
            [
                "course_name" => "মেল্ট এন্ড পোর সোপ মেকিং",
                "course_tagline" => "ঘরে বসেই শিখুন সাবান তৈরির সহজ কৌশল!",
                "course_fee" => "2999",
                "course_selling_fee" => "2999",
                "course_slug" => "melt-and-pour-soap-making",
                "course_duration" => "৫১ মিনিট",
                "course_level" => "Advanced",
                "course_image" => "melt&poursoapmaking.webp",
                "course_description" => "<p>বাংলাদেশে মেল্ট এন্ড পোর সোপ এর চাহিদা ব্যপক। তবে সঠিক প্রশিক্ষণের অভাবে বেশিরভাগ সোপ ঘামতে ও গলতে শুরু করে। ফলে ক্রেতাদের নেগেটিভ রিভিউ আসে। এই সকল সমস্যার সমাধান নিয়ে আমদের মেল্ট এন্ড পোর সোপ মেকিং কোর্স চালু করা হয়েছে।</p>
                    <br>
                    যা যা শেখানো হয়েছে -
                    <br>
                    <ul>
                    <li>গোট মিল্ক সোপ বেজ</li>
                    <li>গ্লিসারিন সোপ বেজ</li>
                    <li>ট্রান্সপারেন্ট সোপ</li>
                    <li>স্যাফরন গোট মিল্ক সোপ</li>
                    <li>রেইনবো সোপ</li>
                    <li>সোপ কাষ্টমাইজেশন</li>
                    </ul>
                    <br>
                    <p>আরো তথ্য পেতে কল করুন - 01719295000</p>",
                "course_status" => 1,
                "category_id" => 1,
                "instructor_id" => 1,
                "created_at" => "2025-05-01"
            ],
            [
                "course_name" => "ই-কমার্স ম্যানেজমেন্ট কোর্স",
                "course_tagline" => "নিজেই তৈরি করুন নিজের ই-কমার্স ওয়েব সাইট",
                "course_fee" => "2999",
                "course_selling_fee" => "2999",
                "course_slug" => "e-commerce-management-course",
                "course_duration" => "৬ ঘন্টা",
                "course_level" => "Beginner",
                "course_image" => "ecommerce-management.webp",
                "course_description" => "<p>ব্যবসা পরিচালোনা করার জন্য সবচেয়ে জনপ্রিয় মাধ্যম হলো একটি ইকমার্স ওয়েবসাইট। তবে নতুন উদ্দক্তাদের বাজেট প্রবলেম এর কারনে অনেক সময় ওয়েব সাইট করা হয়না। আমাদের এই কোর্সটি এমন ভাবে সাজানো হয়েছে যাতে একজন শিক্ষার্থী ডোমেন হোষ্টিং কেনা থেকে শুরু করে নিজে নিজে কিভাবে সাইট সেটআপ করে নিজেই বিজনেস পরিচালনা করতে পারে। আমাদের বিশ্বাস এই কোর্সটি করার পরে আপনি যে কোন মার্কেট প্লেসে কাজ তো করতেই পারবেন সাথে নিজে নিজের বিজনেস পরিচালনা করতে পারবেন।</p> <p>আরো তথ্য পেতে কল করুন - 01719295000</p>",
                "course_status" => 1,
                "category_id" => 2,
                "instructor_id" => 1,
                "created_at" => "2025-05-01"
            ],
            [
                "course_name" => "B2B প্রোডাক্ট সোর্সিং",
                "course_tagline" => "হোলসেলে পণ্য কিনুন",
                "course_fee" => "1600",
                "course_selling_fee" => "1600",
                "course_slug" => "b2b-product-sourcing",
                "course_duration" => "৬ ঘন্টা",
                "course_level" => "Intermediate",
                "course_image" => "product-sourcing.webp",
                "course_description" => "<p>একটা বিজনেসের সবচেয়ে গুরুত্বপূর্ণ বিষয় হলো প্রডাক্ট সোর্সিং। আপনি যদি কিনে জিততে না পারেন তাহলে কখনোই সেল করে প্রফিট করতে পারবেন না। সেই সাথে আপনাকে জানতে হবে একটি পন্যের পরিপূর্ণ কষ্টিং বা দাম নির্ধারন করার ক্ষমতা। পুরাতন ও নতুন উদ্দ্যোক্তাদের কথা মাথায় রেখেই আমাদের বি টু বি প্রডাক্ট সোর্সিং কোর্সটি চালু করেছি। এই কের্সিটিতে আপনি কিভাবে একটি পণ্য খুবই কম দামে দেশিও মার্কেট ও চায়না আলিবাবা থেকে পন্য নিয়ে এসে সঠিক কষ্টিং এর মাধ্যমে একটি লাভবান বিজনেস দাড় করাবেন তার পরিপূর্ণ গাইডলাইন দেখানো হয়েছে। এছাড়াও বাংলাদেশের কোথায় কোন প্রডাক্ট হোলসেল পাওয়া যায় সে সম্পর্কে বিস্তারি আলোচনা ও প্রাকটিক্যাল দেখানো হয়েছে। এই কোর্সটি আপনার ব্যবসার মোড় ঘুরিয়ে দেবে বলে আমরা বিশ্বাস করি। তাই আজই জয়েন করুন।</p> <p>আরো তথ্য পেতে কল করুন - 01719295000</p>",
                "course_status" => 1,
                "category_id" => 3,
                "instructor_id" => 1,
                "created_at" => "2025-05-01"
            ]
        ];
        foreach ($course as $c) {
            $is_data = DB::table('course')->where('course_name', $c['course_name'])->first();

            if (!$is_data) {
                DB::table('course')->insert([
                    'course_name' => $c['course_name'],
                    'course_tagline' => $c['course_tagline'],
                    'course_fee' => $c['course_fee'],
                    'course_selling_fee' => $c['course_selling_fee'],
                    'course_slug' => $c['course_slug'],
                    'course_duration' => $c['course_duration'],
                    'course_level' => $c['course_level'],
                    'course_image' => $c['course_image'],
                    'course_description' => $c['course_description'],
                    'course_status' => $c['course_status'],
                    'category_id' => $c['category_id'],
                    'instructor_id' => $c['instructor_id'],
                    'created_at' => $c['created_at'],
                ]);
            }
        }

        //course chapter
        $course_chapter = [
            [
                "chapter_name" => "অধ্যায় ১",
                "course_id" => 1
            ],
            [
                "chapter_name" => "অধ্যায় ২",
                "course_id" => 1
            ],
            [
                "chapter_name" => "অধ্যায় ৩",
                "course_id" => 1
            ],
            [
                "chapter_name" => "অধ্যায় ৪",
                "course_id" => 1
            ],
            [
                "chapter_name" => "অধ্যায় ৫",
                "course_id" => 1
            ],
            [
                "chapter_name" => "মৌলিক ক্লাস",
                "course_id" => 2
            ],
            [
                "chapter_name" => "সাবান বেস তৈরি",
                "course_id" => 2
            ],
            [
                "chapter_name" => "সাবান কাস্টমাইজেশন",
                "course_id" => 2
            ],
            [
                "chapter_name" => "ব্যবসায়িক নির্দেশিকা",
                "course_id" => 2
            ],
            [
                "chapter_name" => "শুরু থেকে শেষ",
                "course_id" => 4
            ]
            ,
            [
                "chapter_name" => "WooCommerce Chapter 01",
                "course_id" => 3
            ],
            [
                "chapter_name" => "WooCommerce Chapter 02",
                "course_id" => 3
            ],
            [
                "chapter_name" => "WooCommerce Chapter 03",
                "course_id" => 3
            ],
            [
                "chapter_name" => "WooCommerce Chapter 04",
                "course_id" => 3
            ],
            [
                "chapter_name" => "WooCommerce Chapter 05",
                "course_id" => 3
            ],
            [
                "chapter_name" => "WooCommerce Chapter 6",
                "course_id" => 3
            ],
            [
                "chapter_name" => "WooCommerce Chapter 07",
                "course_id" => 3
            ],
            [
                "chapter_name" => "WooCommerce Chapter 08",
                "course_id" => 3
            ]
        ];
        foreach ($course_chapter as $cch) {
            $is_data = DB::table('course_chapter')->where('chapter_name', $cch['chapter_name'])->first();
            if (!$is_data) {
                DB::table('course_chapter')->insert([
                    'chapter_name' => $cch['chapter_name'],
                    'course_id' => $cch['course_id'],
                ]);
            }
        }


        //topic
        $topic = [
            [
                'topic_name' => 'ভূমিকা এবং আমাদের লক্ষ্য',
                'topic_video' => 'https://youtu.be/f66vdB-ri9M',
                'course_id' => 4,
                'chapter_id' => 10,
            ],
            [
                'topic_name' => 'পণ্য সোর্সিং কি এবং কেন এটি গুরুত্বপূর্ণ',
                'topic_video' => 'https://youtu.be/14tI6ZCX700',
                'course_id' => 4,
                'chapter_id' => 10,
            ],
            [
                'topic_name' => 'কিভাবে একটি ব্যবসা শুরু করবেন',
                'topic_video' => 'https://youtu.be/gNAB19z4L5k',
                'course_id' => 4,
                'chapter_id' => 10,
            ],
            [
                'topic_name' => 'নিশ বা পণ্য নির্বাচান পদ্ধতি',
                'topic_video' => 'https://youtu.be/9-oORTmqd_E',
                'course_id' => 4,
                'chapter_id' => 10,
            ],
            [
                'topic_name' => 'সোর্সিং করার আগে পণ্যের মূল্য নির্ধারণ করুন',
                'topic_video' => 'https://youtu.be/h9ZlaLC_7xw',
                'course_id' => 4,
                'chapter_id' => 10,
            ],
            [
                'topic_name' => 'অনলাইনে কিভাবে পাইকারী সাপ্লাইয়ার খুজে বের করবেন',
                'topic_video' => 'https://youtu.be/OaTNLLqVedQ',
                'course_id' => 4,
                'chapter_id' => 10,
            ],
            [
                'topic_name' => 'কিভাবে আলিবাবা থেকে পণ্য আমদানি করতে হয়',
                'topic_video' => 'https://youtu.be/1reGqBJvun0',
                'course_id' => 4,
                'chapter_id' => 10,
            ],
            [
                'topic_name' => 'চীনের বাজারে কীভাবে বিশ্বস্ত সরবরাহকারী খুঁজে পাবেন',
                'topic_video' => 'https://youtu.be/oKHTWTrtqok',
                'course_id' => 4,
                'chapter_id' => 10,
            ],
            [
                'topic_name' => 'যেভাবে পেমেন্ট ম্যাথড এড করবেন',
                'topic_video' => 'https://youtu.be/AkOH8AbJYdI',
                'course_id' => 4,
                'chapter_id' => 10,
            ],
            [
                'topic_name' => 'আলিবাবাতে কীভাবে অর্ডার করবেন',
                'topic_video' => 'https://youtu.be/c9PFp6I_i58',
                'course_id' => 4,
                'chapter_id' => 10,
            ],
            [
                'topic_name' => 'চায়নাকে কিভাবে ওয়ার হউজ বুক করবেন',
                'topic_video' => 'https://youtu.be/-ooQyAG0xLY',
                'course_id' => 4,
                'chapter_id' => 10,
            ],
            [
                'topic_name' => 'চায়না পণ্যের মূল্য নির্ধারণ',
                'topic_video' => 'https://youtu.be/whTF6pOOoKU',
                'course_id' => 4,
                'chapter_id' => 10,
            ],
            [
                'topic_name' => 'একজন সফল ব্যবসায়ী হওয়ার গোপন টিপস',
                'topic_video' => 'https://youtu.be/yxiMCrGeHg0',
                'course_id' => 4,
                'chapter_id' => 10,
            ],

            [
                'topic_name' => 'নিরাপত্তা সরঞ্জাম',
                'topic_video' => 'https://youtu.be/SfHCNDID1F4',
                'course_id' => 2,
                'chapter_id' => 6,
            ],
            [
                'topic_name' => 'প্রয়োজনীয় যন্ত্রপাতি ও তাদের দাম',
                'topic_video' => 'https://youtu.be/sfmEnarlH_8',
                'course_id' => 2,
                'chapter_id' => 6,
            ],
            [
                'topic_name' => 'সাবান তৈরির উপযুক্ত পরিবেশ',
                'topic_video' => 'https://youtu.be/4-oNKPyOnM8',
                'course_id' => 2,
                'chapter_id' => 6,
            ],
            [
                'topic_name' => 'ছাগলের দুধ দিয়ে সাবান বেস তৈরি',
                'topic_video' => 'https://youtu.be/MA8_-ZpF_cE',
                'course_id' => 2,
                'chapter_id' => 7,
            ],
            [
                'topic_name' => 'স্বচ্ছ গ্লিসারিন সাবান বেস তৈরি',
                'topic_video' => 'https://youtu.be/_4bOfGMxTM0',
                'course_id' => 2,
                'chapter_id' => 7,
            ],
            [
                'topic_name' => 'স্বচ্ছ সাবান বেস তৈরি',
                'topic_video' => 'https://youtu.be/xxhz5YM7RSQ',
                'course_id' => 2,
                'chapter_id' => 7,
            ],
            [
                'topic_name' => 'জাফরান ও ছাগলের দুধ দিয়ে সাবান কাস্টমাইজেশন',
                'topic_video' => 'https://youtu.be/r3Kt5FcPICE',
                'course_id' => 2,
                'chapter_id' => 8,
            ],
            [
                'topic_name' => 'রেইনবো সাবান তৈরি',
                'topic_video' => 'https://youtu.be/WCrDl5f1roI',
                'course_id' => 2,
                'chapter_id' => 8,
            ],
            [
                'topic_name' => 'পণ্যের মূল্য নির্ধারণ',
                'topic_video' => 'https://youtu.be/88Ry546HCBE',
                'course_id' => 2,
                'chapter_id' => 9,
            ],
            [
                'topic_name' => 'পণ্য বিক্রির উপায়',
                'topic_video' => 'https://youtu.be/GFzxOr3Flns',
                'course_id' => 2,
                'chapter_id' => 9,
            ],
            [
                'topic_name' => 'সফল ব্যবসায়ী হওয়ার ১০টি পরামর্শ',
                'topic_video' => 'https://youtu.be/yxiMCrGeHg0',
                'course_id' => 2,
                'chapter_id' => 9,
            ],

            [
                'topic_name' => 'পাঠ পরিচিতি',
                'topic_video' => 'https://youtu.be/nQOD_lBRHgA',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'যে সকল পদ্ধতিতে সাবান তৈরী করা যায়',
                'topic_video' => 'https://youtu.be/YanNpUChOIE',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'স্যাপোনিফিকেশন বলতে কি বোঝায়',
                'topic_video' => 'https://youtu.be/mCTLF42yXnU',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'সাবান তৈরীর জন্য দকারী উপকরন',
                'topic_video' => 'https://youtu.be/aRMtDFGNDRI',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'যে সকল নিরাপত্তা সরঞ্জাম দরকার হবে',
                'topic_video' => 'https://youtu.be/7sNboWkMLX4',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'সবান তৈরীর দরকারী যন্ত্রপাতি',
                'topic_video' => 'https://youtu.be/BuiHFzSGNNw',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'যেকল তেল বা চর্বি দিয়ে সাবান তৈরী করা যায়',
                'topic_video' => 'https://youtu.be/WIBs7PN8_B0',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'যেমন পরিবেশ দরকার',
                'topic_video' => 'https://youtu.be/VpG1j236cQ8',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'হার্ব বা ভেষজ ব্যবহারের নিয়ম',
                'topic_video' => 'https://youtu.be/CokGyJ0PD-Q',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'সুপার ফ্যাট বলতে কি বোঝায়',
                'topic_video' => 'https://youtu.be/zC1G4GmItvg',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'পানি ও লাই রেশিও কেমন হবে',
                'topic_video' => 'https://youtu.be/UG2wEPWWxos',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'নারিকেল তেলের ধরন যা জানা দরকার',
                'topic_video' => 'https://youtu.be/jVmtwXQyVRk',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'ভালো সাবানে যে সকল বৈশিষ্ট থাকতে হবে',
                'topic_video' => 'https://youtu.be/glv493WBB_Q',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'প্রাকৃতিক ভাবে সাবান রং করার পদ্ধতি',
                'topic_video' => 'https://youtu.be/uHNoQjy2dP8',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'সাবান তৈরীরর কোর ফর্মূলা',
                'topic_video' => 'https://youtu.be/Hnc40M2H98A',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'তেলের বৈশিষ্ট ও মিশ্রনের নিয়ম',
                'topic_video' => 'https://youtu.be/JAjzm3bHU8E',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'স্যাপ ভ্যালু ও তেলের গুরুত্ব',
                'topic_video' => 'https://youtu.be/IK0f6_GvDXw',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'লাই ক্যালকুলেশনের নিয়ম',
                'topic_video' => 'https://youtu.be/A27642MWKfQ',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'অটোমেটিক লাই ক্যালকুলেশন',
                'topic_video' => 'https://youtu.be/ZVa-ifKckBU',
                'course_id' => 1,
                'chapter_id' => 1,
            ],
            [
                'topic_name' => 'স্যাফরন গোট মিল্ক সোপ তৈরী',
                'topic_video' => 'https://youtu.be/sVFH_kUahnM',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => 'পিওর গোট মিল্ক সোপ তৈরী',
                'topic_video' => 'https://youtu.be/49DMF0wTiXs',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => 'চন্দন সাবান তৈরির প্রক্রিয়া (পাউডার)',
                'topic_video' => 'https://youtu.be/Wg6jSY3HGcg',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => 'বেদিং বার তৈরী করার নিয়ম',
                'topic_video' => 'https://youtu.be/qWH3YVFklXk',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => 'তুলশী সাবান তৈরি',
                'topic_video' => 'https://youtu.be/YLyRXaPaIN4',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => 'এক্টিভেটেড চারকোল সাবান তৈরি',
                'topic_video' => 'https://youtu.be/EaHrwLsKyJM',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => 'চামিলি সাবান তৈরির প্রক্রিয়া',
                'topic_video' => 'https://youtu.be/UTkhcWBvMm4',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => '3 লেয়ার ক্লে সোপ আর্ট',
                'topic_video' => 'https://youtu.be/h41M_w3toOo',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => 'কিভাবে ইনফিউজড তেল তৈরি করবেন',
                'topic_video' => 'https://youtu.be/b6s575TJ93M',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => 'ইনফিউজড অয়েল দিয়ে মরিঙ্গা সাবান তৈরী',
                'topic_video' => 'https://youtu.be/6pGOqxKHljk',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => 'কিভাবে শেভিং বার করা যায়',
                'topic_video' => 'https://youtu.be/UKFLxFJy1O0',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => 'কীভাবে অ্যালোভেরা সাবান (জেল) তৈরি করবেন',
                'topic_video' => 'https://youtu.be/fH15GurEg3s',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => 'কাঁচা হলুদ সাবান তৈরীর পদ্ধতি',
                'topic_video' => 'https://youtu.be/56jRNQ6z7sc',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => 'কীভাবে কফি সাবান তৈরি করবেন',
                'topic_video' => 'https://youtu.be/gVswb2A6YCI',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => 'কিভাবে কমলার খোসার সাবান তৈরি করবেন',
                'topic_video' => 'https://youtu.be/q7u9IJmEgl8',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => 'নিম সাবান তৈরী করার নিয়ম',
                'topic_video' => 'https://youtu.be/HGZEMZnyhw8',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => '2 রঙের Swirl সাবান তৈরি',
                'topic_video' => 'https://youtu.be/FAkjWn2BzVA',
                'course_id' => 1,
                'chapter_id' => 2,
            ],
            [
                'topic_name' => 'সাবান শুকানোর এবং ট্র্যাকিং প্রক্রিয়া',
                'topic_video' => 'https://youtu.be/dJEyASn0aLk',
                'course_id' => 1,
                'chapter_id' => 3,
            ],
            [
                'topic_name' => 'সাঠক নিয়মে সাবানের pH পরীক্ষা',
                'topic_video' => 'https://youtu.be/UMXn08PHk7M',
                'course_id' => 1,
                'chapter_id' => 3,
            ],
            [
                'topic_name' => 'কিভাবে সাবান পলি করতে হয়',
                'topic_video' => 'https://youtu.be/tNqCdX_Ymkk',
                'course_id' => 1,
                'chapter_id' => 3,
            ],
            [
                'topic_name' => 'সাবান প্যাকেজিং ধারণা',
                'topic_video' => 'https://youtu.be/tdidi8yWNK4',
                'course_id' => 1,
                'chapter_id' => 3,
            ],
            [
                'topic_name' => 'নারকেল তেলের আচরণ বিশ্লেষণ',
                'topic_video' => 'https://youtu.be/Y3NcQF33KQE',
                'course_id' => 1,
                'chapter_id' => 4,
            ],
            [
                'topic_name' => 'অলিভ অয়েল এর আচরণ বিশ্লেষণ',
                'topic_video' => 'https://youtu.be/-H_GOvQKoeM',
                'course_id' => 1,
                'chapter_id' => 4,
            ],
            [
                'topic_name' => 'সূর্যমুখী তেলের আচরণ বিশ্লেষণ',
                'topic_video' => 'https://youtu.be/jFfg1bqybtc',
                'course_id' => 1,
                'chapter_id' => 4,
            ],
            [
                'topic_name' => '3 টি তেলের সাবান পরীক্ষার ফলাফল',
                'topic_video' => 'https://youtu.be/QSWG3quQHZc',
                'course_id' => 1,
                'chapter_id' => 4,
            ],
            [
                'topic_name' => 'পাম তেলের আচরণ বিশ্লেষণ',
                'topic_video' => 'https://youtu.be/Nw55TDYm94c',
                'course_id' => 1,
                'chapter_id' => 4,
            ],
            [
                'topic_name' => 'ট্যালোর আচরণ বিশ্লেষণ',
                'topic_video' => 'https://youtu.be/4MD9xGq5M_c',
                'course_id' => 1,
                'chapter_id' => 4,
            ],
            [
                'topic_name' => 'পরীক্ষার ফলাফল এবং বুদ্বুদ পরীক্ষা',
                'topic_video' => 'https://youtu.be/nqmMO-o5N2s',
                'course_id' => 1,
                'chapter_id' => 4,
            ],
            [
                'topic_name' => 'মাইকা কালার এক্সপ্লেমেন্ট',
                'topic_video' => 'https://youtu.be/k5lAc2mEcfk',
                'course_id' => 1,
                'chapter_id' => 4,
            ],
            [
                'topic_name' => 'কিভাবে পন্যের কষ্টিং করবেন',
                'topic_video' => 'https://youtu.be/88Ry546HCBE',
                'course_id' => 1,
                'chapter_id' => 5,
            ],
            [
                'topic_name' => 'দরকারী ডকুমেন্ট সমূহ',
                'topic_video' => 'https://youtu.be/zQ_jNOOCCe8',
                'course_id' => 1,
                'chapter_id' => 5,
            ],
            [
                'topic_name' => 'কতগুলা উপায়ে পণ্য সেল করা যায়',
                'topic_video' => 'https://youtu.be/GFzxOr3Flns',
                'course_id' => 1,
                'chapter_id' => 5,
            ],
            [
                'topic_name' => 'ব্যবসা প্রস্তুতি এবং প্রয়োজনীয়তা',
                'topic_video' => 'https://youtu.be/Vq08bFr-8JU',
                'course_id' => 1,
                'chapter_id' => 5,
            ],
            [
                'topic_name' => 'স্ট্রোরী টেলিং কনটেন্ট আইডিয়া ও লেখা',
                'topic_video' => 'https://youtu.be/50M1j_cbeM0',
                'course_id' => 1,
                'chapter_id' => 5,
            ],
            [
                'topic_name' => 'পারফেক্ট এডি ক্যাম্পেইন সেটআপ',
                'topic_video' => 'https://youtu.be/JocC0Gmv8wI',
                'course_id' => 1,
                'chapter_id' => 5,
            ],
            [
                'topic_name' => 'এডি ক্যাম্পেইন সেটআপ পার্ট ২',
                'topic_video' => 'https://youtu.be/tCkcLU-Ha40',
                'course_id' => 1,
                'chapter_id' => 5,
            ],
            [
                'topic_name' => 'পণ্য সরবরাহ করার সহজ উপায়',
                'topic_video' => 'https://youtu.be/aHmqmThVmcw',
                'course_id' => 1,
                'chapter_id' => 5,
            ],
            [
                'topic_name' => 'একজন সফল ব্যবসায়ী হওয়ার টিপস',
                'topic_video' => 'https://youtu.be/m7rvSlKFD-w',
                'course_id' => 1,
                'chapter_id' => 5,
            ],
            [
                'topic_name' => 'Introduction',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 11,
            ],
            [
                'topic_name' => 'What is Domain?',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 11,
            ],
            [
                'topic_name' => 'How To Buy a Domain',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 11,
            ],
            [
                'topic_name' => 'What is Hosting and How to Buy',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 11,
            ],
            [
                'topic_name' => 'Domain Hosting Pointing',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 11,
            ],
            [
                'topic_name' => 'How to Install WordPress In Proper Way',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 11,
            ],
            [
                'topic_name' => 'Basic WordPress Settings',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 12,
            ],
            [
                'topic_name' => 'How to Add User',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 12,
            ],
            [
                'topic_name' => 'How To Install Theme',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 12,
            ],
            [
                'topic_name' => 'Template Selection and Activation',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 12,
            ],
            [
                'topic_name' => 'WooCommerce Settings',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 12,
            ],
            [
                'topic_name' => 'Payment Getaway Setup',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 13,
            ],
            [
                'topic_name' => 'Guest Checkout Enable',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 13,
            ],
            [
                'topic_name' => 'Shipping Methods Setup',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 13,
            ],
            [
                'topic_name' => 'Checkout Field Editing As per Requirements',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 13,
            ],
            [
                'topic_name' => 'Order Status Management For Tracking',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 13,
            ],
            [
                'topic_name' => 'Profit Calculation For Your Business',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 14,
            ],
            [
                'topic_name' => 'Sales Report Generation',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 14,
            ],
            [
                'topic_name' => 'Monthly Order and Profit Auto Calculation',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 14,
            ],
            [
                'topic_name' => 'Invoice and Packaging Slip Download',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 14,
            ],
            [
                'topic_name' => 'Order Sequence Maintaining',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 14,
            ],
            [
                'topic_name' => 'Stock Management',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 15,
            ],
            [
                'topic_name' => 'Web Security Limit Login',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 15,
            ],
            [
                'topic_name' => 'Web Security login URL Changing',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 15,
            ],
            [
                'topic_name' => 'How to take site Backup',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 15,
            ],
            [
                'topic_name' => 'Important Plugins You Should Have',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 15,
            ],
            [
                'topic_name' => 'Social Chat Option setup',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 16,
            ],
            [
                'topic_name' => 'SEO plugin Installation',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 16,
            ],
            [
                'topic_name' => 'Basic Logo Design for Website',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 16,
            ],
            [
                'topic_name' => 'Site Logo Settings',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 16,
            ],
            [
                'topic_name' => 'How to Create a Page',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 16,
            ],
            [
                'topic_name' => 'Edit a Page with Elementor',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 17,
            ],
            [
                'topic_name' => 'How to change website elements',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 17,
            ],
            [
                'topic_name' => 'All About website Menu',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 17,
            ],
            [
                'topic_name' => 'Edit footer and Widget area',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 17,
            ],
            [
                'topic_name' => 'How to upload single product',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 17,
            ],
            [
                'topic_name' => 'How to Upload Variable Product',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 18,
            ],
            [
                'topic_name' => 'Basic Product SEO',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 18,
            ],
            [
                'topic_name' => 'How to Create a Blog',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 18,
            ],
            [
                'topic_name' => 'Edit single product and catalog page',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 18,
            ],
            [
                'topic_name' => 'Website Function Checking',
                'topic_video' => 'https://youtu.be/',
                'course_id' => 3,
                'chapter_id' => 18,
            ]
        ];
        foreach ($topic as $t) {
            $is_data = DB::table('chapter_topic')->where('topic_name', $t['topic_name'])->first();
            if (!$is_data) {
                DB::table('chapter_topic')->insert([
                    'topic_name' => $t['topic_name'],
                    'topic_video' => $t['topic_video'],
                    'course_id' => $t['course_id'],
                    'chapter_id' => $t['chapter_id'],
                ]);
            }
        }


        //question and answer
        $question_answer = [
            [
                "question" => "অনলাইনে কি সোপ মেকিং শেখা সম্ভব?",
                "answer" => "এটা নির্ভর করে কে শেখাচ্ছেন ও কিভাবে শেখাচ্ছেন। আমাদের রয়েছে নিয়মিত সাপোর্ট সিষ্টেম। প্রতি সপ্তাহে লাইভে জয়েন হওয়ার সুযোগ ও পার্সোনাল সাপোর্ট।",
                "course_id" => 1
            ],
            [
                "question" => "প্রাকৃতিক সোপ এর ডিমান্ড কেমন?",
                "answer" => "বর্তমানে এটি ট্রেন্ডিং বিজনেস আইডিয়া। মানুষ দিন দিন স্বাস্থ্য সচেতন হচ্ছেন, প্রাকৃতিক পণ্য ব্যবহার করা শিখছে। প্রতি বছর এর ডিমান্ড ৬.৫ শতাংশ হাড়া বাড়ছে। সুতরাং মার্কেট দখল করার এখনই সময়।",
                "course_id" => 1
            ],
            [
                "question" => "বিজনেস শুরু করতে কত টাকা ইনভেষ্টমেন্ট দরকার?",
                "answer" => "যত বেশি ইনভেষ্ট করবেন বিজনেস ততো বড় হবে। তবে যেহেতু তেমন কোন মেশিন লাগে না তাই খুব একটা খরচ নেই। ২-১০ হাজার টাকার ভিতরে শুরু করতে পারবেন।",
                "course_id" => 1
            ],
            [
                "question" => "প্রতি পিচ প্রাকৃতিক সাবান তৈরী করতে কত টাকা লাগে?",
                "answer" => "২০ থেকে ৩০০ টাকা পর্যন্ত লাগতে পারে প্রতি ১০০ গ্রাম সোপ এর জন্য। যেমন উপাদান ব্যবহার করবেন তেমন খরচ হবে।",
                "course_id" => 1
            ],
            [
                "question" => "কাঁচামাল কোথায় পাবো?",
                "answer" => "প্রাকৃতিক সাবান তৈরী হয় প্রাকৃতিক উপাদান দিয়ে, যেমন, নারিকেল তেল, সরিষার তেল, সয়াবিন তেল, পাম তেল, অলিভ তেল ইত্যাদি ও বিভন্ন রকম ভেষজ দিয়ে। এসকল উপাদান আপনার আশেপাশেই পেয়ে যাবেন আশাকরি। যদি কোন উপদান না পান তাহলে আমাদের ষ্টোর ROSOMART.COM থেকে অর্ডার করতে পারবেন।",
                "course_id" => 1
            ],
            [
                "question" => "কিভাবে সেল করবো তা কি শেখানো হবে?",
                "answer" => "যেহেতু আমাদের দীর্ঘ ১৩ বছর ডিজিটাল মার্কেটের অভিজ্ঞতা রয়েছে তাই আমরা আপনাকে বেসিক আইডিয়া দিয়ে দেবো।",
                "course_id" => 1
            ],
            [
                "question" => "বাড়িতে বসেই কি এই বিজনেস করা সম্ভব?",
                "answer" => "অবশ্যই, আপনার বাড়েতে যে কোন একটা ছোট রুম হলেই আপনি কাজ শুরু করতে পারবেন। থেকে অর্ডার করতে পারবেন।",
                "course_id" => 1
            ]
        ];
        foreach ($question_answer as $qa) {
            $is_data = DB::table('question_answer')->where('question', $qa['question'])->first();

            if (!$is_data) {
                DB::table('question_answer')->insert([
                    'question' => $qa['question'],
                    'answer' => $qa['answer'],
                    'course_id' => $qa['course_id'],
                ]);
            }
        }


        //student
        $student = [
            ["id" => "1", "student_name" => "Masud Rana", "student_email" => "mmashud02@gmail.com", "student_number" => "01712437997", "course_id" => "2",],
            ["id" => "2", "student_name" => "Khan Dayeen Zadid", "student_email" => "zadiddayyen00@gmail.com", "student_number" => "01315185800", "course_id" => "1",],
            ["id" => "3", "student_name" => "Lamia akter Rula", "student_email" => "lamiaakterrula@gmail.com", "student_number" => "01790579942", "course_id" => "1",],
            ["id" => "4", "student_name" => "Tahamina Mumtaz Ishrat", "student_email" => "tahaminaishrat@gmail.com", "student_number" => "01890816606", "course_id" => "1",],
            ["id" => "5", "student_name" => "Md. Juwel Rana", "student_email" => "juwelranarehan@gmail.com", "student_number" => "01648169369", "course_id" => "1",],
            ["id" => "6", "student_name" => "Azizul Haque Raihan", "student_email" => "mahr.micky@gmail.com", "student_number" => "01711703609", "course_id" => "1",],
            ["id" => "7", "student_name" => "Afrin Akter", "student_email" => "afrin.himu77@gmail.com", "student_number" => "01914717797", "course_id" => "1",],
            ["id" => "8", "student_name" => "Md. Abdul Gaffar", "student_email" => "gaffarbd7@gmail.com", "student_number" => "01717662710", "course_id" => "1",],
            ["id" => "9", "student_name" => "Sheikh Tanjina Tanha", "student_email" => "subahtanjina@gmail.com", "student_number" => "01628178584", "course_id" => "1",],
            ["id" => "10", "student_name" => "Jannatul Ferdous", "student_email" => "rufaidarumaiya306@gmail.com", "student_number" => "01648210899", "course_id" => "1",],
            ["id" => "11", "student_name" => "Humaun Kabir", "student_email" => "humaunkabirxyz@gmail.com", "student_number" => "01903453509", "course_id" => "0",],
            ["id" => "12", "student_name" => "salah uddin", "student_email" => "lavlu.denimach@gmail.com", "student_number" => "01712348065", "course_id" => "2",],
            ["id" => "13", "student_name" => "Ahmmed Mursalin", "student_email" => "circledigitalmarketingagency@gmail.com", "student_number" => "01308270368", "course_id" => "1",],
            ["id" => "14", "student_name" => "Tabassum Hasnnat Tamima", "student_email" => "tabassumhasnatt@gmail.com", "student_number" => "01570204704", "course_id" => "1",],
            ["id" => "15", "student_name" => "Rahat Rcs", "student_email" => "rahatrcs27@gmail.com", "student_number" => "01325277000", "course_id" => "1",],
            ["id" => "16", "student_name" => "Shahriar Islam", "student_email" => "shahriar.amcl@gmail.com", "student_number" => "01745915311", "course_id" => "0",],
            ["id" => "17", "student_name" => "Md. Harun or Rashid", "student_email" => "jonayed66@gmail.com", "student_number" => "01863484119", "course_id" => "1",],
            ["id" => "18", "student_name" => "Jakir Hossain", "student_email" => "jakirhossen750@gmail.com", "student_number" => "01727185249", "course_id" => "1",],
            ["id" => "19", "student_name" => "Faria Akhter", "student_email" => "150573@gmail.com", "student_number" => "01767625531", "course_id" => "1",],
            ["id" => "20", "student_name" => "Md Fahim Ahmed", "student_email" => "borhanuddinfahim1994@gmail.com", "student_number" => "01628210820", "course_id" => "1",],
            ["id" => "21", "student_name" => "Md. Arif Khondokar", "student_email" => "arifkhondokar442@gmail.com", "student_number" => "01889047204", "course_id" => "1",],
            ["id" => "22", "student_name" => "Nadira Afroz", "student_email" => "afroz.nadira71@gmail.com", "student_number" => "01711433490", "course_id" => "1",],
            ["id" => "23", "student_name" => "Sazia Afrin,", "student_email" => "saziakamal@gmail.com", "student_number" => "01977211172", "course_id" => "0",],
            ["id" => "24", "student_name" => "Rumana Nazim", "student_email" => "rumananazim@gmail.com", "student_number" => "01671654724", "course_id" => "1",],
            ["id" => "25", "student_name" => "Arju Ahmed", "student_email" => "arjuagmed94@gmail.com", "student_number" => "01816163170", "course_id" => "0",],
            ["id" => "26", "student_name" => "Moyenul Islam", "student_email" => "dev.moyenislam@gmail.com", "student_number" => "01308989743", "course_id" => "1",],
            ["id" => "27", "student_name" => "Najia Akter", "student_email" => "nsj23bd@gmail.com", "student_number" => "01846491354", "course_id" => "0",],
            ["id" => "28", "student_name" => "Jabin Tasnim Munia", "student_email" => "jabintua0009@gmail.com", "student_number" => "01940685551", "course_id" => "0",],
            ["id" => "29", "student_name" => "Raiyan Rashid Prodhan Prodhan Prodhan", "student_email" => "rrprodhan1998@gmail.com", "student_number" => "01575579841", "course_id" => "1",],
            ["id" => "30", "student_name" => "Jannatul Maua Farhana", "student_email" => "mauafarhana@gmail.com", "student_number" => "01826687778", "course_id" => "1",],
            ["id" => "31", "student_name" => "Ahmed Bejoy Bejoy Bejoy Bejoy", "student_email" => "ahmedbejoy15@gmail.com", "student_number" => "01969503152", "course_id" => "1",],
            ["id" => "32", "student_name" => "Atkia tahira Tasnim", "student_email" => "tasnim.lopa01@gmail.com", "student_number" => "01714897218", "course_id" => "1",],
            ["id" => "33", "student_name" => "Afia", "student_email" => "afia.bintabdulghanie@gmail.com", "student_number" => "01670860069", "course_id" => "1",],
            ["id" => "34", "student_name" => "Sheila Ahmed", "student_email" => "sheila.ahmed45@gmail.com", "student_number" => "01755625582", "course_id" => "1",],
            ["id" => "35", "student_name" => "Masuma aktar", "student_email" => "masumaaktarsakila@gmail.com", "student_number" => "01711745029", "course_id" => "1",],
            ["id" => "36", "student_name" => "RAKIBUZZAMAN", "student_email" => "rakibuzzaman47@gmail.com", "student_number" => "01976241050", "course_id" => "1",],
            ["id" => "37", "student_name" => "Mahmudul Hasan", "student_email" => "alhakimdawakhana@gmail.com", "student_number" => "01776008574", "course_id" => "1",],
            ["id" => "38", "student_name" => "Jannatul Ferdous Ananna", "student_email" => "anannaahmed21@gmail.com", "student_number" => "01617112856", "course_id" => "0",],
            ["id" => "39", "student_name" => "Sami Mahmud Khan", "student_email" => "rock.on.samikhan@gmail.com", "student_number" => "01674356049", "course_id" => "0",],
            ["id" => "40", "student_name" => "Md. Oliure Rahman Ripon", "student_email" => "oliureripon@gmail.com", "student_number" => "01755532335", "course_id" => "1",],
            ["id" => "41", "student_name" => "Mohammod Tasneem Hasan", "student_email" => "tasneemhasan432@gmail.com", "student_number" => "01821367128", "course_id" => "1",],
            ["id" => "42", "student_name" => "Ahiyatul Ahmed Sneha", "student_email" => "tasheho@gmail.com", "student_number" => "01739562901", "course_id" => "0",],
            ["id" => "43", "student_name" => "Murad", "student_email" => "murad07ipe@gmail.com", "student_number" => "01983490540", "course_id" => "0",],
            ["id" => "44", "student_name" => "Naznin Mazumder", "student_email" => "nazninn007@gmail.com", "student_number" => "01670338071", "course_id" => "3",],
            ["id" => "45", "student_name" => "Abu Taher", "student_email" => "abu.taher28@yahoo.com", "student_number" => "01930911737", "course_id" => "2",],
            ["id" => "46", "student_name" => "Naznin Anis", "student_email" => "nazninanis1988@gmail.com", "student_number" => "01968561689", "course_id" => "0",],
            ["id" => "47", "student_name" => "Shihab", "student_email" => "shihab3499@gmail.com", "student_number" => "01820859214", "course_id" => "0",],
            ["id" => "48", "student_name" => "Umme Tabasum Jelifar", "student_email" => "jenifartabassum@gmail.com", "student_number" => "01717079772", "course_id" => "1",],
            ["id" => "49", "student_name" => "Ashraful Alam", "student_email" => "mdashrafulalam0591@gmail.com", "student_number" => "01929731411", "course_id" => "0",],
            ["id" => "50", "student_name" => "MD Suman Mia", "student_email" => "sumonbepari122@gmail.com", "student_number" => "01886668623", "course_id" => "0",],
            ["id" => "51", "student_name" => "Rakibul Islam", "student_email" => "rakibulroky35@gmail.com", "student_number" => "01789373878", "course_id" => "0",],
            ["id" => "52", "student_name" => "Asrafun Nesa Asha", "student_email" => "mstasrafunnasaasha@gmail.com", "student_number" => "01303395453", "course_id" => "0",],
            ["id" => "53", "student_name" => "Pratuttar Chakma", "student_email" => "pratuttarchakma84@gmail.com", "student_number" => "01862939857", "course_id" => "1",],
            ["id" => "54", "student_name" => "Md Matiul alam", "student_email" => "matiul.prob2009@gmail.com", "student_number" => "01732461420", "course_id" => "2",],
            ["id" => "55", "student_name" => "Harun or Rashid", "student_email" => "atmharunbd@gmail.com", "student_number" => "01730335079", "course_id" => "2",],
            ["id" => "56", "student_name" => "Nurul Amin", "student_email" => "namin.lkm@gmail.com", "student_number" => "01610405666", "course_id" => "0",],
            ["id" => "57", "student_name" => "Sabrina", "student_email" => "bgga.uttaradistrict@gmail.com", "student_number" => "01729072784", "course_id" => "0",],
            ["id" => "58", "student_name" => "Halima sadia", "student_email" => "hurrem.lb1feb@gmail.com", "student_number" => "01683598164", "course_id" => "1",],
            ["id" => "59", "student_name" => "Kawsar Jahan Chowdhury", "student_email" => "abtaheechy1@gmail.com", "student_number" => "01716108965", "course_id" => "0",],
            ["id" => "60", "student_name" => "Md Nazrul Islam", "student_email" => "nazrulislamregion@gmail.com", "student_number" => "01624931233", "course_id" => "4",],
            ["id" => "61", "student_name" => "Sayla Rahman", "student_email" => "sayla.rahman14@gmail.com", "student_number" => "01717731469", "course_id" => "0",],
            ["id" => "62", "student_name" => "Farjana Amin", "student_email" => "farjanaaminrony@gmail.com", "student_number" => "01778601413", "course_id" => "0",],
            ["id" => "63", "student_name" => "Mahir", "student_email" => "royellab@gmail.com", "student_number" => "01711845082", "course_id" => "0",],
            ["id" => "64", "student_name" => "Rumana Khanom", "student_email" => "rumanakhanom213@gmail.com", "student_number" => "01712758439", "course_id" => "0",],
            ["id" => "65", "student_name" => "Manirul islam", "student_email" => "bappysheikh57@gmail.com", "student_number" => "01834972652", "course_id" => "0",],
            ["id" => "66", "student_name" => "Fahim Tanvir", "student_email" => "volcofahim999@gmail.com", "student_number" => "01794375401", "course_id" => "0",],
            ["id" => "67", "student_name" => "Shimu", "student_email" => "hasanshakib81@gmail.com", "student_number" => "01762286848", "course_id" => "1",],
            ["id" => "68", "student_name" => "Sonia", "student_email" => "thananesarbad@gmail.com", "student_number" => "01731195073", "course_id" => "1",],
            ["id" => "69", "student_name" => "Amrin Rahman", "student_email" => "sharasorganiccare4@gmail.com", "student_number" => "01911449178", "course_id" => "0",],
            ["id" => "70", "student_name" => "Ahasanul Hasan", "student_email" => "ahasanulhasan7@gmail.com", "student_number" => "01775522329", "course_id" => "1",],
            ["id" => "71", "student_name" => "Zulkarnain", "student_email" => "pieraci25@gmail.com", "student_number" => "01576487213", "course_id" => "0",],
            ["id" => "72", "student_name" => "Jabin", "student_email" => "jabinzinnurain@gmail.com", "student_number" => "01875174215", "course_id" => "0",],
            ["id" => "73", "student_name" => "Kamrul Hussain Choudhury", "student_email" => "tanvirchy@gmail.com", "student_number" => "01772167054", "course_id" => "0",],
            ["id" => "74", "student_name" => "Shawqi Sharzarin", "student_email" => "alve.imam59@gmail.com", "student_number" => "01766337668", "course_id" => "0",],
            ["id" => "75", "student_name" => "Md. Mahmudul Haque", "student_email" => "pondsvew@yahoo.com", "student_number" => "01712042324", "course_id" => "0",],
            ["id" => "76", "student_name" => "Syeda An Noor", "student_email" => "syeda_1245@yahoo.com", "student_number" => "01674327138", "course_id" => "0",],
            ["id" => "77", "student_name" => "Hanif", "student_email" => "hanif721@yahoo.com", "student_number" => "01841222924", "course_id" => "0",],
            ["id" => "78", "student_name" => "Md Mizanur Rahman", "student_email" => "botanicagrovat@gmail.com", "student_number" => "01715999317", "course_id" => "1",],
            ["id" => "79", "student_name" => "Sarmin", "student_email" => "ssmoon3210@gmail.com", "student_number" => "01682272101", "course_id" => "1",],
            ["id" => "80", "student_name" => "Md Shakhawat hossain", "student_email" => "shakhawat@gmail.com", "student_number" => "01684459051", "course_id" => "1",],
            ["id" => "81", "student_name" => "Aleya Ferdaushi", "student_email" => "aleya.ferdaushi@gmail.com", "student_number" => "01717342441", "course_id" => "1",],
            ["id" => "82", "student_name" => "M A Aman", "student_email" => "aman4jr@gmail.com", "student_number" => "01833963333", "course_id" => "0",],
            ["id" => "83", "student_name" => "Khokan Chandra Sarker", "student_email" => "khokanchem@yahoo.com", "student_number" => "01716411321", "course_id" => "0",],
            ["id" => "84", "student_name" => "Md Sadiqul Islam", "student_email" => "sadiqulru@yahoo.com", "student_number" => "01711930968", "course_id" => "0",],
            ["id" => "85", "student_name" => "Israt Jahan", "student_email" => "israt.jahan7044@gmail.com", "student_number" => "01796587960", "course_id" => "0",],
            ["id" => "86", "student_name" => "Nasrin Sultana", "student_email" => "nasrinsultanashilpy6@gmail.com", "student_number" => "01303822572", "course_id" => "1",],
            ["id" => "87", "student_name" => "Mohammad Sajjat Hossen Santo", "student_email" => "Sazzad25800@gmail.com", "student_number" => "01813688883", "course_id" => "0",],
            ["id" => "88", "student_name" => "Md. Golam Mortuza Mahin", "student_email" => "mortuzashifat8@gmail.com", "student_number" => "01982014016", "course_id" => "0",],
            ["id" => "89", "student_name" => "Md Abul Khayer", "student_email" => "md.tarun0000@gmail.com", "student_number" => "01811909926", "course_id" => "0",],
            ["id" => "90", "student_name" => "Mariyam Tamanna", "student_email" => "mariyam.242692@gmail.com", "student_number" => "01823249781", "course_id" => "0",],
            ["id" => "91", "student_name" => "Saburun Nesa Nawmi", "student_email" => "snnawmi203@gmail.com", "student_number" => "01771706004", "course_id" => "0",],
            ["id" => "92", "student_name" => "Ramjan Ali Khan majlish", "student_email" => "majlish.1994@gmail.com", "student_number" => "01713065708", "course_id" => "0",],
            ["id" => "93", "student_name" => "Jannatul Farhana Rupa", "student_email" => "jannatul.farhana2023@gmail.com", "student_number" => "01616630152", "course_id" => "0",],
            ["id" => "94", "student_name" => "Ahana", "student_email" => "aahanaafrida@gmail.com", "student_number" => "01713491736", "course_id" => "0",],
            ["id" => "95", "student_name" => "Niloy Khondaker", "student_email" => "niloykhondaker22@gmail.com", "student_number" => "01850113368", "course_id" => "0",],
            ["id" => "96", "student_name" => "Ahmed Babu", "student_email" => "s.a.babuhoney707@gmail.com", "student_number" => "01912840338", "course_id" => "0",],
            ["id" => "97", "student_name" => "Rahima Begum", "student_email" => "rahimashuma25@gmail.com", "student_number" => "01718147456", "course_id" => "0",],
            ["id" => "98", "student_name" => "Umma salma", "student_email" => "suchonasuchi715@gmail.com", "student_number" => "01865070548", "course_id" => "0",],
            ["id" => "99", "student_name" => "Zzahirul", "student_email" => "educationofkarma@gmail.com", "student_number" => "01540656077", "course_id" => "0",],
            ["id" => "100", "student_name" => "Tanvir Choudhury", "student_email" => "user_z847vmww@example.com", "student_number" => "01712100170", "course_id" => "0",],
            ["id" => "101", "student_name" => "Jahirul Islam Khan", "student_email" => "setoursbd@gmail.com", "student_number" => "01726114142", "course_id" => "0",],
            ["id" => "102", "student_name" => "MD Azim Rana", "student_email" => "azitbd.com@gmail.com", "student_number" => "01892353510", "course_id" => "0",],
            ["id" => "103", "student_name" => "jamir", "student_email" => "jomirhossen4@gmail.com", "student_number" => "01974438482", "course_id" => "0",],
            ["id" => "104", "student_name" => "Shahreen Hoque", "student_email" => "shahreen.hoque@gmail.com", "student_number" => "01764492708", "course_id" => "0",],
            ["id" => "105", "student_name" => "Md Rubel Miah", "student_email" => "rubelsocio@gmail.com", "student_number" => "01711122404", "course_id" => "0",],
            ["id" => "106", "student_name" => "Sayeda Ferdous Ahmed", "student_email" => "ahmed.sayeda0507@gmail.com", "student_number" => "01727421867", "course_id" => "0",],
            ["id" => "107", "student_name" => "Md. Mahbub Parvej", "student_email" => "rrfurnituremart1@gmail.com", "student_number" => "01717428000", "course_id" => "1",],
            ["id" => "108", "student_name" => "ZUBAYER", "student_email" => "zubayer993@gmail.com", "student_number" => "01974821927", "course_id" => "0",],
            ["id" => "109", "student_name" => "MD.Motiur Rahman Badal", "student_email" => "mahitoiletries@gmail.com", "student_number" => "01711762870", "course_id" => "0",],
            ["id" => "110", "student_name" => "Rossi barman", "student_email" => "rossi.barman@gmail.com", "student_number" => "01936084173", "course_id" => "0",],
            ["id" => "111", "student_name" => "MOHAMMED RASHED", "student_email" => "rashed143@yahoo.com", "student_number" => "01744470444", "course_id" => "0",],
            ["id" => "112", "student_name" => "Karan Bhowmick", "student_email" => "karanbhowmick55@gmail.com", "student_number" => "01814333866", "course_id" => "2",],
            ["id" => "113", "student_name" => "User_soniakonna12", "student_email" => "soniakonna12@gmail.com", "student_number" => "01311209401", "course_id" => "0",],
            ["id" => "114", "student_name" => "Md Abid Hossain", "student_email" => "abid.hossain@renata-ltd.com", "student_number" => "01707558874", "course_id" => "0",],
            ["id" => "115", "student_name" => "Ajufa Akhter", "student_email" => "ajuaaju@gmail.com", "student_number" => "01536157676", "course_id" => "0",],
            ["id" => "116", "student_name" => "Salma Akter", "student_email" => "salmamone2024@gmail.com", "student_number" => "01710588350", "course_id" => "1",],
            ["id" => "117", "student_name" => "Aklima Akhter Tisha", "student_email" => "aklimaakhter579@gamil.com", "student_number" => "01960286002", "course_id" => "2",],
            ["id" => "118", "student_name" => "MD.JIHAD HOSSEN", "student_email" => "shantobd6766@gmail.com", "student_number" => "01619455566", "course_id" => "2",],
            ["id" => "119", "student_name" => "A S M Muradullah", "student_email" => "businesshelpbd@gmail.com", "student_number" => "01875018501", "course_id" => "1",],
            ["id" => "120", "student_name" => "Bhaskar", "student_email" => "bmbanik79@gmail.com", "student_number" => "01944794000", "course_id" => "1",],
            ["id" => "121", "student_name" => "Jannat Munni", "student_email" => "jannatmunni322@gmail.com", "student_number" => "01736375400", "course_id" => "1",],
            ["id" => "122", "student_name" => "Md.Taslim Khan", "student_email" => "taslimkhanbd17@gmail.com", "student_number" => "01307619878", "course_id" => "1",],
            ["id" => "123", "student_name" => "Samia Bari", "student_email" => "samiabari80@gmail.com", "student_number" => "01736048748", "course_id" => "1",],
            ["id" => "124", "student_name" => "Mourie", "student_email" => "mouriechowdhury@gmail.com", "student_number" => "01817144389", "course_id" => "2",],
            ["id" => "125", "student_name" => "Syod firoj", "student_email" => "firoj661@icloud.com", "student_number" => "01869887442", "course_id" => "1",],
            ["id" => "126", "student_name" => "Maysha Siddika Mohona", "student_email" => "mayeeshasiddika00@gmail.com", "student_number" => "01630503553", "course_id" => "1",],
            ["id" => "127", "student_name" => "Aminul Islam", "student_email" => "aminulbhuiyan012@gmail.com", "student_number" => "01735574574", "course_id" => "1",],
            ["id" => "128", "student_name" => "Bellal Hossain", "student_email" => "malihaorganic1992@gmail.com", "student_number" => "01905851164", "course_id" => "1",],
            ["id" => "129", "student_name" => "Ridoy Roy", "student_email" => "ridoyroycse53engg@gmail.com", "student_number" => "01779714999", "course_id" => "1",],
            ["id" => "130", "student_name" => "Saddam Sikder", "student_email" => "saddamsikderfiles@gmail.com", "student_number" => "01681216082", "course_id" => "1",],
            ["id" => "131", "student_name" => "Mahafuza Akter Ronee", "student_email" => "akter.ronee@gmail.com", "student_number" => "01628104951", "course_id" => "1",],
            ["id" => "132", "student_name" => "User_user_3c5kll5i", "student_email" => "user_3c5kll5i@example.com", "student_number" => "01800000000", "course_id" => "1",],
            ["id" => "133", "student_name" => "Mubin", "student_email" => "mubin986@gmail.com", "student_number" => "01831925544", "course_id" => "1",],
            ["id" => "134", "student_name" => "MD Naziur Haque Emon", "student_email" => "mdnaziurhaqueemon732@gmail.com", "student_number" => "01748486048", "course_id" => "1",],
            ["id" => "135", "student_name" => "Ibrahim Hossain (Prince)", "student_email" => "princedhk77@gmail.com", "student_number" => "01795668466", "course_id" => "1",],
            ["id" => "136", "student_name" => "Shamima Shirin", "student_email" => "shamimashirin400664@gmail.com", "student_number" => "01912953590", "course_id" => "1",],
            ["id" => "137", "student_name" => "Ariful Rifat Hemel", "student_email" => "arifhemel41@gmail.com", "student_number" => "01869454688", "course_id" => "1",],
            ["id" => "138", "student_name" => "farhananahid", "student_email" => "farhananahid57@gmail.com", "student_number" => "01749855550", "course_id" => "0",],
            ["id" => "139", "student_name" => "Arafat Hossain", "student_email" => "arafathossain77724@gmail.com", "student_number" => "01609030475", "course_id" => "1",],
            ["id" => "140", "student_name" => "Atik Hasan Sobuj", "student_email" => "atikhasansobuj1@gmail.com", "student_number" => "01720807330", "course_id" => "0",],
            ["id" => "141", "student_name" => "Sazia Akter", "student_email" => "saziayesmin146@gmail.com", "student_number" => "01766530516", "course_id" => "1",],
            ["id" => "142", "student_name" => "Kazi Ruhul", "student_email" => "ruhulkazi9@gmail.com", "student_number" => "01713625916", "course_id" => "1",],
            ["id" => "143", "student_name" => "Munayem Rayhan", "student_email" => "mrvegitoblue@gmail.com", "student_number" => "01892727419", "course_id" => "1",],
            ["id" => "144", "student_name" => "Tania Afrin", "student_email" => "tafrin861@gmail.com", "student_number" => "01746914854", "course_id" => "1",],
            ["id" => "145", "student_name" => "Md. Rushaed Ali (Tomal)", "student_email" => "rushaed.versatile@gmail.com", "student_number" => "01714256601", "course_id" => "1",],
            ["id" => "146", "student_name" => "ashrafulbd282", "student_email" => "ashrafulbd282@gmail.com", "student_number" => "01766791364", "course_id" => "1",],
            ["id" => "147", "student_name" => "Khandoker Abul Bashar", "student_email" => "khandoker.bashar@gmail.com", "student_number" => "01731987623", "course_id" => "1",],
            ["id" => "148", "student_name" => "Kulsuma Begum", "student_email" => "taskinnihan35@gmail.com", "student_number" => "01712852501", "course_id" => "1",],
            ["id" => "149", "student_name" => "Md. Manik Hossain", "student_email" => "hmdmanik64@gamil.com", "student_number" => "01614101073", "course_id" => "1",],
            ["id" => "150", "student_name" => "Shahidul Islam Rayhan", "student_email" => "shahidul395.si@gmail.com", "student_number" => "01861006000", "course_id" => "1",],
            ["id" => "151", "student_name" => "Anower Hossain", "student_email" => "sebsebagro@gmail.com", "student_number" => "01310934796", "course_id" => "1",],
            ["id" => "152", "student_name" => "Humaira Haque Laiba", "student_email" => "laiba.isabela995@gmail.com", "student_number" => "01677817870", "course_id" => "1",],
            ["id" => "153", "student_name" => "Najirul Islam Islam", "student_email" => "najirul.islam533513@gmail.com", "student_number" => "01767804004", "course_id" => "1",],
            ["id" => "154", "student_name" => "Mosharaf hossain", "student_email" => "parvejbriste@gmail.com", "student_number" => "01717858003", "course_id" => "1",],
            ["id" => "155", "student_name" => "Arman Ibne Idris", "student_email" => "rokyarman.b@gmail.com", "student_number" => "01677504424", "course_id" => "1",],
            ["id" => "156", "student_name" => "Alamin", "student_email" => "alamin.iium2017@gmail.com", "student_number" => "01920915832", "course_id" => "1",],
            ["id" => "157", "student_name" => "Rumana Hossain", "student_email" => "rumana.hussen@gmail.com", "student_number" => "01839299734", "course_id" => "1",],
            ["id" => "158", "student_name" => "Liton", "student_email" => "litonnsi5@gmail.com", "student_number" => "01973903331", "course_id" => "3",],
            ["id" => "159", "student_name" => "Anisur", "student_email" => "anisurrahman015@gmail.com", "student_number" => "01870814727", "course_id" => "1",],
            ["id" => "160", "student_name" => "Md. Jahidul Chawdory", "student_email" => "www.jahidcw11@gmail.com", "student_number" => "01719131035", "course_id" => "1",],
            ["id" => "161", "student_name" => "Asma ul hosna", "student_email" => "asma18hosna@gmail.com", "student_number" => "01635399342", "course_id" => "1",],
            ["id" => "162", "student_name" => "Abdullah Al Mamun", "student_email" => "mamun.abdullah74@gmail.com", "student_number" => "01712203031", "course_id" => "1",],
            ["id" => "163", "student_name" => "Dr. Md. Bokul", "student_email" => "miahbakul113@gmail.com", "student_number" => "01325954646", "course_id" => "1",],
            ["id" => "164", "student_name" => "Dr. A Z M Doulat Al Mamun", "student_email" => "aimbd07@gmail.com", "student_number" => "01733228800", "course_id" => "1",],
            ["id" => "165", "student_name" => "Khadija Akter", "student_email" => "viqaroonnisanoon12@gmail.com", "student_number" => "01937128203", "course_id" => "1",],
            ["id" => "166", "student_name" => "Amit Kumar Saha", "student_email" => "amitkhulna23@gmail.com", "student_number" => "01719717605", "course_id" => "1",],
            ["id" => "167", "student_name" => "Md. Raqibul Alam", "student_email" => "raqibulalamapon@gmail.com", "student_number" => "01686495537", "course_id" => "1",],
            ["id" => "168", "student_name" => "Khondoker Ayasha Anjum", "student_email" => "anjumayasha@gmail.com", "student_number" => "01738891299", "course_id" => "1",],
            ["id" => "169", "student_name" => "Md. Osman Gani", "student_email" => "mdosmangani179@gmail.com", "student_number" => "01814915454", "course_id" => "1",],
            ["id" => "170", "student_name" => "Md. Mortuja Fahad", "student_email" => "fahadbinmubarak5@gmail.com", "student_number" => "01316514567", "course_id" => "0",],
            ["id" => "171", "student_name" => "Papia Sultana Snigdha", "student_email" => "sultanapapia965@gmail.com", "student_number" => "01825848122", "course_id" => "1",],
            ["id" => "172", "student_name" => "Emamur Rahman", "student_email" => "emamur946@gmail.com", "student_number" => "01710380313", "course_id" => "1",],
            ["id" => "173", "student_name" => "Khirul Islam", "student_email" => "kitowhid68@gmail.com", "student_number" => "01722045524", "course_id" => "1",],
            ["id" => "174", "student_name" => "Shoriful Islam", "student_email" => "shorifbd1@gmail.com", "student_number" => "01767516150", "course_id" => "1",],
            ["id" => "175", "student_name" => "Negar Sultana", "student_email" => "negersultana50@gmail.com", "student_number" => "01777634444", "course_id" => "0",],
            ["id" => "176", "student_name" => "Shahidul Islam Sabuj", "student_email" => "shahidulislamsabuj1@gmail.com", "student_number" => "01791009893", "course_id" => "1",],
            ["id" => "177", "student_name" => "Md. Golam Saklain", "student_email" => "saklain.nbiu@gmail.com", "student_number" => "01712769698", "course_id" => "1",],
            ["id" => "178", "student_name" => "Rakibul Hasan", "student_email" => "mrtexpress009@gmail.com", "student_number" => "01859405348", "course_id" => "1",],
            ["id" => "179", "student_name" => "Sharmin Akter", "student_email" => "sharminakther4954@gmail.com", "student_number" => "01685705161", "course_id" => "1",],
            ["id" => "180", "student_name" => "Mohammad Hossain", "student_email" => "tmkhossain@gmail.com", "student_number" => "01726877363", "course_id" => "1",],
            ["id" => "181", "student_name" => "Most. Asmara Begum", "student_email" => "asmarabegumabl@gmail.com", "student_number" => "01741081637", "course_id" => "1",],
            ["id" => "182", "student_name" => "Sharmin Jahan", "student_email" => "nnmee30@yahoo.com", "student_number" => "01715013577", "course_id" => "1",],
            ["id" => "183", "student_name" => "Fatema Ritu", "student_email" => "fatemaritu20@gmail.com", "student_number" => "01719243061", "course_id" => "0",],
            ["id" => "184", "student_name" => "Amit Chakraborty", "student_email" => "camit6151@gmail.com", "student_number" => "01818460299", "course_id" => "1",],
            ["id" => "185", "student_name" => "Shimul Sarwat", "student_email" => "shimulsarwat45@gmail.com", "student_number" => "01676909730", "course_id" => "1",],
            ["id" => "186", "student_name" => "Selina Akter", "student_email" => "Selinaakter32@gmail.com", "student_number" => "01746794293", "course_id" => "1",],
            ["id" => "187", "student_name" => "Saeed Mahmud Saiful Alam", "student_email" => "korkonika@gmail.com", "student_number" => "01713116565", "course_id" => "1",],
            ["id" => "188", "student_name" => "Meer Hasibuzzaman", "student_email" => "hasibsozol@gmail.com", "student_number" => "01912717723", "course_id" => "0",],
            ["id" => "189", "student_name" => "Md. Kazem Hossain", "student_email" => "mdkazem71@gmail.com", "student_number" => "01911472728", "course_id" => "1",],
            ["id" => "190", "student_name" => "Nazmus Sadat", "student_email" => "nazmussadat.saad@gmail.com", "student_number" => "01531182108", "course_id" => "1",],
            ["id" => "191", "student_name" => "Cleanser", "student_email" => "cleanser9631@gmail.com", "student_number" => "01886276210", "course_id" => "1",],
            ["id" => "192", "student_name" => "Munni Akter", "student_email" => "jobayerkhan89@gmail.com", "student_number" => "01681905120", "course_id" => "1",],
            ["id" => "193", "student_name" => "Mushfiq Hasnain", "student_email" => "worldwise.bd@gmail.com", "student_number" => "01711908963", "course_id" => "1",],
            ["id" => "194", "student_name" => "Halima Khan", "student_email" => "halima.khan3437@gmail.com", "student_number" => "01774321918", "course_id" => "1",],
            ["id" => "195", "student_name" => "Md. Morsalin", "student_email" => "morsalin99@gmail.com", "student_number" => "01914848245", "course_id" => "1",],
            ["id" => "196", "student_name" => "Romanch", "student_email" => "romanch@gmail.com", "student_number" => "01630689909", "course_id" => "1",],
            ["id" => "197", "student_name" => "Shofiqul Islam", "student_email" => "shafikul9220@gmail.com", "student_number" => "01946426669", "course_id" => "1",],
            ["id" => "198", "student_name" => "Afrin Hasan", "student_email" => "afrinhasan14@gmail.com", "student_number" => "01771223102", "course_id" => "1",],
            ["id" => "199", "student_name" => "Sabrina Mohi", "student_email" => "subrinaarafat32@gmail.com", "student_number" => "01784399632", "course_id" => "1",],
            ["id" => "200", "student_name" => "Abdullah Abu Syed Reza", "student_email" => "syed.reza909@gmail.com", "student_number" => "01885266433", "course_id" => "1",],
            ["id" => "201", "student_name" => "Khalid Rahman", "student_email" => "khalidrahman122065@gmail.com", "student_number" => "01737122065", "course_id" => "1",],
            ["id" => "202", "student_name" => "Mehedi Hasan", "student_email" => "mahadimunshi351@gmail.com", "student_number" => "01717298090", "course_id" => "1",],
            ["id" => "203", "student_name" => "Md. Jahangir Alam Noyon", "student_email" => "jahangira69@gmail.com", "student_number" => "01737170730", "course_id" => "1",],
            ["id" => "204", "student_name" => "Abu Ribat Ser", "student_email" => "cleanser9631@gmail.com", "student_number" => "01886276215", "course_id" => "2",],
            ["id" => "205", "student_name" => "Robin Hasan", "student_email" => "rakibulhasanmollah@gmail.com", "student_number" => "01832068300", "course_id" => "2",],
            ["id" => "206", "student_name" => "Sumaiya", "student_email" => "c.sumaiya12@gmail.com", "student_number" => "01779230376", "course_id" => "1",],
            ["id" => "207", "student_name" => "minhajul islam F1348 islam islam", "student_email" => "minhajuli830@gmail.com", "student_number" => "01772525250", "course_id" => "1",],
            ["id" => "208", "student_name" => "Mazharul Islam", "student_email" => "imazharul2020@gmail.com", "student_number" => "01550033477", "course_id" => "2",],
            ["id" => "209", "student_name" => "Yaashin Misbah Misbah", "student_email" => "yaashinmisbah@gmail.com", "student_number" => "01721601070", "course_id" => "1",],
            ["id" => "210", "student_name" => "Nafisa Tabassum Tabassum", "student_email" => "nafisant2019@gmail.com", "student_number" => "01869661295", "course_id" => "1",],
            ["id" => "211", "student_name" => "Sumia Akter Tohfa Tohfa", "student_email" => "sumaiatohfa95@gmail.com", "student_number" => "01750234095", "course_id" => "1",],
            ["id" => "212", "student_name" => "SIRAJ Hossain Hossain", "student_email" => "drsirajhossainakon@gmail.com", "student_number" => "01754932408", "course_id" => "1",],
            ["id" => "213", "student_name" => "Rifa Mom", "student_email" => "rifasmom.rmc@gmail.com", "student_number" => "01400908883", "course_id" => "1",],
            ["id" => "214", "student_name" => "Sabbir Ahmed", "student_email" => "nbsf1982@gmail.com", "student_number" => "01711164677", "course_id" => "1",],
            ["id" => "215", "student_name" => "salah uddin", "student_email" => "lavlu.denimach@gmail.com", "student_number" => "01712348060", "course_id" => "1",],
            ["id" => "216", "student_name" => "Mohammad Faysal", "student_email" => "mfaysalalam@gmail.com", "student_number" => "01815100020", "course_id" => "1",],
            ["id" => "217", "student_name" => "Adil Uzzaman", "student_email" => "adiluzzaman63@gmail.com", "student_number" => "01768555588", "course_id" => "1",],
            ["id" => "218", "student_name" => "M.A. Rahman", "student_email" => "ma.rahmanfb@gmail.com", "student_number" => "01748381927", "course_id" => "2",],
            ["id" => "219", "student_name" => "Shohag", "student_email" => "mdj946309@gmail.com", "student_number" => "01626240510", "course_id" => "2",],
            ["id" => "220", "student_name" => "Ahmed Foysal", "student_email" => "foysalahmed09643@gmail.com", "student_number" => "01988834522", "course_id" => "1",],
            ["id" => "221", "student_name" => "Sera Agro", "student_email" => "seraagro@gamil.com", "student_number" => "01795381998", "course_id" => "2",],
            ["id" => "222", "student_name" => "Most Tanzima", "student_email" => "mosttanzima@gmail.com", "student_number" => "01789369796", "course_id" => "1",],
            ["id" => "223", "student_name" => "Md Masud Rana", "student_email" => "mdmrana81@gmail.com", "student_number" => "01756768939", "course_id" => "1",],
            ["id" => "224", "student_name" => "Sharif Bhuiyan", "student_email" => "sharifskm77@gmail.com", "student_number" => "01400820022", "course_id" => "1",],
            ["id" => "225", "student_name" => "Ayesha Rahman", "student_email" => "rahmanayesha162@gmail.com", "student_number" => "01833912875", "course_id" => "1",],
            ["id" => "226", "student_name" => "Dalia Nasrin", "student_email" => "fatemanasrin7@gmail.com", "student_number" => "01703936003", "course_id" => "1",],
            ["id" => "227", "student_name" => "Noor Shama", "student_email" => "nsnooreshama@gmail.com", "student_number" => "01774557775", "course_id" => "1",],
            ["id" => "228", "student_name" => "Md Abu Fahim", "student_email" => "mdfahim91981@gmail.com", "student_number" => "01626625900", "course_id" => "1",],
            ["id" => "229", "student_name" => "Tarek Rahman Nisan", "student_email" => "nisansinfo@gmail.com", "student_number" => "01788110636", "course_id" => "1",],
            ["id" => "230", "student_name" => "Sumona Sultana", "student_email" => "craftngo6664@gmail.com", "student_number" => "01406696664", "course_id" => "1",],
            ["id" => "231", "student_name" => "Asraful Islam", "student_email" => "asrafulislam02011991@gmail.com", "student_number" => "01725621918", "course_id" => "1",],
            ["id" => "232", "student_name" => "Joly Alam", "student_email" => "jolyalam733@gmail.com", "student_number" => "01718821005", "course_id" => "1",],
            ["id" => "233", "student_name" => "Md.Tuhin", "student_email" => "md.tuhinwit231@gmail.com", "student_number" => "01777020676", "course_id" => "1",],
            ["id" => "234", "student_name" => "Zavia Tanni", "student_email" => "zaviatanniofficial@gmail.com", "student_number" => "01881654624", "course_id" => "1",],
            ["id" => "235", "student_name" => "Jamer Uddin", "student_email" => "jameruddin681@gmail.com", "student_number" => "01992395433", "course_id" => "1",],
            ["id" => "236", "student_name" => "Jannatul Ferdus Arin", "student_email" => "jferarin6@gmail.com", "student_number" => "01758525110", "course_id" => "1",],
            ["id" => "237", "student_name" => "Shamim Islam", "student_email" => "shamimislam5858@gmail.com", "student_number" => "01787876303", "course_id" => "1",],
            ["id" => "238", "student_name" => "Zn Shaon", "student_email" => "shaonnaim2@gmail.com", "student_number" => "01724131128", "course_id" => "1",],
            ["id" => "239", "student_name" => "Dr. Shaikh Zakir Mahmud", "student_email" => "zakirmahmud@gmail.com", "student_number" => "01819441700", "course_id" => "1",],
            ["id" => "240", "student_name" => "Zahid", "student_email" => "rukutelecom@gmail.com", "student_number" => "01705933500", "course_id" => "1",],
            ["id" => "241", "student_name" => "Zaber Mostafa", "student_email" => "zaber.mostafa@gmail.com", "student_number" => "01710223379", "course_id" => "1",],
            ["id" => "242", "student_name" => "Yasmin Sultana", "student_email" => "yasminsultanabd82@gmail.com", "student_number" => "01704701754", "course_id" => "1",],
            ["id" => "243", "student_name" => "Victor", "student_email" => "victorsaha92@gmail.com", "student_number" => "01676398230", "course_id" => "1",],
            ["id" => "244", "student_name" => "Umme Sumaiya leya", "student_email" => "leya.starfashion@gmail.com", "student_number" => "01307663939", "course_id" => "1",],
            ["id" => "245", "student_name" => "Moslem Uddin", "student_email" => "uddinmoslem132@gmail.com", "student_number" => "01715205408", "course_id" => "1",],
            ["id" => "246", "student_name" => "Towfiq Hossain", "student_email" => "akhtartowfiq@gmail.com", "student_number" => "01949331549", "course_id" => "1",],
            ["id" => "247", "student_name" => "Top Grain Oils", "student_email" => "topgrainoils@gmail.com", "student_number" => "01710518077", "course_id" => "1",],
            ["id" => "248", "student_name" => "Jobayer Rahman", "student_email" => "tejr43@gmail.com", "student_number" => "01716461953", "course_id" => "1",],
            ["id" => "249", "student_name" => "Taziz", "student_email" => "tarikazizbd23@gmail.com", "student_number" => "01841797741", "course_id" => "1",],
            ["id" => "250", "student_name" => "Taslima Rumki", "student_email" => "rumjhumrumki@gmail.com", "student_number" => "01912940294", "course_id" => "1",],
            ["id" => "251", "student_name" => "Taslima", "student_email" => "mubarakhsipon@gmail.com", "student_number" => "01615825623", "course_id" => "1",],
            ["id" => "252", "student_name" => "Montaisir", "student_email" => "montaisir838@gmail.com", "student_number" => "01715022322", "course_id" => "1",],
            ["id" => "253", "student_name" => "Tanjina Aktar Naema", "student_email" => "tanjinanaema@gmail.com", "student_number" => "01818659634", "course_id" => "1",],
            ["id" => "254", "student_name" => "Tanha Feroz", "student_email" => "tanhaferoz686@gmail.com", "student_number" => "01948193257", "course_id" => "1",],
            ["id" => "255", "student_name" => "Tamanna", "student_email" => "juitamannah@gmail.com", "student_number" => "01951385025", "course_id" => "1",],
            ["id" => "256", "student_name" => "tahmidhtamim", "student_email" => "tahmidgfx2020@gmail.com", "student_number" => "01886059131", "course_id" => "1",],
            ["id" => "257", "student_name" => "Syed Galib Arafeen", "student_email" => "galib.areefin@gmail.com", "student_number" => "01717758965", "course_id" => "1",],
            ["id" => "258", "student_name" => "Suriya", "student_email" => "suriyamansur2@gmail.com", "student_number" => "01763681629", "course_id" => "1",],
            ["id" => "259", "student_name" => "Sonali Akter", "student_email" => "sonaliakterca@gmail.com", "student_number" => "01772566491", "course_id" => "1",],
            ["id" => "260", "student_name" => "Sojeeb", "student_email" => "sojibenterprise22@gmail.com", "student_number" => "01922225040", "course_id" => "1",],
            ["id" => "261", "student_name" => "Sohel Mahmud", "student_email" => "sohelmaahmud0055@gmail.com", "student_number" => "01916584142", "course_id" => "1",],
            ["id" => "262", "student_name" => "Shimul Dutta", "student_email" => "shimul.dutta1@gmail.com", "student_number" => "01961896760", "course_id" => "1",],
            ["id" => "263", "student_name" => "Sheik Sazzad Hossain", "student_email" => "bandrose.it@gmail.com", "student_number" => "01907780000", "course_id" => "1",],
            ["id" => "264", "student_name" => "Sharmin Meem", "student_email" => "sharminmeem@583gmail.com", "student_number" => "01708970583", "course_id" => "1",],
            ["id" => "265", "student_name" => "Sharmin", "student_email" => "bdsharmin77@gmail.com", "student_number" => "01716541500", "course_id" => "1",],
            ["id" => "266", "student_name" => "shanaj-roksana", "student_email" => "shanajroksana@gmail.com", "student_number" => "01861103286", "course_id" => "1",],
            ["id" => "267", "student_name" => "Shahedur", "student_email" => "shahed_uap@yahoo.com", "student_number" => "01717446316", "course_id" => "1",],
            ["id" => "268", "student_name" => "Shabnam Liza", "student_email" => "shabnamm89@gmail.com", "student_number" => "01919315181", "course_id" => "1",],
            ["id" => "269", "student_name" => "Amor Chandra Das", "student_email" => "rtr.amor@gmail.com", "student_number" => "01617555112", "course_id" => "1",],
            ["id" => "270", "student_name" => "Sazzadul Alam", "student_email" => "sazzadulsohag@gmail.com", "student_number" => "01612561694", "course_id" => "1",],
            ["id" => "271", "student_name" => "Sayma Akter", "student_email" => "ssaymasiddique23@gmail.com", "student_number" => "01727184746", "course_id" => "1",],
            ["id" => "272", "student_name" => "Sayfun Nahar", "student_email" => "sayfunnahar797@gmail.com", "student_number" => "01722685797", "course_id" => "1",],
            ["id" => "273", "student_name" => "Sarfuddin Faisal", "student_email" => "faisalsarfuddin@gmail.com", "student_number" => "01777866661", "course_id" => "1",],
            ["id" => "274", "student_name" => "Saleha rahman", "student_email" => "rahmandatema77@gmail.com", "student_number" => "01747363575", "course_id" => "1",],
            ["id" => "275", "student_name" => "Md Sakib Ahamed", "student_email" => "ahamedsakib960@gmail.com", "student_number" => "01929424414", "course_id" => "1",],
            ["id" => "276", "student_name" => "Saiuddin", "student_email" => "saif77079@gmail.com", "student_number" => "01682531622", "course_id" => "1",],
            ["id" => "277", "student_name" => "Saiful islam", "student_email" => "generaltradingcx@gmail.com", "student_number" => "01851990620", "course_id" => "1",],
            ["id" => "278", "student_name" => "Saif Ahmed", "student_email" => "saifshihab14@gmail.com", "student_number" => "01710378514", "course_id" => "1",],
            ["id" => "279", "student_name" => "Md Saidur Rahman", "student_email" => "saidursoap@gmail.com", "student_number" => "01711379374", "course_id" => "1",],
            ["id" => "280", "student_name" => "Sabrin Sultana", "student_email" => "sabrin725114@gmail.com", "student_number" => "01814725114", "course_id" => "1",],
            ["id" => "281", "student_name" => "S M Romeo Hossain", "student_email" => "romeo.piash@gmail.com", "student_number" => "01711313901", "course_id" => "1",],
            ["id" => "282", "student_name" => "Rokibul", "student_email" => "rokibulislam699870@gmail.com", "student_number" => "01990653485", "course_id" => "1",],
            ["id" => "283", "student_name" => "Riazur Rahman", "student_email" => "rahmanriazur198@gmail.com", "student_number" => "01700708050", "course_id" => "1",],
            ["id" => "284", "student_name" => "Md. Abdur Razzak", "student_email" => "razzak_deshadev@yahoo.com", "student_number" => "01711432452", "course_id" => "1",],
            ["id" => "285", "student_name" => "ratree", "student_email" => "nusratratree.sau.79@gmail.com", "student_number" => "01631389206", "course_id" => "1",],
            ["id" => "286", "student_name" => "Rashed", "student_email" => "rashed8451@gmail.com", "student_number" => "01977499524", "course_id" => "1",],
            ["id" => "287", "student_name" => "Raqibul Alam", "student_email" => "raqibulalam75@gmail.com", "student_number" => "01718740375", "course_id" => "1",],
            ["id" => "288", "student_name" => "Rakib Sharker", "student_email" => "rakibsharker1996@gmail.com", "student_number" => "01641872620", "course_id" => "1",],
            ["id" => "289", "student_name" => "prabaltujan09", "student_email" => "prabaltujan09@gmail.com", "student_number" => "01741831920", "course_id" => "1",],
            ["id" => "290", "student_name" => "Nusrat Jahan Zitu", "student_email" => "nusratjahanzitu@gmail.com", "student_number" => "01939802931", "course_id" => "1",],
            ["id" => "291", "student_name" => "Nusrat Islam", "student_email" => "nusrat2404@gmail.com", "student_number" => "01816722727", "course_id" => "1",],
            ["id" => "292", "student_name" => "Nupur Farazi", "student_email" => "nupurfarazi009@gmail.com", "student_number" => "01825442424", "course_id" => "1",],
            ["id" => "293", "student_name" => "Mizan", "student_email" => "rahman612941@gmail.com", "student_number" => "01863612941", "course_id" => "1",],
            ["id" => "294", "student_name" => "Abdur Rob Milad", "student_email" => "arob.cep@gmail.com", "student_number" => "01886469076", "course_id" => "1",],
            ["id" => "295", "student_name" => "Yousuf Shimul", "student_email" => "megetinfo24@gmail.com", "student_number" => "01992292589", "course_id" => "0",],
            ["id" => "296", "student_name" => "Md Ripon Khan", "student_email" => "mdriponkhan5555550@gamil.com", "student_number" => "01740851804", "course_id" => "1",],
            ["id" => "297", "student_name" => "Md. Baharul Islam", "student_email" => "mdbaharulislam1900@gmail.com", "student_number" => "01998996706", "course_id" => "1",],
            ["id" => "298", "student_name" => "Md. Rofiqul Islam Rony", "student_email" => "ri4981675@gmail.com", "student_number" => "01778864396", "course_id" => "1",],
            ["id" => "299", "student_name" => "Md. Majedul Islam", "student_email" => "farmersbari.com.bd@gmail.com", "student_number" => "01973544804", "course_id" => "0",],
            ["id" => "300", "student_name" => "Md. Ismail", "student_email" => "bdshop32@gmail.com", "student_number" => "01681562031", "course_id" => "1",],
            ["id" => "301", "student_name" => "Md. Zahid Hassan", "student_email" => "priyozahid59@gmail.com", "student_number" => "01405267614", "course_id" => "1",],
            ["id" => "302", "student_name" => "Md. Zafrullah", "student_email" => "zafrullahhelmansur@gmail.com", "student_number" => "01951013726", "course_id" => "1",],
            ["id" => "303", "student_name" => "md-mustafizur-rahman-sharon", "student_email" => "mustafizsharon.cu@gmail.com", "student_number" => "01786628644", "course_id" => "1",],
            ["id" => "304", "student_name" => "Md. Maksudur Rahman", "student_email" => "mdmaksudur3@gmail.com", "student_number" => "01722445389", "course_id" => "1",],
            ["id" => "305", "student_name" => "Md. Khalid Hussain Ayon", "student_email" => "shunnoayon@gmail.com", "student_number" => "01619415341", "course_id" => "1",],
            ["id" => "306", "student_name" => "Iftekhar Hossain", "student_email" => "iftedc@gmail.com", "student_number" => "01936558093", "course_id" => "1",],
            ["id" => "307", "student_name" => "Md. Hasibul Hasan", "student_email" => "hasibcht@gmail.com", "student_number" => "01716334790", "course_id" => "1",],
            ["id" => "308", "student_name" => "Md. Azmol Haque", "student_email" => "azmol86@gmail.com", "student_number" => "01970080303", "course_id" => "1",],
            ["id" => "309", "student_name" => "Md. Al Emran Sardar", "student_email" => "emransardar7368@gmail.com", "student_number" => "01795664008", "course_id" => "1",],
            ["id" => "310", "student_name" => "Md wajiuddin zafore", "student_email" => "zafore82@gmail.com", "student_number" => "01845603741", "course_id" => "1",],
            ["id" => "311", "student_name" => "MD Shakil", "student_email" => "shakilahmod498@gmail.com", "student_number" => "01760544345", "course_id" => "1",],
            ["id" => "312", "student_name" => "Md Salim uddin", "student_email" => "neembasalim@gmail.com", "student_number" => "01763073338", "course_id" => "1",],
            ["id" => "313", "student_name" => "Md Mozammel Haque", "student_email" => "mdchowdhury6643@gmail.com", "student_number" => "01913976643", "course_id" => "1",],
            ["id" => "314", "student_name" => "Md Mahbub Patwary", "student_email" => "ru_mahbub@yahoo.co.in", "student_number" => "01730069300", "course_id" => "1",],
            ["id" => "315", "student_name" => "Md. Ifranul Huda", "student_email" => "ifranul@gmail.com", "student_number" => "01715427747", "course_id" => "1",],
            ["id" => "316", "student_name" => "MD Fazla Rabby", "student_email" => "m.frabby36@gmail.com", "student_number" => "01686770407", "course_id" => "1",],
            ["id" => "317", "student_name" => "Md Fayez", "student_email" => "fayezhasan1234@gmail.com", "student_number" => "01869992514", "course_id" => "1",],
            ["id" => "318", "student_name" => "Md Ashraful Alum", "student_email" => "hdhomeo@gmail.com", "student_number" => "01978789494", "course_id" => "1",],
            ["id" => "319", "student_name" => "bithymasuma@gmail.com", "student_email" => "bithymasuma@gmail.com", "student_number" => "01711031448", "course_id" => "1",],
            ["id" => "320", "student_name" => "Maruf Hossain Huma", "student_email" => "maruf.huma@gmail.com", "student_number" => "01922391892", "course_id" => "1",],
            ["id" => "321", "student_name" => "Mamun Ahmed", "student_email" => "mamunahmedofficial414@gmail.com", "student_number" => "01300777005", "course_id" => "1",],
            ["id" => "322", "student_name" => "Mamun Moni", "student_email" => "mamun50.moni@gmail.com", "student_number" => "01304050750", "course_id" => "1",],
            ["id" => "323", "student_name" => "Mala", "student_email" => "malakhatun197812@gmail.com", "student_number" => "01710487729", "course_id" => "1",],
            ["id" => "324", "student_name" => "Mak Bony", "student_email" => "pmak8925@gmail.com", "student_number" => "01775843176", "course_id" => "1",],
            ["id" => "325", "student_name" => "Mahir Arif", "student_email" => "mahirarif1234@gmail.com", "student_number" => "01305337084", "course_id" => "1",],
            ["id" => "326", "student_name" => "Mahfuz bhuyan", "student_email" => "inebula50@gmail.com", "student_number" => "01734113566", "course_id" => "1",],
            ["id" => "327", "student_name" => "Lopa Mazumder", "student_email" => "lopa.0470@gmail.com", "student_number" => "01685712274", "course_id" => "1",],
            ["id" => "328", "student_name" => "libaszone", "student_email" => "libaszone@gmail.com", "student_number" => "01854044933", "course_id" => "1",],
            ["id" => "329", "student_name" => "Lelin Dhar", "student_email" => "lelindhar14@gmail.com", "student_number" => "01740933154", "course_id" => "1",],
            ["id" => "330", "student_name" => "konoknewgmailcom", "student_email" => "konoknew@gmail.com", "student_number" => "01718436894", "course_id" => "1",],
            ["id" => "331", "student_name" => "ki780450", "student_email" => "ki780450@gmail.com", "student_number" => "01686239004", "course_id" => "1",],
            ["id" => "332", "student_name" => "khorsheda", "student_email" => "akterbaby37@gmail.com", "student_number" => "01771707160", "course_id" => "1",],
            ["id" => "333", "student_name" => "Khan Md. Sagar", "student_email" => "khanmdsagar96@gmail.com", "student_number" => "01735637915", "course_id" => "1",],
            ["id" => "334", "student_name" => "Kazi Shobi", "student_email" => "kaziadiba18@gmail.com", "student_number" => "01677621141", "course_id" => "1",],
            ["id" => "335", "student_name" => "Kazi Robin", "student_email" => "kazirobin1987@gmail.com", "student_number" => "01718485713", "course_id" => "1",],
            ["id" => "336", "student_name" => "K.M. Shameem Ahsan Ahsan", "student_email" => "shameem.kln@gmail.com", "student_number" => "01819451156", "course_id" => "1",],
            ["id" => "337", "student_name" => "Jumanna Akter", "student_email" => "jumannaakter00@gmail.com", "student_number" => "01725396053", "course_id" => "1",],
            ["id" => "338", "student_name" => "Jannatul Ferdus Nipa", "student_email" => "jannatulnipa5895@gmail.com", "student_number" => "01742005895", "course_id" => "1",],
            ["id" => "339", "student_name" => "Jannatul Fatema", "student_email" => "jannatulfatema881@gmail.com", "student_number" => "01711521852", "course_id" => "1",],
            ["id" => "340", "student_name" => "jahid-hasan-pappu", "student_email" => "pappu9299@gmail.com", "student_number" => "01728345133", "course_id" => "1",],
            ["id" => "341", "student_name" => "Shawda Jannat", "student_email" => "ibrahimia1988@gmail.com", "student_number" => "01852223563", "course_id" => "1",],
            ["id" => "342", "student_name" => "Ibrahim", "student_email" => "ibrahimbd29feni@gmail.com", "student_number" => "01815808229", "course_id" => "1",],
            ["id" => "343", "student_name" => "Hossen Ali", "student_email" => "hossen.ali.du@gmail.com", "student_number" => "01308230059", "course_id" => "1",],
            ["id" => "344", "student_name" => "Hadi", "student_email" => "hadi34nar@gmail.com", "student_number" => "01876533431", "course_id" => "1",],
            ["id" => "345", "student_name" => "Hasan", "student_email" => "hasan2502@gmail.com", "student_number" => "01616112112", "course_id" => "1",],
            ["id" => "346", "student_name" => "Hanif Sumon", "student_email" => "hanifhomedecor4373@gmail.com", "student_number" => "01724024373", "course_id" => "1",],
            ["id" => "347", "student_name" => "Hafizul Islam", "student_email" => "babahafiz.mpl@gmail.com", "student_number" => "01943355845", "course_id" => "1",],
            ["id" => "348", "student_name" => "Hafaj Robiul Islam Hafaj", "student_email" => "hafajrobi@gmail.com", "student_number" => "01926464512", "course_id" => "1",],
            ["id" => "349", "student_name" => "GM Eiacin", "student_email" => "gmeiacin98@gmail.com", "student_number" => "01818082398", "course_id" => "1",],
            ["id" => "350", "student_name" => "Ferdoushi Bcsir", "student_email" => "ferdoushi.bcsir@gmail.com", "student_number" => "01913071452", "course_id" => "1",],
            ["id" => "351", "student_name" => "Ferdous", "student_email" => "ferdous890@gmail.com", "student_number" => "01913949779", "course_id" => "1",],
            ["id" => "352", "student_name" => "Fatema Begum", "student_email" => "fatemabegum023@gmail.com", "student_number" => "01711267017", "course_id" => "1",],
            ["id" => "353", "student_name" => "Fatema Tuj Johra", "student_email" => "k.saifam1282@gmail.com", "student_number" => "01744313086", "course_id" => "1",],
            ["id" => "354", "student_name" => "Sharif Faruq Hossan", "student_email" => "faruqperso@gmail.com", "student_number" => "01940833146", "course_id" => "1",],
            ["id" => "355", "student_name" => "Kazi Abdulla evena shrif", "student_email" => "evenashrif@gmail.com", "student_number" => "01558956923", "course_id" => "1",],
            ["id" => "356", "student_name" => "Dr. Mamun", "student_email" => "hakim.mamun@gmail.com", "student_number" => "01712156008", "course_id" => "1",],
            ["id" => "357", "student_name" => "Dr. Asraful Islam", "student_email" => "jewel8020@gmail.com", "student_number" => "01720801466", "course_id" => "1",],
            ["id" => "358", "student_name" => "Dr Rakibul hasan", "student_email" => "drrakibulhasan20@gmail.com", "student_number" => "01673644559", "course_id" => "1",],
            ["id" => "359", "student_name" => "Doyeeta Dasgupta", "student_email" => "ddoyeeta@gmail.com", "student_number" => "01911317802", "course_id" => "1",],
            ["id" => "360", "student_name" => "Sirazul Islam Dipu", "student_email" => "dpustudio71@gmail.com", "student_number" => "01401110030", "course_id" => "1",],
            ["id" => "361", "student_name" => "Dewan Nehar", "student_email" => "dewannehar2016@gmail.com", "student_number" => "01674003369", "course_id" => "1",],
            ["id" => "362", "student_name" => "Md Mynul islam", "student_email" => "dalimmj95@gmail.com", "student_number" => "01970131806", "course_id" => "1",],
            ["id" => "363", "student_name" => "Mokter", "student_email" => "coxtc94@gmail.com", "student_number" => "01858000242", "course_id" => "1",],
            ["id" => "364", "student_name" => "Chowdhury Khadija Saz", "student_email" => "khadijasaz187@gmail.com", "student_number" => "01711083187", "course_id" => "1",],
            ["id" => "365", "student_name" => "Bushra Rahman", "student_email" => "identity.rizvanrahman@gmail.com", "student_number" => "01769009102", "course_id" => "1",],
            ["id" => "366", "student_name" => "Md. Emran Hossain", "student_email" => "biplobchisti@gmail.com", "student_number" => "01683557798", "course_id" => "1",],
            ["id" => "367", "student_name" => "Binita-Dhar", "student_email" => "binitadharbini143@gmail.com", "student_number" => "01686902792", "course_id" => "1",],
            ["id" => "368", "student_name" => "babar", "student_email" => "monjory.printer@gmail.com", "student_number" => "01768959864", "course_id" => "1",],
            ["id" => "369", "student_name" => "Azizul Hoque Limon", "student_email" => "limonhoque48@gmail.com", "student_number" => "01313055687", "course_id" => "1",],
            ["id" => "370", "student_name" => "arju-rahim", "student_email" => "arjurahim572@gmail.com", "student_number" => "01328297676", "course_id" => "1",],
            ["id" => "371", "student_name" => "Arifur Rahman", "student_email" => "arifurrhaman20@gmail.com", "student_number" => "01792180895", "course_id" => "1",],
            ["id" => "372", "student_name" => "Arifur Rahman", "student_email" => "arifurrahman.edu@gmail.com", "student_number" => "01755627985", "course_id" => "1",],
            ["id" => "373", "student_name" => "Arif Hossain", "student_email" => "arif2the6@gmail.com", "student_number" => "01767485862", "course_id" => "1",],
            ["id" => "374", "student_name" => "Arafat Hossin Pranto", "student_email" => "arafathossin0123@gmail.com", "student_number" => "01749405233", "course_id" => "1",],
            ["id" => "375", "student_name" => "Apon Good Food", "student_email" => "apongoodfood@gmail.com", "student_number" => "01720636259", "course_id" => "1",],
            ["id" => "376", "student_name" => "Md Anamul Haque", "student_email" => "mdanamul421052@gmail.com", "student_number" => "01873582077", "course_id" => "1",],
            ["id" => "377", "student_name" => "Amdadul", "student_email" => "m.a.t.executive.director@gmail.com", "student_number" => "01713362302", "course_id" => "1",],
            ["id" => "378", "student_name" => "Md. Abdullah", "student_email" => "mamun.mth@gmail.com", "student_number" => "01710404743", "course_id" => "1",],
            ["id" => "379", "student_name" => "Al Mamun", "student_email" => "mdalmamunsikder0@gmail.com", "student_number" => "01749419728", "course_id" => "1",],
            ["id" => "380", "student_name" => "Alamgir Kabir Kabir", "student_email" => "agkabir80@gmail.com", "student_number" => "01737211592", "course_id" => "1",],
            ["id" => "381", "student_name" => "Akter", "student_email" => "sharminakter1930@gmail.com", "student_number" => "01960275920", "course_id" => "1",],
            ["id" => "382", "student_name" => "Akashi Akther Toffa", "student_email" => "anthurioum.rz@gmail.com", "student_number" => "01743064542", "course_id" => "1",],
            ["id" => "383", "student_name" => "Aiman Uddin", "student_email" => "aimanu015@gmail.com", "student_number" => "01601171797", "course_id" => "1",],
            ["id" => "384", "student_name" => "Ahmed Shilpi", "student_email" => "ahmed.shilpi3043@gmail.com", "student_number" => "01711590377", "course_id" => "1",],
            ["id" => "385", "student_name" => "Affan", "student_email" => "pigeonfarm1@gmail.com", "student_number" => "01915820530", "course_id" => "1",],
            ["id" => "386", "student_name" => "Adnan", "student_email" => "atikullah6255@gmail.com", "student_number" => "01955276255", "course_id" => "1",],
            ["id" => "387", "student_name" => "Abu Kaiser", "student_email" => "abukaiser.raju@gmail.com", "student_number" => "01920071987", "course_id" => "1",],
            ["id" => "388", "student_name" => "Abu Sinha", "student_email" => "jannatulferdousnishi92@gmail.com", "student_number" => "01304175972", "course_id" => "1",],
            ["id" => "389", "student_name" => "Abrar Tashfin", "student_email" => "abrartashfin12@gmail.com", "student_number" => "01865471212", "course_id" => "1",],
            ["id" => "390", "student_name" => "Ador Rahman", "student_email" => "abdulla.al.noman1510@gmail.com", "student_number" => "01676771034", "course_id" => "1",],
            ["id" => "391", "student_name" => "Shajahan Pradhan", "student_email" => "abdulkuddusa4@gmail.com", "student_number" => "01869311598", "course_id" => "1",],
            ["id" => "392", "student_name" => "1shopbd2023", "student_email" => "1shopbd2023@gmail.com", "student_number" => "01624004148", "course_id" => "1",],


            ["id" => "393", "student_name" => "Lotas Wahid", "student_email" => "dilrubasw@gmail.com", "student_number" => "01783614200", "course_id" => "1"],
            ["id" => "394", "student_name" => "Arifunnesa", "student_email" => "arifunnesa2023@gmail.com", "student_number" => "01718704354", "course_id" => "1"],
            ["id" => "395", "student_name" => "Dr. Md Mizanur Rahman", "student_email" => "malekstoredbblab@gmail.com", "student_number" => "01731250775", "course_id" => "1"],
            ["id" => "396", "student_name" => "Fatema Akter", "student_email" => "sur.etotex11@gmail.com", "student_number" => "01777677411", "course_id" => "1"],
            ["id" => "397", "student_name" => "Fuad Hasan", "student_email" => "femon40@gmail.com", "student_number" => "01704239505", "course_id" => "1"],

            ["id" => "398", "student_name" => "Hasina Salma", "student_email" => "hasinasalma71@gmail.com", "student_number" => "01558457670", "course_id" => "1"],
            ["id" => "399", "student_name" => "Fahmida Sultana", "student_email" => "fahmidasultanagmc@gmail.com", "student_number" => "01754486918", "course_id" => "1"],
            ["id" => "400", "student_name" => "SN SHAKIB", "student_email" => "snorganica1@gmail.com", "student_number" => "01722396348", "course_id" => "1"],
            ["id" => "401", "student_name" => "MD MUSFIQ", "student_email" => "musfiq198117@gmail.com", "student_number" => "01965546221", "course_id" => "1"],
            ["id" => "402", "student_name" => "Hasan Mehedi", "student_email" => "mehedi.hasan17@outlook.com", "student_number" => "01725886386", "course_id" => "1"],
            ["id" => "403", "student_name" => "Md Abdullah", "student_email" => "mdabdmmu@gmail.com", "student_number" => "01883349494", "course_id" => "1"],
            ["id" => "404", "student_name" => "Habibur Rahman", "student_email" => "hasanmahmud1628@gmail.com", "student_number" => "01922529089", "course_id" => "1"],

            ["id" => "405", "student_name" => "Sharif Hossain", "student_email" => "sharif9983@gmail.com", "student_number" => "01823819983", "course_id" => "1"],
            ["id" => "406", "student_name" => "Akram Husain", "student_email" => "husainakram09@gmail.com", "student_number" => "01765854959", "course_id" => "1"],
            ["id" => "407", "student_name" => "Shirin Akter", "student_email" => "rasnijahan2016@gmail.com", "student_number" => "01772699694", "course_id" => "1"],
            ["id" => "408", "student_name" => "Jahidul Islam", "student_email" => "rjjahidul2025@gmail.com", "student_number" => "01846697236", "course_id" => "1"],
            ["id" => "409", "student_name" => "Farjana Akter Tania", "student_email" => "taniafarzana40@gmail.com", "student_number" => "01740126707", "course_id" => "1"],
            ["id" => "410", "student_name" => "Shahriar Mufid Rahman", "student_email" => "shahriarmufidrahman@gmail.com", "student_number" => "01726202884", "course_id" => "1"],
            ["id" => "411", "student_name" => "Iffat Arefin", "student_email" => "tanwi13@yahoo.com", "student_number" => "01710583584", "course_id" => "1"],
            ["id" => "412", "student_name" => "Mysha", "student_email" => "saifulislamti77@gmail.com", "student_number" => "01790452205", "course_id" => "1"],

            ["id" => "413", "student_name" => "Nazmush Sakib", "student_email" => "sakibfish@gmail.com", "student_number" => "01737500471", "course_id" => "1"],
            ["id" => "414", "student_name" => "Mohammed Saiful Kabir", "student_email" => "mosakauae@gmail.com", "student_number" => "01687832745", "course_id" => "1"],
            ["id" => "415", "student_name" => "Shifat-E-Jahan", "student_email" => "sjs.shifat@gmail.com", "student_number" => "01319629796", "course_id" => "1"],

            ["id" => "416", "student_name" => "Sharmin", "student_email" => "jahanrj80@gmail.com", "student_number" => "01884520074", "course_id" => "1"],
            ["id" => "417", "student_name" => "Nasrin Jahan", "student_email" => "nasrin.akter6796@gmail.com", "student_number" => "01604867143", "course_id" => "1"],
            ["id" => "418", "student_name" => "Fahmida Akter", "student_email" => "fahmidaakther832527@gmail.com", "student_number" => "01817274627", "course_id" => "1"],
            ["id" => "419", "student_name" => "Mahar Nigar Jui", "student_email" => "mahernigar1996@gmail.com", "student_number" => "01760279285", "course_id" => "1"],
            ["id" => "420", "student_name" => "S A M Jubayer", "student_email" => "jubayer1971@gmail.com", "student_number" => "01737339333", "course_id" => "1"],
            ["id" => "421", "student_name" => "Mahmuda Khanam", "student_email" => "nasrinhasnat0102@gmail.com", "student_number" => "01331223299", "course_id" => "1"],
            ["id" => "422", "student_name" => "Santa Islam", "student_email" => "santaislam17og@gmail.com", "student_number" => "01876329745", "course_id" => "1"],
            ["id" => "423", "student_name" => "Md. Nasir Haider Noori", "student_email" => "mnh.noori@gmail.com", "student_number" => "01777000444", "course_id" => "1"],
            ["id" => "424", "student_name" => "Ruma Akter", "student_email" => "md1023731@gmail.com", "student_number" => "01967080245", "course_id" => "1"],

            ["id" => "425", "student_name" => "najmul hasan", "student_email" => "forestman502@gmail.com", "student_number" => "01609710349", "course_id" => "1"],
            ["id" => "426", "student_name" => "Shahidullah", "student_email" => "s396hg258@gmail.com", "student_number" => "01928372762", "course_id" => "1"],
            ["id" => "427", "student_name" => "MD.Mehedi Hasan", "student_email" => "shovon144624@gmail.com", "student_number" => "01749650128", "course_id" => "1"],
            ["id" => "428", "student_name" => "Md. Shahin", "student_email" => "alombarun66678900@gmail.com", "student_number" => "01642464435", "course_id" => "1"],
            ["id" => "429", "student_name" => "Mahdi", "student_email" => "mdalimahdi73@gmail.com", "student_number" => "01325891413", "course_id" => "1"],
            ["id" => "430", "student_name" => "Md. Masud Rana", "student_email" => "masudbgbd24@gmail.com", "student_number" => "01914213231", "course_id" => "1"],

            ["id" => "431", "student_name" => "Sayem Bin Ashraf Mallik", "student_email" => "sayemashraf.malik81@gmail.com", "student_number" => "01818052615", "course_id" => "1"],
            ["id" => "432", "student_name" => "Samina Rafiq Mukti", "student_email" => "lailahaillallah122@gmail.com", "student_number" => "01613831594", "course_id" => "1"],
            ["id" => "433", "student_name" => "Zarin Sabah", "student_email" => "zarinsabah894@gmail.com", "student_number" => "01875313507", "course_id" => "1"],
            ["id" => "434", "student_name" => "MD MASUD BIN HASAN", "student_email" => "marzuqbinmasud@gmail.com", "student_number" => "01719313093", "course_id" => "1"],
            ["id" => "435", "student_name" => "Halima Islam", "student_email" => "rajmiah176@gmail.com", "student_number" => "01777340947", "course_id" => "1"],
            ["id" => "436", "student_name" => "Tanzila Basunia", "student_email" => "tanzilabasunia1992@gmail.com", "student_number" => "01794866665", "course_id" => "1"],
            ["id" => "437", "student_name" => "Taufique Anzan Ayon", "student_email" => "taufiqueanzan@gmail.com", "student_number" => "01918885339", "course_id" => "1"],
            ["id" => "438", "student_name" => "Abdur Rashid", "student_email" => "rashid.miah1961@gmail.com", "student_number" => "01757836207", "course_id" => "1"],
            ["id" => "439", "student_name" => "Mossammad Tahmina Sultana", "student_email" => "mtsultana2016@gmail.com", "student_number" => "01772501667", "course_id" => "1"],
            ["id" => "440", "student_name" => "Md. Abdul Halim", "student_email" => "begamih@gmail.com", "student_number" => "01858069108", "course_id" => "1"],

            ["id" => "441", "student_name" => "Md. Abu Saeed", "student_email" => "saeedpubs@gmail.com", "student_number" => "01717513056", "course_id" => "2"],
            ["id" => "442", "student_name" => "Nasrin Farzana", "student_email" => "farzanaripa444@gmail.com", "student_number" => "01949096883", "course_id" => "2"],
            ["id" => "443", "student_name" => "Sanjida Rahman Shelley", "student_email" => "advocateshelley1979@gmail.com", "student_number" => "01914129344", "course_id" => "2"],
            ["id" => "444", "student_name" => "Md. Nasim", "student_email" => "nasimu385@gmail.com", "student_number" => "01854369941", "course_id" => "2"],

            ["id" => "445", "student_name" => "Jakir Ahmed", "student_email" => "jakir111094@gmail.com", "student_number" => "01725318468", "course_id" => "4"],
            ["id" => "446", "student_name" => "Rahat", "student_email" => "archrahat3@gmail.com", "student_number" => "01794624546", "course_id" => "4"],

            ["id" => "447", "student_name" => "Farhana Sultana Disha", "student_email" => "farhanasultanadisha@gmail.com", "student_number" => "01728216905", "course_id" => "0"],

            ["id" => "448", "student_name" => "Shahadat Hossain", "student_email" => "shahadat3045@gmail.com", "student_number" => "01609496624", "course_id" => "1"],
            ["id" => "449", "student_name" => "Johara", "student_email" => "moinouddin200@gamil.com", "student_number" => "01865685257", "course_id" => "1"],
            ["id" => "450", "student_name" => "Jannatul Ferdous", "student_email" => "jfdewan76@gmail.com", "student_number" => "0187464770", "course_id" => "1"],
            ["id" => "451", "student_name" => "S M Naima Shohan Esha", "student_email" => "azansm81@gmail.com", "student_number" => "01877749927", "course_id" => "1"],
            ["id" => "452", "student_name" => "Jannat", "student_email" => "jannat.ictob@gmail.com", "student_number" => "01313622187", "course_id" => "2"],

            ["id" => "453", "student_name" => "Rownok Jahan", "student_email" => "", "student_number" => "01796359657", "course_id" => "1"],
            ["id" => "454", "student_name" => "Benzir shupti", "student_email" => "shupti.mithi08@gmail.com", "student_number" => "01937477099", "course_id" => "1"],
            ["id" => "455", "student_name" => "Jowel Chowdhury", "student_email" => "jowelco1@gmail.com", "student_number" => "01879106560", "course_id" => "1"],
            ["id" => "456", "student_name" => "Sayeda Sidratul Muntaha", "student_email" => "shormisidratul@gmail.com", "student_number" => "01701436492", "course_id" => "1"],
            ["id" => "457", "student_name" => "Nupur", "student_email" => "arohiakas@gmail.com", "student_number" => "01975532509", "course_id" => "1"],

            ["id" => "458", "student_name" => "Labib Farhan Aditya", "student_email" => "labibfarhan913@gmail.com", "student_number" => "01768797982", "course_id" => "0"],
            ["id" => "459", "student_name" => "Mst Fatema", "student_email" => "mstmukta1982@gmail.com", "student_number" => "01681643131", "course_id" => "2"],
            ["id" => "460", "student_name" => "Khaleda Haque", "student_email" => "lina.haque.666@gmail.com", "student_number" => "01793511595", "course_id" => "0"],
            ["id" => "461", "student_name" => "", "student_email" => "", "student_number" => "01960278360", "course_id" => "0"],
            ["id" => "462", "student_name" => "Rakibul Isalm", "student_email" => "rakibulroky2001@gmail.com", "student_number" => "01778114805", "course_id" => "1"],
            ["id" => "463", "student_name" => "Farzana Ahmed", "student_email" => "fasabuj@gmail.com", "student_number" => "01799537187", "course_id" => "1"],
            ["id" => "464", "student_name" => "", "student_email" => "", "student_number" => "01885957809", "course_id" => "0"],
            ["id" => "465", "student_name" => "Ummey Salma Akhi", "student_email" => "ummaysalma9424780@gmail.com", "student_number" => "01852208864", "course_id" => "0"],
            ["id" => "466", "student_name" => "", "student_email" => "", "student_number" => "01747684311", "course_id" => "0"],
            ["id" => "467", "student_name" => "", "student_email" => "", "student_number" => "01999363041", "course_id" => "0"],
            ["id" => "468", "student_name" => "", "student_email" => "", "student_number" => "01874647705", "course_id" => "0"],
            ["id" => "469", "student_name" => "", "student_email" => "", "student_number" => "01759876963", "course_id" => "0"],
            ["id" => "470", "student_name" => "", "student_email" => "", "student_number" => "01979079096", "course_id" => "0"],
            
            ["id" => "472", "student_name" => "", "student_email" => "", "student_number" => "01841610789", "course_id" => "0"],
            ["id" => "473", "student_name" => "", "student_email" => "", "student_number" => "01407206605", "course_id" => "0"],
            ["id" => "474", "student_name" => "", "student_email" => "", "student_number" => "01627241476", "course_id" => "0"],
            ["id" => "475", "student_name" => "", "student_email" => "", "student_number" => "01732521194", "course_id" => "0"],
            ["id" => "476", "student_name" => "", "student_email" => "", "student_number" => "01734425925", "course_id" => "0"],
            ["id" => "477", "student_name" => "", "student_email" => "", "student_number" => "01737354497", "course_id" => "0"],
            ["id" => "478", "student_name" => "", "student_email" => "", "student_number" => "01751624994", "course_id" => "0"],
            ["id" => "479", "student_name" => "", "student_email" => "", "student_number" => "01815848148", "course_id" => "0"],
            ["id" => "480", "student_name" => "", "student_email" => "", "student_number" => "01817772746", "course_id" => "0"],
            ["id" => "481", "student_name" => "", "student_email" => "", "student_number" => "01821830327", "course_id" => "0"],
            ["id" => "482", "student_name" => "", "student_email" => "", "student_number" => "01747989897", "course_id" => "0"],
            ["id" => "483", "student_name" => "", "student_email" => "", "student_number" => "01775713057", "course_id" => "0"],
            ["id" => "484", "student_name" => "", "student_email" => "", "student_number" => "01685586584", "course_id" => "0"],
            ["id" => "485", "student_name" => "", "student_email" => "", "student_number" => "01792659581", "course_id" => "0"],
            ["id" => "486", "student_name" => "", "student_email" => "", "student_number" => "01307857577", "course_id" => "0"],
            ["id" => "487", "student_name" => "", "student_email" => "", "student_number" => "01611443717", "course_id" => "0"],
            ["id" => "488", "student_name" => "", "student_email" => "", "student_number" => "01738706869", "course_id" => "0"],
            ["id" => "489", "student_name" => "", "student_email" => "", "student_number" => "01714969067", "course_id" => "0"],
            ["id" => "490", "student_name" => "", "student_email" => "", "student_number" => "01730068505", "course_id" => "0"],
            ["id" => "491", "student_name" => "", "student_email" => "", "student_number" => "01720005627", "course_id" => "0"],
            ["id" => "492", "student_name" => "", "student_email" => "", "student_number" => "01857427634", "course_id" => "0"],
            ["id" => "493", "student_name" => "", "student_email" => "", "student_number" => "01408816239", "course_id" => "0"],
            ["id" => "494", "student_name" => "", "student_email" => "", "student_number" => "01730975452", "course_id" => "0"],
            ["id" => "495", "student_name" => "", "student_email" => "", "student_number" => "01705809633", "course_id" => "0"],
            ["id" => "496", "student_name" => "", "student_email" => "", "student_number" => "01754804002", "course_id" => "0"],
            ["id" => "497", "student_name" => "", "student_email" => "", "student_number" => "01621723517", "course_id" => "0"],
            ["id" => "498", "student_name" => "", "student_email" => "", "student_number" => "01711010511", "course_id" => "0"],
        ];
        foreach ($student as $stu) {
            $is_data = DB::table('student')->where('id', $stu['id'])->first();

            if (!$is_data) {
             DB::table('student')->insert([
                 'student_name' => $stu['student_name'],
                 'student_photo' => "",
                 'student_address' => "",
                 'student_note' => "",
                 'student_division' => "",
                 'student_district' => "",
                 'student_email' => $stu['student_email'],
                 'student_number' => $stu['student_number'],
                 'student_birthday' => "",
                 'student_profession' => "",
                 'student_page_url' => "",
                 'student_profile_url' => "",
                 'student_password' => "",
                 'created_at' => "2025-01-01",
             ]);
            }
        }

        foreach ($student as $stu2) {
            $is_data = DB::table('enrolled_course')->where('student_id', $stu2['id'])->where('course_id', $stu2['course_id'])->first();

            if (!$is_data) {
                if($stu2['course_id'] == 0){}
                else{
                    DB::table('enrolled_course')->insert([
                        'student_id' => $stu2['id'],
                        'course_id' => $stu2['course_id'],
                        'is_new' => 1,
                        'enrolled_date' => Carbon::now(),
                    ]);
                }
            }
        }

        $student_data = DB::table('student')->get();
        foreach ($student_data as $stu) {
            $enrolled_course = DB::table('enrolled_course')->where('student_id', $stu->id)->count();
            DB::table('student')->where('id', $stu->id)->update(['student_enrolled_course' => $enrolled_course]);
        }

        //review
         $review = [
             [
                 "review" => "কোর্সটি দারুণ। প্রতিটি ধাপ সুন্দরভাবে ব্যাখ্যা করা হয়েছে। নিজে বানানো সাবান দেখে আনন্দিত।",
                 "review_rating" => 5,
                 "review_date" => '2025-05-01',
                 "student_id" => 10,
                 "course_id" => 1
             ]
         ];
         foreach ($review as $r) {
             $is_data = DB::table('course_review')->where('student_id', $r['student_id'])->where('course_id', $r['course_id'])->first();

             if (!$is_data) {
                 DB::table('course_review')->insert([
                     'review' => $r['review'],
                     'review_rating' => $r['review_rating'],
                     'review_date' => $r['review_date'],
                     'student_id' => $r['student_id'],
                     'course_id' => $r['course_id'],
                 ]);
             }
         }

        //gallery
        $gallery = [
            [
                "gallery_image" => "pic1.jpg",
            ],
            [
                "gallery_image" => "pic2.jpg",
            ],
            [
                "gallery_image" => "pic3.jpg",
            ]
        ];
        foreach ($gallery as $gl) {
            $is_data = DB::table('site_gallery')->where('gallery_image', $gl['gallery_image'])->first();

            if (!$is_data) {
                DB::table('site_gallery')->insert([
                    'gallery_image' => $gl['gallery_image']
                ]);
            }
        }

        //blog
        $blog = [
                [
                    "blog_title" => "কোল্ড প্রসেজ সাবানে কিভাবে pH নিয়ন্ত্রন করা যায়?",
                    "blog_slug" => "কোল্ড-প্রসেজ-সাবানে-কিভাবে-ph-নিয়ন্ত্রন-করানো-যায়",
                    "blog_thumbnail" => "ph_test.webp",
                    "blog_detail" => "<p>কোল্ড প্রসেজ সাবানের pH সাধারনত ৮ থেকে ১০ পর্যন্ত হতে পারে। তবে এটি নিয়ে ঘাবড়ানোর কোন কারন নেই। এই মাত্রার পিএইচ আমাদের ত্বকের জন্য সহনীয় তবে চোখ জ্বালা করতে পারে। বিশেষ করে বাচ্চাদের জন্য কোল্ড প্রসেজ সাবান ব্যবহার করা কিছুটা সমস্যার সৃষ্টি করতে পারে। আজ আলোচনা করবো কিভাবে কোল্ড প্রসেজ সাবানের পিএইচ নিয়ন্ত্রন করা সম্ভব।</p>

                                        <h3>ফর্মুলা নিয়ন্ত্রন</h3>

                                        <h4>১। সুপার ফ্যাটের ব্যবহার:</h4>
                                        <p>ফর্মুলা করার সময় সঠিক ভাবে লাই বা কস্টিক সোডা ব্যবহার করা উচিৎ। ফর্মূলা অনুসারে আমরা সাবানে সুপার ফ্যাট ৫% থেকে ১২% বা তার অধিক ব্যাবহার করতে পারি। এই সুপার ফ্যাট সাবানে অতিরিক্ত ক্ষারের উপস্থিতি নিয়ন্ত্রন করবে। ফলে পিএইচ নিয়ন্ত্রনে থাকবে।</p>

                                        <h4>২। সঠিক ভাবে পরিমাপ করা:</h4>
                                        <p>সোপ তৈরীর কাঁচামাল পরিমাপ করার সময় আমরা চেষ্টা করব কিছুটা দামি ব্যালেন্স ব্যবহার করার। বাজারে যে সকল সস্তা ব্যালেন্স রয়েছে তা বেশির ভাগ ক্ষেত্রে সঠিক ভাবে পরিমাপ করতে পারে না।</p>

                                        <h3>ক্ষারের উপস্থিতি পরীক্ষা ও কিউরিং</h3>

                                        <p>৪-৬ সপ্তাহ কিউরিং করার পরে আমরা চাইলে পিএইচ স্ট্রাইপ দিয়ে অথবা Phenolphthalein টেষ্ট করে অধিক এলকালি বা ক্ষারের পরীক্ষা করতে পারি। সঠিক পরিবেশে ও সঠিক নিয়মে সোপ কিউরিং করলে স্বাভাবিক ভাবেই পিএইচ কম হতে পারে।</p>

                                        <h3>সোপ pH কমানোর উপায়</h3>

                                        <p>কোল্ড প্রসেজ সোপ প্রাকৃতিক ভাবেই অধিক ক্ষারীয় হয়ে থাকে। চলুন কিছু পদ্ধতি আলোচনা করা যাক যার মাধ্যমে পিএইচ নিয়ন্ত্রন করা সম্ভব।</p>

                                        <h4>সাইট্রিক এসিড:</h4>
                                        <p>সামান্য পরিমান সাইট্রিক এসিড সাবানের পিএইচ নিউট্রাল করতে পারে। তবে অধিক ব্যবহার স্যাফোনিফিকেশন ব্যহত করতে পারে। ওয়াটার ফেজ এ ০.৫% থেকে ১% পর্যন্ত ব্যবহার করা যেতে পারে।</p>

                                        <h4>ভিনেগার ও ল্যাক্টিক এসিড:</h4>
                                        <p>সামান্য পরিমান ভিনেগার অথবা ল্যাক্টিক এসিড সাবানের পিএইচ নিয়ন্ত্রন করতে পারে। যদিও এসিড লাই এর ক্ষমতা কমিয়ে দিতে পারে। তাই এডজাস্টমেন্ট সম্পর্কে ধারণা থাকতে হবে।</p>

                                        <h4>সোডিয়াম ল্যাকটেট:</h4>
                                        <p>সোডিয়াম ল্যাকটেট সাবানকে শক্ত করতে পারে। এই উপাদানটিও সাবানের পিএইচ কমাতে ভূমিকা রাখতে পারে।</p>

                                        <h4>নোট:</h4>
                                        <p>পিএইচ কমাতে রেসিপিতে অধিক পরিমাণ এসিড এর ব্যবহার সাবানের স্ট্রাকচার নষ্ট করে দিতে পারে। এছাড়াও সাবান নরম ও চিটচিটে হতে পারে।</p>

                                        <h3>শেষ কথা</h3>

                                        <p>সবশেষে বলতে পারি, কোল্ড প্রসেজ সাবনের পিএইচ প্রাকৃতিক ভাবেই বেশি হতে পারে। তবে এই বেশি পিএইচ (৮-৯.৫) ত্বকের জন্য ক্ষতিকারক নয়। ব্যবহারের প্রথম দিকে কিছু অস্বস্তি লাগলেও এটি ধীরে ধীরে ত্বকে এডজাস্ট হয়ে যাবে।</p>

                                        <p>সঠিক সুপার ফ্যাটের ব্যবহার, মৃদু এসিড এর ব্যবহার ও সঠিক কিউরিং সময় মেন্টেন করে খুব সহজেই সাবানের পিএইচ নিয়ন্ত্রন সম্ভব।</p>
                                        ",
                ],
                [
                    "blog_title" => "সাবান তৈরীর বিভিন্ন রকম টার্মস জেনে নিন",
                    "blog_slug" => "সাবান-তৈরীর-বিভিন্ন-রকম-টার্মস-জেনে-নিন",
                    "blog_thumbnail" => "soap_making.webp",
                    "blog_detail" => "
                                        <p>যখন আপনি সাবান তৈরী করতে আসবেন তখন বিভিন্ন নতুন নতুন শব্দ আপনাকে শুনতে হবে। যা অনেক সময় আপনার বুঝতে অসুবিধা হতে পারে। তাই কিছু শব্দ নিয়ে এই আয়োজন। চলুন জেনে নেয়া যাক-</p>

                                        <h3>হার্ডনেস (Hardness)</h3>
                                        <p>একটি সাবান কতটুকু শক্ত বা নরম এটি প্রকাশ করার জন্য হার্ডনেস শব্দটি ব্যবহার করা হয়। একটি আদর্শ সাবানের হার্ডনেস ভ্যালু ২৯ থেকে ৫৪ এর ভিতরে। ভ্যালু যত বেশি ততো শক্ত সাবান।</p>

                                        <h3>ক্লিনজিং (Cleansing)</h3>
                                        <p>একটি সাবান কতটুকু তেল অপসারন করার ক্ষমতা রাখে তাকে ক্লিনজিং বলা হয়। একটি আদর্শ সাবানের ক্লিনজিং মান ১২ থেকে ২২ এর ভিতরে। বিষয়টা যত সাধারন মনে হচ্ছে আসলে ততোটা সাধারন নয়। অধিক ক্লিনজিং যুক্ত সাবান সবাই ব্যবহার করতে পরে না। যেমন- যাদের ত্বক শুষ্ক, চর্মরোগ রয়েছে তাদের জন্য উচ্চ ক্লিনজিং সাবান বেশ ক্ষতিকর। একজন সোপ এক্সপার্ট মূলত এটি নিয়ন্ত্রন করে রেসিপি করে থাকেন। অনেক সময় ক্লিনজিং নিয়ন্ত্রনের জন্য সুপার ফ্যাট ব্যবহার করতে হয়।</p>

                                        <h3>কন্ডিশনিং (Conditioning)</h3>
                                        <p>কন্ডিশনিং বলতে ত্বক কোমল রাখার উপাদানকে বোঝায়। আমরা যখন সাবান ব্যবহার করি তখন তার কিছু উপাদান ত্বকের উপর থেকে যায়। যে উপদান আমাদের ত্বকের মশ্চার ধরে রাখতে সহায়তা করে। যা ত্বকের সাথে সহজেই স্যুট করে ও ত্বককে নরম রাখতে হেল্প করে। একটি আদর্শ সাবানের কন্ডিশনিং মান ৪৪ থেকে ৬৯ এর ভিতরে হয়ে থাকে।</p>

                                        <h3>বুবলি (Bubbly)</h3>
                                        <p>এটি সাবানের বুদবুদ হওয়ার ক্ষমতাকে বোঝায়। আর এর মান ১৪ থেকে ৪৬ এর ভিতরে রাখতে হয়। ন্যাচারাল সাবানে অনেক সময় বুবলি বাড়াতে চিনি বা মধু ব্যবহার করতে হয়।</p>

                                        <h3>ক্রিমি (Creamy)</h3>
                                        <p>এটি সাবানের ফেনার স্থায়ীত্ব ও ক্লিমকে বোঝায়। এটির মান সাবানে ১৬ থেকে ৪৮ এর ভিতরে রাখা জরুরী। একটি সাবানে যত বেশি ক্রিম থাকে এটি দেখতে ততো আকর্ষনীয় মনে হয়। সাবানে শিয়া বাটার ব্যবহার করলে দেখতে অন্যরকম মনে হয়।</p>

                                        <h3>আয়ডিন (Iodine)</h3>
                                        <p>আয়োডিন মান কম হলে সাবান শক্ত হয় পাশাপাশি কন্ডিশনিং কোয়ালিটি কমতে শুরু করে। আয়োডিন মান ৭০ এর উপরে হলে সাবান নরম হয়ে যায়।</p>

                                        <h3>আইএনএস (INS)</h3>
                                        <p><strong>Iodine’n SAP</strong> এটি দ্বার সাধারনত একটি সাবানের বৈশিষ্ট কেমন তা বোঝানো হয়। একটি আদর্শ সাবানের আইএনএস ভেলু ১৬০ হতে পারে। তবে ১৩৬ থেকে ১৭০ এর ভিতরে হলেও তা গ্রহনযোগ্য।</p>

                                        <h3>সুপার ফ্যাট (Super Fat)</h3>
                                        <p>সুপার ফ্যাট হলো একটি সাবানের অতিরিক্ত তেল বা ফ্যাট যা কস্টিকের সাথে বিক্রিয়া না করে সাবানের ভিতরে সুপ্ত অবস্থায় থাকে।</p>

                                        <h3>ওয়াটার : লাই রেশিও (Water: Lye Ratio)</h3>
                                        <p>বাংলাদেশের আবহাওয়াতে <strong>1.8:1</strong> রেশিও পার্ফেক্ট মনে হয়েছে। অর্থাৎ লাই সলুশন ১ গ্রাম হলে পানি হতে ১.৮ গ্রাম। পানি বেশি হলে সাবান শুকাতে বেশি সময় লাগতে পারে। পাশাপাশি সাবানের উপর সোডা অ্যাশ (সাবানের উপরে সাদা সাদা দেখা দেয়) তৈরীর হওয়ার প্রবনাতা সৃষ্টি হতে পারে। তাই আপনার পরিবেশ ও উপাদানের উপর এটি এডজাষ্ট করে নেয়া খুবই জরুরী।</p>

                                        <h3>স্যাচুরেটেড: আনস্যাচুরেটেড রেশিও (Sat: Unsat Ratio)</h3>
                                        <p>
                                        <strong>স্যাচুরেটেড ফ্যাট</strong> মানে রুম টেম্পারেচার এ এটি শক্ত হয়ে যায়। যেমন মাখন, পনির, পাম কার্নেল, নারকেল তেল ইত্যাদি।
                                        </p>
                                        <p>
                                        <strong>আনস্যাচুরেটেড ফ্যাট</strong> বা অসম্পৃক্ত চর্বি সাধারণত ঘরের তাপমাত্রায় তরল থাকে। যেমন জলপাই তেল, সূর্যমুখী তেল ইত্যাদি।
                                        </p>
                                        ",
                ],
                [
                "blog_title" => "সাবান তৈরির জন্য সুরক্ষা সরঞ্জামগুলি জানুন",
                "blog_slug" => "সাবান-তৈরির-জন্য-সুরক্ষা-সরঞ্জামগুলি-জানুন",
                "blog_thumbnail" => "safety.webp",
                "blog_detail" => "<p><strong>কোল্ড প্রসেজ সাবান তৈরীতে সেফটি যন্ত্রপাতি:</strong></p>
                                    <ul>
                                      <li>হ্যান্ড গ্লোভস্</li>
                                      <li>সেফটি গগলস্</li>
                                      <li>মাস্ক</li>
                                      <li>এপ্রোন</li>
                                    </ul>

                                    <h3>হ্যান্ড গ্লোভস্</h3>
                                    <p>আমরা জানি সাবান তৈরী হয় মূলত তেল বা চর্বি ও ক্ষার বা কষ্টিক সোডা বা সোডিয়াম হাইড্রোক্সাইডের মিশ্রণে। সরাসরি তেল আমাদের ত্বকের জন্য নিরাপদ হলেও কষ্টিক সোডা আমাদের ত্বকের জন্য নিরাপদ নয়। এটি ত্বকে জ্বলাপোড়া, চুলকানো আবার কখনো কখনো ত্বক পুড়ে যেতে পারে। তাই ত্বকের নিরাপত্তায় আমাদের অবশ্যই সাবান তৈরী করার সময় হাতে হ্যান্ড গ্লোভস্ ব্যবহার করা উচিৎ।</p>

                                    <h3>সেফটি গগলস্</h3>
                                    <p>কষ্টিক সোডা চোখের জন্য খুবই ক্ষতিকারক একটি রাসায়নিক। এটি চোখে গেলে অনেক সময় চোখ নষ্ট হয়ে যেতে পারে। তবে অসাবধানতায় যদি চোখে চলে যায় তাহলে দ্রুত চলমান পানি দিয়ে চোখ ভালো করে পরিষ্কার করে ডাক্তার পরামর্শ নিতে হবে। তাছাড়া বিপদ বলে কয়ে আসে না, কাজ করার সময় যে কোন মূহুর্তে সোডা আমাদের চোখে যেতে পারে তাই চোখের নিরাপত্তায় অবশ্যই সেফটি গগলস্ ব্যবহার করুন।</p>

                                    <h3>মাস্ক</h3>
                                    <p>সাবান তৈরী করার সময় আমাদের কষ্টিক সোডা পানিতে মেশাতে হয়। তখন প্রচুর ধোঁয়া তৈরী হয়। এই ধোঁয়া যেমন আমাদের চোখের জন্য ক্ষতিকর, তেমনি আমাদের শ্বাসযন্ত্রের জন্যও বেশি ক্ষতিকর। তাই নিজের শ্বাসযন্ত্র নিরাপদ রাখতে সাবান তৈরীর সময় অবশ্যই মাস্ক ব্যবহার করুন।</p>

                                    <h3>এপ্রোন</h3>
                                    <p>কাজ করার সময় অসাবধানতায় অনেক সময় যে কোন কিছু যেমন, তেল ও কষ্টিক আমাদের পোশাকে লেগে যেতে পারে। তাই পোশাক ও নিজের নিরাপত্তায় এপ্রোন পরে কাজ করলে অনেকটা নিরাপদ থাকা যায়।</p>

                                    <h3>শেষ কথা</h3>
                                    <p>আশা করি আজকের আর্টিকেলটি আপনাদের বেশ উপকারে আসবে। আবারো সবাইকে বলছি, নিজের নিরাপত্তা সবার আগে। তাই সাবান তৈরীর সময় অবশ্যই নিরাপত্তার জন্য সেফটি যন্ত্রপাতি ব্যবহার করুন।</p>",
            ],
            [
                "blog_title" => "সাবান তৈরি করতে কি কি লাগে",
                "blog_slug" => "সাবান-তৈরি-করতে-কি-কি-লাগে",
                "blog_thumbnail" => "soap_making.webp",
                "blog_detail" => "<p>সাবান তৈরি করতে কি কি লাগে সেটা নির্ভর করে সাবান তৈরীর পদ্ধতির উপর। তিন ধরনের সাবান তৈরীর পদ্ধতি লক্ষনীয়, আর এই তিন রকম সাবান তৈরী করতে তিন রকমেরই সেটআপ দরকার হবে। কোনটায় যন্ত্রপাতি লাগে, কোনটায় কেমিক্যাল।</p>

                                    <h3>পরিবেশ</h3>
                                    <p>সাবান তৈরী করার জন্য পরিবেশ সবচেয়ে গুরুত্বপূর্ণ বিষয়। পরিবেশ হতে হবে আদ্রতা ফ্রি, যদিও আমাদের দেশে আদ্রতা ফ্রি পরিবেশ পাওয়াটা বেশ কঠিন কাজ। এর জন্য ব্যবহার করতে হয় একটি বদ্ধ রুম আর ডিহিউমিডিফায়ার মেশিন। ডিহিউমিডিফায়ার এর বৈশিষ্ট হলো এটি বাতাসের আদ্রতা পানিতে রূপান্তর করে মেশিনে জমা করে। এতে রুম থাকে শুষ্ক। আর রুম যদি শুষ্ক না থাকে তাহলে সাবান ড্রাই করাটা বেশ কঠিন হয়ে দাঁড়াবে।</p>

                                    <h3>কাচামাল</h3>
                                    <p>এক এক রকম সাবানের জন্য কাচামাল এক এক রকম। তবে আমার কাছে মনে হয় ঘুরে ফিরে সকল কাচামাল একই থাকে, শুধু দুই একটা উপাদান পরিবর্তন হয়। সাবান তৈরীর কিছু কাচামালের লিস্ট দেয়া হলো, তবে সব কাচামাল একই সাবানে ইউজ হয় না:</p>

                                    <ul>
                                      <li>বিভিন্ন রকম উদ্ভিজ্য তেল</li>
                                      <li>পশু চর্বি</li>
                                      <li>সোডিয়াম হাইড্রোক্সাইড</li>
                                      <li>পটাসিয়াম হাইড্রোক্সাইড</li>
                                      <li>SLES</li>
                                      <li>সোডিয়াম ল্যাকটেট</li>
                                      <li>প্রপালিন গ্লাইকোল</li>
                                      <li>এলকোহল</li>
                                      <li>ট্রাইইথানোলামাইন</li>
                                      <li>বিভিন্ন ভেষজ উপাদান</li>
                                      <li>এসেনশিয়াল অয়েল</li>
                                      <li>ফ্র্যাগরেন্স</li>
                                      <li>ইত্যাদি</li>
                                    </ul>

                                    <h3>যন্ত্রপাতি</h3>
                                    <p>যন্ত্রপাতি বলতে আসলে দুটি জিনিসকে বোঝায় — প্রথমত একটি বড় পাত্র, অন্যটি হলো মোল্ড বা ডাই। এখন এই দুটি যন্ত্র অটোমেটিকও হতে পারে আবার ম্যানুয়ালও হতে পারে। যেমন কোল্ড প্রসেস সাবান তৈরি করতে একটা স্টেইনলেস স্টিলের পাত্র হলেই হয়ে যাবে, কিন্তু যখন আপনি হট প্রসেস সাবান তৈরী করবেন তখন একটি বড় পাত্র বা মেশিন দরকার হবে।</p>
                                    <p>অতিরিক্তভাবে কিছু প্রয়োজনীয় যন্ত্রপাতি:</p>
                                    <ul>
                                      <li>সোপ কাটার</li>
                                      <li>থার্মোমিটার</li>
                                      <li>ইলেকট্রিক ব্যালেন্স</li>
                                    </ul>

                                    <h3>আলাদা রুম</h3>
                                    <p>ড্রাই, প্যাকেজিং ও স্টোর করার জন্য দরকার হবে কয়েকটি আলাদা রুম, যাতে করে কাজ করতে সুবিধা হয়। তবে ড্রাই করতে অবশ্যই আলাদা রুম থাকা দরকার, কারণ সাবান থেকে যখন কষ্টিক সোডা উড়ে যেতে থাকবে তখন যেন সেটা আমাদের শ্বাসযন্ত্রে না প্রবেশ করতে পারে।</p>

                                    <h3>পরীক্ষাগার</h3>
                                    <p>সাবানের মান নিয়ন্ত্রণ করার জন্য দরকার হবে একটি পরীক্ষাগার ও একজন অভিজ্ঞ ব্যক্তি, যেখানে pH, TFM সহ নানান পরীক্ষা করা সম্ভব হবে।</p>

                                    <h3>ডকুমেন্টস্</h3>
                                    <p>যে কোন ব্যবসা পরিচালনা করার জন্য ডকুমেন্টস্ থাকতেই হবে। বাইরে থেকে অনেকেই এই ডকুমেন্টস নিয়ে বেশ চিন্তায় থাকে। তবে আমাদের কথা হলো, কোন কিছুই অসম্ভব নয়। কারো কাছ থেকে তথ্য না নিয়ে সরাসরি আপনি অফিসে চলে গিয়ে তথ্য নিন। এতে দেখবেন খুবই সহজভাবে আপনি নিজেই সকল ডকুমেন্টস করতে পারবেন।</p>

                                    <p>যে ডকুমেন্টস গুলো প্রয়োজন:</p>
                                    <ul>
                                      <li>ট্রেড লাইসেন্স</li>
                                      <li>ট্যাক্স সার্টিফিকেট</li>
                                      <li>ট্রেডমার্ক</li>
                                      <li>কম্পানি একাউন্ট</li>
                                    </ul>

                                    <p>তবে সাবানের বিজনেস করতে হলে একটি বড় চ্যালেঞ্জ হলো BSTI অ্যাপ্রুভাল নেয়া। তবে হোমমেড বা হ্যান্ডমেড হার্বাল সাবানের জন্য এখন পর্যন্ত BSTI লিস্টেড নয়, তাই সকলে BCSIR এর মাধ্যমে এই বিজনেস করে থাকেন।</p>

                                    <h3>শেষ কথা</h3>
                                    <p>আমার ক্ষুদ্র জ্ঞানে যতটুকু সম্ভব হয়েছে আপনাদের সাথে শেয়ার করার চেষ্টা করেছি। আশা করছি কারো কারো উপকারে আসবে। ভালো লাগলে লেখাটি আপনার ফেসবুকে শেয়ার করতে পারেন। সবাই ভালো থাকবেন, সুস্থ থাকবেন, আল্লাহ হাফেজ।</p>
                                    ",
            ]
        ];
        foreach ($blog as $bl) {
            $is_data = DB::table('blog')->where('blog_title', $bl['blog_title'])->first();

            if (!$is_data) {
                DB::table('blog')->insert([
                    'blog_title' => $bl['blog_title'],
                    'blog_slug' => $bl['blog_slug'],
                    'blog_thumbnail' => $bl['blog_thumbnail'],
                    'blog_detail' => $bl['blog_detail']
                ]);
            }
        }

    }
}
