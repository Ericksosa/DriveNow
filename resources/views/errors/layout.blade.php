<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | DriveNow</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: #fff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            text-align: center;
            max-width: 600px;
            padding: 20px;
        }

        .error-code {
            font-size: 6rem;
            font-weight: bold;
            color: #facc15;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.3);
        }

        .message {
            font-size: 1.5rem;
            margin: 20px 0;
        }

        .car-illustration {
            margin: 30px auto;
            width: 200px;
            height: auto;
        }

        .btn {
            display: inline-block;
            margin: 10px;
            padding: 12px 24px;
            border-radius: 30px;
            background: #facc15;
            color: #1e3a8a;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn:hover {
            background: #fff;
            color: #1e3a8a;
        }

        footer {
            margin-top: 40px;
            font-size: 0.9rem;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-code">@yield('code')</div>
        <p class="message">@yield('message')</p>

        <!-- Imagen ilustrativa de carro (puedes cambiar a un SVG/PNG en public/images) -->
        <img src="{{ asset('images/car-error.png') }}" alt="Car Illustration" class="car-illustration">

        <div>
            <a href="{{ url('/') }}" class="btn">🏠 Ir al inicio</a>
            <a href="{{ url('/dashboard') }}" class="btn">📋 Ir al Dashboard</a>
        </div>

        <footer>
            © {{ date('Y') }} DriveNow - Tu renta de carros de confianza 🚗
        </footer>
    </div>
</body>
</html>
