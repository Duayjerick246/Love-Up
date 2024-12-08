<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Love Up</title>


    <link rel="icon" src="/storage/picture/pngwing.com.png" >


    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <style>
        html, body {
            background: linear-gradient(135deg, #ff7eb3, #ff758c);
            color: #fff;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
            z-index: 1;
            position: relative;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .title {
            font-size: 84px;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .links > a {
            color: #fff;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 30px;
            margin: 5px;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .links > a:hover {
            background: rgba(0, 0, 0, 0.4);
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
       
    </style>
</head>
<body>
<canvas id="heartCanvas"></canvas>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title">
            Love Up
        </div>
        <div class="links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</div>

<script>
    const canvas = document.getElementById('heartCanvas');
    const ctx = canvas.getContext('2d');

    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }

    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    const hearts = [];
    const heartCount = 50;

    // Function to draw a perfect heart
    function drawHeart(x, y, size, color) {
        ctx.save();
        ctx.translate(x, y);
        ctx.beginPath();

        // Move to the starting point
        ctx.moveTo(0, -size / 2);

        // Create the left curve
        ctx.bezierCurveTo(
            -size / 2, -size,    // Control point 1
            -size, size / 3,     // Control point 2
            0, size              // Ending point
        );

        // Create the right curve
        ctx.bezierCurveTo(
            size, size / 3,      // Control point 1
            size / 2, -size,     // Control point 2
            0, -size / 2         // Ending point
        );

        ctx.closePath();
        ctx.fillStyle = color;
        ctx.fill();
        ctx.restore();
    }

    // Function to create heart objects
    function createHearts() {
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

    // Function to update and render hearts
    function updateHearts() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        for (let heart of hearts) {
            drawHeart(heart.x, heart.y, heart.size, heart.color);
            heart.y += heart.speed;

            // Reset position if the heart goes out of view
            if (heart.y > canvas.height) {
                heart.y = -heart.size;
                heart.x = Math.random() * canvas.width;
            }
        }

        requestAnimationFrame(updateHearts);
    }

    createHearts();
    updateHearts();
</script>
</body>
</html>
