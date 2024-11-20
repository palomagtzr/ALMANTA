<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirige al login si no hay sesión activa
    exit();
}
?>
<?php
session_start();
include('conection.php'); // Incluye el archivo de conexión a la base de datos

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirige al login si no hay sesión activa
    exit();
}

// Obtener el ID del usuario de la sesión
$user_id = $_SESSION['user_id'];

// Consulta para obtener la información del usuario desde la base de datos
$query = "SELECT * FROM usuarios WHERE id = '$user_id'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    // En caso de que el usuario no exista en la base de datos
    echo "Usuario no encontrado.";
    exit();
}

mysqli_close($con);
?>

<!DOCTYPE php>
<php lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Perfil de Usuario - ALMANTA</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
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
                        <li class="nav-item"><a class="nav-link" href="catalog.php">Catalog</a></li>
                        <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User'; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item" href="register.php">Register</a></li>
                                    <li><a class="dropdown-item" href="login.php">Log in</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Profile Information -->
        <div class="container py-5">
            <h2 class="display-4 text-center mb-4">USER PROFILE</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($user['nombre']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['correo']); ?></p>
                            <p><strong>Birthdate:</strong>
                                <?php echo htmlspecialchars($user['fecha_nacimiento']); ?></p>
                            <p><strong>Bank card number:</strong>
                                <?php echo htmlspecialchars($user['num_tarjeta_bancaria']); ?></p>
                            <p><strong>Postal address:</strong>
                                <?php echo htmlspecialchars($user['direccion_postal']); ?>
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