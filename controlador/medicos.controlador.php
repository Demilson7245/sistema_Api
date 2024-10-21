<?php
class ControladorMedico
{
    public function index() {
        $medicos = ModeloMedico::index("medicos");
        echo json_encode($medicos);
    }

    public function authenticate() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data['username']) || empty($data['password'])) {
            http_response_code(400);
            echo json_encode(array("detalle" => "Usuario y contraseña son requeridos"));
            return;
        }
        $username = $data['username'];
        $password = $data['password'];
        $medico = ModeloMedico::getByUsername($username);
        if ($medico && password_verify($password, $medico->password)) {
            http_response_code(200);
            echo json_encode($medico);
        } else {
            http_response_code(401);
            echo json_encode(array("detalle" => "Credenciales incorrectas"));
        }
    }

    public function show($id) {
        $medico = ModeloMedico::show("medicos", $id);
        if ($medico) {
            echo json_encode($medico);
        } else {
            http_response_code(404);
            echo json_encode(array("detalle" => "Medico no encontrado"));
        }
    }

    public function create() {
        $data = json_decode(file_get_contents("php://input"), true);
        if ($this->validateMedicoData($data)) {
            try {
                if (ModeloMedico::create("medicos", $data)) {
                    http_response_code(201);
                    echo json_encode(["mensaje" => "Creado correctamente"]);
                } else {
                    http_response_code(400);
                    echo json_encode(["mensaje" => "Error al crear el medico"]);
                }
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(["mensaje" => "Error interno del servidor", "error" => $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["mensaje" => "Datos incompletos"]);
        }
    }

    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        if (ModeloMedico::update("medicos", $id, $data)) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Actualizado correctamente"]);
        } else {
            http_response_code(400);
            echo json_encode(["mensaje" => "Error al actualizar el medico"]);
        }
    }

    public function delete($id) {
        if (ModeloMedico::delete("medicos", $id)) {
            echo json_encode(array("detalle" => "Medico eliminado correctamente"));
        } else {
            http_response_code(404);
            echo json_encode(array("detalle" => "Medico no encontrado"));
        }
    }

    private function validateMedicoData($data) {
        return !empty($data['nombre']) && !empty($data['apellido']) && !empty($data['especialidad']) &&
               !empty($data['telefono']) && !empty($data['correo']) && !empty($data['username']) &&
               !empty($data['password']);
    }
}

?>