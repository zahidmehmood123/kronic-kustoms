<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Kronic Kustoms</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #333 0%, #1a1a1a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #EDEDED;
        }
        .login-container {
            background: #444;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            width: 100%;
            max-width: 400px;
        }
        .login-container h1 {
            color: #FF0000;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2em;
        }
        .form-group {
            margin-bottom: 20px;
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
        .error-message {
            background: #ff4444;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .btn-login {
            width: 100%;
            padding: 12px;
            background: #FF0000;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-login:hover {
            background: #cc0000;
        }
        .text-danger {
            color: #ff4444;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        
        @if(session('error'))
            <div class="error-message">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
</body>
</html>

