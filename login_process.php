<?php
session_start(); // Iniciar la sesión
require 'database.php'; // Incluir la conexión a la base de datos

$message = ''; // Variable para almacenar mensajes

if (!empty($_POST['username']) && !empty($_POST['password'])) { // Verificar si los campos no están vacíos
    if (isset($conn)) { // Verificar si la conexión existe
        $records = $conn->prepare('SELECT id, nombre_usuario, contrasena FROM usuarios WHERE nombre_usuario = :username'); // Preparar la consulta
        $records->bindParam(':username', $_POST['username']); // Asignar valores a los parámetros
        $records->execute(); // Ejecutar la consulta
        $results = $records->fetch(PDO::FETCH_ASSOC); // Obtener los resultados

        if ($results && password_verify($_POST['password'], $results['contrasena'])) { // Verificar si el usuario existe y la contraseña es correcta
            $_SESSION['user_id'] = $results['id']; // Almacenar el id del usuario en la sesión
            header("Location: home.php"); // Redirigir a home.php
            exit; // Asegurarse de detener el script después de la redirección
        } else {
            $message = 'Lo siento, las credenciales no coinciden';
        }
    } else {
        $message = 'Error en la conexión a la base de datos';
    }
}
?>
