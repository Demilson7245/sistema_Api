<?php

// Captura de la ruta desde la barra "/"
$array = array_values(array_filter(explode("/", $_SERVER["REQUEST_URI"])));

// Manejo de la solicitud raíz
if (empty($array[1])) {
   // echo json_encode(array("detalle" => "Sin Solicitudes"));
} else {
    switch ($array[1]) {
        case "pacientes":
            handlePacientesRequest($array);
            break;
        case "medicos":
            handleMedicosRequest($array);
            break;
        case "citas":
            handleCitasRequest($array);
            break;
        default:
            http_response_code(404);
            echo json_encode(array("detalle" => "Ruta no encontrada"));
    }
}

function handlePacientesRequest($array) {
    $pacientes = new ControladorPaciente();

    switch ($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            if (isset($array[2])) {
                $pacientes->show($array[2]);
            } else {
                $pacientes->index();
            }
            break;
        case "POST":
            $pacientes->create();
            break;
        case "PUT":
            if (isset($array[2])) {
                $pacientes->update($array[2]);
            } else {
                http_response_code(400);
                echo json_encode(array("detalle" => "ID requerido para actualizar"));
            }
            break;
        case "DELETE":
            if (isset($array[2])) {
                $pacientes->delete($array[2]);
            } else {
                http_response_code(400);
                echo json_encode(array("detalle" => "ID requerido para eliminar"));
            }
            break;
        default:
            http_response_code(405);
            echo json_encode(array("detalle" => "Método no permitido"));
    }
}

function handleMedicosRequest($array) {
    $medicos = new ControladorMedico();

    if (isset($array[2]) && $array[2] == "auth" && $_SERVER["REQUEST_METHOD"] == "POST") {
        $medicos->authenticate();
        return;
    }

    switch ($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            if (isset($array[2])) {
                $medicos->show($array[2]);
            } else {
                $medicos->index();
            }
            break;
        case "POST":
            $medicos->create();
            break;
        case "PUT":
            if (isset($array[2])) {
                $medicos->update($array[2]);
            } else {
                http_response_code(400);
                echo json_encode(array("detalle" => "ID requerido para actualizar"));
            }
            break;
        case "DELETE":
            if (isset($array[2])) {
                $medicos->delete($array[2]);
            } else {
                http_response_code(400);
                echo json_encode(array("detalle" => "ID requerido para eliminar"));
            }
            break;
        default:
            http_response_code(405);
            echo json_encode(array("detalle" => "Método no permitido"));
    }
}

function handleCitasRequest($array) {
    $citas = new ControladorCita();

    switch ($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            if (isset($array[2])) {
                $citas->show($array[2]);
            } else {
                $citas->index();
            }
            break;
        case "POST":
            $citas->create();
            break;
        case "PUT":
            if (isset($array[2])) {
                $citas->update($array[2]);
            } else {
                http_response_code(400);
                echo json_encode(array("detalle" => "ID requerido para actualizar"));
            }
            break;
        case "DELETE":
            if (isset($array[2])) {
                $citas->delete($array[2]);
            } else {
                http_response_code(400);
                echo json_encode(array("detalle" => "ID requerido para eliminar"));
            }
            break;
        default:
            http_response_code(405);
            echo json_encode(array("detalle" => "Método no permitido"));
    }
}

?>