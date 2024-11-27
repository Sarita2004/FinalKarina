<?php
session_start();
require_once '../includes/conexion.php';
require '../pruebaqr/barcode-master/barcode.php'; // Librería para generar QR

// Verificar si el usuario ha iniciado sesión y es profesor
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'profesor') {
    header('Location: ../index.php');
    exit();
}

// Obtener el ID de la materia desde la URL
$materia_id = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$materia_id) {
    echo "Materia no encontrada.";
    exit();
}

// Obtener los datos de la materia
$stmtMateria = $conn->prepare("SELECT nombre FROM materias WHERE id_materia = ?");
$stmtMateria->bind_param("i", $materia_id);
$stmtMateria->execute();
$materia = $stmtMateria->get_result()->fetch_assoc();
$stmtMateria->close();

if (!$materia) {
    echo "Materia no encontrada.";
    exit();
}

// Obtener los alumnos asignados a la materia
$stmtAlumnos = $conn->prepare("
    SELECT u.nombre, u.apellido
    FROM usuarios u
    INNER JOIN usuario_materia um ON u.id = um.id_usuario
    WHERE um.id_materia = ? AND u.rol = 'alumno'
");
$stmtAlumnos->bind_param("i", $materia_id);
$stmtAlumnos->execute();
$alumnos = $stmtAlumnos->get_result()->fetch_all(MYSQLI_ASSOC);
$stmtAlumnos->close();

// Generar QR
$profesor_id = $_SESSION['id']; // ID del profesor desde la sesión
$urlQR = "http://192.168.1.16/Asistencia/pruebaqr/asistencia_registrar.php?id_materia={$materia_id}&id_profesor={$profesor_id}";

// Crear el QR en SVG
$generator = new barcode_generator();
$qrCode = $generator->render_svg('qr', $urlQR, [
    'w' => 300,
    'h' => 300,
    'bc' => '#637181', // color de fondo
    'cs' => '#000000', // color de los espacios
    'cm' => '#ffffff', // color de los módulos
    'ms' => 's' // s: square, r: round, x: cross
]);

$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Materia</title>
    <link rel="stylesheet" href="estilosMateria.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="profesor_dashboard.php" class="home-link">Inicio</a>
        <h1><?php echo htmlspecialchars($materia['nombre']); ?></h1>
    </div>

    <div class="container">
        <!-- Barra lateral -->
        <aside class="sidebar">
            <h3>Alumnos Asignados</h3>
            <ul>
                <?php if (!empty($alumnos)): ?>
                    <?php foreach ($alumnos as $alumno): ?>
                        <li><?php echo htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido']); ?></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No hay alumnos asignados a esta materia.</li>
                <?php endif; ?>
            </ul>
        </aside>

        <!-- Contenido principal -->
        <main class="main-content">
            <div class="card">
                <h3>Código QR de la materia</h3>
                <div class="qr-container">
                    <p>Escanea este código para registrar la asistencia:</p>
                    <div><?php echo $qrCode; ?></div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>


