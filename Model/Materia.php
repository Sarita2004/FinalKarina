<?php

require_once 'Conexion.php';

class Materia extends Conexion
{
    public $id_materia, $nombre, $carga_horaria;

    // Crear una nueva materia
    public function create()
    {
        $this->conectar();
        $pre = mysqli_prepare($this->con, "INSERT INTO materias (nombre, carga_horaria) VALUES (?,?)");
        $pre->bind_param(
            "si",
            $this->nombre,
            $this->carga_horaria
        );
        $pre->execute();
    }

    // Obtener todas las materias
    public static function all()
    {
        $conexion = new Conexion();
        $conexion->conectar();
        $result = mysqli_prepare($conexion->con, "SELECT * FROM materias");
        $result->execute();
        $valoresDb = $result->get_result();
        $materias = [];
        while ($materia = $valoresDb->fetch_object(Materia::class)) {
            $materias[] = $materia;
        }
        return $materias;
    }

    // Obtener una materia por su ID
    public static function getById($id_materia)
    {
        $conexion = new Conexion();
        $conexion->conectar();
        $result = mysqli_prepare($conexion->con, "SELECT * FROM materias WHERE id_materia = ?");
        $result->bind_param("i", $id_materia);
        $result->execute();
        $valorDb = $result->get_result();
        $materia = $valorDb->fetch_object(Materia::class);
        return $materia;
    }

    // Eliminar una materia
    public function delete()
    {
        $this->conectar();
        $pre = mysqli_prepare($this->con, "DELETE FROM materias WHERE id_materia = ?");
        $pre->bind_param("i", $this->id_materia);
        $pre->execute();
    }

    // Actualizar los detalles de una materia
    public function update()
    {
        $this->conectar();
        $pre = mysqli_prepare($this->con, "UPDATE materias SET nombre = ?, carga_horaria = ? WHERE id_materia = ?");
        $pre->bind_param(
            "sii",
            $this->nombre,
            $this->carga_horaria,
            $this->id_materia
        );
        $pre->execute();
    }

    // Obtener los profesores asignados a una materia
    public function profesores()
    {
        $this->conectar();
        $result = mysqli_prepare($this->con, "SELECT usuarios.id, usuarios.nombre, usuarios.apellido FROM usuarios 
            INNER JOIN usuarios_materias ON usuarios.id = usuarios_materias.id_usuario 
            WHERE usuarios_materias.id_materia = ? AND usuarios_materias.rol = 'profesor'");
        $result->bind_param("i", $this->id_materia);
        $result->execute();
        $valoresDb = $result->get_result();

        $profesores = [];
        while ($profesor = $valoresDb->fetch_object()) {
            $profesores[] = $profesor;
        }

        return $profesores;
    }

    // Asignar un profesor a una materia
    public function asignarProfesor($id_profesor)
    {
        $this->conectar();
        $pre = mysqli_prepare($this->con, "INSERT INTO usuarios_materias (id_usuario, id_materia, rol) VALUES (?, ?, 'profesor')");
        $pre->bind_param("ii", $id_profesor, $this->id_materia);
        $pre->execute();
    }

    // Desasignar un profesor de una materia
    public function desasignarProfesor($id_profesor)
    {
        $this->conectar();
        $pre = mysqli_prepare($this->con, "DELETE FROM usuarios_materias WHERE id_usuario = ? AND id_materia = ? AND rol = 'profesor'");
        $pre->bind_param("ii", $id_profesor, $this->id_materia);
        $pre->execute();
    }

    // Obtener los alumnos asignados a una materia
    public function alumnos()
    {
        $this->conectar();
        $result = mysqli_prepare($this->con, "SELECT usuarios.id, usuarios.nombre, usuarios.apellido FROM usuarios 
            INNER JOIN usuarios_materias ON usuarios.id = usuarios_materias.id_usuario 
            WHERE usuarios_materias.id_materia = ? AND usuarios_materias.rol = 'alumno'");
        $result->bind_param("i", $this->id_materia);
        $result->execute();
        $valoresDb = $result->get_result();
        $alumnos = [];
        while ($alumno = $valoresDb->fetch_object()) {
            $alumnos[] = $alumno;
        }

        return $alumnos;
    }

    // Asignar un alumno a una materia
    public function asignarAlumno($id_alumno)
    {
        $this->conectar();
        $pre = mysqli_prepare($this->con, "INSERT INTO usuarios_materias (id_usuario, id_materia, rol) VALUES (?, ?, 'alumno')");
        $pre->bind_param("ii", $id_alumno, $this->id_materia);
        $pre->execute();
    }

    // Desasignar un alumno de una materia
    public function desasignarAlumno($id_alumno)
    {
        $this->conectar();
        $pre = mysqli_prepare($this->con, "DELETE FROM usuarios_materias WHERE id_usuario = ? AND id_materia = ? AND rol = 'alumno'");
        $pre->bind_param("ii", $id_alumno, $this->id_materia);
        $pre->execute();
    }
}
