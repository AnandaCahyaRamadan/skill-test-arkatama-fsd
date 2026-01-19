<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

@if ($errors->any())
    <div style="color:red">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="/login">
    @csrf

    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div>
        <label>Password</label>
        <input type="password" name="password" required>
    </div>

    <button type="submit">Login</button>
</form>

</body>
</html>
