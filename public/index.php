<?php
session_start();
require '../includes/conexion.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Preparar la consulta
    $stmt = $conn->prepare("SELECT id, rol, password FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si el usuario existe
    if ($result->num_rows > 0) {
        $result = $result->fetch_assoc();



        // Verificar la contraseña
        if (password_verify($password, $result['password'])) {
            // Guardar el id del usuario en la sesión
            $_SESSION['id'] = $result['id'];
            $_SESSION['rol'] = $result['rol'];


            // Redirigir basado en el rol
            if ($_SESSION['rol'] == 'profesor') {

                header('Location: ../views/profesor_dashboard.php');
            } elseif ($_SESSION['rol'] == 'alumno') {

                header('Location: ../views/alumno_dashboard.php');
            }
           
        } else {
            // Contraseña incorrecta
            echo "La contraseña es incorrecta.";
        }
    } else {
        // Usuario no encontrado
        echo "No se encontró una cuenta con ese correo.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/estiloGeneral.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="login-container">
        <h1>ISSP 9112</h1>
        <form method="post" action="">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Iniciar sesión</button>
        </form>

       
        <p>¿No tienes una cuenta? <a href="register.php">Crear una cuenta</a></p>
    </div>

</body>

</html>

