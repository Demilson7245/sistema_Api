<?php
require_once "../controladorVista/pacientes.controlador.php"; 
require_once "../modeloVista/pacientes.modelo.php";

// Lógica para agregar un paciente si se recibe el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Filtrar y validar los datos recibidos
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = trim($_POST['direccion']);
    $telefono = trim($_POST['telefono']);
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);


    // Si hay errores, mostrarlos y no continuar
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<script>alert('$error');</script>";
        }
    } else {
        // Si no hay errores, intentar agregar el paciente
        $data = [
            "nombre" => $nombre,
            "apellido" => $apellido,
            "fecha_nacimiento" => $fecha_nacimiento,
            "direccion" => $direccion,
            "telefono" => $telefono,
            "correo" => $correo,
        ];

        $controladorPaciente = new ControladorPaciente();
        $resultado = $controladorPaciente->create($data);

        if ($resultado) {
            echo "<script>alert('Paciente agregado exitosamente'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Error al agregar el paciente');</script>";
        }
    }
}
?>



