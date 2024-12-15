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

    <label for="role">Role:</label>
    <select name="role" id="role" required>
        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
    </select>

    @error('role')
        <div>{{ $message }}</div>
    @enderror

    <!-- Admin Key container -->
    <div id="admin-key-container" style="display: none;">
        <label for="admin_key">Admin Key:</label>
        <input type="text" id="admin_key" name="admin_key" value="{{ old('admin_key') }}" required>

        @error('admin_key')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Register</button>
</form>

<script>
    document.getElementById('role').addEventListener('change', function() {
        var adminKeyContainer = document.getElementById('admin-key-container');
        if (this.value === 'admin') {
            adminKeyContainer.style.display = 'block';
        } else {
            adminKeyContainer.style.display = 'none';
        }
    });

    // Trigger the event on page load to show the correct admin key field state
    document.getElementById('role').dispatchEvent(new Event('change'));
</script>
</body>
</html>
