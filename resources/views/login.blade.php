<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        .toggle-box {
            margin-top: 20px;
            display: block;
        }
        .toggle-panel {
            text-align: center;
        }
        .toggle-box .btn {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: lightblue;
            color: white;
            border: none;
            cursor: pointer;
        }
        .toggle-box .btn:hover {
            background-color: darkblue;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- User Login Form -->
        <div class="form-box login" id="user-login">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h1>User Login</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>

        <!-- Admin Login Form (Initially hidden) -->
        <div class="form-box login" id="admin-login" style="display: none;">
            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <h1>Admin Login</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>

        <!-- Toggle Button to Switch Between User and Admin Login -->
        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Sign In To Access Our Ticketing System</p>
                <button class="btn register-btn" onclick="toggleLogin()">Admin Login</button>
            </div>
        </div>
    </div>

    <script>
        // Function to switch between User and Admin login
        function toggleLogin() {
            const userLogin = document.getElementById('user-login');
            const adminLogin = document.getElementById('admin-login');
            const toggleButton = document.querySelector('.register-btn');
            const title = document.querySelector('title');

            // Toggle the login forms
            if (userLogin.style.display === 'none') {
                userLogin.style.display = 'block';
                adminLogin.style.display = 'none';
                title.textContent = 'User Login'; 
                toggleButton.textContent = 'Admin Login'; 
            } else {
                userLogin.style.display = 'none';
                adminLogin.style.display = 'block';
                title.textContent = 'Admin Login'; 
                toggleButton.textContent = 'User Login'; 
            }
        }
    </script>
</body>
</html>