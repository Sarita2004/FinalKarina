<?php
// asistencia_registrar.php
session_start();
require '../includes/conexion.php';

// Verificar si el alumno está autenticado
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'alumno') {
    //header('Location: ../public/views/index.php');

    exit();
}

// Obtener el ID del alumno desde la sesión
$alumno_id = $_SESSION['id'];

// Verificar si se ha pasado el ID de la clase en la URL
if (isset($_GET['clase_id'])) {
    $clase_id = $_GET['clase_id'];

    // Obtener los detalles de la clase (profesor y materia) desde la tabla clases
    $sqlClase = "SELECT id_profesor, id_materia FROM clases WHERE id_clase = ?";
    $stmtClase = $pdo->prepare($sqlClase);
    $stmtClase->execute([$clase_id]);
    $clase = $stmtClase->fetch();

    // Verificar si se encontró la clase
    if ($clase) {
        $id_profesor = $clase['id_profesor'];
        $id_materia = $clase['id_materia'];

        // Registrar la asistencia en la tabla 'asistencias'
        $sqlAsistencia = "INSERT INTO asistencias (id_alumno, id_profesor, id_materia, fecha) 
                          VALUES (?, ?, ?, NOW())";
        $stmtAsistencia = $pdo->prepare($sqlAsistencia);
        $stmtAsistencia->execute([$alumno_id, $id_profesor, $id_materia]);

        echo "Asistencia registrada correctamente.";
    } else {
        echo "Clase no encontrada o código QR inválido.";
    }
} else {
    echo "No se proporcionó información de la clase.";
}
?>
