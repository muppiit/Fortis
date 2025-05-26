<div class="form-container">
    <h2>Tambah Departemen Baru</h2>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <form action="{{ route('admin.departments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="department">Nama Departemen</label>
            <input type="text" id="department" name="department" required>
        </div>
        
        <div class="form-group">
            <label for="manager_department">Manager Departemen</label>
            <input type="text" id="manager_department" name="manager_department" required>
        </div>
        
        <button type="submit" class="btn-submit">Simpan</button>
        <a href="{{ route('admin.departments.index') }}" class="btn-cancel">kembali</a>
    </form>
</div>
