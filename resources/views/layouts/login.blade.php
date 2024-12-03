<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Register')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (for modern utilities) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #87CEEB 0%, #4682B4 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.125);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 35px 60px rgba(0, 0, 0, 0.15);
        }

        .input-field {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            outline: none;
            box-shadow: 0 0 0 3px rgba(135, 206, 235, 0.3);
        }

        .register-image {
            object-fit: cover;
            object-position: center;
            width: 100%;
            height: 100%;
            transition: transform 0.3s ease;
        }

        .glass-card:hover .register-image {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="antialiased">
    <div class="container mx-auto px-4">
        <div class="glass-card grid md:grid-cols-2 shadow-2xl max-w-4xl mx-auto">
            <!-- Image Section -->
            <div class="hidden md:block relative overflow-hidden">
                <img 
                    src="{{ asset('img/img3.jpg') }}" 
                    alt="Registration Background" 
                    class="register-image absolute inset-0 w-full h-full"
                >
            </div>

            <!-- Form Section -->
            <div class="p-8 md:p-12 flex flex-col justify-center text-white">
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-bold mb-2">Create Account</h2>
                    <p class="text-gray-300">Start your journey with us</p>
                </div>

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Optional: Simple form validation
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                let valid = true;
                $(this).find('input').each(function() {
                    if ($(this).val().trim() === '') {
                        valid = false;
                        $(this).addClass('border-red-500');
                    } else {
                        $(this).removeClass('border-red-500');
                    }
                });
                return valid;
            });
        });
    </script>
</body>
</html>