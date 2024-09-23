<?php
class Database {
    public static function Conectar(){
        // Datos de conexión
        $host = "localhost";
        $baseDeDatos = 'softcorp';
        $usuario = 'root';
        $contrasena = "";

        try {
            // Crear la conexión con PDO
            $conexion = new PDO("mysql:host=$host;dbname=$baseDeDatos;charset=utf8", $usuario, $contrasena);

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            // Manejar el error de conexión
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
    }
}
?>
