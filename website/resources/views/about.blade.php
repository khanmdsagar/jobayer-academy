@extends('layouts.app')

@section('title', 'Jobayer Academy - About')

@section('content')
<section class="main-section">
    <div class="as-responsive-container">
        {!!$settings->site_about!!}
    </div>
</section>
@endsection
