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
                <i class="fas fa-calendar-day"></i>
            </div>
            <div class="stat-info">
                <h3 id="today-visitors">....</h3>
                <p>Visitors Today</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3 id="total-visitors">....</h3>
                <p>Total Visitors</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-mobile-alt"></i>
            </div>
            <div class="stat-info">
                <h3 id="total-mobile-visitors">....</h3>
                <p>Mobile Visitors</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-desktop"></i>
            </div>
            <div class="stat-info">
                <h3 id="total-desktop-visitors">....</h3>
                <p>Desktop Visitors</p>
            </div>
        </div>

    </div>

    <canvas class="as-card" id="daily-visitor-chart" height="80" style="background: white; margin-bottom: 10px; border-radius: 5px"></canvas>
   
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
                document.getElementById('total-visitors').innerText = response.data.total_visitor;
                document.getElementById('today-visitors').innerText = response.data.today_visitor;
                visitorDataTable.innerHTML = '';

                document.getElementById('total-mobile-visitors').innerText =
                    ((response.data.mobile_device/response.data.total_visitor) * 100).toFixed(0) + '%';

                document.getElementById('total-desktop-visitors').innerText =
                    ((response.data.desktop_device/response.data.total_visitor) * 100).toFixed(0) + '%';

                if(response.data.visitor.length == 0){
                    visitorDataTable.innerHTML = `<tr>
                                <td colspan="100%" style="text-align:center; padding:10px;">
                                    No visitor found.
                                </td>
                            </tr>`;
                }

                const data   = response.data.daily_visitor.map(item => item.total);
                const labels = response.data.daily_visitor.map(item => item.visited_at);
                console.log(data);
                console.log(labels);

                const ctx = document.getElementById('daily-visitor-chart').getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels, // dates
                        datasets: [{
                            label: 'Daily Visitors',
                            data: data,   // visitor count
                            fill: false,
                            borderColor: 'blue',
                            tension: 0.3,
                            pointRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: true }
                        },
                        scales: {
                            x: { title: { display: true, text: 'Date' }},
                            y: { title: { display: true, text: 'Visitors' }, beginAtZero: true }
                        }
                    }
                });



                response.data.visitor.forEach(function(item){
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