<?php
class Clase {
    private $pdo;
    private $id_profesor;
    private $id_materia;
    private $id_clase;
    
    public function __construct($pdo, $id_profesor, $id_materia, $id_clase) {
        $this->pdo = $pdo;
        $this->id_profesor = $id_profesor;
        $this->id_materia = $id_materia;
        $this->id_clase = $id_clase;
    }
    
    public function generarQR() {
        $urlQR = "http://192.168.2.111/Asistencia/pruebaqr/asistencia_registrar.php?clase_id=" . $this->id_clase;
        
        // Asumiendo que usas la biblioteca Picqer Barcode Generator
        $generator = new barcode_generator();
        return $generator->render_svg('qr', $urlQR, [
            'w' => 300,
            'h' => 300,
            'bc' => '#00f2df', // color de fondo
            'cs' => '#000000', // color de los espacios
            'cm' => '#ffffff', // color de los módulos
            'ms' => 's' // s: square, r: round, x: cross
        ]);
    }
}


require '../pruebaqr/barcode-master/barcode.php';
session_start();

$profesor_id = $_SESSION['id'];
$clase_id = 1; // Obtener dinámicamente el ID de la clase actual
$materia_id = 1; // Obtener el ID de la materia correspondiente

$clase = new Clase($pdo, $profesor_id, $materia_id, $clase_id);
echo $clase->generarQR();


?>
