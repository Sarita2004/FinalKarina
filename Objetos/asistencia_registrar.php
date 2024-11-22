<?php
session_start();
require '../includes/conexion.php';

if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'alumno') {
    exit();
}

$alumno_id = $_SESSION['id'];

if (isset($_GET['clase_id'])) {
    $clase_id = $_GET['clase_id'];

    $sqlClase = "SELECT id_profesor, id_materia FROM clases WHERE id_clase = ?";
    $stmtClase = $pdo->prepare($sqlClase);
    $stmtClase->execute([$clase_id]);
    $clase = $stmtClase->fetch();

    if ($clase) {
        $asistencia = new Asistencia($pdo, $alumno_id, $clase['id_profesor'], $clase['id_materia']);
        echo $asistencia->registrar();
    } else {
        echo "Clase no encontrada o código QR inválido.";
    }
} else {
    echo "No se proporcionó información de la clase.";
}
?>
