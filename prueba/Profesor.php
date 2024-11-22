<?php
session_start();
require '../includes/conexion.php'; // Incluye la conexión a la base de datos

// Verifica si el usuario tiene sesión iniciada y si su rol es 'profesor'
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'profesor') {
    header('Location: ../public/index.php'); // Si no es profesor, redirige al login
    exit();
}

// Obtén el ID del profesor desde la sesión
$profesor_id = $_SESSION['usuario_id'];

// Consulta para obtener los datos del profesor desde la base de datos
$sql = "SELECT nombre, apellido, email FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $profesor_id);
$stmt->execute();
$result = $stmt->get_result();

// Variables por defecto por si la consulta falla
$nombreProfesor = "Nombre no disponible";
$apellidoProfesor = "Apellido no disponible";
$emailProfesor = "Email no disponible";


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombreProfesor = $row['nombre'];
    $apellidoProfesor = $row['apellido'];
    $emailProfesor = $row['email'];
    // Si hay foto, usarla
}

$stmt->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Profesor</title>
    <link rel="stylesheet" href="css/stylesProf.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #e8f0f2; /* Fondo claro y moderno */
            color: #333; /* Color de texto legible */
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            width: 90%;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Sombra suave */
            margin-top: 20px;
        }

        /* Sección de Perfil del Usuario */
        .perfil {
            width: 30%;
            margin-right: 20px; /* Espacio entre el perfil y las materias */
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #ffffff; /* Fondo blanco */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }

        .perfil img {
            width: 100px; /* Tamaño de la imagen de perfil */
            height: 100px; /* Tamaño de la imagen de perfil */
            border-radius: 50%; /* Hace que la imagen sea circular */
            margin-bottom: 15px;
            border: 2px solid #6e8efb; /* Borde azul */
        }

        .perfil h2 {
            font-size: 20px;
            margin: 5px 0;
            color: #2c3e50;
        }

        .perfil p {
            font-size: 14px;
            color: #666;
            text-align: center;
        }

        /* Sección de Materias en el centro */
        .main-content {
            width: 70%; /* Espacio para las materias */
            padding: 20px;
        }

        .materias {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Diseño responsivo en columnas */
            grid-gap: 20px;
            width: 100%;
            justify-items: center;
        }

        .materia-btn {
            background-color: #6e8efb; /* Color azul moderno */
            color: white;
            border: none;
            padding: 20px;
            margin: 10px 0;
            cursor: pointer;
            width: 100%;
            text-align: center;
            font-size: 18px;
            border-radius: 10px;
            transition: all 0.3s ease; /* Transiciones suaves */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Sombra para dar profundidad */
        }

        .materia-btn:hover {
            background-color: #2980b9; /* Cambio de color interactivo */
            transform: translateY(-5px); /* Efecto de elevación */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        .materia-btn:active {
            transform: translateY(0); /* Retroceso suave al presionar */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Mejora la tipografía general */
        h2 {
            font-size: 26px;
            color: #2c3e50;
            text-transform: uppercase;
            margin-bottom: 20px;
            text-align: center; /* Centrar títulos */
        }

        /* Efecto de entrada animada */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .main-content, .perfil {
            animation: slideIn 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sección de Perfil del Usuario -->
        <div class="perfil">
            <img src="<?php echo htmlspecialchars($fotoPerfil); ?>" alt="Foto de Perfil">
            <h2><?php echo htmlspecialchars($nombreProfesor) . ' ' . htmlspecialchars($apellidoProfesor); ?></h2>
            <p>Email: <?php echo htmlspecialchars($emailProfesor); ?></p>
        </div>

        <!-- Sección de Materias -->
        <div class="main-content">
            <h2>Materias</h2>
            <div class="materias">
                <a href="clases.php?materia=Matemáticas I" class="materia-btn">Matemáticas I</a>
                <a href="clases.php?materia=Arquitectura de las computadoras" class="materia-btn">Arquitectura de las computadoras</a>
                <a href="clases.php?materia=Estadística" class="materia-btn">Estadística</a>
                <!-- Puedes agregar más materias aquí -->
            </div>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
