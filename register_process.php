<?php
// Incluir la clase de conexión
require_once 'Database.php';
require 'utils.php';

// Conectar a la base de datos
$pdo = Database::Conectar();
$nombre_usuario = $_POST['username'];
$nombre_usuario_sanitizado = preg_replace(INVALID_USERNAME_PATTERN, '', $nombre_usuario);
$correo = $_POST['email'];

if ((empty($nombre_usuario) or empty($correo)) or !isValidUsername($nombre_usuario)) {
    echo "Algunos datos son invalidos, revisalos e intentalo nuevamente!";
} else if (!$pdo) {
    echo "Error al conectar con la base de datos";
} else {

    // Recibir los datos del formulario
    $contrasena = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash de la contraseña

    // Preparar la consulta SQL para insertar el nuevo usuario
    $sql = "INSERT INTO usuarios (nombre_usuario, correo, contrasena) VALUES (:nombre_usuario, :correo, :contrasena)";
    $stmt = $pdo->prepare($sql);

    // Asignar valores a los parámetros
    $stmt->bindParam(':nombre_usuario', $nombre_usuario_sanitizado);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':contrasena', $contrasena);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: home.php');
    } else {
        $message = "Error en el registro. Intenta de nuevo.";
    }
}

// Cerrar la conexión (opcional, ya que PDO se cierra automáticamente al final del script)
$pdo = null;
