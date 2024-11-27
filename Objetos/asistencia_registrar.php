<?php
session_start();
require '../includes/conexion.php';

// Verificar si el alumno está autenticado
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'alumno') {
    header('Location: ../index.php');
    exit();
}

// Obtener el ID del alumno desde la sesión
$alumno_id = $_SESSION['id'];

// Verificar si se pasaron los parámetros necesarios
if (isset($_GET['id_materia']) && isset($_GET['id_profesor'])) {
    $id_materia = intval($_GET['id_materia']);
    $id_profesor = intval($_GET['id_profesor']);

    // Registrar la asistencia
    $sqlAsistencia = "INSERT INTO asistencias (id_alumno, id_profesor, id_materia, fecha) 
                      VALUES (?, ?, ?, NOW())";
    $stmtAsistencia = $pdo->prepare($sqlAsistencia);
    $stmtAsistencia->execute([$alumno_id, $id_profesor, $id_materia]);

    echo "Asistencia registrada correctamente.";
} else {
    echo "Parámetros inválidos.";
}
?>

