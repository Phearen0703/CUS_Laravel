<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('frontends/assets/css/style.css') }}" rel="stylesheet">
    <style>
        /* Custom styles for this page */
        .hero-slide {
            height: 400px;
            object-fit: cover;
        }

        .news-card {
            transition: transform 0.3s;
            height: 100%;
        }

        .news-card:hover {
            transform: translateY(-5px);
        }

        .news-card-img {
            height: 180px;
            object-fit: cover;
        }

        .category-title {
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .category-title:after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: #0d6efd;
        }

        .ad-box {
            background: #f8f9fa;
            border: 1px dashed #dee2e6;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .ad-box img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    @yield('nav')

    <!-- Hero Slider with Auto-Play -->
    <div id="heroSlider" class="carousel slide carousel-fade mb-4" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="2"></button>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-{{ session('status') }}">
                    {{ session('sms') }}
                </div>
            @endif
            <!-- News Content -->
            @yield('content')

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Categories Widget -->
               @yield('categories')
                

                <!-- Recent News Widget -->
                @yield('recent_news')


            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-4 mt-5">
        <div class="container">

            <hr class="my-4">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; 2023 NewsPortal. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed with Bootstrap 5</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // Your custom JavaScript that uses $ goes here
    </script>
    <script src="{{asset('frontends/assets/js/script.js')}}"></script>
    @stack('scripts')
</body>

</html>