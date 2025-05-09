<!DOCTYPE html>
<html>
<head>
    <title>Daftar Attendance</title>
</head>
<body>
    <h1>Daftar Kehadiran User</h1>
    
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Departement</th>
                <th>Team Departement</th>
                <th>Manager Departement</th>
                <th>Tipe</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $a)
                <tr>
                    <td>{{ $a->nip }}</td>
                    <td>{{ $a->user->nama ?? '-' }}</td>
                    <td>{{ $a->user->departement ?? '-' }}</td>
                    <td>{{ $a->user->team_departement ?? '-' }}</td>
                    <td>{{ $a->user->manager_departement ?? '-' }}</td>
                    <td>{{ $a->type }}</td>
                    <td>{{ $a->waktu }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ route('admin.dashboard') }}">
        <button type="button">Kembali ke Dashboard</button>
    </a>
</body>
</html>
