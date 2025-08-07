@extends('layouts.app') {{-- or use your main layout --}}

@section('title', 'Page Not Found')

@section('content')
<div class="container as-text-center" style="padding: 100px 0;">
    <h1 style="font-size: 100px; font-weight: bold; color: var(--primary)">404</h1>
    <h2>ওহ! পেজটি পওয়া যায়নি</h2>
    <p>আপনি যে পেজটি খুঁজছেন সেটি সার্ভারে নেই</p>
    <a style="display: inline-block" class="as-app-cursor as-btn as-mt-20px" href="{{ url('/') }}" class="btn btn-primary mt-4">হোম পেজে যান</a>
</div>
@endsection
