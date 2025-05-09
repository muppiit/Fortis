<h2>Daftar Cuti</h2>
@if (session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Departement</th>
            <th>Team</th>
            <th>Manager</th>
            <th>Status</th>
            <th>Approval</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($leaves as $l)
            <tr>
                <td>{{ $l->nip }}</td>
                <td>{{ $l->user->nama ?? '-' }}</td>
                <td>{{ $l->user->departement ?? '-' }}</td>
                <td>{{ $l->user->team_departement ?? '-' }}</td>
                <td>{{ $l->user->manager_departement ?? '-' }}</td>
                <td>{{ ucfirst($l->type) }}</td>
                <td>{{ ucfirst($l->approved_manager) }}</td>
                <td><a href="{{ route('admin.leaves.show', $l->id) }}">Detail</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>    
<a href="{{ route('admin.dashboard') }}">
    <button type="button">Kembali ke Dashboard</button>
</a>