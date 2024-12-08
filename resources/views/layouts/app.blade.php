<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Love Up</title>

    <!-- Favicon -->
    <link rel="icon" src="/storage/picture/pngwing.com.png" >

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Nunito', sans-serif;
            overflow-x: hidden;
            background: linear-gradient(to bottom, #ffe6f1, #ffcce6);
            animation: gradient 10s infinite alternate;
        }

        /* Navbar Customizations */
        .navbar-dark {
            background-color: #ff69b4 !important;
        }

        .nav-link {
            font-size: larger;
            color: white !important;
        }

        .nav-link:hover {
            color: #ffcce6 !important;
        }

        /* Sparkling Stars Animation */
        @keyframes sparkle {
            0% { opacity: 0.8; transform: scale(0.8); }
            50% { opacity: 1; transform: scale(1.2); }
            100% { opacity: 0.8; transform: scale(0.8); }
        }

        .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            opacity: 0.8;
            animation: sparkle 1.5s infinite;
        }

        .navbar {
    position: relative;
    z-index: 2;
}

#heartCanvas {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1; /* Ensures hearts are behind navbar text */
    pointer-events: none; /* Prevent interaction with hearts */
}

    </style>
</head>
<body>
<div id="app">
    <!-- Background Sparkling Stars -->
    <div id="stars"></div>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm position-relative">
    <canvas id="heartCanvas"></canvas>
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            <img src="/storage/picture/pngwing.com.png" width="50px" alt="Application logo with heart as a puzzle">
            Love Up
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto"></ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('matches') }}">{{ __('Matches') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pictures.show') }}">{{ __('My Pictures') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.showEditProfile') }}">{{ __('Profile') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


    <main class="py-4">
        @yield('content')
    </main>
</div>

<script>
    // Function to create random stars
    function createStars() {
        const starContainer = document.getElementById('stars');
        const starCount = 500; // Adjust this value for more stars

        for (let i = 0; i < starCount; i++) {
            const star = document.createElement('div');
            star.classList.add('star');

            // Randomize size, position, and animation delay
            const size = Math.random() * 4 + 2; // Size between 2px and 6px
            star.style.width = `${size}px`;
            star.style.height = `${size}px`;

            const top = Math.random() * window.innerHeight;
            const left = Math.random() * window.innerWidth;
            star.style.top = `${top}px`;
            star.style.left = `${left}px`;

            const delay = Math.random() * 2; // Delay between 0s and 2s
            star.style.animationDelay = `${delay}s`;

            starContainer.appendChild(star);
        }
    }

    // Call the function to create stars
    window.onload = createStars;


    const canvas = document.getElementById('heartCanvas');
const ctx = canvas.getContext('2d');

function resizeCanvas() {
    // Set the canvas size to match the navbar dimensions
    const navbar = document.querySelector('.navbar');
    canvas.width = navbar.offsetWidth;
    canvas.height = navbar.offsetHeight;
}

resizeCanvas();
window.addEventListener('resize', resizeCanvas);

const hearts = [];
const heartCount = 30;

// Function to draw a heart
function drawHeart(x, y, size, color) {
    ctx.save();
    ctx.translate(x, y);
    ctx.beginPath();
    ctx.moveTo(0, -size / 2);
    ctx.bezierCurveTo(
        -size / 2, -size, 
        -size, size / 3, 
        0, size
    );
    ctx.bezierCurveTo(
        size, size / 3, 
        size / 2, -size, 
        0, -size / 2
    );
    ctx.closePath();
    ctx.fillStyle = color;
    ctx.fill();
    ctx.restore();
}

// Create heart objects
function createHearts() {
    hearts.length = 0; // Clear existing hearts
    for (let i = 0; i < heartCount; i++) {
        hearts.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            size: Math.random() * 20 + 10,
            speed: Math.random() * 2 + 1,
            color: `hsl(${Math.random() * 360}, 70%, 70%)`
        });
    }
}

// Update and render hearts
function updateHearts() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    for (const heart of hearts) {
        drawHeart(heart.x, heart.y, heart.size, heart.color);
        heart.y += heart.speed;

        // Reset position if a heart goes out of view
        if (heart.y > canvas.height) {
            heart.y = -heart.size;
            heart.x = Math.random() * canvas.width;
        }
    }

    requestAnimationFrame(updateHearts);
}

// Initialize hearts and start animation
createHearts();
updateHearts();

</script>
</body>
</html>
