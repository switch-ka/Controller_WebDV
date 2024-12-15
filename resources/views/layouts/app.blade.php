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
        @if (session('username'))
    <p>Welcome, {{ session('username') }}</p>
@else
    <p>Welcome, Guest</p>
@endif


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
                <button type="submit" class="logout-btn" style="background-color: #e74c3c !important; color: white !important; width: 100% !important; padding: 12px !important; font-size: 16px !important; text-align: center !important; border: none !important; border-radius: 8px !important; cursor: pointer !important;">
                    Logout
                </button>
            </form>
        </div>

        <!-- Content Area -->
        <div class="content">
            <!-- Full-Width Search Bar -->
            <div class="search-container">
                <form action="{{ route('search-ticket') }}" method="GET" style="width: 100%; display: flex;">
                    <input type="text" name="search" placeholder="Search by Ticket #" class="search-bar" style="width: 100%; flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px 0 0 4px;">
                    <button type="submit" class="search-button" style="padding: 8px 16px; background-color: #007bff; color: white; border: none; border-radius: 0 4px 4px 0; cursor: pointer;">
                        Search
                    </button>
                </form>
            </div>

            <!-- Full-Width Form Container -->
            <div class="form-container">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
