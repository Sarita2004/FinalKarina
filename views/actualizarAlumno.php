<?php
require '../includes/conexion.php'; 



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    
    
    $consultaActual = $conn->prepare("SELECT DNI, area, telefono, codigo_postal, calle, numero, estado_civil, genero FROM usuarios WHERE email = ?");
    $consultaActual->bind_param("s", $email);
    $consultaActual->execute();
    $datosActuales = $consultaActual->get_result()->fetch_assoc();
    
    if (!$datosActuales) {
        echo "Usuario no encontrado.";
        exit;
    }

    
    $dni = !empty($_POST['dni']) ? $_POST['dni'] : $datosActuales['dni'];
    $area= !empty($_POST['area']) ? $_POST['area'] : $datosActuales['area'];
    $telefono = !empty($_POST['telefono']) ? $_POST['telefono'] : $datosActuales['telefono'];
    $codigoPostal = !empty($_POST['codigo_postal']) ? $_POST['codigo_postal'] : $datosActuales['codigo_postal'];
    $calle = !empty($_POST['calle']) ? $_POST['calle'] : $datosActuales['calle'];
    $numero = !empty($_POST['numero']) ? $_POST['numero'] : $datosActuales['numero'];
    $estadoCivil = !empty($_POST['estado_civil']) ? $_POST['estado_civil'] : $datosActuales['estado_civil'];
    $genero = !empty($_POST['genero']) ? $_POST['genero'] : $datosActuales['genero'];
    $materia = !empty($_POST['materia'])? $_POST['materia'] : $datosActuales['materia'];

    // Actualizar los datos en la base de datos
    $stmt = $conn->prepare("UPDATE usuarios SET dni = ?, area = ?, telefono = ?, codigo_postal = ?, calle = ?, numero = ?, estado_civil = ?, genero = ? WHERE email = ?");
    $stmt->bind_param("sssssssss", $dni, $area, $telefono, $codigoPostal, $calle, $numero, $estadoCivil, $genero, $materia, $email);
    
    if ($stmt->execute()) {
        echo "Información actualizada correctamente.";
    } else {
        echo "Error al actualizar la información.";
    }

    $stmt->close();
    $consultaActual->close();
}

$conn->close();



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Información del Usuario</title>
    <link rel="stylesheet" href="Formulario.css"> <!-- Asegúrate de enlazar tu archivo CSS -->
</head>
<body>

<div class="container">
    <h1>Actualizar Información</h1>
    <form action="actualizarUsuario.php" method="post">
        <div class="form-grid">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Correo del usuario" required>

            <label for="dni">DNI</label>
            <input type="text" id="dni" name="dni" placeholder="DNI">

            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" placeholder="Teléfono">

            <label for="codigo_postal">Código Postal</label>
            <input type="text" id="codigo_postal" name="codigo_postal" placeholder="Código Postal">

            <label for="calle">Calle</label>
            <input type="text" id="calle" name="calle" placeholder="Calle">

            <label for="numero">Número</label>
            <input type="text" id="numero" name="numero" placeholder="Número">

            <label for="estado_civil">Estado Civil</label>
            <select id="estado_civil" name="estado_civil">
                <option value="">Seleccione</option>
                <option value="soltero">Soltero/a</option>
                <option value="casado">Casado/a</option>
                <option value="divorciado">Divorciado/a</option>
                <option value="viudo">Viudo/a</option>
            </select>

            <label for="genero">Género</label>
            <select id="genero" name="genero">
                <option value="">Seleccione</option>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="otro">Otro</option>
            </select>


            <button type="submit">Actualizar Información</button>
        </div>
    </form>
</div>

</body>
</html>

