<?php
session_start();
require_once '../includes/conexion.php';

header('Content-Type: application/json');

// Verificar si el usuario ha iniciado sesión y es profesor
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'profesor') {
    echo json_encode(['success' => false, 'message' => 'Acceso denegado.']);
    exit();
}

// Obtener los parámetros de la solicitud
$materia_id = isset($_GET['id_materia']) ? intval($_GET['id_materia']) : null;
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : null;

if (!$materia_id || !$fecha) {
    echo json_encode(['success' => false, 'message' => 'Parámetros incompletos.']);
    exit();
}

// Obtener los alumnos presentes en esa fecha
$stmt = $conn->prepare("
    SELECT u.nombre, u.apellido
    FROM asistencias a
    INNER JOIN usuarios u ON a.id_usuario = u.id
    WHERE a.id_materia = ? AND a.fecha = ? AND a.presente = 1
");
$stmt->bind_param("is", $materia_id, $fecha);
$stmt->execute();
$result = $stmt->get_result();
$alumnos = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

echo json_encode(['success' => true, 'alumnos' => $alumnos]);
