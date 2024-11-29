<?php
require_once __DIR__ . '/../Model/Profesor.php';

$profesores = Profesor::all();

require_once __DIR__ . '/../View/indexProfesor.view.php';