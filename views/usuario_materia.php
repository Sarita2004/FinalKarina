<?php

require '../includes/conexion.php';

$query_materias = "SELECT id_materia, nombre FROM materias";
$resultado_materias = $conn->query($query_materias);
?>

<h2>Asignar Materias a Usuario</h2>

<form action="asignar_materias.php" method="POST">
    <label for="email">Email del Usuario:</label>
    <input type="email" name="email" required>
    
    <h3>Selecciona las Materias</h3>
    <?php while ($materia = $resultado_materias->fetch_assoc()): ?>
        <label>
            <input type="checkbox" name="materias[]" value="<?php echo $materia['id_materia']; ?>">
            <?php echo $materia['nombre']; ?>
        </label><br>
    <?php endwhile; ?>
    
    <button type="submit">Asignar Materias</button>
</form>

<?php
$conn->close();
?>
