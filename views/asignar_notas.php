<?php
session_start();
require_once '../includes/conexion.php';

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

// Obtener la lista de alumnos inscritos en la materia
$stmtAlumnos = $conn->prepare("
    SELECT u.id, u.nombre, u.apellido, n.nota_parcial_1, n.nota_parcial_2, n.nota_final
    FROM usuario_materia um
    JOIN usuarios u ON um.id_usuario = u.id
    LEFT JOIN notas n ON n.id_alumno = u.id AND n.id_materia = ?
    WHERE um.id_materia = ? AND u.rol = 'alumno'
");
$stmtAlumnos->bind_param("ii", $materia_id, $materia_id);
$stmtAlumnos->execute();
$alumnos = $stmtAlumnos->get_result()->fetch_all(MYSQLI_ASSOC);
$stmtAlumnos->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Notas</title>
    <link rel="stylesheet" href="estiloNotas.css"> <!-- Asegúrate de agregar estilos adecuados -->
</head>
<body>
    <h1>Asignar Notas - <?php echo htmlspecialchars($materia['nombre']); ?></h1>
    <form action="guardar_notas.php" method="POST">
        <input type="hidden" name="id_materia" value="<?php echo $materia_id; ?>">
        <table>
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Primer Parcial</th>
                    <th>Segundo Parcial</th>
                    <th>Nota Final</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alumnos as $alumno): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido']); ?></td>
                        <td>
                            <input type="number" name="notas[<?php echo $alumno['id']; ?>][nota_parcial_1]" value="<?php echo $alumno['nota_parcial_1']; ?>" step="0.01" min="0" max="10">
                        </td>
                        <td>
                            <input type="number" name="notas[<?php echo $alumno['id']; ?>][nota_parcial_2]" value="<?php echo $alumno['nota_parcial_2']; ?>" step="0.01" min="0" max="10">
                        </td>
                        <td>
                            <input type="number" name="notas[<?php echo $alumno['id']; ?>][nota_final]" value="<?php echo $alumno['nota_final']; ?>" step="0.01" min="0" max="10">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit">Guardar Notas</button>
    </form>
</body>
</html>
