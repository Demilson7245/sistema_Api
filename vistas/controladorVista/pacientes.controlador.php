<?php
require_once "../modeloVista/pacientes.modelo.php"; 

class ControladorPaciente {

    // Método para agregar un nuevo paciente
    public function create($data) {

        // Intentar agregar el paciente al modelo
        $resultado = ModeloPaciente::create("pacientes", $data);
        if ($resultado) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Paciente creado correctamente."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al crear el paciente."]);
        }
    }

    // Método para listar todos los pacientes
    public function index() {
        $pacientes = ModeloPaciente::index("pacientes");
        http_response_code(200);
        echo json_encode($pacientes);
    }

    // Método para mostrar un paciente específico por su ID
    public function show($id) {
        $paciente = ModeloPaciente::show("pacientes", $id);
        if ($paciente) {
            http_response_code(200);
            echo json_encode($paciente);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "Paciente no encontrado."]);
        }
    }

    // Método para actualizar un paciente por su ID
    public function update($id, $data) {
        // Validar que los datos son correctos y no están vacíos
        if (!$data || empty($data['nombre']) || empty($data['apellido']) || empty($data['fecha_nacimiento']) || 
            empty($data['direccion']) || empty($data['telefono']) || empty($data['correo'])) {
            http_response_code(400);
            echo json_encode(["mensaje" => "Todos los campos son obligatorios."]);
            return;
        }

        $resultado = ModeloPaciente::update("pacientes", $id, $data);
        if ($resultado) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Paciente actualizado correctamente."]);
        } else {
            http_response_code(400);
            echo json_encode(["mensaje" => "Error al actualizar el paciente."]);
        }
    }

    // Método para eliminar un paciente por su ID
    public function delete($id) {
        $resultado = ModeloPaciente::delete("pacientes", $id);
        if ($resultado) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Paciente eliminado correctamente."]);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "Paciente no encontrado o no se pudo eliminar."]);
        }
    }
}
?>
