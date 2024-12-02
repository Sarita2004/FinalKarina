<?php
session_start();
require_once '../includes/conexion.php';

// Verificar si el usuario ha iniciado sesión y es profesor
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'profesor') {
    header('Location: ../index.php');
    exit();
}

// Obtener los datos del formulario
$notas = isset($_POST['notas']) ? $_POST['notas'] : [];
$materia_id = isset($_POST['id_materia']) ? intval($_POST['id_materia']) : null;

if (!$materia_id || empty($notas)) {
    echo "Datos inválidos.";
    exit();
}

// Iterar sobre las notas recibidas
foreach ($notas as $alumno_id => $nota) {
    $nota_parcial_1 = isset($nota['nota_parcial_1']) ? floatval($nota['nota_parcial_1']) : null;
    $nota_parcial_2 = isset($nota['nota_parcial_2']) ? floatval($nota['nota_parcial_2']) : null;
    $nota_final = isset($nota['nota_final']) ? floatval($nota['nota_final']) : null;

    // Verificar si ya existe un registro para este alumno y materia
    $stmtCheck = $conn->prepare("SELECT id FROM notas WHERE id_alumno = ? AND id_materia = ?");
    $stmtCheck->bind_param("ii", $alumno_id, $materia_id);
    $stmtCheck->execute();
    $registro_existente = $stmtCheck->get_result()->fetch_assoc();
    $stmtCheck->close();

    if ($registro_existente) {
        // Si el registro ya existe, realizar un UPDATE
        $stmtUpdate = $conn->prepare("
            UPDATE notas 
            SET nota_parcial_1 = IFNULL(?, nota_parcial_1), 
                nota_parcial_2 = IFNULL(?, nota_parcial_2), 
                nota_final = IFNULL(?, nota_final)
            WHERE id_alumno = ? AND id_materia = ?
        ");
        $stmtUpdate->bind_param("dddii", $nota_parcial_1, $nota_parcial_2, $nota_final, $alumno_id, $materia_id);
        $stmtUpdate->execute();
        $stmtUpdate->close();
    } else {
        // Si no existe, realizar un INSERT
        $stmtInsert = $conn->prepare("
            INSERT INTO notas (id_alumno, id_materia, nota_parcial_1, nota_parcial_2, nota_final) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmtInsert->bind_param("iiddi", $alumno_id, $materia_id, $nota_parcial_1, $nota_parcial_2, $nota_final);
        $stmtInsert->execute();
        $stmtInsert->close();
    }
}

$conn->close();
header("Location: materia_detalle.php?id=$materia_id");
exit();
