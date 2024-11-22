<?php
// Funciones reutilizables, como validar el rol de usuario
function validarSesion($rolRequerido) {
    if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== $rolRequerido) {
        header('Location: index.php');
        exit();
    }
}
?>
