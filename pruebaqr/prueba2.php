<?php
require '../pruebaqr/barcode-master/barcode.php'; // Incluye la librería del generador de códigos QR
session_start();

// //Verifica si el profesor está autenticado
// if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'profesor') {
//     header('Location: ../public/views/index.php');
//     exit();
// }

$profesor_id = $_SESSION['id']; // ID del profesor desde la sesión
$clase_id = 1; // Este es el ID de la clase, puedes obtenerlo dinámicamente dependiendo de la clase actual

// Generar la URL que estará embebida en el QR
$urlQR = "http://192.168.2.111/Asistencia/pruebaqr/asistencia_registrar.php?clase_id=" . $clase_id;

// Generar el código QR usando la biblioteca barcode generator
$generator = new barcode_generator(); // Si usas Picqer Barcode Generator
$qrCode = $generator->render_svg('qr', $urlQR, [
    'w' => 300,
    'h' => 300,
    'bc' => '#00f2df', // color de fondo
    'cs' => '#000000', // color de los espacios
    'cm' => '#ffffff', // color de los módulos
    'ms' => 's' // s: square, r: round, x: cross
]);

echo $qrCode; // Mostrar el código QR en la página
?>
