<?php
session_start();

// Conexión a la base de datos
$conn = mysqli_connect("localhost", "root", "", "tienda");

// Validar la conexión
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM productos WHERE alt_nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $product = $result->fetch_assoc();
    } else {
        die("Product not found.");
    }
    $stmt->close();
} else {
    die("Invalid product identifier.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['nombre']); ?> - ALMANTA</title>
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

    <!-- Product Section -->
    <div class="container py-5">
        <div class="row">
            <!-- Imagen del producto -->
            <div class="col-md-6">
                <img src="<?php echo htmlspecialchars($product['fotos']); ?>"
                    alt="<?php echo htmlspecialchars($product['nombre']); ?>" class="img-fluid">
            </div>
            <div class="col-md-6">
                <!-- precio -->
                <h3 class="text-secondary">$<?php echo number_format($product['precio'], 2); ?> MXN</h3>
                <!-- producto -->
                <h1 class="mb-3"><?php echo htmlspecialchars($product['nombre']); ?></h1>
                <!-- stock -->
                <p class="text-secondary mb-3">
                    <?php echo $product['cantidad_almacen'] > 0 ? "--- " . $product['cantidad_almacen'] . " in stock ---" : "Out of stock"; ?>
                </p>
                <!-- descripción -->
                <p class="description"><?php echo htmlspecialchars($product['descripcion']); ?></p>
                <!-- origen -->
                <p class="origen">Origin: <?php echo htmlspecialchars($product['origen']); ?></p>
                <!-- fabricante -->
                <p class="fabricante">Manufacturer: <?php echo htmlspecialchars($product['fabricante']); ?></p>
                <div class="d-flex align-items-center mb-3">
                    <label for="quantity" class="me-3">Qty</label>
                    <input type="number" id="quantity" class="form-control w-auto" value="1" min="1">
                </div>
                <button class="btn btn-custom btn-lg w-100">Add to cart</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>