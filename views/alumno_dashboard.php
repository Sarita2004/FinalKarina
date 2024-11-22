<?php
session_start();
require '../includes/conexion.php'; // Incluye la conexión a la base de datos

// Verifica si el usuario tiene sesión iniciada y si su rol es 'alumno'
if (!isset($_SESSION['alumno_id']) || $_SESSION['rol'] !== 'alumno') {
    header('Location: ../public/index.php'); // Si no es alumno, redirige al login
    exit();
}


// Aquí puedes poner el contenido del dashboard del alumno
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Alumno</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <h1>Bienvenido Alumno, <?php echo $_SESSION['nombre']; ?></h1>
    <div class="navbar">
        <h1>Perfil del Alumno</h1>
        <a href="index2.php">Dashboard</a>
    </div>

    <div class="perfil-container">
        <img src="foto-alumno.jpg" alt="Foto del Alumno" class="foto-perfil">
        <h2>Nombre del Alumno</h2>
        <p><strong>Email:</strong> alumno@example.com</p>
        <p><strong>Curso:</strong> 10° Grado</p>
        <p><strong>Promedio:</strong> 8.5</p>
        <!-- Agregar más datos relevantes -->
    </div>

    <script src="script.js"></script>
    <!-- Contenido del dashboard del alumno -->
</body>
</html>
