<?php
session_start();

// Verificar si el usuario tiene una sesión abierta
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Conexión a la base de datos
$conn = mysqli_connect("localhost", "root", "", "tienda");

// Validar la conexión
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Actualizar la cantidad de productos en el carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    $product_id = intval($_POST['product_id']);
    $new_quantity = intval($_POST['quantity']);
    $user_id = $_SESSION['user_id'];

    // Validar que la cantidad sea mayor a 0
    if ($new_quantity > 0) {
        // Verificar el stock disponible
        $stmt = $conn->prepare("SELECT cantidad_almacen FROM productos WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $stmt->close();

        if ($new_quantity > $product['cantidad_almacen']) {
            $error_message = "Only {$product['cantidad_almacen']} units are available for this product.";
        } else {
            // Actualizar la cantidad en la tabla carrito
            $stmt = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE id_usuario = ? AND id_producto = ?");
            $stmt->bind_param("iii", $new_quantity, $user_id, $product_id);
            $stmt->execute();
            $stmt->close();
            $success_message = "The quantity has been updated successfully.";
        }
    } else {
        // Si la cantidad es 0, elimina el producto del carrito
        $stmt = $conn->prepare("DELETE FROM carrito WHERE id_usuario = ? AND id_producto = ?");
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $stmt->close();
        $success_message = "The product has been removed from your cart.";
    }
}

// Eliminar un producto del carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])) {
    $product_id = intval($_POST['product_id']);
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("DELETE FROM carrito WHERE id_usuario = ? AND id_producto = ?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $stmt->close();

    $success_message = "The product has been removed from your cart.";
}

// Cargar productos del carrito desde la base de datos
$user_id = $_SESSION['user_id'];
$sql = "SELECT productos.nombre, productos.precio, productos.fotos, carrito.id_producto, carrito.cantidad 
        FROM carrito 
        JOIN productos ON carrito.id_producto = productos.id 
        WHERE carrito.id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];
$totalPrice = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
        $totalPrice += $row['precio'] * $row['cantidad'];
    }
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALMANTA - Cart</title>
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
                        <a class="nav-link dropdown-toggle d-flex align-items-center" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
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

    <!-- Cart Section -->
    <div class="container py-5">
        <h2 class="mb-4">My Shopping Bag</h2>
        <!-- isset() verifica si una variable ya ha sido declarada y no es nula.  -->
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Success!</strong> <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Error!</strong> <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-8">
                <?php if (count($cart_items) > 0): ?>
                    <?php foreach ($cart_items as $item): ?>
                        <form method="POST" action="">
                            <div class="row border-bottom py-3">
                                <div class="col-3">
                                    <img src="<?php echo "../" . htmlspecialchars($item['fotos']); ?>"
                                        alt="<?php echo htmlspecialchars($item['nombre']); ?>" class="img-fluid">
                                </div>
                                <div class="col-6">
                                    <h5><?php echo htmlspecialchars($item['nombre']); ?></h5>
                                    <p>Price: $<?php echo number_format($item['precio'], 2); ?></p>
                                    <div class="d-flex align-items-center mb-3">
                                        <label for="quantity-<?php echo $item['id_producto']; ?>" class="me-3">Qty</label>
                                        <input type="number" id="quantity-<?php echo $item['id_producto']; ?>" name="quantity"
                                            class="form-control w-auto" value="<?php echo $item['cantidad']; ?>" min="1">
                                    </div>
                                    <input type="hidden" name="product_id" value="<?php echo $item['id_producto']; ?>">
                                    <button type="submit" name="update_cart" class="btn btn-primary btn-sm">Update</button>
                                    <button type="submit" name="delete_product" class="btn btn-danger btn-sm">Remove</button>
                                </div>
                                <div class="col-3 text-end">
                                    <p>$<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></p>
                                </div>
                            </div>
                        </form>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Your cart is empty.</p>
                <?php endif; ?>
            </div>

            <div class="col-md-4">
                <div class="card p-4">
                    <h5 class="mb-3">Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>$<?php echo number_format($totalPrice, 2); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping (4-7 business days)</span>
                        <span>$65 MXN</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Estimated Total</strong>
                        <strong>$<?php echo number_format($totalPrice + 65, 2); ?></strong>
                    </div>
                    <?php if (count($cart_items) > 0): ?>
                        <a href="checkout.php" class="btn btn-custom btn-lg w-100">Checkout</a>
                    <?php else: ?>
                        <div class="btn btn-secondary btn-lg w-100 disabled">Checkout</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>