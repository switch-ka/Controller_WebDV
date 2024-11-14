<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket System</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>{{ session('user_type') == 'admin' ? 'WELCOME ADMIN' : 'WELCOME USER' }}</h2>
            <ul>
                @if(session('user_type') == 'admin')
                    <li><a href="{{ route('view-ticket') }}">View Ticket</a></li>
                @else
                    <li><a href="{{ route('create-ticket') }}">Create Ticket</a></li>
                    <li><a href="{{ route('view-ticket') }}">View Ticket</a></li>
                @endif
            </ul>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn" style="
                    background-color: #e74c3c !important;
                    color: white !important;
                    width: 100% !important;
                    padding: 12px !important;
                    font-size: 16px !important;
                    text-align: center !important;
                    border: none !important;
                    border-radius: 8px !important;
                    cursor: pointer !important;
                ">Logout</button>

            </form>

        </div>


        <!-- Content Area -->
        <div class="content">
            <!-- Full-Width Search Bar -->
            <div class="search-container">
                <input type="text" placeholder="Search..." class="search-bar">
                <button class="search-button">
                    <img src="{{ asset('images/search.png') }}" alt="Search Icon" />
                </button>
            </div>

            <!-- Full-Width Form Container -->
            <div class="form-container">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
