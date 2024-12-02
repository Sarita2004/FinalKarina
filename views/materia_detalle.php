<?php
session_start();
require_once '../includes/conexion.php';

// Verificar si el usuario ha iniciado sesión y es profesor
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'profesor') {
    header('Location: ../index.php');
    exit();
}

// Obtener el ID de la materia desde la URL
$materia_id = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$materia_id) {
    echo "Materia no encontrada.";
    exit();
}

// Obtener los datos de la materia
$stmtMateria = $conn->prepare("SELECT nombre FROM materias WHERE id_materia = ?");
$stmtMateria->bind_param("i", $materia_id);
$stmtMateria->execute();
$materia = $stmtMateria->get_result()->fetch_assoc();
$stmtMateria->close();

if (!$materia) {
    echo "Materia no encontrada.";
    exit();
}

// Obtener las fechas distintas de las clases de la materia
$stmtFechas = $conn->prepare("
    SELECT DISTINCT DATE(fecha) AS fecha_clase
    FROM asistencias
    WHERE id_materia = ? 
    ORDER BY fecha_clase DESC
");
$stmtFechas->bind_param("i", $materia_id);
$stmtFechas->execute();
$fechas = $stmtFechas->get_result()->fetch_all(MYSQLI_ASSOC);
$stmtFechas->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Materia</title>
    <link rel="stylesheet" href="estiloM.css">
    <script>
        async function generarQR() {
            const response = await fetch(`generar_qr.php?id_materia=<?php echo $materia_id; ?>`);
            const data = await response.json();
            if (data.success) {
                document.getElementById('qrCode').innerHTML = data.qr;
            } else {
                alert('Error al generar el código QR.');
            }
        }
    </script>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="profesor_dashboard.php" class="home-link">Inicio</a>
        <h1><?php echo htmlspecialchars($materia['nombre']); ?></h1>
    </div>

    <div class="container">
        <!-- Barra lateral -->
        <aside class="sidebar">
            <h3>Fechas de Clases</h3>
            <ul>
                <?php if (!empty($fechas)): ?>
                    <?php foreach ($fechas as $fecha): ?>
                        <li>
                            <a href="detalle_clase.php?fecha=<?php echo $fecha['fecha_clase']; ?>&materia_id=<?php echo $materia_id; ?>">
                                <?php echo date('d/m/Y', strtotime($fecha['fecha_clase'])); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No hay clases registradas para esta materia.</li>
                <?php endif; ?>
            </ul>
        </aside>

        <!-- Contenido principal -->
        <main class="main-content">
            <div class="card">
                <h3>Código QR de la materia</h3>
                <div class="qr-container">
                    <p>Presiona el botón para generar un código QR:</p>
                    <button onclick="generarQR()"class="btn-assign-notes">Generar QR</button>
                    <div id="qrCode"></div>
                </div>
            </div>

            <!-- Botón para asignar notas -->
            <div class="card">
                <h3>Notas</h3>
                <p>Asigna notas a los alumnos<br></br></p>
                
                <a href="asignar_notas.php?id=<?php echo $materia_id; ?>" class="btn-assign-notes">Asignar Notas</a>
            </div>
        </main>
    </div>
    
</body>
</html>
