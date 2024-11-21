<?php
session_start();
?>
<!DOCTYPE php>
<php lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ALMANTA - Contact</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" href="../img/ALMANTA_logo.png" type="image/png">
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
                                <?php
                                if (isset($_SESSION['user_id'])) {
                                    if ($_SESSION['user_id'] == 1) { ?>
                                        <li><a class="dropdown-item" href="php/admin.php">Admin page</a></li>
                                        <li><a class="dropdown-item" href="php/profile.php">Profile</a></li>
                                        <li><a class="dropdown-item" href="php/logout.php">Log out</a></li>
                                    <?php } else { ?>
                                        <li><a class="dropdown-item" href="php/profile.php">Profile</a></li>
                                        <li><a class="dropdown-item" href="php/logout.php">Log out</a></li>
                                    <?php }
                                } else { ?>
                                    <li><a class="dropdown-item" href="php/register.php">Register</a></li>
                                    <li><a class="dropdown-item" href="php/login.php">Log in</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Profile Information -->
        <div class="container py-5">
            <h2 class="display-4 text-center mb-4">CONTACT INFO</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p><strong>Owner name: </strong>Paloma Gutiérrez Ricaud</p>
                            <p><strong>Email: </strong>palomagutric@gmail.com</p>
                            <p><strong>Instagram: </strong>@palomagtzr</p>
                            <p><strong>Phone: </strong>+52 55 48 70 65 43</p>
                            <p><strong>Location: </strong>Mexico City</p>
                            <p><strong>Opening hours: </strong></p>
                            <p>
                            <pre>
    Mon - Thu: 9:00am - 7:30pm
    Fri - Sat: 10:00am - 8:30pm
    Sun: Closed
    Holidays: 10:00am - 3:00pm
                            </pre>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer py-4 text-center">
            <p>&copy; 2024 ALMANTA. All rights reserved. | <a href="" style="color: white;">Privacy
                    Policy</a></p>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</php>