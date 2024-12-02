<?php
session_start();
require_once '../includes/conexion.php';


if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'alumno') {
    header('Location: ../index.php'); 
    exit();
}

$alumno_id = $_SESSION['id']; 


$stmt = $conn->prepare("SELECT nombre, apellido FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $alumno_id);
$stmt->execute();
$alumno = $stmt->get_result()->fetch_assoc();


$stmtMaterias = $conn->prepare("
    SELECT m.id_materia, m.nombre AS materia_nombre
    FROM usuario_materia um
    JOIN materias m ON um.id_materia = m.id_materia
    WHERE um.id_usuario = ?
");
$stmtMaterias->bind_param("i", $alumno_id);
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
    <title>Dashboard Alumno</title>
    <link rel="stylesheet" href="estiloDash.css"> 
</head>
<body>
    <div class="dashboard">
        
        <div class="profile-section">
            <div class="profile-picture">
                
            </div>
            <div class="profile-info">
                <h2 id="nombre-alumno">
                    <?php echo htmlspecialchars($alumno['nombre']); ?>
                </h2>
                <h4 id="apellido-alumno">
                    <?php echo htmlspecialchars($alumno['apellido']); ?>
                </h4>
            </div>
        </div>

        
        <div class="courses-section">
            <h3>Mis Materias</h3>
            <div class="course-list">
                <?php foreach ($materias as $materia): ?>
                    <a href="materia_alumno.php?id=<?php echo $materia['id_materia']; ?>" class="course-card">
                        <h4><?php echo htmlspecialchars($materia['materia_nombre']); ?></h4>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
