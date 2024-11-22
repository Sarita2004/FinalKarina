<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Alumno</title>
    <link rel="stylesheet" href="alumnosestilo.css">
</head>
<body>
    <div class="container">
        <!-- Menú lateral -->
        <aside class="sidebar">
            <h2>Elige tu carrera/curso</h2>
            <ul>
                <li><strong>INGENIERÍA EN SISTEMAS INFORMÁTICOS</strong></li>
                <li><a href="#">Estado de situación</a></li>
                <li><a href="#">Cuenta corriente</a></li>
                <li><a href="#">Pagos pendientes</a></li>
                <li><a href="#">Mis horarios</a></li>
                <li><a href="#">Calendario académico</a></li>
                <li><a href="#">Inscripción en asignaturas</a></li>
            </ul>
        </aside>

        <!-- Panel principal -->
        <main class="main-content">
            <header class="top-bar">
                <div class="user-info">
                    <img src="profile.jpg" alt="Foto perfil" class="profile-pic">
                    <div>
                        <span class="name">Meliti, Sara</span>
                        <span class="role">Universidad Abierta Interamericana</span>
                    </div>
                </div>
            </header>

            <section class="personal-info">
                <h1>Datos Personales</h1>
                <div class="info-card">
                    <h3>INGENIERÍA EN SISTEMAS INFORMÁTICOS</h3>
                    <p>Legajo: B00115749-T1 / Estado: Condicional Regular</p>
                    <p>Campus: 120 UAI - REGIONAL ROSARIO / Año: 2° / Turno: Noche / Letra: A</p>
                    <button>Solicitar Cambio de Datos Personales</button>
                    <button>Historial de Solicitudes</button>

                    <div class="personal-details">
                        <img src="profile.jpg" alt="Foto perfil" class="profile-pic-large">
                        <div class="details">
                            <p><strong>Nombre:</strong> Sara</p>
                            <p><strong>Apellido:</strong> Meliti</p>
                            <p><strong>T.E. Celular:</strong> +543364003537</p>
                            <p><strong>T.E. Hogar:</strong> +543364003537</p>
                            <p><strong>Email:</strong> sarameliti3@gmail.com</p>
                            <p><strong>Email Institucional:</strong> Sara.Meliti@alumnos.uai.edu.ar</p>
                            <p><strong>Domicilio:</strong> Florencia 902, Villa Constitución, Santa Fe, Argentina</p>
                            <p><strong>Estado Civil:</strong> Soltero/a</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>

<?php
session_start();
require '../includes/conexion.php';

// Obtener el id del alumno desde la URL
$id = $_GET['id'];

// Usar una consulta preparada para evitar inyección SQL
$stmt = $conn->prepare("SELECT * FROM alumnos WHERE id = ?");
$stmt->bind_param("i", $id);  // "i" indica que es un entero
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $alumno = $result->fetch_assoc();
} else {
    echo "No se encontraron datos del alumno.";
}
?>

<!-- HTML para mostrar los datos -->
<div class="details">
    <p><strong>Nombre:</strong> <?php echo $alumno['nombre']; ?></p>
    <p><strong>Apellido:</strong> <?php echo $alumno['apellido']; ?></p>
    <p><strong>T.E. Celular:</strong> <?php echo $alumno['celular']; ?></p>
    <p><strong>T.E. Hogar:</strong> <?php echo $alumno['telefono']; ?></p>
    <p><strong>Email:</strong> <?php echo $alumno['email']; ?></p>
    <p><strong>Email Institucional:</strong> <?php echo $alumno['email_institucional']; ?></p>
    <p><strong>Domicilio:</strong> <?php echo $alumno['domicilio']; ?></p>
    <p><strong>Estado Civil:</strong> <?php echo $alumno['estado_civil']; ?></p>
</div>
