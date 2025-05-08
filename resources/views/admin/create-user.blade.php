@if ($errors->any())
    <div style="color:red; margin-bottom: 10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.create.user') }}" method="POST">
    @csrf

    <input type="text" name="nip" placeholder="NIP" value="{{ old('nip') }}" required><br><br>

    <input type="text" name="nama" placeholder="Nama" value="{{ old('nama') }}" required><br><br>

    <input type="password" name="password" placeholder="Password" required><br><br>

    <select name="role">
        <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
    </select><br><br>

    <input type="text" name="departement" placeholder="Departement" value="{{ old('departement') }}" required><br><br>

    <input type="text" name="team_departement" placeholder="Team Departement" value="{{ old('team_departement') }}" required><br><br>

    <input type="text" name="manager_departement" placeholder="Manager Departement" value="{{ old('manager_departement') }}" required><br><br>

    <button type="submit">Buat User</button>
    
    <a href="{{ route('admin.dashboard') }}" style="margin-left: 10px;">Kembali</a>
</form>
