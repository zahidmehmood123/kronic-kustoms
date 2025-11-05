<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Kronic Kustoms</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background-color: #333333;
            color: #EDEDED;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            padding-top: 80px;
        }
        nav {
            background-color: #4A4A4A;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 1000;
        }
        .logo-container {
            display: flex;
            align-items: center;
            margin-left: 25px;
        }
        .logo {
            height: 160px;
            margin-right: 10px;
        }
        .logo-text {
            font-size: 1.5em;
            font-weight: bold;
            color: #FF0000;
            margin: 0;
        }
        .nav-links {
            display: flex;
            align-items: center;
            margin-right: 25px;
        }
        .nav-links a {
            color: #EDEDED;
            text-decoration: none;
            margin: 0 15px;
        }
        .nav-links a:hover {
            color: #FF0000;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        h1 {
            color: #FF0000;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2.5em;
        }
        .form-container {
            background: #444;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
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
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            background: #555;
            border: 1px solid #777;
            border-radius: 5px;
            color: #EDEDED;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #FF0000;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }
        .btn-submit {
            width: 100%;
            padding: 15px;
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
        .success-message {
            background: #00ff00;
            color: #000;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .text-danger {
            color: #ff4444;
            font-size: 14px;
            margin-top: 5px;
        }
        footer {
            background-color: #4A4A4A;
            padding: 20px;
            margin-top: 40px;
            width: 100%;
            color: #EDEDED;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo-container">
            <img src="{{ asset('KK Logo 02 NB.png') }}" alt="Kronic Kustoms Logo" class="logo">
            <span class="logo-text">Kronic Kustoms™</span>
        </div>
        <div class="nav-links">
            <a href="/">Home</a>
            <a href="/ordernow">Order Now</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>
    </nav>

    <div class="container">
        <h1>Contact Us</h1>
        
        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <div class="form-container">
            <form method="POST" action="{{ route('contact.store') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}">
                    @error('subject')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" required>{{ old('message') }}</textarea>
                    @error('message')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Send Message</button>
            </form>
        </div>
    </div>

    <footer>
        <p>© 2025 Kronic Kustoms™. Arizona-registered trademark. All rights reserved. Product design pending U.S. copyright.</p>
    </footer>
</body>
</html>

