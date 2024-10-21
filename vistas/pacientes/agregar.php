<?php
 require_once "../controladorVista/pacientes.controlador.php";
 require_once "../vista/modeloVista/pacientes.modelo.php";

// Lógica para agregar un paciente si se recibe el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        "nombre" => trim($_POST['nombre']),
        "apellido" => trim($_POST['apellido']),
        "fecha_nacimiento" => $_POST['fecha_nacimiento'],
        "direccion" => trim($_POST['direccion']),
        "telefono" => trim($_POST['telefono']),
        "correo" => filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL),
    ];

    $controladorPaciente = new ControladorPaciente();
    $resultado = $controladorPaciente->create($data);

    if ($resultado) {
        echo "<script>alert('Paciente agregado exitosamente'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error al agregar el paciente');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Paciente</title>
    <link rel="stylesheet" href="../stylo/agrP.css">
</head>

<body>
    <div class="container">
        <h1>Agregar Paciente</h1>
        <form method="POST" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required>

            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" required>

            <input type="submit" value="Agregar Paciente">
        </form>
    </div>
</body>

</html>