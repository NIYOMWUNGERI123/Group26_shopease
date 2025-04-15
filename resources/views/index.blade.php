<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopEase - Your One-Stop Online Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            padding: 100px 0;
        }
        .feature-card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s;
            margin-bottom: 20px;
            background-color: #f8f9fa;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .category-section {
            padding: 50px 0;
            background-color: #f8f9fa;
        }
        .product-card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .product-card img {
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .cart-icon {
            position: relative;
        }
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff4444;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <span class="text-success fw-bold">Shop</span>Ease
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Deals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <form class="d-flex me-3" action="{{ route('products.index') }}" method="GET">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search products...">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <a href="{{ route('cart.index') }}" class="cart-icon me-3">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                        <span class="cart-count">{{ count(session('cart', [])) }}</span>
                    </a>
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-success">Login</a>
                    @else
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 mb-4">Welcome to ShopEase</h1>
                    <p class="lead mb-4">Discover amazing products at unbeatable prices. Shop with confidence and convenience.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-light btn-lg me-2">Shop Now</a>
                    <a href="#" class="btn btn-outline-light btn-lg">View Deals</a>
                </div>
                <div class="col-md-6">
                    <img src="https://via.placeholder.com/600x400" alt="Shopping" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="category-section">
        <div class="container">
            <h2 class="text-center mb-5">Shop by Category</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card feature-card text-center">
                        <div class="card-body">
                            <i class="fas fa-mobile-alt fa-3x mb-3 text-success"></i>
                            <h3 class="card-title">Electronics</h3>
                            <p class="card-text">Latest gadgets and devices</p>
                            <a href="{{ route('products.index', ['category' => 'electronics']) }}" class="btn btn-outline-success">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card feature-card text-center">
                        <div class="card-body">
                            <i class="fas fa-tshirt fa-3x mb-3 text-success"></i>
                            <h3 class="card-title">Fashion</h3>
                            <p class="card-text">Trendy clothing & accessories</p>
                            <a href="{{ route('products.index', ['category' => 'fashion']) }}" class="btn btn-outline-success">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card feature-card text-center">
                        <div class="card-body">
                            <i class="fas fa-home fa-3x mb-3 text-success"></i>
                            <h3 class="card-title">Home & Living</h3>
                            <p class="card-text">Furniture & decor</p>
                            <a href="{{ route('products.index', ['category' => 'home']) }}" class="btn btn-outline-success">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card feature-card text-center">
                        <div class="card-body">
                            <i class="fas fa-utensils fa-3x mb-3 text-success"></i>
                            <h3 class="card-title">Groceries</h3>
                            <p class="card-text">Fresh food & essentials</p>
                            <a href="{{ route('products.index', ['category' => 'groceries']) }}" class="btn btn-outline-success">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Featured Products</h2>
            <div class="row">
                @foreach($products ?? [] as $product)
                <div class="col-md-3">
                    <div class="card product-card">
                        <img src="{{ $product->image ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-success">${{ number_format($product->price, 2) }}</p>
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>ShopEase</h5>
                    <p>Your one-stop destination for all your shopping needs.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">About Us</a></li>
                        <li><a href="#" class="text-white">Contact</a></li>
                        <li><a href="#" class="text-white">Privacy Policy</a></li>
                        <li><a href="#" class="text-white">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Connect With Us</h5>
                    <div class="social-links">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; 2024 ShopEase. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update cart count when items are added/removed
        function updateCartCount() {
            const cartCount = document.querySelector('.cart-count');
            const cart = {!! json_encode(session('cart', [])) !!};
            cartCount.textContent = Object.keys(cart).length;
        }
    </script>
</body>
</html> 