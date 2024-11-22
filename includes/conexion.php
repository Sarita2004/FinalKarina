<?php
$host = 'localhost';  
$dbname = 'sistema_asistencias';   // Nombre de la base de datos que acabas de crear
$user = 'root';        // Usuario de la base de datos
$password = '';        // Contraseña del usuario (deja vacío si no tienes contraseña en tu entorno local)

// Crear la conexión
$conn = new mysqli($host, $user, $password, $dbname);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
