<?php
session_start();
require '../includes/conexion.php'; // Asegúrate de que este archivo contiene la conexión a tu base de datos

// Verificar si el usuario ha iniciado sesión y es profesor
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'profesor') {
    header('Location: ../index.php'); // Redirige al login si no es profesor o no está logueado
    exit();
}

$profesor_id = $_SESSION['id']; // ID del profesor guardado en la sesión

// Obtener los datos del profesor
$stmt = $conn->prepare("SELECT nombre, apellido FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $profesor_id);
$stmt->execute();
$profesor = $stmt->get_result()->fetch_assoc();

// Obtener solo los nombres de las materias que dicta el profesor
$stmtMaterias = $conn->prepare("
    SELECT nombre AS materia_nombre 
    FROM materias 
    WHERE id_profesor = ?
");
$stmtMaterias->bind_param("i", $profesor_id);
$stmtMaterias->execute();
$materias = $stmtMaterias->get_result()->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$stmtMaterias->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Profesor</title>
    <link rel="stylesheet" href="stylesprof.css"> <!-- Asegúrate de tener el archivo de estilos -->
</head>
<body>
    <div class="dashboard">
        <!-- Sección del perfil del profesor -->
        <div class="profile-section">
            <div class="profile-picture">
                <img src="ruta_foto.jpg" alt="Foto del profesor"> <!-- Cambiar esto para que sea dinámico si tienes fotos -->
            </div>
            <div class="profile-info">
                <h2 id="nombre-profesor">
                    <?php echo htmlspecialchars($profesor['nombre']); ?>
                </h2>
                <h4 id="apellido-profesor">
                    <?php echo htmlspecialchars($profesor['apellido']); ?>
                </h4>
            </div>
        </div>

        <!-- Sección de materias -->
        <div class="courses-section">
            <h3>Materias</h3>
            <div class="course-list">
                <?php foreach ($materias as $materia): ?>
                    <div class="course-card">
                        <h4><?php echo htmlspecialchars($materia['materia_nombre']); ?></h4>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
