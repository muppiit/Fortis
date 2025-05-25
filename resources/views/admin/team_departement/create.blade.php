<h1>Tambah Team Department</h1>

<form action="{{ route('admin.team_departments.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="department_id" class="form-label">Pilih Department</label>
        <select name="department_id" id="department_id" class="form-control" required>
            <option value="">-- Pilih Department --</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                    {{ $department->department }}
                </option>
            @endforeach
        </select>
        @error('department_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Nama Team Department</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.team_departments.index') }}" class="btn btn-secondary">Batal</a>
</form>
