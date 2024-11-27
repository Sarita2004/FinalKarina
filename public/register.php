<?php
require '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];  // Añadido el campo apellido
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashear la contraseña
    $rol = $_POST['rol'];

    // Definir la tabla a la cual se insertarán los datos dependiendo del rol
    $sql = "INSERT INTO usuarios (nombre, apellido, email, password, rol) VALUES (?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$nombre, $apellido, $email, $password, $rol])) {
        echo "Usuario registrado con éxito.";
        header('Location: index.php'); // Redirige al login tras el registro exitoso
        exit;
    } else {
        echo "Error al registrar el usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="css/estiloGeneral.css">
</head>
<body>
    <div class="register-container">
        <h1>Registrate</h1>
        <form method="post" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>

            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <label for="rol">Selecciona tu rol:</label>
            <select id="rol" name="rol" required>
                <option value="alumno">Alumno</option>
                <option value="profesor">Profesor</option>
            </select>

            <button type="submit">Crear Cuenta</button>
        </form>

        <!-- Enlace para regresar al login -->
        <p>¿Ya tienes una cuenta? <a href="index.php">Iniciar sesión</a></p>
    </div>
</body>
</html>
