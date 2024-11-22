<?php
require '../includes/conexion.php'; 
// Obtener datos del formulario
$email = $_POST['email'];
$materias = $_POST['materias'] ?? [];


$query_usuario = "SELECT id FROM usuarios WHERE email = ?";
$stmt_usuario = $conn->prepare($query_usuario);
$stmt_usuario->bind_param("s", $email);
$stmt_usuario->execute();
$resultado_usuario = $stmt_usuario->get_result();
$usuario = $resultado_usuario->fetch_assoc();

if ($usuario && count($materias) > 0) {
    $usuario_id = $usuario['id'];

    
    $query_asignacion = "INSERT INTO usuario_materia (id_usuario, id_materia) VALUES (?, ?)";
    $stmt_asignacion = $conn->prepare($query_asignacion);

    foreach ($materias as $materia_id) {
        $stmt_asignacion->bind_param("ii", $usuario_id, $materia_id);
        $stmt_asignacion->execute();
    }

    echo "Materias asignadas correctamente al usuario.";
} else {
    echo "Usuario no encontrado o no se seleccionaron materias.";
}


$stmt_usuario->close();
$stmt_asignacion->close();
$conn->close();
?>
