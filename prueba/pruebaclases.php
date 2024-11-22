<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "proyecto");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se están pasando los valores de 'profesor_id' y 'materia_id' en la URL
if (isset($_GET['id_profesor']) && isset($_GET['id_materia'])) {
    $id_profesor = $_GET['id_profesor'];
    $id_materia = $_GET['id_materia'];

    // Consulta para obtener los datos del profesor
    $query_profesor = "SELECT nombre FROM profesores WHERE id = $id_profesor";
    $result_profesor = $conexion->query($query_profesor);
    
    // Verificar si se obtuvo un resultado
    if ($result_profesor->num_rows > 0) {
        $profesor = $result_profesor->fetch_assoc()['nombre'];
    } else {
        die("No se encontró el profesor con ID $id_profesor");
    }

    // Consulta para obtener los datos de la materia
    $query_materia = "SELECT nombre FROM materias WHERE id = $id_materia";
    $result_materia = $conexion->query($query_materia);
    
    // Verificar si se obtuvo un resultado
    if ($result_materia->num_rows > 0) {
        $materia = $result_materia->fetch_assoc()['nombre'];
    } else {
        die("No se encontró la materia con ID $id_materia");
    }
} else {
    die("ID del profesor o de la materia no definido.");
}

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="clases-dashboard">
    <!-- Datos del profesor y materia -->
    <div id="datos-clase">
        <p id="nombre-profesor">Profesor: <?php echo $profesor; ?></p>
        <p id="materia-clase">Materia: <?php echo $materia; ?></p>
        <p id="fecha-generacion">Fecha: <span id="fecha-qr"></span></p>
        <button id="generar-qr-btn">Generar QR</button>
    </div>

    <!-- Espacio para mostrar el QR generado -->
    <div id="qr-container">
        <canvas id="qrcode"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
<script>
    // Datos del profesor y materia pasados desde PHP
    const profesor = '<?php echo $profesor; ?>';
    const materia = '<?php echo $materia; ?>';

    document.getElementById("generar-qr-btn").addEventListener("click", function() {
        // Obtener la fecha y hora actuales
        const now = new Date();
        const fecha = now.toLocaleDateString();
        const hora = now.toLocaleTimeString();

        // Actualizar el campo de fecha
        document.getElementById("fecha-qr").innerText = fecha + " " + hora;

        // Contenido del QR: nombre del profesor, materia y fecha y hora
        const contenidoQR = `Profesor: ${profesor}, Materia: ${materia}, Fecha: ${fecha}, Hora: ${hora}`;

        // Generar el QR
        const qrCodeContainer = document.getElementById("qrcode");
        QRCode.toCanvas(qrCodeContainer, contenidoQR, function (error) {
            if (error) console.error(error);
            console.log("¡QR generado con éxito!");
        });
    });
</script>

</body>
</html>



?>
