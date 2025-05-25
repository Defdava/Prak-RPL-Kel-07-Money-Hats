<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MoneyHats</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #0c1120;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #1a2238;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 300px;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .logo img {
            height: 50px;
            margin-right: 10px;
        }

        .logo-text {
            font-size: 26px;
            font-weight: bold;
        }

        .logo-text span.blue {
            color: #3b82f6; /* biru */
        }

        .logo-text span.yellow {
            color: #facc15; /* kuning */
        }

        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-login {
            background-color: #facc15;
            border: none;
            color:rgb(0, 68, 255);
        }

        .btn-login:hover {
            background-color: #eab308;
        }

        .btn-signup {
            background-color: transparent;
            border: 1px solid #facc15;
            color: #facc15;
        }

        .btn-signup:hover {
            background-color: #facc15;
            color: #1a2238;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="MoneyHats Logo">
            <div class="logo-text">
                <span class="blue">Money</span><span class="yellow">Hats</span>
            </div>
        </div>

        <a href="{{ route('filament.auth.login') }}">
            <button class="btn btn-login">Log in</button>
        </a>
        <a href="{{ route('auth.register') }}">
            <button class="btn btn-signup">Sign Up</button>
        </a>
    </div>
</body>
</html>
