<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <style>
        :root {
            --primary-color: #3b82f6;
            --secondary-color: #10b981;
            --dark-color: #1f2937;
            --light-color: #f3f4f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
        }

        /* Modern Navbar */
        .navbar-modern {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.9) 0%, rgba(16, 185, 129, 0.9) 100%);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .navbar-modern .navbar-brand {
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: -1px;
        }

        .navbar-modern .nav-link {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            position: relative;
            transition: color 0.3s ease;
        }

        .navbar-modern .nav-link:hover,
        .navbar-modern .nav-link:focus {
            color: white;
        }

        .navbar-modern .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background-color: white;
            transition: width 0.3s ease, left 0.3s ease;
        }

        .navbar-modern .nav-link:hover::after {
            width: 100%;
            left: 0;
        }

        /* Modern Footer */
        .footer-modern {
        background: linear-gradient(135deg, var(--dark-color) 0%, #374151 100%);
        color: var(--light-color);
        padding: 4rem 0;
        margin-top: auto;
        }

        .footer-modern h5 {
            color: white;
            margin-bottom: 1.5rem;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        .footer-modern .social-links a {
            color: var(--light-color);
            margin-right: 1rem;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .footer-modern .social-links a:hover {
            color: var(--primary-color);
        }

        .footer-modern .contact-info p {
            margin-bottom: 0.5rem;
        }

        .search-wrapper {
            max-width: 700px;
            margin: 0 auto;
        }

        .search-input-group {
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 50px;
            overflow: hidden;
        }

        .search-input {
            border: none;
            padding-left: 50px;
            height: 55px;
            font-size: 16px;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            color: #6c757d;
        }

        .search-button {
            border-radius: 0 50px 50px 0;
            padding: 0 20px;
            height: 55px;
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .search-button:hover {
            background-color: #0056b3;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #80bdff;
        }

        .bg-gradient-primary {
            background: linear-gradient(to right, #5e72e4, #825ee4) !important;
        }

        .event-details .detail-item {
            background-color: #f8f9fe;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .event-details .detail-item h5 {
            margin-bottom: 10px;
            color: #32325d;
        }

        .favorite-event-card {
        transition: transform 0.3s ease;
        overflow: hidden;
    }
    .favorite-event-card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

        .container-fluid{
  
            padding: 100px
        }

        .text-gradient {
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-section {
        min-height: 100vh;
        background: linear-gradient(135deg, rgba(106,17,203,0.1), rgba(37,117,252,0.1));
    }

    .hero-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 100vh;
    }

    .hero-image {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(1.2);
        transition: transform 0.5s ease;
    }

    .hero-image-wrapper:hover .hero-image {
        transform: translate(-50%, -50%) scale(1.3);
    }

    .hero-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to right, rgba(0,0,0,0.0), transparent);
    }

    .modern-search-input {
        max-width: 800px;
        margin: 0 auto;
        border-radius: 50px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .event-stats .stat-item {
        text-align: center;
        padding: 15px;
        border-radius: 10px;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
    }

    .booking-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .booking-card:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .no-bookings svg {
        stroke-width: 1.5;
    }

    .btn {
        transition: all 0.3s ease;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .navbar-modern .navbar-collapse {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.9) 0%, rgba(16, 185, 129, 0.9) 100%);
                backdrop-filter: blur(10px);
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-modern fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Eventix</a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('events.catalog') }}">Events</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        @if(Auth::check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="
                                            @if(Auth::user()->role == 'admin') 
                                                {{ route('admin.dashboard') }}
                                            @elseif(Auth::user()->role == 'organizer') 
                                                {{ route('organizer.dashboard') }}
                                            @elseif(Auth::user()->role == 'user') 
                                                {{ route('user.dashboard') }}
                                            @else 
                                                #
                                            @endif
                                        ">
                                            Dashboard
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" 
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main style="padding-top: 80px;">
        @yield('content')
    </main>

    <footer class="footer-modern">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 contact-info">
                    <h5>Contact Information</h5>
                    <p><i class="fas fa-envelope me-2"></i> Eventix@gmail.com</p>
                    <p><i class="fas fa-phone me-2"></i> 0812345678</p>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Jl. Perintis Kemerdekaan No. 1</p>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>About Us</h5>
                    <p>We are dedicated to providing quality events and services to our customers. Your satisfaction is our priority!</p>
                </div>
                <div class="col-lg-4 col-md-12 mb-4 social-links">
                    <h5>Follow Us</h5>
                    <div>
                        <a href="#" class="text-light"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <p>&copy; 2024 Eventix. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>