<?php
session_start();
session_unset(); // Borra todas las variables de sesión
session_destroy(); // Destruye la sesión activa
header('Location: index.html'); // Redirige al login
exit();
?>