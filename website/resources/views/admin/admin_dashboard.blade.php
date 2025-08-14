@extends('admin.layout')
@section('title', 'Admin - student')

@section('content')
<div class="as-flex">
    <!-- sidebar -->
    <div id="admin-sidebar" class="as-w-250px as-bg-white as-h-100vh">
        @include('admin.sidebar')
    </div>
</div>

<div class="as-w-100">
    <!-- navbar -->
   <div style="height: 10vh;">
        <div class="as-p-10px">
            <i onclick="toggleAdminSidebar()" class="fas fa-bars as-app-cursor as-f-20px"></i>
        </div>

        <div class="as-flex as-p-10px as-justify-center">
            <span class="as-f-bold as-f-20px">ড্যাশবোর্ড</span>
        </div>
   </div> 
    
</div>

@endsection

@section('scripts')
<script>

</script>
@endsection