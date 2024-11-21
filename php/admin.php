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
        .admin-header {
            background-color: #343a40;
            /* Dark theme color */
            color: white;
            padding: 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .admin-buttons .btn {
            background-color: #6c757d;
            /* Secondary theme color */
            color: white;
            border: none;
            padding: 1rem 2rem;
            font-size: 1.2rem;
            margin: 0.5rem;
            transition: all 0.3s ease-in-out;
        }

        .admin-buttons .btn:hover {
            background-color: #495057;
            /* Darker secondary theme */
            transform: scale(1.05);
        }
    </style>
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

    <!-- Admin Header -->
    <div class="admin-header">
        <h1>Welcome to the Admin Panel</h1>
        <p>Manage the inventory, view purchase history, and return to the main menu.</p>
    </div>

    <!-- Buttons Section -->
    <div class="container text-center admin-buttons">
        <a href="inventory.php" class="btn btn-lg">Productos en Inventario</a>
        <a href="purchase_history.php" class="btn btn-lg">Historial de Compras</a>
        <a href="../index.php" class="btn btn-lg">Regresar al Menú</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>