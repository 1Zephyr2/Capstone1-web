<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services - FURCARE Admin</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; min-height: 100vh; }
        .main-content { padding: 104px 32px 32px; }
        .page-title { font-size: 28px; font-weight: 700; color: #1e293b; margin-bottom: 4px; }
        .page-subtitle { color: #64748b; font-size: 14px; margin-bottom: 28px; }
        .card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.08); margin-bottom: 24px; overflow: hidden; }
        .card-header { padding: 18px 24px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; background: #f8fafc; }
        .card-header h2 { font-size: 16px; font-weight: 700; color: #1e293b; }
        .card-body { padding: 24px; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; padding: 10px 14px; border-bottom: 1.5px solid #e2e8f0; }
        td { padding: 12px 14px; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #1e293b; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f8fafc; }
        .badge { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-active { background: #d1fae5; color: #065f46; }
        .badge-inactive { background: #fee2e2; color: #991b1b; }
        .badge-grooming { background: #dbeafe; color: #1e40af; }
        .badge-other { background: #f3e8ff; color: #6b21a8; }
        .btn { padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; border: none; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s; text-decoration: none; }
        .btn-primary { background: #14b8a6; color: white; }
        .btn-primary:hover { background: #0d9488; }
        .btn-danger { background: #fee2e2; color: #991b1b; }
        .btn-danger:hover { background: #fecaca; }
        .btn-edit { background: #eff6ff; color: #1e40af; }
        .btn-edit:hover { background: #dbeafe; }
        .form-control { padding: 9px 12px; border: 1.5px solid #d1d5db; border-radius: 8px; font-size: 14px; width: 100%; transition: border-color 0.2s; }
        .form-control:focus { outline: none; border-color: #14b8a6; box-shadow: 0 0 0 3px rgba(20,184,166,0.1); }
        .form-row { display: grid; grid-template-columns: 1fr 1fr auto; gap: 12px; align-items: end; }
        .form-group label { font-size: 13px; font-weight: 600; color: #374151; display: block; margin-bottom: 5px; }
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 1000; align-items: center; justify-content: center; }
        .modal-overlay.active { display: flex; }
        .modal { background: white; border-radius: 12px; padding: 28px; width: 420px; box-shadow: 0 20px 40px rgba(0,0,0,0.15); }
        .modal h3 { font-size: 18px; font-weight: 700; margin-bottom: 20px; color: #1e293b; }
        .modal-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }
        .toggle-switch { position: relative; width: 44px; height: 24px; }
        .toggle-switch input { opacity: 0; width: 0; height: 0; }
        .toggle-slider { position: absolute; cursor: pointer; inset: 0; background: #d1d5db; border-radius: 24px; transition: 0.3s; }
        .toggle-slider:before { content: ''; position: absolute; height: 18px; width: 18px; left: 3px; bottom: 3px; background: white; border-radius: 50%; transition: 0.3s; }
        input:checked + .toggle-slider { background: #14b8a6; }
        input:checked + .toggle-slider:before { transform: translateX(20px); }
    </style>
</head>
<body>
    <x-admin-navbar />

    <div class="main-content">
        <h1 class="page-title">Manage Services</h1>
        <p class="page-subtitle">Add, edit, or remove grooming and other service options available for booking.</p>

        @if(session('success'))
            <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error"><i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}</div>
        @endif

        {{-- Add New Service --}}
        <div class="card">
            <div class="card-header">
                <h2><i class="bi bi-plus-circle" style="color:#14b8a6;"></i> Add New Service</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label>Service Name <span style="color:#dc2626;">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Spa Treatment" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Category <span style="color:#dc2626;">*</span></label>
                            <select name="category" class="form-control" required>
                                <option value="Grooming Services" {{ old('category') == 'Grooming Services' ? 'selected' : '' }}>Grooming Services</option>
                                <option value="Other Services" {{ old('category') == 'Other Services' ? 'selected' : '' }}>Other Services</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="height:40px;">
                            <i class="bi bi-plus"></i> Add
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Services Table --}}
        <div class="card">
            <div class="card-header">
                <h2><i class="bi bi-list-ul" style="color:#14b8a6;"></i> All Services ({{ $services->count() }})</h2>
            </div>
            <div class="card-body" style="padding:0;">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Service Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td style="color:#94a3b8;">{{ $service->sort_order }}</td>
                            <td style="font-weight:600;">{{ $service->name }}</td>
                            <td>
                                <span class="badge {{ $service->category == 'Grooming Services' ? 'badge-grooming' : 'badge-other' }}">
                                    {{ $service->category }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $service->is_active ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div style="display:flex;gap:8px;">
                                    <button class="btn btn-edit" onclick="openEditModal({{ $service->id }}, '{{ addslashes($service->name) }}', '{{ $service->category }}', {{ $service->is_active ? 'true' : 'false' }})">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Delete this service?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal-overlay" id="editModal">
        <div class="modal">
            <h3><i class="bi bi-pencil-square" style="color:#14b8a6;"></i> Edit Service</h3>
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="form-group" style="margin-bottom:16px;">
                    <label>Service Name</label>
                    <input type="text" name="name" id="editName" class="form-control" required>
                </div>
                <div class="form-group" style="margin-bottom:16px;">
                    <label>Category</label>
                    <select name="category" id="editCategory" class="form-control">
                        <option value="Grooming Services">Grooming Services</option>
                        <option value="Other Services">Other Services</option>
                    </select>
                </div>
                <div class="form-group" style="display:flex;align-items:center;gap:12px;">
                    <label style="margin:0;">Active</label>
                    <label class="toggle-switch">
                        <input type="checkbox" name="is_active" id="editActive">
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn" style="background:#e5e7eb;" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, category, isActive) {
            document.getElementById('editForm').action = `/admin/services/${id}`;
            document.getElementById('editName').value = name;
            document.getElementById('editCategory').value = category;
            document.getElementById('editActive').checked = isActive;
            document.getElementById('editModal').classList.add('active');
        }
        function closeEditModal() {
            document.getElementById('editModal').classList.remove('active');
        }
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) closeEditModal();
        });
    </script>
</body>
</html>