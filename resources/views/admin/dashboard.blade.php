<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>
</head>

<body>
    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif
    <h1>Halo, {{ $nama }} ({{ $role }})</h1>
    <p><strong>Selamat datang di halaman dashboard admin.</strong></p>
    <img src="{{ asset('images/gif1.gif') }}" alt="Welcome GIF" style="width: 300px; margin-top: 10px;">
    <br><br>
    
    <a href="{{ route('admin.create.user.form') }}">
        <button type="button">Buat User Baru</button>
    </a>

    <h2>Daftar User dan Admin</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Role</th>
                <th>Departement</th>
                <th>Team Departement</th>
                <th>Manager Departement</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
                <tr>
                    <td>{{ $u->nip }}</td>
                    <td>{{ $u->nama }}</td>
                    <td>{{ $u->role }}</td>
                    <td>{{ $u->departement }}</td>
                    <td>{{ $u->team_departement }}</td>
                    <td>{{ $u->manager_departement }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('admin.logout') }}" method="POST" style="margin-top: 10px;">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>

</html>
