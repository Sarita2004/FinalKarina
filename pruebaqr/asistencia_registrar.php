<?php
// asistencia_registrar.php
session_start();
require '../includes/conexion.php';

// Verificar si el alumno está autenticado
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'alumno') {
    echo "<script>
        Swal.fire({
            title: 'Acceso denegado',
            text: 'Debes iniciar sesión como alumno.',
            icon: 'error',
            confirmButtonText: 'Entendido'
        }).then(() => {
            window.location.href = '../login.php'; // Redirigir al inicio de sesión
        });
    </script>";
    exit;
}

// Obtener el ID del alumno desde la sesión
$alumno_id = $_SESSION['id'];

$message = ''; // Variable para almacenar mensajes

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

        $message = [
            'title' => 'Asistencia registrada',
            'text' => 'La asistencia se registró correctamente.',
            'icon' => 'success'
        ];
    } else {
        $message = [
            'title' => 'Error',
            'text' => 'El profesor no imparte la materia especificada.',
            'icon' => 'error'
        ];
    }
} else {
    $message = [
        'title' => 'Error',
        'text' => 'Faltan parámetros (id_materia o id_profesor).',
        'icon' => 'error'
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencia</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
    // Configuración del mensaje generado por PHP
    const message = <?php echo json_encode($message); ?>;
    Swal.fire({
        title: message.title,
        text: message.text,
        icon: message.icon,
        confirmButtonText: 'Aceptar'
    }).then(() => {
        // Opcional: Redirigir después de mostrar el mensaje
        <?php if ($message['icon'] === 'success') { ?>
            window.location.href = '../alumno_dashboard.php'; // Redirigir al dashboard del alumno
        <?php } ?>
    });
</script>
</body>
</html>
