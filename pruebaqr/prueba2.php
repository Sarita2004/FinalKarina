<?php
require '../pruebaqr/barcode-master/barcode.php';

// Verificar si se ha recibido el ID de la materia y el ID del profesor
if (!isset($_GET['id_materia']) || !isset($_GET['id_profesor'])) {
    echo "Error: Faltan parámetros (id_materia o id_profesor).";
    exit();
}

$id_materia = intval($_GET['id_materia']);
$id_profesor = intval($_GET['id_profesor']);

// Generar la URL que estará embebida en el QR
$urlQR = "http://192.168.2.111/Asistencia/pruebaqr/asistencia_registrar.php?id_materia=" . $id_materia . "&id_profesor=" . $id_profesor;

// Generar el código QR
$generator = new barcode_generator(); // Usar la biblioteca del generador QR
$qrCode = $generator->render_svg('qr', $urlQR, [
    'w' => 300,
    'h' => 300,
    'bc' => '#2b3e50', // color de fondo
    'cs' => '#000000', // color de los espacios
    'cm' => '#ffffff', // color de los módulos
    'ms' => 's' // s: square, r: round, x: cross
]);

echo $qrCode; // Imprimir el QR generado
?>
