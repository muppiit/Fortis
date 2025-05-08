<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Halo, {{ $nama }} ({{ $role }})</h1>
    <p>Selamat datang di halaman dashboard suuuuuuuppeeerrrr admin!!!!.</p>

    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
