<?php


class ControladorPaciente {

    public function index() {
        $pacientes = ModeloPaciente::index("pacientes");
        echo json_encode($pacientes);
    }


    public function show($id) {
        $paciente = ModeloPaciente::show("pacientes", $id);
        if ($paciente) {
            echo json_encode($paciente);
        } else {
            http_response_code(404);
            echo json_encode(array("detalle" => "Paciente no encontrado"));
        }
    }





    // public function create() {
        
    //     // Obtener los datos del JSON de la solicitud
    //     $data = json_decode(file_get_contents("php://input"), true);

    //     // Enviar los datos al modelo para crear el nuevo paciente
    //     ModeloPaciente::create("pacientes", $data);
    //    // $id =ModeloPaciente::create("pacientes", $data);

    //     // Respuesta con el ID del nuevo paciente y mensaje de éxito
    //     http_response_code(201);
    //     echo json_encode([
    //        // "id" => $id,
    //         "mensaje" => "Creado correctamente"
    //     ]);
    // }
    public function create() {
        // Obtener los datos del JSON de la solicitud
        $data = json_decode(file_get_contents("php://input"), true);
    
        // Verificar si los datos son válidos
        if (!$data || empty($data['nombre']) || empty($data['apellido']) || empty($data['fecha_nacimiento']) || 
            empty($data['direccion']) || empty($data['telefono']) || empty($data['correo'])) {
            http_response_code(400);
            echo json_encode(["mensaje" => "Todos los campos son obligatorios."]);
            return;
        }
    
        // Enviar los datos al modelo para crear el nuevo paciente
        $resultado = ModeloPaciente::create("pacientes", $data);
    
        if ($resultado) {
            // Respuesta con el ID del nuevo paciente y mensaje de éxito
            http_response_code(201);
            echo json_encode(["mensaje" => "Creado correctamente"]);
        } else {
            // Error al crear el paciente
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al crear el paciente"]);
        }
    }


    public function update($id) {
        // Obtener los datos del JSON de la solicitud
        $data = json_decode(file_get_contents("php://input"), true);

        // Llamar al modelo para actualizar el paciente
        $resultado = ModeloPaciente::update("pacientes", $id, $data);

        // Enviar la respuesta dependiendo del resultado
        if ($resultado) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Actualizado correctamente"]);
        } else {
            http_response_code(400);
            echo json_encode(["mensaje" => "Error al actualizar el paciente"]);
        }
    }



    
    public function delete($id) {
        if (ModeloPaciente::delete("pacientes", $id)) {
            echo json_encode(array("detalle" => "Paciente eliminado correctamente"));
        } else {
            http_response_code(404);
            echo json_encode(array("detalle" => "Paciente no encontrado o no se pudo eliminar"));
        }
    }
}
?>
