<?php
// asistencia_registrar.php
session_start();
require '../includes/conexion.php';

// Verificar si el alumno está autenticado
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'alumno') {
    exit("Acceso denegado. Debes iniciar sesión como alumno.");
}

// Obtener el ID del alumno desde la sesión
$alumno_id = $_SESSION['id'];

// Verificar si se han pasado los parámetros necesarios (id_materia e id_profesor)
if (isset($_GET['id_materia']) && isset($_GET['id_profesor'])) {
    $id_materia = intval($_GET['id_materia']);
    $id_profesor = intval($_GET['id_profesor']);

    // Verificar si el profesor realmente imparte esa materia
    $sqlValidar = "SELECT 1 FROM usuario_materia 
                   WHERE id_usuario = ? AND id_materia = ?";
    $stmtValidar = $pdo->prepare($sqlValidar);
    $stmtValidar->execute([$id_profesor, $id_materia]);
    
    if ($stmtValidar->rowCount() > 0) {
        // Registrar la asistencia en la tabla 'asistencias'
        $sqlAsistencia = "INSERT INTO asistencias (id_alumno, id_profesor, id_materia, fecha) 
                          VALUES (?, ?, ?, NOW())";
        $stmtAsistencia = $pdo->prepare($sqlAsistencia);
        $stmtAsistencia->execute([$alumno_id, $id_profesor, $id_materia]);

        echo "Asistencia registrada correctamente.";
    } else {
        echo "Error: El profesor no imparte la materia especificada.";
    }
} else {
    echo "Error: Faltan parámetros (id_materia o id_profesor).";
}
?>
