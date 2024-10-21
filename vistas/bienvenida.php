<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redirigir al login si no ha iniciado sesión
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="stylo/bienvenida.css"> <!-- Asegúrate de que la ruta sea correcta -->
</head>
<body>
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    <div class="menu" id="menu"  style="height: 100%;" >
        <h2>Menú</h2>
        <a href="citas.php">Citas</a>
        <a href="pacientes/listar.php">Pacientes</a>
        <a href="medicos.php">Médicos</a>
        <a href="logout.php">Cerrar Sesión</a>
    </div>

    <div class="contenido">
        <h1>Hola, <?php echo $_SESSION['usuario']->nombre; ?>. Bienvenido!</h1>
        <p>Esta es la página de bienvenida donde puedes acceder a diferentes secciones del sistema.</p>
    </div>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('active');
        }
    </script>
</body>
</html>
