<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Money Hats</title>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>

            html {
                line-height: 1.15;
                -webkit-text-size-adjust: 100%;
            }
            body {
                margin: 0;
                font-family: 'Nunito', sans-serif;
                background-color:rgb(34, 50, 52); 
                color: #fff;
            }
            a {
                background-color: transparent;
                color: inherit;
                text-decoration: none;
            }
            [hidden] {
                display: none;
            }
            *, :after, :before {
                box-sizing: border-box;
                border: 0 solid #e2e8f0;
            }

            /* Utility classes */
            .flex {
                display: flex;
            }
            .items-center {
                align-items: center;
            }
            .justify-center {
                justify-content: center;
            }
            .text-center {
                text-align: center;
            }
            .min-h-screen {
                min-height: 100vh;
            }
            .mx-auto {
                margin-left: auto;
                margin-right: auto;
            }
            .mt-4 {
                margin-top: 1rem;
            }
            .mt-8 {
                margin-top: 2rem;
            }
            .p-6 {
                padding: 1.5rem;
            }
            .rounded-lg {
                border-radius: 0.5rem;
            }
            .shadow-lg {
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }
            .text-sm {
                font-size: 0.875rem;
            }
            .text-gray-500 {
                color: #a0aec0;
            }

            .login-container {
                background-color:rgb(47, 58, 58); 
                max-width: 400px;
                width: 100%;
                text-align: center;
                border-radius: 10px;
                padding: 2rem;
            }

            .logo-placeholder {
                font-size: 1.5rem;
                font-weight: 700;
                color: #fff;
                margin-bottom: 1.5rem;
            }

            .btn {
                display: block;
                width: 100%;
                padding: 0.75rem;
                font-size: 1rem;
                font-weight: 600;
                border-radius: 0.375rem;
                cursor: pointer;
                transition: background-color 0.3s ease;
                margin-bottom: 1rem;
            }
            .btn-primary {
                background-color: #f4c430; 
                color: #1a2526;
            }
            .btn-primary:hover {
                background-color: #e0b028;
            }
            .btn-secondary {
                background-color: transparent;
                color: #f4c430;
                border: 2px solid #f4c430;
            }
            .btn-secondary:hover {
                background-color: rgba(244, 196, 48, 0.1);
            }

            @media (min-width: 640px) {
                .sm\:text-right {
                    text-align: right;
                }
                .sm\:ml-0 {
                    margin-left: 0;
                }
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="flex items-center justify-center min-h-screen">
            <div class="login-container shadow-lg">
                <div class="logo-placeholder">
                    <img src="{{ asset('images/LogoMoneyHats.png') }}" alt="MoneyHats Logo" style="max-width: 200px;">
                </div>

                @if (Route::has('filament.auth.login'))
                    @auth
                        <a href="{{ url('/admin') }}" class="btn btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('filament.auth.login') }}" class="btn btn-primary">Log in</a>

                        @if (Route::has('auth.register'))
                            <a href="{{ route('auth.register') }}" class="btn btn-secondary">Sign Up</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        <div class="flex justify-center mt-4">
            <div class="text-center text-sm text-gray-500">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </body>
</html>