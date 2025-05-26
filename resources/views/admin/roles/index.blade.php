
<h1>Daftar Role</h1>
<a href="{{ route('admin.roles.create') }}">Tambah Role</a>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->level }}</td>
                <td>
                    <a href="{{ route('admin.roles.edit', $role->id) }}">Edit</a>
                    <form action="{{ route('admin.roles.delete', $role->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus role ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('admin.dashboard') }}">kembali</a>
