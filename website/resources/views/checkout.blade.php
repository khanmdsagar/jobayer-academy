@extends('layouts.app')

@section('title', 'Jobayer Academy - Checkout')

@section('content')
<section class="as-content-top-margin">
    <div class="as-w-95 dt:as-mw-1280px as-m-0-auto">

        <div class="as-mt-15px as-text-center">
            <h1>চেকআউট</h1>
            <p>আপনার অর্ডার সম্পূর্ণ করুন</p>
        </div>

        <div class="as-mt-15px as-flex as-space-between md:as-flex-col">
            <div class="as-w-70 md:as-w-100 as-card as-brr-5px as-p-15px">

                <div class="">
                    <div class="as-f-20px as-f-bold as-mb-10px">অর্ডার সারাংশ</div>
                    <div class="">
                        <div class="as-flex as-space-between">
                            <span>{{ $course->course_name }}</span>
                            @if ($course->course_fee != $course->course_selling_fee)
                                <span><b>৳{{ $course->course_selling_fee }}</b></span>
                            @else
                                <span><b>৳{{ $course->course_fee }}</b></span>
                            @endif
                        </div>

                        {{-- combo sell --}}
                        @if ($course->combo_purchase->isNotEmpty())
                            <div id="combo-container">
                                <p class="as-mb-10px as-mt-10px as-f-bold">আরও কিনুন <i class="fas fa-arrow-right"></i></p>
                                @foreach ($course->combo_purchase as $combo)
                                    <div class="as-section-bg as-p-10px as-brr-5px as-mb-10px">
                                        <div class="as-flex as-space-between">
                                            <div class="as-flex">
                                                <label class="checkbox-wrapper" id="checkbox-wrapper"
                                                    style="cursor: default">
                                                    <input data-combo-id="{{ $combo->id }}"
                                                        data-combo-price="{{ $combo->purchase_price }}"
                                                        onclick="calculateWithChecked()" class="combo-checkbox"
                                                        type="checkbox">
                                                    <span class="custom-checkbox"></span>
                                                </label>
                                                <span class="as-ml-10px as-f-bold">{{ $combo->purchase_title }}</span>
                                            </div>
                                            <div id="combo-price" style="text-align: right">
                                                <b>৳{{ $combo->purchase_price }}</b></div>
                                        </div>
                                        <div style="margin-left: 30px">{!! $combo->purchase_description !!}</div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="as-flex as-mt-15px as-mb-15px">
                            <input class="as-input as-mr-15px" type="text" id="coupon"
                                placeholder="কুপন কোড থাকলে দিন">
                            <button class="as-btn as-app-cursor as-f-bengali" id="coupon-btn"
                                onclick="applyCoupon()">অ্যাপ্লাই</button>
                        </div>

                        <p class="as-mt-10px as-mb-10px" id="coupon-msg"></p>

                        <div class="as-flex as-space-between">
                            <span class="as-f-bold">মোট</span>
                            <span id="payment-amount" class="as-f-bold">
                                @if ($course->course_fee != $course->course_selling_fee)
                                    <span>৳{{ $course->course_selling_fee }}</span>
                                @else
                                    <span>৳{{ $course->course_fee }}</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <div class="as-mt-15px">
                    <div>
                        <div for="terms" style="cursor:default;">
                            <input style="padding: 5px" type="checkbox" id="terms" name="terms">
                            <span>আমি <a href="#">শর্তাবলী</a> এবং <a href="#">গোপনীয়তা নীতি</a> পড়েছি এবং
                                সম্মত
                                হয়েছি</span>
                        </div>
                    </div>
                    <button id="pay-now-btn" onclick="payNow()" class="as-btn as-w-100 as-mt-15px as-app-cursor">পেমেন্ট
                        করুন</button>
                </div>
            </div>

            <div class="as-card as-w-28 md:as-w-100 as-brr-5px md:as-mt-15px md:as-mb-15px">
                <div>
                    <img class="as-w-100 as-h-200px as-brr-5px" src="/storage/{{ $course_thumbnail }}">
                    <div class="as-p-15px">
                        <h3 class="as-mb-15px">{{ $course_name }}</h3>
                        <div><i class="fas fa-check"></i> লাইফটাইম অ্যাক্সেস</div>
                        <div><i class="fas fa-check"></i> মোবাইল অ্যাক্সেস</div>
                        <div><i class="fas fa-check"></i> সার্টিফিকেট</div>
                        <div><i class="fas fa-check"></i> ২৪/৭ সাপোর্ট</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@include('partials.footer')

