<?php
session_start();

// Verificar si el usuario tiene una sesión válida
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 1) {
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

// Verificar si se pasó el ID del producto por la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Eliminar el producto de la base de datos
    $stmt = $conn->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        $success_message = "Product successfully deleted.";
    } else {
        $error_message = "Failed to delete the product. Please try again.";
    }

    $stmt->close();
} else {
    $error_message = "Invalid product ID.";
}

// Redirigir de regreso a inventory.php con un mensaje
header("Location: inventory.php?success=" . urlencode($success_message) . "&error=" . urlencode($error_message));
exit();
?>