<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in</title>
</head>
<body>
    <h1>Sign in</h1>

    <form method="POST" action="/login">
        @csrf

        <p>
            <label for="email">Email</label><br>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </p>

        <p>
            <label for="password">Password</label><br>
            <input id="password" type="password" name="password" required>
        </p>

        @error('email')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Sign in</button>
    </form>
</body>
</html>