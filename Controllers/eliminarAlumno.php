<?php
require_once __DIR__ . '/../Model/Usuario.php';  // Cambié Alumno.php por Usuario.php

$id_usuario = $_GET['id'];  // Usamos id_usuario ya que ahora es la tabla 'usuarios'
$usuario = Usuario::getById($id_usuario);  // Obtenemos el usuario (antes alumno)

if ($usuario) {
    $usuario->delete();  // Eliminamos al usuario (antes alumno)
    header('Location: indexAlumno.php');  // Redirigimos a la página principal de alumnos
    exit();
}
?>
