<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirige al login si no hay sesión activa
    exit();
}
?>
<?php
session_start();
include('conection.php'); // Incluye el archivo de conexión a la base de datos

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirige al login si no hay sesión activa
    exit();
}

// Obtener el ID del usuario de la sesión
$user_id = $_SESSION['user_id'];

// Consulta para obtener la información del usuario desde la base de datos
$query = "SELECT * FROM usuarios WHERE id = '$user_id'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    // En caso de que el usuario no exista en la base de datos
    echo "Usuario no encontrado.";
    exit();
}

// Variables de paginación
$limit = 10; // Número de registros por página
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Página actual
$offset = ($page - 1) * $limit;


// Query para contar total de registros (considerando el filtro)
$total_query = "SELECT COUNT(*) AS total FROM historial";
if ($user_filter) {
    $total_query .= " WHERE id_usuario = $user_id";
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
if ($user_id) {
    $sql .= " WHERE historial.id_usuario = $user_id";
}

$sql .= " ORDER BY historial.id_compra ASC LIMIT $limit OFFSET $offset";
$result = mysqli_query($con, $sql);

mysqli_close($con);
?>

<!DOCTYPE php>
<php lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ALMANTA - Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" href="../img/ALMANTA_logo.png" type="image/png">
        <style>
            .table-container {
                margin-top: 3rem;
                padding: 1rem;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                max-width: 90%;
                /* Limitar el ancho máximo */
                margin-left: auto;
                margin-right: auto;
            }

            .table thead {
                background-color: #495057;
                color: white;
            }

            .table tbody tr:hover {
                background-color: #f1f1f1;
            }

            .table th,
            .table td {
                text-align: center;
                vertical-align: middle;
                padding: 0.75rem;
                /* Espaciado interno */
            }

            .pagination {
                justify-content: center;
            }

            .pagination .page-link {
                color: #495057;
            }

            .pagination .page-item.active .page-link {
                background-color: #6c757d;
                border-color: #6c757d;
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

        <!-- Profile Information -->
        <div class="container py-5">
            <h2 class="display-4 text-center mb-4">USER PROFILE</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($user['nombre']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['correo']); ?></p>
                            <p><strong>Birthdate:</strong>
                                <?php echo htmlspecialchars($user['fecha_nacimiento']); ?></p>
                            <p><strong>Bank card number:</strong>
                                <?php echo htmlspecialchars($user['num_tarjeta_bancaria']); ?></p>
                            <p><strong>Postal address:</strong>
                                <?php echo htmlspecialchars($user['direccion_postal']); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <h2 class="display-4 text-center mb-4">USER PURCHASES</h2>
        <div class="container table-container">
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
        </div>

        <!-- Paginación -->
        <nav>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                        <a class="page-link"
                            href="?page=<?php echo $i; ?>&user_id=<?php echo htmlspecialchars($user_id); ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
        </div>

        <!-- Footer -->
        <footer class="footer py-4 text-center">
            <p>&copy; 2024 ALMANTA. All rights reserved. | <a href="" style="color: white;">Privacy
                    Policy</a></p>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</php>