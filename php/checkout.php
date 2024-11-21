<?php
session_start();

// Verificar si el usuario está logueado
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

// Obtener información del usuario
$user_id = $_SESSION['user_id'];
$user_query = $conn->prepare("SELECT nombre, correo, direccion_postal, num_tarjeta_bancaria FROM usuarios WHERE id = ?");
$user_query->bind_param("i", $user_id);
$user_query->execute();
$user_info = $user_query->get_result()->fetch_assoc();
$user_query->close();

// Obtener productos del carrito
$cart_query = $conn->prepare("SELECT id_producto, cantidad FROM carrito WHERE id_usuario = ?");
$cart_query->bind_param("i", $user_id);
$cart_query->execute();
$cart_items = $cart_query->get_result();
$cart_query->close();

// Calcular el total del carrito
$total_price = 0;
$cart_products = [];
foreach ($cart_items as $item) {
    $product_query = $conn->prepare("SELECT precio, cantidad_almacen FROM productos WHERE id = ?");
    $product_query->bind_param("i", $item['id_producto']);
    $product_query->execute();
    $product_data = $product_query->get_result()->fetch_assoc();
    $total_price += $product_data['precio'] * $item['cantidad'];
    $cart_products[] = [
        'id_producto' => $item['id_producto'],
        'cantidad' => $item['cantidad'],
        'cantidad_almacen' => $product_data['cantidad_almacen']
    ];
    $product_query->close();
}

// Procesar el pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    // Iniciar una transacción
    $conn->begin_transaction();

    try {
        // Insertar productos en historial y actualizar el stock
        foreach ($cart_products as $product) {
            // Insertar en historial con la cantidad
            $insert_historial = $conn->prepare("INSERT INTO historial (id_usuario, id_producto, cantidad) VALUES (?, ?, ?)");
            $insert_historial->bind_param("iii", $user_id, $product['id_producto'], $product['cantidad']);
            $insert_historial->execute();
            $insert_historial->close();

            // Restar la cantidad comprada del stock
            $new_stock = $product['cantidad_almacen'] - $product['cantidad'];
            if ($new_stock < 0) {
                throw new Exception("Insufficient stock for product ID: " . $product['id_producto']);
            }
            $update_stock = $conn->prepare("UPDATE productos SET cantidad_almacen = ? WHERE id = ?");
            $update_stock->bind_param("ii", $new_stock, $product['id_producto']);
            $update_stock->execute();
            $update_stock->close();
        }

        // Vaciar el carrito
        $clear_cart = $conn->prepare("DELETE FROM carrito WHERE id_usuario = ?");
        $clear_cart->bind_param("i", $user_id);
        $clear_cart->execute();
        $clear_cart->close();

        // Confirmar la transacción
        $conn->commit();

        // Redirigir a una página de confirmación
        header("Location: confirmation.php");
        exit();
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conn->rollback();
        $error_message = "An error occurred while processing your order. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALMANTA - Checkout</title>
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

    <!-- Checkout Section -->
    <div class="container py-5">
        <h3 class="text-center">Checkout</h3>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <form class="mt-4" method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name"
                    value="<?php echo htmlspecialchars($user_info['nombre']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email"
                    value="<?php echo htmlspecialchars($user_info['correo']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Shipping Address</label>
                <input type="text" class="form-control" id="address"
                    value="<?php echo htmlspecialchars($user_info['direccion_postal']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="billing" class="form-label">Billing Information</label>
                <input type="text" class="form-control" id="billing"
                    value="<?php echo htmlspecialchars($user_info['num_tarjeta_bancaria']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="text" class="form-control" id="total"
                    value="$<?php echo number_format($total_price + 65); ?> MXN" readonly>
            </div>
            <p>By placing your order, you confirm that your personal and shipping information is correct.</p>
            <button type="submit" name="place_order" class="btn btn-secondary w-100">Place Order</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>