<?php
// Conexión a la base de datos
$con = mysqli_connect("localhost", "root", "", "tienda");

// Validar la conexión
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Obtener datos del formulario
$name = $_POST["name"];
$email = $_POST["email"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash de la contraseña
$birthdate = $_POST["birthdate"];
$card_number = $_POST["card_number"];
$postal_address = $_POST["postal_address"];

// Inserción de datos
$action = "INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contraseña`, `fecha_nacimiento`, `num_tarjeta_bancaria`, `direccion_postal`) 
           VALUES (NULL, '$name', '$email', '$password', '$birthdate', '$card_number', '$postal_address')";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>User created</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a href="index.html" class="navbar-brand">
                <img src="img/ALMANTA_logo2.png" alt="Almanta Logo" class="logo" width="150">
            </a>
            <a class="navbar-brand" href="index.html">Menu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="catalog.html">Catalog</a></li>
                    <li class="nav-item"><a class="nav-link" href="cart.html">Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-person"></i> User
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="register.html">Register</a></li>
                            <li><a class="dropdown-item" href="login.html">Login</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container pt-5 text-center">
        <?php
        // Ejecución de la consulta e impresión de mensaje
        if (mysqli_query($con, $action)) {
            echo '<h1 class="display-4 text-success">¡Thank you ' . htmlspecialchars($name) . '!</h1>';
        } else {
            echo '<h1 class="display-5 text-danger">Error en el registro</h1>';
            echo "<p>Error: " . mysqli_error($con) . "</p>";
        }

        // Cerrar la conexión
        mysqli_close($con);
        ?>

        <a href="index.html" class="btn btn-custom mt-4 text-white">Back to menu</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>