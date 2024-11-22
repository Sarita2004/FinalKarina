document.getElementById('generarQR').addEventListener('click', function() {
    // Genera un QR para una clase específica
    var qr = new QRious({
        element: document.getElementById('qrCode'),
        value: 'https://instituto.com/clase?profesor=JuanPérez', // URL única para la clase
        size: 200
    });
});

// Función para agregar alumno a la lista de presentes
function marcarPresente(alumno) {
    const lista = document.getElementById('alumnosPresentes');
    const nuevoAlumno = document.createElement('li');
    nuevoAlumno.textContent = alumno;
    lista.appendChild(nuevoAlumno);
}

// Ejemplo de cómo marcar presente
marcarPresente('Alumno 1');
marcarPresente('Alumno 2');
