<?php
session_start();
require_once '../includes/conexion.php';

// Verificar si el usuario ha iniciado sesión y es profesor
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'profesor') {
    header('Location: ../index.php');
    exit();
}

// Obtener parámetros de la URL
$materia_id = isset($_GET['materia_id']) ? intval($_GET['materia_id']) : null;
$fecha_clase = isset($_GET['fecha']) ? $_GET['fecha'] : null;

if (!$materia_id || !$fecha_clase) {
    echo "Materia o fecha no válida.";
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

// Obtener todos los alumnos inscritos en la materia
$stmtInscritos = $conn->prepare("
    SELECT u.id, u.nombre, u.apellido
    FROM usuario_materia um
    JOIN usuarios u ON um.id_usuario = u.id
    WHERE um.id_materia = ? AND u.rol = 'alumno'
");
$stmtInscritos->bind_param("i", $materia_id);
$stmtInscritos->execute();
$alumnosInscritos = $stmtInscritos->get_result()->fetch_all(MYSQLI_ASSOC);
$stmtInscritos->close();

// Obtener los alumnos presentes en la clase
$stmtAsistencias = $conn->prepare("
    SELECT u.id, u.nombre, u.apellido
    FROM asistencias a
    JOIN usuarios u ON a.id_alumno = u.id
    WHERE a.id_materia = ? AND DATE(a.fecha) = ? AND u.rol = 'alumno'
");
$stmtAsistencias->bind_param("is", $materia_id, $fecha_clase);
$stmtAsistencias->execute();
$alumnosPresentes = $stmtAsistencias->get_result()->fetch_all(MYSQLI_ASSOC);
$stmtAsistencias->close();

// Filtrar los alumnos ausentes
$idsPresentes = array_column($alumnosPresentes, 'id');
$alumnosAusentes = array_filter($alumnosInscritos, function ($alumno) use ($idsPresentes) {
    return !in_array($alumno['id'], $idsPresentes);
});

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencias - <?php echo htmlspecialchars($materia['nombre']); ?></title>
    <link rel="stylesheet" href="estiloclase.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="materia_detalle.php?id=<?php echo $materia_id; ?>" class="back-link">Volver</a>
        <h1>Asistencias - <?php echo htmlspecialchars($materia['nombre']); ?></h1>
        <h3>Fecha: <?php echo date('d/m/Y', strtotime($fecha_clase)); ?></h3>
    </div>

    <div class="container">
    <div class="lists-container">
        <!-- Lista de presentes -->
        <div class="list-box">
            <h3>Alumnos presentes</h3>
            <ul class="attendance-list">
                <?php foreach ($alumnosPresentes as $alumno): ?>
                    <li><?php echo htmlspecialchars($alumno['nombre'] . " " . $alumno['apellido']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Lista de ausentes -->
        <div class="list-box">
            <h3>Alumnos ausentes</h3>
            <ul class="attendance-list">
                <?php foreach ($alumnosAusentes as $alumno): ?>
                    <li><?php echo htmlspecialchars($alumno['nombre'] . " " . $alumno['apellido']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
</body>
</html>

