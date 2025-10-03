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
            font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated background elements */
        .bg-decoration {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.15), transparent);
            animation: float 20s infinite ease-in-out;
        }

        .bg-circle:nth-child(1) {
            width: 400px;
            height: 400px;
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }

        .bg-circle:nth-child(2) {
            width: 300px;
            height: 300px;
            bottom: -50px;
            right: -50px;
            animation-delay: 5s;
        }

        .bg-circle:nth-child(3) {
            width: 250px;
            height: 250px;
            top: 50%;
            right: 10%;
            animation-delay: 10s;
        }

        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(30px, -30px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .container {
            text-align: center;
            max-width: 700px;
            padding: 40px 20px;
            position: relative;
            z-index: 1;
        }

        /* Glass card effect */
        .error-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-radius: 32px;
            padding: 60px 40px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Logo/Brand */
        .brand {
            display: inline-flex;
            align-items: center;
            /* gap: 12px; */
            margin-bottom: 30px;
            font-size: 1.5rem;
            font-weight: bold;
            color: #facc15;
            text-shadow: 0 2px 10px rgba(250, 204, 21, 0.3);
        }

        .brand-text-drive{
            color: rgb(96, 165, 250);
            text-shadow: 0 2px 10px rgba(96, 165, 250, 0.3);

        }
        .brand-text-now{
            color: rgb(251, 146, 60);
            text-shadow: 0 2px 10px rgba(251, 146, 60, 0.3);
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #facc15, #fbbf24);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            box-shadow: 0 4px 15px rgba(250, 204, 21, 0.4);
        }

        .error-code {
            font-size: 8rem;
            font-weight: 900;
            background: linear-gradient(135deg, #facc15, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 20px;
            text-shadow: 0 10px 30px rgba(250, 204, 21, 0.3);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.8;
            }
        }

        .error-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #f1f5f9;
        }

        .message {
            font-size: 1.125rem;
            margin: 0 0 40px;
            color: #cbd5e1;
            line-height: 1.6;
        }

        /* Car illustration */
        .car-container {
            margin: 40px 0;
            position: relative;
        }

        .car-svg {
            width: 200px;
            height: auto;
            margin: 0 auto;
            display: block;
            filter: drop-shadow(0 10px 25px rgba(250, 204, 21, 0.3));
            animation: carBounce 3s ease-in-out infinite;
        }

        @keyframes carBounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        .road {
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg,
                transparent 0%,
                transparent 40%,
                #facc15 40%,
                #facc15 60%,
                transparent 60%,
                transparent 100%);
            background-size: 60px 4px;
            margin-top: 20px;
            border-radius: 2px;
            animation: roadMove 1s linear infinite;
        }

        @keyframes roadMove {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 60px 0;
            }
        }

        /* Buttons */
        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 40px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1rem;
            border: 2px solid transparent;
        }

        .btn-primary {
            background: linear-gradient(135deg, #facc15, #fbbf24);
            color: #0f172a;
            box-shadow: 0 4px 15px rgba(250, 204, 21, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(250, 204, 21, 0.5);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
        }

        .btn svg {
            width: 20px;
            height: 20px;
        }

        footer {
            margin-top: 50px;
            font-size: 0.875rem;
            color: #94a3b8;
            opacity: 0.8;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .error-card {
                padding: 40px 24px;
            }

            .error-code {
                font-size: 5rem;
            }

            .error-title {
                font-size: 1.5rem;
            }

            .message {
                font-size: 1rem;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <div class="bg-decoration">
        <div class="bg-circle"></div>
        <div class="bg-circle"></div>
        <div class="bg-circle"></div>
    </div>

    <div class="container">
        <div class="error-card">

            <div class="brand">
                <span class="brand-text-drive">Drive</span><span class="brand-text-now">Now</span>
            </div>


            <div class="error-code">@yield('code')</div>


            <h1 class="error-title">@yield('title')</h1>


            <p class="message">@yield('message')</p>


            <div class="car-container">
                <svg class="car-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="#facc15">
                    <path d="M544 192h-16l-64-96H176l-64 96h-16C42.98 192 0 234.1 0 288v96c0 17.7 14.33 32 32 32h32c0 35.3 28.65 64 64 64s64-28.7 64-64h256c0 35.3 28.7 64 64 64s64-28.7 64-64h32c17.7 0 32-14.3 32-32v-96c0-53-42.1-96-96-96zM160 400c-17.67 0-32-14.3-32-32s14.33-32 32-32 32 14.3 32 32-14.3 32-32 32zm320 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"/>
                </svg>
                <div class="road"></div>
            </div>


            <div class="button-group">
                <a href="{{ url('/') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Ir al Inicio
                </a>
                <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Dashboard
                </a>
            </div>


            <footer>
                &copy; {{ date('Y') }} DriveNow - Conduce sin preocupaciones
            </footer>
        </div>
    </div>
</body>
</html>