<?php

require_once 'Conexion.php';
require_once 'Materia.php';

class Usuario extends Conexion
{
    public $id, $nombre, $apellido, $email, $DNI, $fecha_nacimiento, $telefono, $calle, $nro, $codigo_postal, $estado_civil, $genero, $rol;

    // Crear un nuevo usuario
    public function create()
    {
        $this->conectar();
        $pre = mysqli_prepare($this->con, "INSERT INTO usuarios (nombre, apellido, email, DNI, fecha_nacimiento, telefono, calle, nro, codigo_postal, estado_civil, genero, rol) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $pre->bind_param(
            "ssssisisiiss",
            $this->nombre,
            $this->apellido,
            $this->email,
            $this->DNI,
            $this->fecha_nacimiento,
            $this->telefono,
            $this->calle,
            $this->nro,
            $this->codigo_postal,
            $this->estado_civil,
            $this->genero,
            $this->rol // Asignamos el rol (alumno, profesor, etc.)
        );
        $pre->execute();
    }

    // Obtener todos los usuarios por rol
    public static function all($rol = null)
    {
        $conexion = new Conexion();
        $conexion->conectar();
        $sql = "SELECT * FROM usuarios";
        if ($rol) {
            $sql .= " WHERE rol = ?";
        }
        $result = mysqli_prepare($conexion->con, $sql);
        if ($rol) {
            $result->bind_param("s", $rol);  // Filtramos por rol si se especifica
        }
        $result->execute();
        $valoresDb = $result->get_result();
        $usuarios = [];
        while ($usuario = $valoresDb->fetch_object(Usuario::class)) {
            $usuarios[] = $usuario;
        }
        return $usuarios;
    }

    // Obtener un usuario por ID
    public static function getById($id)
    {
        $conexion = new Conexion();
        $conexion->conectar();
        $result = mysqli_prepare($conexion->con, "SELECT * FROM usuarios WHERE id = ?");
        $result->bind_param("i", $id);
        $result->execute();
        $valorDb = $result->get_result();
        $usuario = $valorDb->fetch_object(Usuario::class);
        return $usuario;
    }

    // Eliminar un usuario
    public function delete()
    {
        $this->conectar();
        $pre = mysqli_prepare($this->con, "DELETE FROM usuarios WHERE id = ?");
        $pre->bind_param("i", $this->id);
        $pre->execute();
    }

    // Actualizar los datos de un usuario
    public function update()
    {
        $this->conectar();
        $pre = mysqli_prepare($this->con, "UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, DNI = ?, telefono = ?, calle = ?, numero = ?, codigo_postal = ?, estado_civil = ?, genero = ?, rol = ? WHERE id = ?");
        $pre->bind_param(
            "ssssiisiissi",
            $this->nombre,
            $this->apellido,
            $this->email,
            $this->DNI,
            $this->telefono,
            $this->calle,
            $this->numero,
            $this->codigo_postal,
            $this->estado_civil,
            $this->genero,
            $this->rol,
            $this->id
        );
        $pre->execute();
    }

    // Obtener las materias asignadas a un usuario (alumno o profesor)
    public function materias()
    {
        $this->conectar();
        $result = mysqli_prepare($this->con, "SELECT * FROM materias INNER JOIN usuario_materia ON materias.id_materia = usuario_materia.id_materia WHERE usuario_materia.id_usuario = ?");
        $result->bind_param("i", $this->id);
        $result->execute();
        $valoresDb = $result->get_result();
        $materias = [];
        while ($materia = $valoresDb->fetch_object(Materia::class)) {
            $materias[] = $materia;
        }
        return $materias;
    }

    // Desasignar todas las materias de un usuario
    public function desasignarTodasLasMaterias()
    {
        $this->conectar();
        $pre = mysqli_prepare($this->con, "DELETE FROM usuario_materia WHERE id_usuario = ?");
        $pre->bind_param("i", $this->id);
        $pre->execute();
    }

    // Asignar una materia a un usuario (alumno o profesor)
    public function asignarMateria($id_materia)
    {
        $this->conectar();
        $pre = mysqli_prepare($this->con, "INSERT INTO usuario_materia (id_usuario, id_materia) VALUES (?, ?)");
        $pre->bind_param("ii", $this->id, $id_materia);
        $pre->execute();
    }
}
?>
