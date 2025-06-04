<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f5f9ff;
        margin: 0;
        padding: 20px;
    }

    .form-container {
        max-width: 500px;
        margin: auto;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 123, 255, 0.1);
        border: 1px solid #e0eaff;
    }

    .form-container h2 {
        color: #0056b3;
        margin-bottom: 20px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #003366;
        font-weight: 600;
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid #cce0ff;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .form-group input:focus {
        border-color: #3399ff;
        outline: none;
    }

    .alert-success {
        background-color: #d1ecf1;
        color: #0c5460;
        padding: 12px 20px;
        border-radius: 8px;
        border: 1px solid #bee5eb;
        margin-bottom: 20px;
    }

    .btn-submit,
    .btn-cancel {
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s ease;
    }

    .btn-submit {
        background-color: #007bff;
        color: white;
        margin-right: 10px;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }

    .btn-cancel {
        background-color: #f0f4ff;
        color: #0056b3;
    }

    .btn-cancel:hover {
        background-color: #dbe9ff;
    }
</style>

<div class="form-container">
    <h2>Edit Departemen</h2>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="department">Nama Departemen</label>
            <input type="text" id="department" name="department" value="{{ $department->department }}" required>
        </div>
        
        <div class="form-group">
            <label for="manager_department">Manager Departemen</label>
            <input type="text" id="manager_department" name="manager_department"
                value="{{ $department->manager_department }}" required>
        </div>
        
        <button type="submit" class="btn-submit">Update</button>
        <a href="{{ route('admin.departments.index') }}" class="btn-cancel">Kembali</a>
    </form>
</div>
