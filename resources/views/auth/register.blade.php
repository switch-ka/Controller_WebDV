<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Register</h1>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                </div>

                <!-- Role Selection -->
                <div class="form-group">
                    <label for="role">Select Role</label>
                    <select id="role" name="role" required onchange="toggleAdminKey()">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <!-- Admin Key -->
                <div class="form-group admin-key" id="admin-key-container" style="display: none;">
                    <label for="admin_key">Admin Key</label>
                    <input type="password" id="admin_key" name="admin_key" placeholder="Enter the admin key">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn">Register</button>

                <!-- Login Redirect -->
                <p class="redirect">Already have an account? <a href="{{ route('login') }}">Login here</a>.</p>
            </form>
        </div>
    </div>

    <script>
        function toggleAdminKey() {
            const role = document.getElementById('role').value;
            const adminKeyContainer = document.getElementById('admin-key-container');
            if (role === 'admin') {
                adminKeyContainer.style.display = 'block';
            } else {
                adminKeyContainer.style.display = 'none';
            }
        }
    </script>
</body>
</html>