<?php
session_start();

// Conexión a la base de datos
$conn = mysqli_connect("localhost", "root", "", "tienda");

// Validar la conexión a la BdD
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Verificar si el usuario tiene una sesión abierta
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Cuando se agrega un producto al carrito
//Se verifica que los datos del producto sean enviados correctamente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    // Obtener el ID y la cantidad del producto desde el formulario
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    $user_id = $_SESSION['user_id'];

    // Verificar que la cantidad sea válida
    if ($quantity <= 0) {
        $error_message = "Invalid quantity. Please add at least one product.";
    } else {
        // Verificar si el producto ya está en el carrito
        $stmt = $conn->prepare("SELECT cantidad FROM carrito WHERE id_usuario = ? AND id_producto = ?");
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Producto ya existe, actualizar cantidad
            $cart_item = $result->fetch_assoc();
            $new_quantity = $cart_item['cantidad'] + $quantity;

            // Verificar stock disponible
            $stmt = $conn->prepare("SELECT cantidad_almacen FROM productos WHERE id = ?");
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $product_result = $stmt->get_result();
            $product = $product_result->fetch_assoc();
            $stmt->close();

            if ($new_quantity > $product['cantidad_almacen']) {
                $error_message = "Only {$product['cantidad_almacen']} units are available for this product.";
            } else {
                $stmt = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE id_usuario = ? AND id_producto = ?");
                $stmt->bind_param("iii", $new_quantity, $user_id, $product_id);
                $stmt->execute();
                $stmt->close();

                $success_message = "The product quantity has been updated in your cart.";
            }
        } else {
            // Producto no existe en el carrito, agregarlo
            $stmt = $conn->prepare("INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $user_id, $product_id, $quantity);
            $stmt->execute();
            $stmt->close();

            $success_message = "The product has been added to your cart.";
        }
    }
}


// Obtener los datos del producto seleccionado
if (isset($_GET['id'])) {
    $alt_nombre = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM productos WHERE alt_nombre = ?");
    $stmt->bind_param("s", $alt_nombre);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    if (!$product) {
        die("Product not found.");
    }
} else {
    die("Invalid product ID.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALMANTA - Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../img/ALMANTA_logo.png" type="image/png">
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

    <!-- Product Section -->
    <div class="container py-5">
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>YAY!</strong> <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Oops!</strong> <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo "../" . htmlspecialchars($product['fotos']); ?>"
                    alt="<?php echo htmlspecialchars($product['nombre']); ?>" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h3 class="text-secondary">$<?php echo number_format($product['precio'], 2); ?> MXN</h3>
                <h1 class="mb-3"><?php echo htmlspecialchars($product['nombre']); ?></h1>
                <p class="text-secondary mb-3">
                    <?php echo $product['cantidad_almacen'] > 0 ? '--- ' . $product['cantidad_almacen'] . ' in stock ---' : '--- Out of stock ---'; ?>
                </p>
                <p class="description"><?php echo htmlspecialchars($product['descripcion']); ?></p>
                <p class="origen">Origin: <?php echo htmlspecialchars($product['origen']); ?></p>
                <p class="fabricante">Manufacturer: <?php echo htmlspecialchars($product['fabricante']); ?></p>
                <form method="POST" action="">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <div class="d-flex align-items-center mb-3">
                        <label for="quantity" class="me-3">Qty</label>
                        <input type="number" id="quantity" name="quantity" class="form-control w-auto" value="1"
                            min="1">
                    </div>
                    <button type="submit" name="add_to_cart" class="btn btn-custom btn-lg w-100" <?php echo $product['cantidad_almacen'] <= 0 ? 'disabled' : ''; ?>>
                        Add to cart
                    </button>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>