@extends('layouts.app')

@section('title', 'Jobayer Academy - Callback')

@section('content')
    @if($status == 'success')
        <div class="as-flex as-flex-center">
            <div class="as-card as-w-300px as-p-20px as-mt-15px as-text-center">
                <div><img style="width: 50px" src="/image/icon/check.png"></div>
                <div class="as-f-20px as-f-bold as-mb-15px as-mt-15px">
                    আপনার ভর্তি সফল হয়েছে।
                </div>
                <div><button onclick="window.location.href='/dashboard'" class="as-btn as-w-100">কোর্সে যান</button></div>
            </div>
        </div>
    @elseif($status == 'cancel')
        <div class="as-flex as-flex-center">
            <div class="as-card as-w-300px as-p-20px as-mt-15px as-text-center">
                <div><img style="width: 50px" src="/image/icon/close.png"></div>
                <div class="as-f-20px as-f-bold as-mb-15px as-mt-15px">
                    আপনার ভর্তি বাতিল হয়েছে।
                </div>
                <div><button onclick="window.location.href='/'" class="as-btn as-w-100">হোমে যান</button></div>
            </div>
        </div>
    @else
        <div class="as-flex as-flex-center">
            <div class="as-card as-w-300px as-p-20px as-mt-15px as-text-center">
                <div><img style="width: 50px" src="/image/icon/close.png"></div>
                <div class="as-f-20px as-f-bold as-mb-15px as-mt-15px">
                    আপনার ভর্তি সফল হয়নি।
                </div>
                <div><button onclick="window.location.href='/'" class="as-btn as-w-100">আবার চেষ্টা করুন</button></div>
            </div>
        </div>
    @endif
    @include('partials.footer')
@endsection

@section('scripts')
<script>
    if('{{$status}}' == 'success'){
        axios.post('/api/enroll-course', {course_id: {{$course_id}}, combo_ids: @json($combo_ids)})
    }
</script>
@endsection
