@extends('layouts.app')

@section('title', 'Jobayer Academy')

@section('content')
<section class="as-content-top-margin">
    <div class="as-responsive-container">
        @if (isset($page_content))
            <div class="page-content">{!!$page_content->page_content!!}</div>
        @endif
    </div>
</section>
@include('partials.footer')
@endsection
