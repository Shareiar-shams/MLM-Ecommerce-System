@extends('layouts.administration.app')

@section('admin_title_content')
    AHVision | Roles
@endsection

@section('admin_content_header')
    <div class="col-sm-6">
        <h1 class="m-0">Role List</h1>
    </div><!-- /.col -->
    <!-- breadcrumb -->
    <x-ad-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.home')],
        ['label' => 'System', 'url' => route('admin.profile')],
        ['label' => 'Role', 'url' => route('admin.profile')],
        ['label' => 'Role List'],
    ]" />
@endsection

@section('admin_vendor_css')
@endsection

@section('admin_page_css')
<style>
    :root {
        --primary: #007bff;
        --success: #28a745;
        --danger: #dc3545;
        --info: #17a2b8;
    }

    .content-wrapper {
        padding: 20px;
    }

    .search-container {
        margin-bottom: 30px;
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .search-box {
        flex: 1;
        min-width: 250px;
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 10px 15px 10px 40px;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }

    .search-box i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #95a5a6;
        font-size: 14px;
    }

    .btn-add {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
        font-size: 13px;
        white-space: nowrap;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.4);
    }

    .roles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .role-card {
        background: white;
        border-radius: 8px;
        padding: 16px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-left: 4px solid var(--primary);
        position: relative;
    }

    .role-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }

    .role-card.admin {
        border-left-color: #dc3545;
    }

    .role-card.customer {
        border-left-color: #28a745;
    }

    .role-card.vendor {
        border-left-color: #ffc107;
    }

    .role-card.moderator {
        border-left-color: #17a2b8;
    }

    .role-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .role-name {
        font-size: 16px;
        font-weight: 700;
        color: #2c3e50;
    }

    .role-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .role-badge.admin {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .role-badge.customer {
        background-color: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }

    .role-badge.vendor {
        background-color: rgba(255, 193, 7, 0.1);
        color: #856404;
    }

    .role-badge.moderator {
        background-color: rgba(23, 162, 184, 0.1);
        color: #17a2b8;
    }

    .role-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        padding: 10px 0;
        border-top: 1px solid #ecf0f1;
        border-bottom: 1px solid #ecf0f1;
    }

    .info-item {
        text-align: center;
        flex: 1;
    }

    .info-label {
        font-size: 11px;
        color: #95a5a6;
        text-transform: uppercase;
        margin-top: 4px;
    }

    .info-value {
        font-size: 16px;
        font-weight: 700;
        color: var(--primary);
    }

    .users-avatars {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 12px;
    }

    .avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        color: white;
        border: 2px solid white;
    }

    .avatar-1 {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .avatar-2 {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .avatar-3 {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .avatar-plus {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background-color: #ecf0f1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: #7f8c8d;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .avatar-plus:hover {
        background-color: #d5dbdb;
        transform: scale(1.1);
    }

    .role-actions {
        display: flex;
        gap: 8px;
    }

    .btn-action {
        flex: 1;
        padding: 8px 10px;
        border: none;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .btn-edit {
        background-color: rgba(23, 162, 184, 0.15);
        color: #17a2b8;
    }

    .btn-edit:hover {
        background-color: rgba(23, 162, 184, 0.25);
    }

    .btn-delete {
        background-color: rgba(220, 53, 69, 0.15);
        color: #dc3545;
    }

    .btn-delete:hover {
        background-color: rgba(220, 53, 69, 0.25);
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1050;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal-content {
        background-color: white;
        margin: 5% auto;
        padding: 0;
        border-radius: 8px;
        width: 90%;
        max-width: 450px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-header {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
        padding: 18px;
        border-radius: 8px 8px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h2 {
        margin: 0;
        font-size: 18px;
    }

    .close-btn {
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .close-btn:hover {
        transform: rotate(90deg);
    }

    .modal-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #34495e;
        font-size: 13px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 9px 11px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        font-size: 13px;
        font-family: inherit;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 60px;
    }

    .permissions-checkboxes {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
    }

    .checkbox-item input {
        width: 16px;
        height: 16px;
        margin-right: 7px;
        cursor: pointer;
        accent-color: var(--primary);
    }

    .checkbox-item label {
        margin: 0;
        font-weight: 400;
        cursor: pointer;
        font-size: 12px;
    }

    .modal-footer {
        padding: 15px;
        display: flex;
        gap: 8px;
        justify-content: flex-end;
        background-color: #f8f9fa;
        border-radius: 0 0 8px 8px;
    }

    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 13px;
    }

    .btn-cancel {
        background-color: #e0e0e0;
        color: #34495e;
    }

    .btn-cancel:hover {
        background-color: #d0d0d0;
    }

    .btn-submit {
        background-color: var(--primary);
        color: white;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #95a5a6;
        grid-column: 1/-1;
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 15px;
        opacity: 0.5;
    }

    .empty-state p {
        font-size: 14px;
        margin: 8px 0;
    }

    @media (max-width: 768px) {
        .search-container {
            flex-direction: column;
        }

        .search-box {
            width: 100%;
        }

        .roles-grid {
            grid-template-columns: 1fr;
        }

        .modal-content {
            width: 95%;
            margin: 30% auto;
        }
    }
</style>
@endsection

@section('admin_main_content')
    <!-- container-fluid -->
    <div class="container-fluid">
        <div class="content-wrapper">
            <div class="search-container">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Search roles..." onkeyup="filterRoles()">
                </div>
                <button class="btn-add" onclick="openAddModal()">
                    <i class="fas fa-plus"></i> Add Role
                </button>
            </div>

            <div class="roles-grid" id="rolesContainer">
                <!-- Roles will be populated here -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Add/Edit Modal -->
    <div id="roleModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Add New Role</h2>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <form id="roleForm">
                    <div class="form-group">
                        <label for="roleName">Role Name *</label>
                        <input type="text" id="roleName" placeholder="e.g., Moderator" required>
                    </div>
                    <div class="form-group">
                        <label for="roleDesc">Description</label>
                        <textarea id="roleDesc" placeholder="Describe the purpose of this role"></textarea>
                    </div>
                    <div class="form-group">
                        <label style="margin-bottom: 10px; display: block;">Permissions</label>
                        <div class="permissions-checkboxes">
                            <div class="checkbox-item">
                                <input type="checkbox" id="perm_view" value="view">
                                <label for="perm_view">View</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="perm_create" value="create">
                                <label for="perm_create">Create</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="perm_edit" value="edit">
                                <label for="perm_edit">Edit</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="perm_delete" value="delete">
                                <label for="perm_delete">Delete</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="perm_manage" value="manage">
                                <label for="perm_manage">Manage</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="perm_export" value="export">
                                <label for="perm_export">Export</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancel" onclick="closeModal()">Cancel</button>
                <button class="btn btn-submit" onclick="saveRole()">Save</button>
            </div>
        </div>
    </div>
@endsection

@section('admin_page_js')
<script>
    let roles = [
        {
            id: 1,
            name: 'Admin',
            type: 'admin',
            permissions: ['view', 'create', 'edit', 'delete', 'manage', 'export'],
            users: 2
        },
        {
            id: 2,
            name: 'Vendor',
            type: 'vendor',
            permissions: ['view', 'create', 'edit', 'export'],
            users: 8
        },
        {
            id: 3,
            name: 'Customer',
            type: 'customer',
            permissions: ['view'],
            users: 1542
        },
        {
            id: 4,
            name: 'Moderator',
            type: 'moderator',
            permissions: ['view', 'edit', 'delete', 'manage'],
            users: 5
        }
    ];

    let currentEditId = null;

    function renderRoles() {
        const container = document.getElementById('rolesContainer');
        if (roles.length === 0) {
            container.innerHTML = `
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>No roles found</p>
                    <p style="font-size: 12px;">Create your first role to get started</p>
                </div>
            `;
            return;
        }

        container.innerHTML = roles.map(role => `
            <div class="role-card ${role.type}">
                <div class="role-header">
                    <div class="role-name">${role.name}</div>
                    <span class="role-badge ${role.type}">${role.type}</span>
                </div>
                
                <div class="users-avatars">
                    <div class="avatar avatar-1">A</div>
                    ${role.users > 1 ? `<div class="avatar avatar-2">B</div>` : ''}
                    ${role.users > 2 ? `<div class="avatar avatar-3">C</div>` : ''}
                    ${role.users > 3 ? `<div class="avatar-plus" onclick="event.stopPropagation()">+${role.users - 3}</div>` : ''}
                </div>

                <div class="role-info">
                    <div class="info-item">
                        <div class="info-value">${role.permissions.length}</div>
                        <div class="info-label">Permissions</div>
                    </div>
                    <div class="info-item">
                        <div class="info-value">${role.users}</div>
                        <div class="info-label">Users</div>
                    </div>
                </div>

                <div class="role-actions">
                    <button class="btn-action btn-edit" onclick="openEditModal(${role.id})">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn-action btn-delete" onclick="deleteRole(${role.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `).join('');
    }

    function openAddModal() {
        currentEditId = null;
        document.getElementById('roleForm').reset();
        document.getElementById('modalTitle').textContent = 'Add New Role';
        document.getElementById('roleModal').style.display = 'block';
    }

    function openEditModal(id) {
        const role = roles.find(r => r.id === id);
        if (!role) return;

        currentEditId = id;
        document.getElementById('roleName').value = role.name;
        document.getElementById('roleDesc').value = '';
        
        document.querySelectorAll('.permissions-checkboxes input').forEach(checkbox => {
            checkbox.checked = role.permissions.includes(checkbox.value);
        });

        document.getElementById('modalTitle').textContent = `Edit Role: ${role.name}`;
        document.getElementById('roleModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('roleModal').style.display = 'none';
        currentEditId = null;
    }

    function saveRole() {
        const name = document.getElementById('roleName').value.trim();
        
        if (!name) {
            alert('Please fill in role name');
            return;
        }

        const permissions = Array.from(document.querySelectorAll('.permissions-checkboxes input:checked')).map(cb => cb.value);

        if (currentEditId === null) {
            const newRole = {
                id: Math.max(...roles.map(r => r.id), 0) + 1,
                name,
                type: name.toLowerCase(),
                permissions,
                users: 0
            };
            roles.push(newRole);
        } else {
            const role = roles.find(r => r.id === currentEditId);
            if (role) {
                role.name = name;
                role.permissions = permissions;
            }
        }

        renderRoles();
        closeModal();
    }

    function deleteRole(id) {
        if (confirm('Are you sure you want to delete this role?')) {
            roles = roles.filter(r => r.id !== id);
            renderRoles();
        }
    }

    function filterRoles() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const filtered = roles.filter(role =>
            role.name.toLowerCase().includes(searchTerm)
        );

        const container = document.getElementById('rolesContainer');
        if (filtered.length === 0) {
            container.innerHTML = `
                <div class="empty-state">
                    <i class="fas fa-search"></i>
                    <p>No roles match your search</p>
                </div>
            `;
            return;
        }

        container.innerHTML = filtered.map(role => `
            <div class="role-card ${role.type}">
                <div class="role-header">
                    <div class="role-name">${role.name}</div>
                    <span class="role-badge ${role.type}">${role.type}</span>
                </div>
                
                <div class="users-avatars">
                    <div class="avatar avatar-1">A</div>
                    ${role.users > 1 ? `<div class="avatar avatar-2">B</div>` : ''}
                    ${role.users > 2 ? `<div class="avatar avatar-3">C</div>` : ''}
                    ${role.users > 3 ? `<div class="avatar-plus" onclick="event.stopPropagation()">+${role.users - 3}</div>` : ''}
                </div>

                <div class="role-info">
                    <div class="info-item">
                        <div class="info-value">${role.permissions.length}</div>
                        <div class="info-label">Permissions</div>
                    </div>
                    <div class="info-item">
                        <div class="info-value">${role.users}</div>
                        <div class="info-label">Users</div>
                    </div>
                </div>

                <div class="role-actions">
                    <button class="btn-action btn-edit" onclick="openEditModal(${role.id})">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn-action btn-delete" onclick="deleteRole(${role.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `).join('');
    }

    window.onclick = function(event) {
        const modal = document.getElementById('roleModal');
        if (event.target === modal) {
            closeModal();
        }
    }

    // Initialize roles grid on page load
    $(document).ready(function() {
        renderRoles();
    });
</script>
@endsection