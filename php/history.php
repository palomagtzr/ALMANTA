<?php
session_start();

// Conexión a la base de datos
$con = mysqli_connect("localhost", "root", "", "tienda");

// Validar la conexión
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Variables de paginación
$limit = 10; // Número de registros por página
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Página actual
$offset = ($page - 1) * $limit;

// Filtro por usuario
$user_filter = isset($_GET['user_id']) ? $_GET['user_id'] : null;

// Query para contar total de registros (considerando el filtro)
$total_query = "SELECT COUNT(*) AS total FROM historial";
if ($user_filter) {
    $total_query .= " WHERE id_usuario = $user_filter";
}
$total_result = mysqli_query($con, $total_query);
$total_rows = mysqli_fetch_assoc($total_result)['total'];
$total_pages = ceil($total_rows / $limit);

// Query para obtener los registros paginados
$sql = "SELECT 
    historial.id_compra AS Purchase_ID,
    historial.id_usuario AS User_ID,
    usuarios.nombre AS User_Name,
    productos.nombre AS Product_Name,
    historial.cantidad AS Quantity
FROM 
    historial
JOIN 
    usuarios ON historial.id_usuario = usuarios.id
JOIN 
    productos ON historial.id_producto = productos.id";

// Agregar filtro por usuario si está definido
if ($user_filter) {
    $sql .= " WHERE historial.id_usuario = $user_filter";
}

$sql .= " ORDER BY historial.id_compra ASC LIMIT $limit OFFSET $offset";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALMANTA - Purchase History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../img/ALMANTA_logo.png" type="image/png">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .table-container {
            margin-top: 3rem;
        }

        .filter-form {
            margin-bottom: 2rem;
        }

        .pagination {
            justify-content: center;
        }

        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: #495057;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .pagination .page-link {
            color: #495057;
        }

        .pagination .page-item.active .page-link {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .back-button {
            margin-bottom: 2rem;
            text-align: center;
        }

        .back-button .btn {
            background-color: #5B7045;
            color: white;
            text-transform: uppercase;
            border-radius: 5px;
        }

        .back-button .btn:hover {
            background-color: #465C37;
            color: white;
        }
    </style>
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

    <!-- Header -->
    <header class="text-center my-5">
        <h1>Purchase History</h1>
        <p class="lead">Review all user purchases or filter by user ID</p>
    </header>

    <!-- Botón para regresar al panel de administrador -->
    <div class="back-button">
        <a href="admin.php" class="btn btn-secondary">Go back to admin panel</a>
    </div>

    <div class="container table-container">
        <!-- Filtro por usuario -->
        <form class="filter-form text-center" method="GET" action="history.php">
            <div class="input-group mb-3 w-50 mx-auto">
                <input type="number" name="user_id" class="form-control" placeholder="Search by User ID"
                    value="<?php echo htmlspecialchars($user_filter); ?>">
                <button class="btn btn-secondary" type="submit">Filter</button>
            </div>
        </form>

        <!-- Tabla -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Purchase ID</th>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Purchase_ID']); ?></td>
                        <td><?php echo htmlspecialchars($row['User_ID']); ?></td>
                        <td><?php echo htmlspecialchars($row['User_Name']); ?></td>
                        <td><?php echo htmlspecialchars($row['Product_Name']); ?></td>
                        <td><?php echo htmlspecialchars($row['Quantity']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Paginación -->
        <nav>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                        <a class="page-link"
                            href="?page=<?php echo $i; ?>&user_id=<?php echo htmlspecialchars($user_filter); ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>