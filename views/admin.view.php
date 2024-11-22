<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador</title>
    <link rel="stylesheet" href="admincss.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Administrador</h2>
            <ul>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="createAlumno.php">Agregar Alumno</a></li>
                <li><a href="createProfesor.php">Agregar Profesor</a></li>
                <li><a href="deleteAlumno.php">Eliminar Alumno</a></li>
                <li><a href="deleteProfesor.php">Eliminar Profesor</a></li>
            </ul>
        </div>

        <!-- Panel principal -->
        <div class="main-content">
            <!-- Barra superior -->
            <div class="top-bar">
                <div class="user-info">
                    <img src="profile_pic.png" alt="Foto de perfil" class="profile-pic">
                    <span>Admin</span>
                </div>
            </div>

            
            <div class="main-section">
                
                <div class="card">
                    
                   <h3> <a href="actualizarAlumno.php">Actualizar Informacion</a></h3>
                </div>

                <div class="card">
                    
                    <h3><a href="usuario_materia.php">Asignar Materias</a></h3>
                </div>

               
                <div class="card delete-card">
                    <h3><a href="eliminarUsuario.php">Eliminar Usuario</a></h3>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