@endsection

@section('scripts')
    <script>
        var courseFee = {{ $course->course_fee }} != {{ $course->course_selling_fee }} ?
            {{ $course->course_selling_fee }} : {{ $course->course_fee }};
        var purchasePrice = 0;
        var paymentAmount = {{ $course->course_fee }} != {{ $course->course_selling_fee }} ?
            {{ $course->course_selling_fee }} : {{ $course->course_fee }};

        let listenersAttached = false;

        var paymentAmountDiv = document.getElementById('payment-amount');

        function updatePaymentAmount(courseId = undefined, comboIds = undefined) {
            axios.post('/api/update-payment-amount', {
                    payment_amount: paymentAmount,
                    course_id: courseId,
                    combo_ids: comboIds
                })
                .then(res => {})
        }

        function clearCoupon(coupon) {
            document.getElementById('coupon').value = '';
            document.getElementById("coupon").disabled = true;
            document.getElementById("coupon-btn").disabled = true;
            document.getElementById("coupon-msg").innerHTML = `<b>${coupon}</b> কুপনটি অ্যাপ্লাই করা হয়েছে`;
        }

        window.addEventListener('pageshow', function() {
            document.getElementById('pay-now-btn').disabled = false;
            document.getElementById('pay-now-btn').innerHTML = 'পেমেন্ট করুন';
        });

        function calculateWithChecked() {
            if (listenersAttached) return;
            listenersAttached = true;

            var combo_checkboxes = document.querySelectorAll('.combo-checkbox');

            combo_checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const price = parseInt(checkbox.dataset.comboPrice);

                    if (checkbox.checked) {
                        purchasePrice += price;
                    } else {
                        purchasePrice -= price;
                    }

                    paymentAmount = courseFee + purchasePrice;
                    paymentAmountDiv.innerHTML = "৳" + paymentAmount;
                });
            });

            updatePaymentAmount();
        }

        function applyCoupon() {
            var coupon = document.getElementById("coupon").value;

            if (coupon == '') {
                alert("কুপন কোড লিখুন")
            } else {
                axios.post('/api/check-coupon', {
                        coupon_code: coupon
                    })
                    .then(res => {
                        const discount = res.data.coupon_discount;

                        if (res.data.coupon_discount_type == 'm') {
                            clearCoupon(res.data.coupon_code);

                            courseFee -= discount;
                            paymentAmount = courseFee + purchasePrice;
                            paymentAmountDiv.innerHTML = "৳" + paymentAmount;

                        } else if (res.data.coupon_discount_type == 'p') {
                            clearCoupon(res.data.coupon_code);

                            courseFee -= Math.round(courseFee * discount / 100);
                            paymentAmount = courseFee + purchasePrice;
                            paymentAmountDiv.innerHTML = "৳" + paymentAmount;
                        } else {
                            alert(res.data);
                        }
                    })
                    .catch(error => {
                        console.error('Error checking coupon:', error);
                    });
            }
        }

        function payNow() {
            var courseId = {{ $course->id }};

            var comboCheckbox = document.querySelectorAll('.combo-checkbox:checked');
            var comboIds = [];

            comboCheckbox.forEach(function(checkbox) {
                comboIds.push(checkbox.dataset.comboId)
            });

            const terms = document.getElementById("terms");

            if (terms.checked) {
                document.getElementById('pay-now-btn').disabled = true;
                document.getElementById('pay-now-btn').innerHTML =
                    '<i class="fas fa-spinner fa-spin"></i> পেমেন্ট প্রসেসিং...';

                updatePaymentAmount(courseId, comboIds);
                setTimeout(function() {
                    window.location.href = '/bkash/checkout';
                }, 500);
            } else {
                alert("অনুগ্রহ করে চালিয়ে যেতে শর্তাবলীতে সম্মতি দিন।");
            }
        }
    </script>
@endsection
