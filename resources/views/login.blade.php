<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
</head>
<body>
    <h2>LOGIN</h2>

    @if ($errors->has('login_error'))
        <p style="color:red;">{{ $errors->first('login_error') }}</p>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <label>NIP</label>
        <input type="text" name="nip" required><br><br>

        <label>Password</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
