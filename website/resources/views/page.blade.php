@extends('layouts.app')

@section('title', 'Jobayer Academy')

@section('content')
<section class="main-section">
    <div class="as-responsive-container">
        @if (isset($page))
            {!!$page->page_content!!}
        @endif
    </div>
</section>
@endsection
