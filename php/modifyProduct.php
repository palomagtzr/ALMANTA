<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "tienda");

// Check the connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Get product ID from the URL
if (!isset($_GET['id'])) {
    header("Location: inventory.php");
    exit();
}

$product_id = $_GET['id'];

// Fetch product data
$product_query = $con->prepare("SELECT * FROM productos WHERE id = ?");
$product_query->bind_param("i", $product_id);
$product_query->execute();
$product_data = $product_query->get_result()->fetch_assoc();
$product_query->close();

if (!$product_data) {
    echo "Product not found!";
    exit();
}

// Update product data on form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $alt_nombre = $_POST['alt_nombre'];
    $descripcion = $_POST['descripcion'];
    $fotos = $_POST['fotos'];
    $precio = $_POST['precio'];
    $cantidad_almacen = $_POST['cantidad_almacen'];
    $fabricante = $_POST['fabricante'];
    $origen = $_POST['origen'];
    $seccion = $_POST['seccion'];

    $update_query = $con->prepare("UPDATE productos SET nombre = ?, alt_nombre = ?, descripcion = ?, fotos = ?, precio = ?, cantidad_almacen = ?, fabricante = ?, origen = ?, seccion = ? WHERE id = ?");
    $update_query->bind_param("ssssdisssi", $nombre, $alt_nombre, $descripcion, $fotos, $precio, $cantidad_almacen, $fabricante, $origen, $seccion, $product_id);

    if ($update_query->execute()) {
        header("Location: inventory.php");
        exit();
    } else {
        echo "Error updating product: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Modify Product</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nombre" class="form-label">Name</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="<?php echo htmlspecialchars($product_data['nombre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="alt_nombre" class="form-label">Alternative Name</label>
                <input type="text" class="form-control" id="alt_nombre" name="alt_nombre"
                    value="<?php echo htmlspecialchars($product_data['alt_nombre']); ?>">
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Description</label>
                <textarea class="form-control" id="descripcion" name="descripcion"
                    required><?php echo htmlspecialchars($product_data['descripcion']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="fotos" class="form-label">Image URL</label>
                <input type="text" class="form-control" id="fotos" name="fotos"
                    value="<?php echo htmlspecialchars($product_data['fotos']); ?>">
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio"
                    value="<?php echo htmlspecialchars($product_data['precio']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="cantidad_almacen" class="form-label">Stock</label>
                <input type="number" class="form-control" id="cantidad_almacen" name="cantidad_almacen"
                    value="<?php echo htmlspecialchars($product_data['cantidad_almacen']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="fabricante" class="form-label">Manufacturer</label>
                <input type="text" class="form-control" id="fabricante" name="fabricante"
                    value="<?php echo htmlspecialchars($product_data['fabricante']); ?>">
            </div>
            <div class="mb-3">
                <label for="origen" class="form-label">Origin</label>
                <input type="text" class="form-control" id="origen" name="origen"
                    value="<?php echo htmlspecialchars($product_data['origen']); ?>">
            </div>
            <div class="mb-3">
                <label for="seccion" class="form-label">Section</label>
                <select class="form-select" id="seccion" name="seccion" required>
                    <option value="Desierto" <?php echo $product_data['seccion'] === 'Desierto' ? 'selected' : ''; ?>>
                        Desierto</option>
                    <option value="Agua" <?php echo $product_data['seccion'] === 'Agua' ? 'selected' : ''; ?>>Agua
                    </option>
                    <option value="Sombra" <?php echo $product_data['seccion'] === 'Sombra' ? 'selected' : ''; ?>>Sombra
                    </option>
                    <option value="Aromaticas" <?php echo $product_data['seccion'] === 'Aromaticas' ? 'selected' : ''; ?>>
                        Aromaticas</option>
                    <option value="Casa" <?php echo $product_data['seccion'] === 'Casa' ? 'selected' : ''; ?>>Casa
                    </option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modify</button>
            <a href="inventory.php" class="btn btn-secondary">Go Back</a>
        </form>
    </div>
</body>

</html>