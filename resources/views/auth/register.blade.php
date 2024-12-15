<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<form action="{{ route('register.submit') }}" method="POST">
    @csrf
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required value="{{ old('username') }}">

    @error('username')
        <div>{{ $message }}</div>
    @enderror

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required value="{{ old('email') }}">

    @error('email')
        <div>{{ $message }}</div>
    @enderror

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    @error('password')
        <div>{{ $message }}</div>
    @enderror

    <label for="password_confirmation">Confirm Password:</label>
    <input type="password" id="password_confirmation" name="password_confirmation" required>

    <button type="submit">Register</button>
</form>
</body>
</html>
