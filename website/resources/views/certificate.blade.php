@extends('layouts.app')
@section('title', 'Jobayer Academy - Certificate')

@section('content')
    <div class="as-flex as-flex-col as-align-center as-justify-center as-w-95 dt:as-mw-1280px as-m-0-auto">
        <div id="certificate-container" style="display: none; text-align: center;">
            <div id="certificate"
                style="margin-top: 10px; width: 1124px; height: 797px; border: 1px solid #e6e6e6; padding: 30px;">
                <div
                    style="position: relative; font-family: 'Roboto', sans-serif; box-sizing: border-box; width: 100%; height: 100%; text-align: center; padding: 30px; border: 3px dotted var(--primary-color);">
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                        <img style="opacity: .1" width="180px" src="{{ asset('image/icon/logo1.png') }}">
                    </div>
                    <div style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                        <div>
                            <div style="display: flex; justify-content: space-between;">
                                <img width="120px" src="{{ asset('image/other/qr.png') }}">
                                <img width="200px" height="80px" src="{{ asset('image/icon/logo2.png') }}">
                                <p id="certificate-id">...</p>
                            </div>
                            <p>Skill Development Training Institute</p>
                            <p>(Under valid trade license in Bangladesh)</p>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <h1 style="margin-top: 0px">CERTIFICATE OF COMPLETION</h1>
                            <p style="margin-top: 5px">This is to certify that</p>
                            <h1 style="font-family: 'Meow Script', cursive; margin-top: 10px; font-size: 40px;">
                                {{ $student_name }}
                            </h1>
                            <div style="height: 1px; width: 400px; background-color: #303030;"></div>
                            <p style="margin-top: 5px">has successfully completed the</p>
                            <h2 style="font-family: 'Tiro Bangla', serif; margin-top: 5px" id="course-name">...</h2>
                            <p style="margin-top: 5px">training course conducted by Jobayer Academy. The training was held
                                on a
                                period of <span id="course-duration"></span>, and the participants demonstrated satisfactory
                                under practical skill in the
                                subject.</p>
                        </div>
                        <div style="text-align: right;">
                            <img width="150px" src="{{ asset('image/other/signature.png') }}">
                            <h3 style="margin-top: 5px">Jobayer Rahman</h3>
                            <p>(Founder &amp; Instructor, Jobayer Academy)</p>
                        </div>
                        <div>
                            <p><b id="issue-date">...</b></p>
                            <p style="margin-top: 5px">Note: this certificate is issued by Jobayer Academy, a privately
                                operated
                                training institute under valid
                                trade license in Bangladesh. This is not a government-accredited certificate.</p>
                        </div>
                    </div>
                </div>
            </div>

            <button class="as-btn as-m-10px as-app-cursor" onclick="downloadCertificate()">ডাউনলোড করুন</button>
        </div>

        <div id="notice-container" class="as-card as-p-10px as-mt-15px" style="display: none">
            <div style="text-align: center">
                <h2>নোটিশ</h2>
                <p id="notice"></p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var certificateCode;
        var issueDate;

        //download certificate as image
        function downloadCertificate() {
            const element = document.getElementById("certificate");
            html2canvas(element).then(canvas => {
                const link = document.createElement("a");
                link.download = "certificate.png";
                link.href = canvas.toDataURL();
                link.click();
            });

            axios.post('/api/confirm-certificate-generation', {
                course_id: {{ $course_id }},
                student_id: {{ $student_id }},
                certificate_code: certificateCode,
                issue_date: issueDate
            }).then(response => {
                console.log('Certificate download logged successfully');
            })
        }

        //getting course data
        axios.get('/api/get-course-data/' + {{ $course_id }})
            .then(response => {
                document.getElementById('course-name').innerText = response.data.course_another_name;
                document.getElementById('course-duration').innerText = response.data.course_duration;
                document.getElementById('certificate-id').innerText = response.data.course_code + new Date().getDate() + new Date().getMonth() + new Date().getFullYear() + {{ $student_id }};
                certificateCode = response.data.course_code + new Date().getDate() + new Date().getMonth() + new Date().getFullYear() + {{ $student_id }};
            })
            .catch(error => {
                console.error('Error fetching IP address:', error);
            });

        //updating issue date
        const date = new Date();
        const formatted = date.toLocaleDateString('en-GB', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });

        document.getElementById('issue-date').innerText = formatted;
        issueDate = formatted;

        //user exam participation check
        axios.get('/api/check-exam-participation/' + {{$course_id}})
            .then(response => {
                const participated = response.data.has_participated;
                const examMark = response.data.exam_mark;

                if (participated) {
                    if(examMark >= 70){
                        document.getElementById('certificate-container').style.display = 'block';
                    } else {
                        document.getElementById('notice-container').style.display = 'block';
                        document.getElementById('notice').innerText = 'আপনি এই কোর্সের পরীক্ষায় উত্তীর্ণ হননি। \n পরীক্ষায় উত্তীর্ণ না হলে সার্টিফিকেট ডাউনলোড করার অনুমতি দেওয়া হবে না। \n আবার পরীক্ষায় অংশগ্রহণ করতে কর্তৃপক্ষের সাথে যোগাযোগ করুন।';
                    }
                }
                else {
                    document.getElementById('notice-container').style.display = 'block';
                    document.getElementById('notice').innerText = 'আপনি এই কোর্সের পরীক্ষায় অংশগ্রহণ করেননি। \n পরীক্ষায় অংশগ্রহণ না করলে সার্টিফিকেট ডাউনলোড করার অনুমতি দেওয়া হবে না।';
                }
            })
            .catch(error => {
                console.error('Error checking exam participation:', error);
            });

    </script>
@endsection