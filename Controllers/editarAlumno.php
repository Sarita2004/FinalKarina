<?php
require_once __DIR__ . '/../Model/Usuario.php';

// Asegúrate de que el parámetro "id" está presente en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID de usuario no proporcionado");
}

$id_usuario = (int)$_GET['id']; // Convertimos a entero para mayor seguridad
$alumno = Usuario::getById($id_usuario); // Usamos $id_usuario correctamente

// Verificamos que el objeto $alumno exista
if (!$alumno) {
    die("Usuario no encontrado con el ID proporcionado");
}

if (isset($_POST['actualizarDatos'])) {
    // Recibimos los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $DNI = $_POST['DNI'];
    $telefono = $_POST['telefono'];
    $calle = $_POST['calle'];
    $nro = $_POST['nro'];
    $codigo_postal = $_POST['codigo_postal'];
    $estado_civil = $_POST['estado_civil'];
    $genero = $_POST['genero'];

    // Asignamos los valores al objeto alumno
    $alumno->nombre = $nombre;
    $alumno->apellido = $apellido;
    $alumno->email = $email;
    $alumno->DNI = $DNI;
    $alumno->telefono = $telefono;
    $alumno->calle = $calle;
    $alumno->nro = $nro;
    $alumno->codigo_postal = $codigo_postal;
    $alumno->estado_civil = $estado_civil;
    $alumno->genero = $genero;

    // Actualizamos los datos en la base de datos
    $alumno->update();

    // Redirigimos al listado de alumnos
    header('Location: indexAlumno.php');
    exit();
}

require_once __DIR__ . '/../View/editarAlumno.view.php';
