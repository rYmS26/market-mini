<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Website')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            margin-bottom: 0;
        }
        .jumbotron {
            background-color: #f8f9fa;
            padding: 50px 25px;
            text-align: left;
        }
        .left-content {
            max-width: 50%;
        }
        .right-content {
            max-width: 50%;
            text-align: center;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        footer {
            background-color: #f8f9fa;
            padding: 25px;
            text-align: center;
        }
        .navbar {
            background-color: white; /* Make the navbar background transparent */
        }
        .navbar-brand {
            position: absolute;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}" style="width: 100px;">
             <img src="{{ asset('storage/photos/market-mini-logo.png') }}" alt="market-mini-logo" class="img-fluid" style="width: 100%;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('products.index')}}">Product</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart') }}">Cart</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                @if(Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route('profile')}}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('actionlogout') }}">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
    <div class="container">
        @yield('content')
    </div>

    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>About Us</h5>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus similique, laborum consequuntur amet ab adipisci dolores odio voluptas minima hic at illum accusamus qui officiis ad tempora ut. Officia, in.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <div class="links">
                        <a href="#" style="color: #179BAE;">Home</a> |
                        <a href="#" style="color: #179BAE;">About</a> |
                        <a href="#" style="color: #179BAE;">Services</a> |
                        <a href="#" style="color: #179BAE;">Contact</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <div class="social-icons">
                        <a href="#" class="text-dark me-2">
                            <!-- Facebook Icon -->
                        </a>
                        <a href="#" class="text-dark me-2">
                            <!-- Twitter Icon -->
                        </a>
                        <a href="#" class="text-dark me-2">
                            <!-- Instagram Icon -->
                        </a>
                        <a href="#" class="text-dark">
                            <!-- LinkedIn Icon -->
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <p>&copy; 2024 MyWebsite. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
