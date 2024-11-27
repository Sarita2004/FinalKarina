<?php
session_start();
require_once '../includes/conexion.php';

// Verificar si el usuario ha iniciado sesión y es profesor
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'profesor') {
    header('Location: ../index.php'); 
    exit();
}

$profesor_id = $_SESSION['id']; 

// Obtener los datos del profesor
$stmt = $conn->prepare("SELECT nombre, apellido FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $profesor_id);
$stmt->execute();
$profesor = $stmt->get_result()->fetch_assoc();

// Obtener las materias del profesor desde la tabla intermedia
$stmtMaterias = $conn->prepare("
    SELECT m.id_materia, m.nombre AS materia_nombre
    FROM usuario_materia um
    JOIN materias m ON um.id_materia = m.id_materia
    WHERE um.id_usuario = ?
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
    <link rel="stylesheet" href="estiloProfe.css"> 
</head>
<body>
    <div class="dashboard">
        <!-- Perfil del profesor -->
        <div class="profile-section">
            <div class="profile-picture">
                
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

        <!-- Materias -->
        <div class="courses-section">
            <h3>Materias</h3>
            <div class="course-list">
                <?php foreach ($materias as $materia): ?>
                    <a href="materia_detalle.php?id=<?php echo $materia['id_materia']; ?>" class="course-card">
                        <h4><?php echo htmlspecialchars($materia['materia_nombre']); ?></h4>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
