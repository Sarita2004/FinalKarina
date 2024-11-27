<?php
session_start();
require_once '../includes/conexion.php';

// Verificar si el usuario ha iniciado sesión y es alumno
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'alumno') {
    header('Location: ../index.php');
    exit();
}

// Obtener el ID del alumno y la materia desde la sesión y URL
$alumno_id = $_SESSION['id'];
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

// Calcular el porcentaje de asistencia
$stmtPorcentaje = $conn->prepare("
    SELECT 
        (SELECT COUNT(*) FROM asistencias WHERE id_alumno = ? AND id_materia = ?) AS asistencias_alumno,
        (SELECT COUNT(DISTINCT fecha) FROM asistencias WHERE id_materia = ?) AS total_clases
");
$stmtPorcentaje->bind_param("iii", $alumno_id, $materia_id, $materia_id);
$stmtPorcentaje->execute();
$resultadoPorcentaje = $stmtPorcentaje->get_result()->fetch_assoc();
$stmtPorcentaje->close();

$asistenciasAlumno = $resultadoPorcentaje['asistencias_alumno'];
$totalClases = $resultadoPorcentaje['total_clases'];
$porcentajeAsistencia = ($totalClases > 0) ? ($asistenciasAlumno / $totalClases) * 100 : 0;

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
        <a href="alumno_dashboard.php" class="home-link">Inicio</a>
        <h1><?php echo htmlspecialchars($materia['nombre']); ?></h1>
    </div>

    <div class="container">


        <!-- Contenido principal -->
        <main class="main-content">
            <div class="card">
                <h3>Porcentaje de Asistencia</h3>
                <p>
                    <?php echo number_format($porcentajeAsistencia, 2); ?>% <!-- Formato a dos decimales -->
                </p>
                <p>Total de clases: <?php echo $totalClases; ?></p>
                <p>Clases asistidas: <?php echo $asistenciasAlumno; ?></p>
            </div>
        </main>
    </div>
</body>
</html>
