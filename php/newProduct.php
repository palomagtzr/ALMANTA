<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $con = mysqli_connect("localhost", "root", "", "tienda");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $nombre = $_POST['nombre'];
    $alt_nombre = $_POST['alt_nombre'];
    $descripcion = $_POST['descripcion'];
    $fotos = $_POST['fotos'];
    $precio = $_POST['precio'];
    $cantidad_almacen = $_POST['cantidad_almacen'];
    $fabricante = $_POST['fabricante'];
    $origen = $_POST['origen'];
    $seccion = $_POST['seccion'];

    $query = "INSERT INTO productos (nombre, alt_nombre, descripcion, fotos, precio, cantidad_almacen, fabricante, origen, seccion)
              VALUES ('$nombre', '$alt_nombre', '$descripcion', '$fotos', '$precio', '$cantidad_almacen', '$fabricante', '$origen', '$seccion')";

    if (mysqli_query($con, $query)) {
        header("Location: inventory.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Add New Product</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nombre" class="form-label">Name</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="alt_nombre" class="form-label">Alternative Name</label>
                <input type="text" class="form-control" id="alt_nombre" name="alt_nombre">
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Description</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>
            <div class="mb-3">
                <label for="fotos" class="form-label">Image URL</label>
                <input type="text" class="form-control" id="fotos" name="fotos">
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
            </div>
            <div class="mb-3">
                <label for="cantidad_almacen" class="form-label">Stock</label>
                <input type="number" class="form-control" id="cantidad_almacen" name="cantidad_almacen" required>
            </div>
            <div class="mb-3">
                <label for="fabricante" class="form-label">Manufacturer</label>
                <input type="text" class="form-control" id="fabricante" name="fabricante">
            </div>
            <div class="mb-3">
                <label for="origen" class="form-label">Origin</label>
                <input type="text" class="form-control" id="origen" name="origen">
            </div>
            <div class="mb-3">
                <label for="seccion" class="form-label">Section</label>
                <select class="form-select" id="seccion" name="seccion" required>
                    <option value="Desierto">Desierto</option>
                    <option value="Agua">Agua</option>
                    <option value="Sombra">Sombra</option>
                    <option value="Aromaticas">Aromaticas</option>
                    <option value="Casa">Casa</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</body>

</html>