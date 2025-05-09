<h2>Detail Cuti</h2>

<p><strong>ID:</strong> {{ $leave->nip }}</p>
<p><strong>Nama:</strong> {{ $leave->user->nama ?? '-' }}</p>
<p><strong>Departement:</strong> {{ $leave->user->departement ?? '-' }}</p>
<p><strong>Team:</strong> {{ $leave->user->team_departement ?? '-' }}</p>
<p><strong>Manager:</strong> {{ $leave->user->manager_departement ?? '-' }}</p>
<p><strong>Tanggal Cuti:</strong> {{ $leave->tanggal_mulai }} s/d {{ $leave->tanggal_selesai }}</p>
<p><strong>Alasan:</strong> {{ $leave->alasan }}</p>
<p><strong>Jenis Cuti:</strong> {{ ucfirst($leave->type) }}</p>
<p><strong>Approval Manager:</strong> {{ ucfirst($leave->approved_manager) }}</p>

@if ($leave->approved_manager === 'pending')
    <form method="POST" action="{{ route('admin.leaves.updateStatus', $leave->id) }}">
        @csrf
        <button type="submit" name="approved_manager" value="approved">Setujui</button>
        <button type="submit" name="approved_manager" value="rejected">Tolak</button>
    </form>
@endif

<br>
<a href="{{ route('admin.leaves.index') }}">Kembali</a>
