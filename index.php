<?php
// Iniciar la sesión al principio del archivo
session_start();

// Requerir controladores
require_once "controlador/rutas.controlador.php";
require_once "controlador/citas.controlador.php";
require_once "controlador/pacientes.controlador.php";
require_once "controlador/medicos.controlador.php";
require_once "vistas/controladorVistas/medicos.controlador.php";
require_once "vistas/modeloVista/medicos.modelo.php";
// Requerir modelos
require_once "modelo/pacientes.modelo.php";
require_once "modelo/medicos.modelo.php";
require_once "modelo/citas.modelo.php";

// Verificar el método de la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "modelo/medicos.modelo.php"; // Asegúrate de que el modelo esté incluido

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Obtener el médico por su nombre de usuario
    $medico = ModeloMedico::getByUsername($username);

    // Validar las credenciales
    if ($medico && password_verify($password, $medico->password)) {
        // Guardar información del usuario en la sesión
        $_SESSION['usuario'] = $medico;
        header("Location: vistas/bienvenida.php");
        exit;
    } else {
        $error = "Credenciales incorrectas.";
    }
}

// Iniciar el enrutador
$rutas = new controladorRutas();
$rutas->inicio();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="vistas/stylo/sty.css">
</head>
<body>
    <div class="login-container">
       <div>
        <h1>Clinica Labosur</h1>
        <img  class="imagen" src="vistas/imagenes/logo.png" alt="">    
        </div>
        <?php if (isset($error)) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username"  required>
            <br>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>
</body>
</html>
