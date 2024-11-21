<?php
session_start();
// Conexión a la base de datos
$conn = mysqli_connect("localhost", "root", "", "tienda");

// Validar la conexión
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALMANTA - Catalog</title>
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
    <!-- DESERT PLANTS -->
    <div id="desert-plants" class="container py-5">
        <h2 class="mb-4 text-center">DESERT PLANTS</h2>
        <div class="row">
            <?php
            $sql = "SELECT * FROM productos WHERE seccion = 'Desierto'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '  <div class="card m-2">';
                    echo '      <img src="' . "../" . $row['fotos'] . '" class="card-img-top" alt="' . $row['nombre'] . '">';
                    echo '      <div class="card-body text-center">';
                    echo '          <h5 class="card-title">' . $row['nombre'] . '</h5>';
                    echo '          <p class="price">$' . $row['precio'] . '</p>';
                    echo '          <a href="product.php?id=' . $row['alt_nombre'] . '" class="btn btn-custom">View Details</a>';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No products available.</p>';
            }
            ?>
        </div>
    </div>
    </div>
    <!-- WATER PLANTS -->
    <div id="water-plants" class="container py-5">
        <h2 class="mb-4 text-center">WATER PLANTS</h2>
        <div class="row">
            <?php
            $sql = "SELECT * FROM productos WHERE seccion = 'Agua'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '  <div class="card m-2">';
                    echo '      <img src="' . "../" . $row['fotos'] . '" class="card-img-top" alt="' . $row['nombre'] . '">';
                    echo '      <div class="card-body text-center">';
                    echo '          <h5 class="card-title">' . $row['nombre'] . '</h5>';
                    echo '          <p class="price">$' . $row['precio'] . '</p>';
                    echo '          <a href="product.php?id=' . $row['alt_nombre'] . '" class="btn btn-custom">View Details</a>';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No products available.</p>';
            }
            ?>
        </div>
    </div>
    </div>
    <!-- AROMATIC PLANTS -->
    <div id="aromatic-plants" class="container py-5">
        <h2 class="mb-4 text-center">AROMATIC PLANTS</h2>
        <div class="row">
            <?php
            $sql = "SELECT * FROM productos WHERE seccion = 'Aromaticas'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '  <div class="card m-2">';
                    echo '      <img src="' . "../" . $row['fotos'] . '" class="card-img-top" alt="' . $row['nombre'] . '">';
                    echo '      <div class="card-body text-center">';
                    echo '          <h5 class="card-title">' . $row['nombre'] . '</h5>';
                    echo '          <p class="price">$' . $row['precio'] . '</p>';
                    echo '          <a href="product.php?id=' . $row['alt_nombre'] . '" class="btn btn-custom">View Details</a>';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No products available.</p>';
            }
            ?>
        </div>
    </div>
    </div>
    <!-- HOUSE PLANTS -->
    <div id="house-plants" class="container py-5">
        <h2 class="mb-4 text-center">HOUSE PLANTS</h2>
        <div class="row">
            <?php
            $sql = "SELECT * FROM productos WHERE seccion = 'Casa'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '  <div class="card m-2">';
                    echo '      <img src="' . "../" . $row['fotos'] . '" class="card-img-top" alt="' . $row['nombre'] . '">';
                    echo '      <div class="card-body text-center">';
                    echo '          <h5 class="card-title">' . $row['nombre'] . '</h5>';
                    echo '          <p class="price">$' . $row['precio'] . '</p>';
                    echo '          <a href="product.php?id=' . $row['alt_nombre'] . '" class="btn btn-custom">View Details</a>';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No products available.</p>';
            }
            ?>
        </div>
    </div>
    </div>
    <!-- INDOOR PLANTS -->
    <div id="indoor-plants" class="container py-5">
        <h2 class="mb-4 text-center">INDOOR PLANTS</h2>
        <div class="row">
            <?php
            $sql = "SELECT * FROM productos WHERE seccion = 'Sombra'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '  <div class="card m-2">';
                    echo '      <img src="' . "../" . $row['fotos'] . '" class="card-img-top" alt="' . $row['nombre'] . '">';
                    echo '      <div class="card-body text-center">';
                    echo '          <h5 class="card-title">' . $row['nombre'] . '</h5>';
                    echo '          <p class="price">$' . $row['precio'] . '</p>';
                    echo '          <a href="product.php?id=' . $row['alt_nombre'] . '" class="btn btn-custom">View Details</a>';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No products available.</p>';
            }
            ?>
        </div>
    </div>
    </div>
    <!-- MEDICINAL PLANTS -->
    <div id="medicinal-plants" class="container py-5">
        <h2 class="mb-4 text-center">MEDICINAL PLANTS</h2>
        <div class="row">
            <?php
            $sql = "SELECT * FROM productos WHERE seccion = 'Medicinales'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '  <div class="card m-2">';
                    echo '      <img src="' . "../" . $row['fotos'] . '" class="card-img-top" alt="' . $row['nombre'] . '">';
                    echo '      <div class="card-body text-center">';
                    echo '          <h5 class="card-title">' . $row['nombre'] . '</h5>';
                    echo '          <p class="price">$' . $row['precio'] . '</p>';
                    echo '          <a href="product.php?id=' . $row['alt_nombre'] . '" class="btn btn-custom">View Details</a>';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No products available.</p>';
            }
            ?>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>