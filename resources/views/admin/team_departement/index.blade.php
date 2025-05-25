a<h1>Daftar Team Department</h1>

<a href="{{ route('admin.team_departments.create') }}" class="btn btn-primary mb-3">Tambah Team Department</a>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Team Department</th>
            <th>Department</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($teamDepartments as $team)
            <tr>
                <td>{{ $team->id }}</td>
                <td>{{ $team->name }}</td>
                <td>{{ $team->department->department ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.team_departments.edit', $team->id) }}"
                        class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.team_departments.destroy', $team->id) }}" method="POST"
                        style="display:inline-block;" onsubmit="return confirm('Yakin ingin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Tidak ada data team department</td>
            </tr>
        @endforelse
    </tbody>
</table>
