<?php

require_once "conexion.php";

class ModeloPaciente {

    // Método para obtener todos los pacientes
    public static function index($tabla) {
        $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS); 
    }


    // Método para obtener un paciente por ID
    public static function show($tabla, $id) {
        $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ); // Retorna un solo resultado
    }


public static function create($tabla, $data) {
    try {
        $conexion = conexion::conectar();
        $stmt = $conexion->prepare(
            "INSERT INTO $tabla (nombre, apellido, fecha_nacimiento, direccion, telefono, correo) 
            VALUES (:nombre, :apellido, :fecha_nacimiento, :direccion, :telefono, :correo)"
        );

        // Asociar los datos con los parámetros de la consulta
        $stmt->execute([
            ":nombre" => $data['nombre'],
            ":apellido" => $data['apellido'],
            ":fecha_nacimiento" => $data['fecha_nacimiento'],
            ":direccion" => $data['direccion'],
            ":telefono" => $data['telefono'],
            ":correo" => $data['correo']
        ]);

        // Retornar verdadero si la inserción fue exitosa
        return true;
    } catch (PDOException $e) {
        // Manejo de errores
        error_log("Error en la inserción: " . $e->getMessage());
        return false;
    }
}



// Método para actualizar un paciente
public static function update($tabla, $id, $data) {
    $conexion = conexion::conectar();
    $stmt = $conexion->prepare(
        "UPDATE $tabla SET 
            nombre = :nombre, 
            apellido = :apellido, 
            fecha_nacimiento = :fecha_nacimiento, 
            direccion = :direccion, 
            telefono = :telefono, 
            correo = :correo 
        WHERE id = :id"
    );

    // Arreglo con los datos para la actualización
    $array = [
        ":nombre" => $data['nombre'],
        ":apellido" => $data['apellido'],
        ":fecha_nacimiento" => $data['fecha_nacimiento'],
        ":direccion" => $data['direccion'],
        ":telefono" => $data['telefono'],
        ":correo" => $data['correo'],
        ":id" => $id
    ];

    // Vinculación de los array y ejecución
    return $stmt->execute($array); 
}


    // Método para eliminar un paciente
    public static function delete($tabla, $id) {
        $stmt = conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute(); // Devuelve verdadero si se eliminó correctamente
    }
}
?>
