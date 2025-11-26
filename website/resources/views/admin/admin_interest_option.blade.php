@extends('admin.layout')
@section('title', 'Admin - Interest Option')

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
                <h2>Interest Option</h2>
            </div>
            <div class="user-info">
                <div class="user-avatar">AD</div>
                <div>
                    <div style="font-weight: 600;">{{ $admin[0]->admin_username }}</div>
                    <div style="font-size: 12px; color: var(--gray);">{{ $admin[0]->admin_role }}</div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon primary">
                    <i class="fas fa-interests"></i>
                </div>
                <div class="stat-info">
                    <h3 id="total-interest-options">....</h3>
                    <p>Total Interest Options</p>
                </div>
            </div>
        </div>

   </div>

   <!-- interest option Table -->
    <div class="content-section">
        <div class="section-header">
            <h3>Interest Options List</h3>
            <div class="actions as-flex as-justify-end">
                <button onclick="showModal('add-interest-option')" class="as-btn as-app-cursor" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                    <i class="fa-solid fa-plus as-app-cursor as-f-20px"></i> Add Interest Option
                </button>
            </div>
        </div>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Interest Option Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="interest-option-data-table">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- add student interest Option modal -->
<div class="as-modal" id="add-interest-option" style="display: none">
    <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

        <div class="as-modal-child as-p-10px">
            <div class="as-mt-10px">
                <div class="as-mb-5px"><b>Interest Option Title</b></div>
                <input type="text" id="interest-option-title" class="as-input" placeholder="Enter Interest Option Title">
            </div>
        </div>
        <div class="as-mt-10px as-text-right">
            <button class="as-btn as-app-cursor as-bg-cancel" onclick="hideModal('add-interest-option')">Cancel</button>
            <button id="add-interest-option-btn" class="as-btn as-app-cursor" onclick="addInterestOption()">Add</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    getInterestOptionData();

    function addInterestOption(){
        var interestOptionTitle  = document.getElementById('interest-option-title').value;
        var addInterestOptionBtn = document.getElementById('add-interest-option-btn');

        if(interestOptionTitle == ''){
            alert('Enter Interest Option Title');
        }
        else{
            addInterestOptionBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
            addInterestOptionBtn.disabled  = true;

            axios.post('/admin/interest-option/add', {interest_option_title: interestOptionTitle})
                .then(function(response){
                    alert(response.data.message);

                    console.log(response.data);

                    if(response.data.status == 200){
                        getInterestOptionData();
                        hideModal('add-interest-option');
                        addInterestOptionBtn.innerHTML = 'Add';
                        addInterestOptionBtn.disabled = false;
                    }
                    else{
                        hideModal('add-interest-option');
                        addInterestOptionBtn.innerHTML = 'Add';
                        addInterestOptionBtn.disabled = false;
                    }
                })
        }
    }

    function getInterestOptionData(){
        var interestOptionData = document.getElementById('interest-option-data-table');

        interestOptionData.innerHTML = `
                    <tr>
                        <td colspan="100%" style="text-align:center; padding:10px;">
                            <i style="font-size:25px;" class="fa-solid fa-spinner fa-spin"></i>
                        </td>
                    </tr>
                `;

        axios.get('/admin/interest-option/data')
            .then(function(response){
                document.getElementById('total-interest-options').innerText = response.data.length;
                interestOptionData.innerHTML = '';

                console.log(response.data);

                if(response.data.length == 0){
                    interestOptionData.innerHTML = `<tr>
                                <td colspan="100%" style="text-align:center; padding:10px;">
                                    No interest option found.
                                </td>
                            </tr>`;
                }

                response.data.forEach(function(item){
                    interestOptionData.innerHTML += `
                    <tr>
                        <td>${item.interest_option_title}</td>
                        <td>
                            <i onclick="showEditInterestOptionModal(${item.id}, '${item.interest_option_title}')" class="fa-solid fa-edit as-app-cursor as-p-10px"></i>
                            <i onclick="deleteInterestOption(${item.id})" class="fa-solid fa-trash as-app-cursor as-p-10px"></i>
                        </td>
                    </tr>
                    `;
                })
                   
            });
    }

    function showEditInterestOptionModal(interestOptionId, interestOptionTitle){
        var body = document.getElementsByTagName('body');
        body[0].innerHTML += `<div class="as-modal" id="edit-interest-option-modal" style="display: none">
            <div class="info-section as-bg-white as-shadow-lw as-p-20px as-w-50 md:as-w-90 as-mt-10px as-brr-5px">

                <div class="as-modal-child as-p-10px">
                    <div class="as-mt-10px">
                        <div class="as-mb-5px"><b>interest Option Title</b></div>
                        <input type="text" id="edited-interest-option-title" class="as-input" value="${interestOptionTitle}">
                    </div>
                </div>
                <div class="as-mt-10px as-text-right">
                    <button class="as-btn as-app-cursor as-bg-cancel" onclick="removeModal('edit-interest-option-modal')">Cancel</button>
                    <button id="edit-interest-option-btn" class="as-btn as-app-cursor" onclick="editInterestOption(${interestOptionId}, '${interestOptionTitle}')">Edit</button>
                </div>
            </div>
        </div>`

        showModal('edit-interest-option-modal');
    }

    function editInterestOption(interestOptionId, interestOptionTitle){
        var editedInterestOptionTitle = document.getElementById('edited-interest-option-title').value;
        var editInterestOptionBtn     = document.getElementById('edit-interest-option-btn');

        editInterestOptionBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
        editInterestOptionBtn.disabled  = true;

        if(editedInterestOptionTitle == ''){
            alert('Enter Interest Option Title');
        }
        else{
            axios.post('/admin/interest-option/edit', {interest_option_id: interestOptionId, interest_option_title: editedInterestOptionTitle})
                .then(function(response){
                    alert(response.data.message);

                    if(response.data.status == 200){
                        getInterestOptionData();
                        removeModal('edit-interest-option-modal');
                        editInterestOptionBtn.innerHTML = 'Edit';
                        editInterestOptionBtn.disabled = false;
                    }
                    else{
                        removeModal('edit-interest-option-modal');
                        editInterestOptionBtn.innerHTML = 'Edit';
                        editInterestOptionBtn.disabled = false;
                    }
                });
        }
    }

    function deleteInterestOption(interestOptionId){
        var confirm = window.confirm('Do you want to delete interest Option?');

        if(confirm){
            axios.post('/admin/interest-option/delete', {interest_option_id: interestOptionId})
                .then(function(response){
                    alert(response.data.message);
                    getInterestOptionData();
                });
        }
    }
</script>
@endsection