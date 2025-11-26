@extends('admin.layout')
@section('title', 'Admin - Visitor')

@section('content')
<div class="as-w-100">
   <!-- navbar -->
   <div>
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <button class="sidebar-toggle as-app-cursor as-flex as-align-center" id="sidebarToggle" style="display: inline-flex">
                    <i style="font-size: 24px" class="fas fa-bars"></i>
                </button>
                <h2>Visitor</h2>
            </div>
            <div class="user-info">
                <div class="user-avatar">AD</div>
                <div>
                    <div style="font-weight: 600;">{{ $admin[0]->admin_username }}</div>
                    <div style="font-size: 12px; color: var(--gray);">{{ $admin[0]->admin_role }}</div>
                </div>
            </div>
        </div>
   </div>

    <!-- Stats Cards -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-layer-group"></i>
            </div>
            <div class="stat-info">
                <h3 id="total-visitors">....</h3>
                <p>Total Visitors</p>
            </div>
        </div>
    </div>
   
    <!-- Visitor Table -->
    <div class="content-section">
        <div class="section-header">
            <h3>Visitor List</h3>
        </div>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>IP</th>
                        <th>Device</th>
                        <th>Location</th>
                        <th>Visited At</th>
                    </tr>
                </thead>
                <tbody id="visitor-data-table">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    getVisitorData();

    function getVisitorData(){
        var visitorDataTable = document.getElementById('visitor-data-table');
        visitorDataTable.innerHTML = '';
        visitorDataTable.innerHTML = `
                    <tr>
                        <td colspan="100%" style="text-align:center; padding:10px;">
                            <i style="font-size:25px;" class="fa-solid fa-spinner fa-spin"></i>
                        </td>
                    </tr>
                `;

        axios.get('/admin/visitor/data')
            .then(function(response){
                document.getElementById('total-visitors').innerText = response.data.length;
                visitorDataTable.innerHTML = '';

                if(response.data.length == 0){
                    visitorDataTable.innerHTML = `<tr>
                                <td colspan="100%" style="text-align:center; padding:10px;">
                                    No visitor found.
                                </td>
                            </tr>`;
                }

                response.data.forEach(function(item){
                    visitorDataTable.innerHTML += `
                        <tr>
                            <td>${item.ip_address}</td>
                            <td>${item.user_device}</td>
                            <td>${item.location}</td>
                            <td>${item.visited_at}</td>
                        </tr>
                    `;
                })
                   
            });
    }
</script>
@endsection