<?php
session_start();
require '../includes/conexion.php'; // Asegúrate de que este archivo contiene la conexión a tu base de datos

// Verificar si el usuario ha iniciado sesión y es profesor
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'profesor') {
    header('Location: ../index.php'); // Redirige al login si no es profesor o no está logueado
    exit();
}

$profesor_id = $_SESSION['id']; // ID del profesor guardado en la sesión
$materia_id = $_GET['id_materia']; // ID de la materia que el profesor está gestionando

// Obtener los datos de la materia
$stmtMateria = $conn->prepare("SELECT nombre FROM materias WHERE id_materia = ?");
$stmtMateria->bind_param("i", $materia_id);
$stmtMateria->execute();
$materia = $stmtMateria->get_result()->fetch_assoc();

// Obtener los alumnos asignados a esta materia
$stmtAlumnos = $conn->prepare("
    SELECT u.id, u.nombre, u.apellido 
    FROM usuarios u
    JOIN usuario_materia um ON u.id = um.id_usuario
    WHERE um.id_materia = ?
");
$stmtAlumnos->bind_param("i", $materia_id);
$stmtAlumnos->execute();
$alumnos = $stmtAlumnos->get_result()->fetch_all(MYSQLI_ASSOC);

// Si se envía el formulario para asignar las notas
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST['notas'] as $alumno_id => $nota_final) {
        // Verificar si ya existe una calificación para el alumno en esta materia
        $stmtCheckNota = $conn->prepare("SELECT id FROM notas WHERE id_alumno = ? AND id_materia = ?");
        $stmtCheckNota->bind_param("ii", $alumno_id, $materia_id);
        $stmtCheckNota->execute();
        $result = $stmtCheckNota->get_result();
        
        if ($result->num_rows > 0) {
            // Si ya tiene nota, actualiza la calificación
            $stmtUpdateNota = $conn->prepare("UPDATE notas SET nota_final = ? WHERE id_alumno = ? AND id_materia = ?");
            $stmtUpdateNota->bind_param("dii", $nota_final, $alumno_id, $materia_id);
            $stmtUpdateNota->execute();
        } else {
            // Si no tiene nota, inserta una nueva calificación
            $stmtInsertNota = $conn->prepare("INSERT INTO notas (id_alumno, id_materia, nota_final) VALUES (?, ?, ?)");
            $stmtInsertNota->bind_param("iid", $alumno_id, $materia_id, $nota_final);
            $stmtInsertNota->execute();
        }
    }
    
    // Redirigir después de guardar las notas
    header("Location: materia_notas.php?id=$materia_id");
    exit();
}

$stmtMateria->close();
$stmtAlumnos->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Notas - <?php echo htmlspecialchars($materia['nombre']); ?></title>
    <link rel="stylesheet" href="stylesmateria.css"> <!-- Aquí aplica tu archivo de estilos -->
</head>
<body>
    <div class="container">
        <h1>Asignar Notas Finales - Materia: <?php echo htmlspecialchars($materia['nombre']); ?></h1>
        <form method="POST" action="">
            <div class="alumnos-lista">
                <?php foreach ($alumnos as $alumno): ?>
                    <div class="alumno">
                        <h3><?php echo htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido']); ?></h3>
                        <input type="number" name="notas[<?php echo $alumno['id']; ?>]" step="0.1" min="0" max="10" placeholder="Nota final" required>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit">Guardar Notas</button>
        </form>
    </div>
</body>
</html>
