<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALMANTA - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="/img/ALMANTA_logo.png" type="image/png">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a href="index.php" class="navbar-brand">
                <img src="img/ALMANTA_logo2.png" alt="Almanta Logo" class="logo" width="300">
            </a>
            <a class="navbar-brand" href="index.php">Menu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="php/catalog.php">Catalog</a></li>
                    <li class="nav-item"><a class="nav-link" href="php/cart.php">Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="php/contact.php">Contact</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User'; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <li><a class="dropdown-item" href="php/profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="php/logout.php">Log out</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="php/register.php">Register</a></li>
                                <li><a class="dropdown-item" href="php/login.php">Log in</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Hero Section with Cover Image -->
    <header class="hero-section text-center d-flex align-items-center justify-content-center">
        <div class="container text-white">
            <h1 class="display-4">Bring Nature Home</h1>
            <p class="lead">Discover our curated collection of various types of plants and some botanical treasures to
                brighten up your
                space.</p>
            <a href="php/catalog.php" class="btn btn-custom btn-lg mt-3">Shop Now</a>
        </div>
    </header>

    <!-- Categories Section -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Shop by Category</h2>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img_main/desierto.jpg" class="card-img-top" alt="Desert">
                    <div class="card-body">
                        <h5 class="card-title">DESERT PLANTS</h5>
                        <a href="php/catalog.php#desert-plants" class="btn btn-custom">View Collection</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img_main/agua.jpg" class="card-img-top" alt="Ferns">
                    <div class="card-body">
                        <h5 class="card-title">WATER PLANTS</h5>
                        <a href="php/catalog.php#water-plants" class="btn btn-custom">View Collection</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img_main/aromaticas.jpg" class="card-img-top" alt="Flowering Plants">
                    <div class="card-body">
                        <h5 class="card-title">AROMATIC PLANTS</h5>
                        <a href="php/catalog.php#aromatic-plants" class="btn btn-custom">View Collection</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img_main/casa.jpg" class="card-img-top" alt="Cacti">
                    <div class="card-body">
                        <h5 class="card-title">HOUSE PLANTS</h5>
                        <a href="php/catalog.php#house-plants" class="btn btn-custom">View Collection</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img_main/sombra.jpg" class="card-img-top" alt="Indoor Plants">
                    <div class="card-body">
                        <h5 class="card-title">INDOOR PLANTS</h5>
                        <a href="php/catalog.php#indoor-plants" class="btn btn-custom">View Collection</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/img_main/medicinales.jpg" class="card-img-top" alt="Bonsai">
                    <div class="card-body">
                        <h5 class="card-title">MEDICINAL PLANTS</h5>
                        <a href="php/catalog.php#medicinal-plants" class="btn btn-custom">View Collection</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">What Our Customers Say</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card p-3 shadow">
                        <p>"Absolutely love my plants! They arrived in perfect condition and bring so much life to my
                            living room!"</p>
                        <p class="text-end"><strong>- Jamie R.</strong></p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card p-3 shadow">
                        <p>"I’m new to plant care, but their customer support helped me choose the perfect beginner
                            plants."</p>
                        <p class="text-end"><strong>- Alex W.</strong></p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card p-3 shadow">
                        <p>"High-quality plants, quick delivery, and excellent service. I highly recommend Plant Shop!"
                        </p>
                        <p class="text-end"><strong>- Taylor S.</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="text-center py-5" style="background-color: var(--theme-color); color: white;">
        <div class="container">
            <h3>Ready to Green Up Your Space?</h3>
            <p>Join our community of plant lovers and bring home your first plant today!</p>
            <a href="catalog.php" class="btn btn-custom btn-lg">Explore Our Collection</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-4 text-center">
        <p>&copy; 2024 ALMANTA. All rights reserved. | <a href="" style="color: white;">Privacy
                Policy</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>