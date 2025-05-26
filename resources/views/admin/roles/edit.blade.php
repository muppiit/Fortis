
<h1>Edit Role</h1>
<form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Nama:</label>
    <input type="text" name="name" value="{{ old('name', $role->name) }}" required>
    <label>Level:</label>
    <select name="level" required>
        <option value="super_super_admin" {{ $role->level == 'super_super_admin' ? 'selected' : '' }}>Super Super Admin</option>
        <option value="super_admin" {{ $role->level == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
        <option value="admin" {{ $role->level == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="user" {{ $role->level == 'user' ? 'selected' : '' }}>User</option>
    </select>
    <button type="submit">Update</button>
</form>

<a href="{{ route('admin.roles.index') }}">kembali</a>
