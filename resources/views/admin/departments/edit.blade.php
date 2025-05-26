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
        <a href="{{ route('admin.departments.index') }}" class="btn-cancel">kembali</a>
    </form>
</div>
