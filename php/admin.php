<?php
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 1) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALMANTA - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../img/ALMANTA_logo.png" type="image/png">
    <style>
        body {
            background-color: #f8f9fa;
        }

        /* Hero Section with Cover Image */
        .admin-hero {
            background-image: url('../img/plantas_cover.jpg');
            /* Replace with your admin background image */
            background-size: cover;
            background-position: center;
            color: white;
            height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
        }

        .admin-hero h1 {
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
        }

        .admin-hero p {
            font-size: 1.3rem;
            margin-top: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        }

        .admin-buttons {
            margin-top: 2rem;
        }

        .admin-buttons .btn {
            background-color: #6c757d;
            color: white;
            padding: 1rem 3rem;
            font-size: 1.2rem;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            text-transform: uppercase;
        }

        .btn-custom-admin {
            background-color: #5b7045;
            color: #eae6d7;
            border-radius: 10px;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
            text-transform: capitalize;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            /* Slight shadow for depth */
        }

        .btn-custom-admin:hover {
            background-color: #465c37;
            color: #ffffff;
            transform: scale(1.01);
        }

        .admin-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .admin-card h2 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .admin-footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
        }

        .admin-footer p {
            margin: 0;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a href="../index.php" class="navbar-brand">
                <img src="../img/ALMANTA_logo2.png" alt="Almanta Logo" class="logo" width="300">
            </a>
            <a class="navbar-brand" href="../index.php">Menu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="catalog.php">Catalog</a></li>
                    <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User'; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <?php
                            if (isset($_SESSION['user_id'])) {
                                if ($_SESSION['user_id'] == 1) { ?>
                                    <li><a class="dropdown-item" href="admin.php">Admin page</a></li>
                                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                                <?php } else { ?>
                                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                                <?php }
                            } else { ?>
                                <li><a class="dropdown-item" href="register.php">Register</a></li>
                                <li><a class="dropdown-item" href="login.php">Log in</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Admin Hero Section -->
    <header class="admin-hero">
        <div class="container text-center">
            <h1>Admin Panel</h1>
            <p>Manage everything with ease. Explore the options below.</p>
        </div>
    </header>

    <!-- Admin Buttons -->
    <div class="container admin-section text-center">
        <div class="row">
            <div class="col-md-4">
                <div class="admin-card text-center">
                    <h2>Inventory</h2>
                    <a href="inventory.php" class="btn btn-custom-admin">Manage Inventory</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="admin-card text-center">
                    <h2>Purchase History</h2>
                    <a href="history.php" class="btn btn-custom-admin">View History</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="admin-card text-center">
                    <h2>Main Menu</h2>
                    <a href="../index.php" class="btn btn-custom-admin">Go Back</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="admin-footer">
        <br>
        <p>&copy; 2024 ALMANTA. All rights reserved.</p>
        <br>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>