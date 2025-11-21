@extends('admin.layout')
@section('title', 'Admin - student')

@section('content')
<div class="as-w-100">
    <!-- navbar -->
   <div style="height: 10vh;">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <button class="sidebar-toggle as-app-cursor as-flex as-align-center" id="sidebarToggle" style="display: inline-flex">
                    <i style="font-size: 24px" class="fas fa-bars"></i>
                </button>
                <h2>Dashboard</h2>
            </div>
            <div class="user-info">
                <div class="user-avatar">AD</div>
                <div>
                    <div style="font-weight: 600;">{{ $admin[0]->admin_username }}</div>
                    <div style="font-size: 12px; color: var(--gray);">{{ $admin[0]->admin_role }}</div>
                </div>
            </div>
        </div>

        <div class="as-flex as-p-10px as-justify-center">
            <span class="as-f-bold as-f-20px">Welcome to Admin Dashboard</span>
        </div>
   </div> 
    
</div>

@endsection

@section('scripts')
<script>

</script>
@endsection