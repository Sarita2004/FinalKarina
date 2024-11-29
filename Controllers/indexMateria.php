<?php
require_once __DIR__ . '/../Model/Materia.php';

$materias = Materia::all();

require_once __DIR__ . '/../View/indexMateria.view.php';