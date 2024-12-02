<?php
session_start();
require_once '../includes/conexion.php';
require '../pruebaqr/barcode-master/barcode.php'; // Librería para generar QR

header('Content-Type: application/json');

// Verificar si el usuario ha iniciado sesión y es profesor
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'profesor') {
    echo json_encode(['success' => false, 'message' => 'Acceso denegado.']);
    exit();
}

// Obtener el ID de la materia desde la solicitud
$materia_id = isset($_GET['id_materia']) ? intval($_GET['id_materia']) : null;
if (!$materia_id) {
    echo json_encode(['success' => false, 'message' => 'ID de materia no proporcionado.']);
    exit();
}

// Generar URL única para el QR
$profesor_id = $_SESSION['id'];
$timestamp = time();
$urlQR = "http://192.168.1.17/Asistencia/pruebaqr/asistencia_registrar.php?id_materia={$materia_id}&id_profesor={$profesor_id}&timestamp={$timestamp}";

// Crear el QR en SVG
$generator = new barcode_generator();
$qrCode = $generator->render_svg('qr', $urlQR, [
    'w' => 300,
    'h' => 300,
    
    'cs' => '#000000', // color de los espacios
    'cm' => '#ffffff', // color de los módulos
    'ms' => 's' // s: square, r: round, x: cross
]);

echo json_encode(['success' => true, 'qr' => $qrCode]);
