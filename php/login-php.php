<?php
session_start();
include('conection.php'); // Incluye tu archivo de conexión a la base de datos

// Obtener los datos del formulario de inicio de sesión
$email = $_POST['correo'];
$password = $_POST['contraseña'];

// Consulta para verificar el usuario
$query = "SELECT * FROM usuarios WHERE correo = '$email'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    // Verificar la contraseña
    if (password_verify($password, $user['contraseña'])) {
        // Guardar los datos del usuario en la sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre'];
        header('Location: ../index.php'); // Redirige al usuario al dashboard u otra página
        exit();
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}
?>