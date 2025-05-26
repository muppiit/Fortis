<div class="container">
    <h1>Daftar Departemen</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.departments.create') }}" class="btn btn-primary mb-3">+ Tambah Departemen</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Departemen</th>
                <th>Manager Departemen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $dept)
                <tr>
                    <td>{{ $dept->department }}</td>
                    <td>{{ $dept->manager_department }}</td>
                    <td>
                        <a href="{{ route('admin.departments.edit', $dept->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.departments.destroy', $dept->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus departemen ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.dashboard') }}">kembali</a>
</div>
