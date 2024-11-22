<?php
class Asistencia {
    private $pdo;
    private $id_alumno;
    private $id_profesor;
    private $id_materia;
    
    public function __construct($pdo, $id_alumno, $id_profesor, $id_materia) {
        $this->pdo = $pdo;
        $this->id_alumno = $id_alumno;
        $this->id_profesor = $id_profesor;
        $this->id_materia = $id_materia;
    }
    
    public function registrar() {
        $sqlAsistencia = "INSERT INTO asistencias (id_alumno, id_profesor, id_materia, fecha) 
                          VALUES (?, ?, ?, NOW())";
        $stmtAsistencia = $this->pdo->prepare($sqlAsistencia);
        $stmtAsistencia->execute([$this->id_alumno, $this->id_profesor, $this->id_materia]);
        return "Asistencia registrada correctamente.";
    }
}
?>
