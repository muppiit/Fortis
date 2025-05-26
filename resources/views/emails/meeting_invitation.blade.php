<!DOCTYPE html>
<html>
<head>
    <title>Undangan Meeting</title>
</head>
<body>
    <h2>Undangan Meeting: {{ $meeting->title }}</h2>

    <p><strong>Diundang oleh:</strong> {{ $meeting->creator->name }} ({{ $meeting->creator->email }})</p>

    <p><strong>Deskripsi:</strong> {{ $meeting->description }}</p>

    <p><strong>Waktu:</strong>
        {{ \Carbon\Carbon::parse($meeting->start_time)->format('d M Y H:i') }} -
        {{ \Carbon\Carbon::parse($meeting->end_time)->format('H:i') }}
    </p>

    @if ($meeting->type === 'online')
        <p><strong>Link Online:</strong> <a href="{{ $meeting->online_url }}">{{ $meeting->online_url }}</a></p>
    @else
        <p><strong>Lokasi:</strong> {{ $meeting->location }}</p>
    @endif

    <p>Silakan hadir tepat waktu.</p>
</body>
</html>
