<?php

require_once __DIR__ . '/../Model/Profesor.php';

if (isset($_POST['enviarFormulario'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $DNI = $_POST['DNI'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $calle = $_POST['calle'];
    $nro = $_POST['nro'];
    $codigo_postal = $_POST['codigo_postal'];
    $estado_civil = $_POST['estado_civil'];
    $genero = $_POST['genero'];

    $profesor = new Profesor();
    $profesor->nombre = $nombre;
    $profesor->apellido = $apellido;
    $profesor->DNI = $DNI;
    $profesor->fecha_nacimiento = $fecha_nacimiento;
    $profesor->telefono = $telefono;
    $profesor->calle = $calle;
    $profesor->nro = $nro;
    $profesor->codigo_postal = $codigo_postal;
    $profesor->estado_civil = $estado_civil;
    $profesor->genero = $genero;
    $profesor->create();

    
    header('Location: indexProfesor.php');
    exit();
} 

require_once __DIR__ . '/../View/createProfesor.view.php'; 