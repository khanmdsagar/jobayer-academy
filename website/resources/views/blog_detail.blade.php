@extends('layouts.app')

@section('title', 'Jobayer Academy - Blog')

@section('content')

<section class="main-section">
    <div class="as-responsive-container">
        <div class="as-text-center"><h1 class="as-mb-10px">{{$blog->blog_title}}</h1></div>
        <div class="blog-container">
            {!! $blog->blog_detail !!}
        </div>
    </div>
</section>

@include('partials.footer')

@endsection

@section('styles')
    <style>
        .blog-container ul{
            padding-left: 30px;
        }
    </style>
@endsection
