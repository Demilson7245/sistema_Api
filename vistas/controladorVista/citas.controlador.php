<?php
class ControladorCita{

    public function index(){
        $citas = ModeloCita::index("citas");
        echo json_encode($citas);
    }

    public function show($id) {
        $citas = ModeloCita::show("citas", $id);
        if ($citas) {
            echo json_encode($citas);
        } else {
            http_response_code(404);
            echo json_encode(array("detalle" => "Cita no encontrado"));
        }
    }

    public function create() {
        // Obtener los datos del JSON de la solicitud
        $data = json_decode(file_get_contents("php://input"), true);

        // Enviar los datos al modelo para crear el nuevo médico
        $id = ModeloCita::create("citas", $data); // Aquí suponemos que el modelo se llama ModeloMedico

        // Respuesta con el ID del nuevo médico y mensaje de éxito
        http_response_code(201);
        echo json_encode([
           // "id" => $id, 
            "mensaje" => "Creado correctamente"
        ]);
    }

    public function update($id) {
        // Obtener los datos del JSON de la solicitud
        $data = json_decode(file_get_contents("php://input"), true);

        // Llamar al modelo para actualizar el paciente
        $resultado = ModeloCita::update(" citas", $id, $data);

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
        if (ModeloCita::delete("citas", $id)) {
            echo json_encode(array("detalle" => "Cita eliminado correctamente"));
        } else {
            http_response_code(404);
            echo json_encode(array("detalle" => "Cita no encontrado o no se pudo eliminar"));
        }
    }



}






?>