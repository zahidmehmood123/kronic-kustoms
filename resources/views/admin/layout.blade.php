<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Kronic Kustoms</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #333333;
            color: #EDEDED;
            min-height: 100vh;
        }
        .top-navbar {
            background: #4A4A4A;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        .top-navbar h1 {
            color: #FF0000;
            font-size: 1.5em;
            margin: 0;
        }
        .top-navbar h1 a {
            color: #FF0000;
            text-decoration: none;
            transition: color 0.3s;
        }
        .top-navbar h1 a:hover {
            color: #cc0000;
        }
        .top-navbar .nav-links {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .top-navbar .nav-links a {
            color: #EDEDED;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .top-navbar .nav-links a:hover {
            background: #555;
        }
        .top-navbar .nav-links a.active {
            background: #FF0000;
            color: white;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .user-info span {
            color: #EDEDED;
        }
        .btn {
            padding: 8px 16px;
            background: #555;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #666;
        }
        .main-container {
            display: flex;
            margin-top: 70px;
            min-height: calc(100vh - 70px);
        }
        .sidebar {
            width: 250px;
            background: #444;
            padding: 20px 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.3);
            position: fixed;
            left: 0;
            top: 70px;
            height: calc(100vh - 70px);
            overflow-y: auto;
        }
        .sidebar-menu {
            list-style: none;
        }
        .sidebar-menu li {
            margin-bottom: 5px;
        }
        .sidebar-menu a {
            display: block;
            color: #EDEDED;
            text-decoration: none;
            padding: 12px 20px;
            transition: background 0.3s;
            border-left: 3px solid transparent;
        }
        .sidebar-menu a:hover {
            background: #555;
        }
        .sidebar-menu a.active {
            background: #555;
            border-left-color: #FF0000;
            color: #FF0000;
        }
        .sidebar-menu .menu-title {
            padding: 15px 20px 10px;
            color: #999;
            font-size: 0.85em;
            text-transform: uppercase;
            font-weight: bold;
        }
        .content-area {
            margin-left: 250px;
            flex: 1;
            padding: 30px;
        }
        .card {
            background: #444;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            margin-bottom: 20px;
        }
        .card h2 {
            color: #FF0000;
            margin-bottom: 20px;
            font-size: 1.8em;
        }
        .success-message {
            background: #00ff00;
            color: #000;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .error-message {
            background: #ff4444;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: #555;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .stat-card h3 {
            color: #FF0000;
            margin-bottom: 10px;
            font-size: 1.2em;
        }
        .stat-card .value {
            font-size: 2em;
            font-weight: bold;
            color: #EDEDED;
            margin: 10px 0;
        }
        .stat-card .label {
            color: #999;
            font-size: 0.9em;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #EDEDED;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            background: #555;
            border: 1px solid #777;
            border-radius: 5px;
            color: #EDEDED;
            font-size: 16px;
        }
        .form-group input:focus {
            outline: none;
            border-color: #FF0000;
        }
        .form-group .help-text {
            color: #999;
            font-size: 0.9em;
            margin-top: 5px;
        }
        .text-danger {
            color: #ff4444;
            font-size: 14px;
            margin-top: 5px;
        }
        .btn-submit {
            padding: 15px 30px;
            background: #FF0000;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-submit:hover {
            background: #cc0000;
        }
        .breadcrumb {
            background: #555;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }
        .breadcrumb a {
            color: #FF0000;
            text-decoration: none;
            transition: color 0.3s;
        }
        .breadcrumb a:hover {
            color: #cc0000;
            text-decoration: underline;
        }
        .breadcrumb span {
            color: #999;
        }
        .breadcrumb .active {
            color: #EDEDED;
            font-weight: bold;
        }
        /* Pagination Styles */
        .pagination-wrapper {
            margin-top: 30px;
        }
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            background: #555;
            border-radius: 8px;
        }
        .pagination-info {
            color: #EDEDED;
            font-size: 14px;
        }
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin: 0;
            padding: 0;
            list-style: none;
            flex-wrap: wrap;
        }
        .pagination li {
            display: inline-flex;
            margin: 0;
        }
        .pagination a,
        .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 8px 12px;
            background: #666;
            color: #EDEDED;
            text-decoration: none;
            border-radius: 5px;
            border: 1px solid #777;
            transition: all 0.3s;
            font-size: 14px;
            font-weight: normal;
        }
        .pagination a:hover {
            background: #777;
            border-color: #FF0000;
            color: #FF0000;
            transform: translateY(-2px);
        }
        .pagination .active span {
            background: #FF0000;
            color: white;
            border-color: #FF0000;
            font-weight: bold;
        }
        .pagination .disabled span,
        .pagination .disabled a {
            background: #444;
            color: #666;
            cursor: not-allowed;
            opacity: 0.5;
            pointer-events: none;
        }
        .pagination span:not(.active) {
            background: #444;
            color: #999;
            cursor: default;
        }
        @media (max-width: 768px) {
            .pagination-container {
                flex-direction: column;
                align-items: center;
            }
            .pagination-info {
                text-align: center;
            }
            .sidebar {
                width: 200px;
            }
            .content-area {
                margin-left: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="top-navbar">
        <h1><a href="{{ route('admin.dashboard') }}">📊 Kronic Kustoms - Admin Panel</a></h1>
       
        <div class="user-info">
            <span>Welcome, {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="main-container">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        📊 Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                        ⚙️ Pricing & Shipping
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                        📦 All Orders
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.contacts') }}" class="{{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">
                        📧 Contact Submissions
                    </a>
                </li>
            </ul>
        </div>

        <div class="content-area">
            @if(session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="error-message">{{ session('error') }}</div>
            @endif

            @hasSection('breadcrumb')
                <div class="breadcrumb">
                    @yield('breadcrumb')
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>

