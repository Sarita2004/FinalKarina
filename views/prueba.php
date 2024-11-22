<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escáner QR</title>
</head>
<body>
    <h1>Escanea tu código QR</h1>
    <button onclick="iniciarCamara()">Abrir Cámara</button>
    <button onclick="detenerCamara()">Detener Cámara</button>
    <video id="video" width="300" height="300" autoplay style="display: none;"></video>
    <p id="mensaje"></p>

    <script>
        let stream;

        async function iniciarCamara() {
            const video = document.getElementById('video');
            const mensaje = document.getElementById('mensaje');
            mensaje.textContent = "";  // Limpiar mensajes anteriores

            // Intentar acceder a la cámara
            try {
                stream = await navigator.mediaDevices.getUserMedia({
                    video: { facingMode: { ideal: 'environment' } } // Modo ideal para la cámara trasera
                });
                video.style.display = "block";  // Mostrar video
                video.srcObject = stream;
                mensaje.textContent = "Cámara activada.";
            } catch (error) {
                console.error("Error al abrir la cámara:", error);
                mensaje.textContent = "Error: No se puede acceder a la cámara. Verifica los permisos del navegador.";
            }
        }

        function detenerCamara() {
            const video = document.getElementById('video');
            const mensaje = document.getElementById('mensaje');
            video.style.display = "none"; // Ocultar el video

            // Detener los tracks si el stream está activo
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                mensaje.textContent = "Cámara detenida.";
            }
        }
    </script>
</body>
</html>
