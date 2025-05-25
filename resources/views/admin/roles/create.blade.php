
<h1>Buat Role Baru</h1>
<form action="{{ route('admin.roles.store') }}" method="POST">
    @csrf
    <label>Nama:</label>
    <input type="text" name="name" value="{{ old('name') }}" required>
    <label>Level:</label>
    <select name="level" required>
        <option value="">Pilih Level</option>
        <option value="super_super_admin">Super Super Admin</option>
        <option value="super_admin">Super Admin</option>
        <option value="admin">Admin</option>
        <option value="user">User</option>
    </select>
    <button type="submit">Simpan</button>
</form>