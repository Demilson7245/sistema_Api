<?php
require_once "conexion.php";

class ModeloPaciente {

    public static function index($tabla) {
        $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public static function show($tabla, $id) {
        $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function create($tabla, $data) {
        try {
            $conexion = conexion::conectar();
            $stmt = $conexion->prepare(
                "INSERT INTO $tabla (nombre, apellido, fecha_nacimiento, direccion, telefono, correo) 
                VALUES (:nombre, :apellido, :fecha_nacimiento, :direccion, :telefono, :correo)"
            );

            $stmt->execute([
                ":nombre" => $data['nombre'],
                ":apellido" => $data['apellido'],
                ":fecha_nacimiento" => $data['fecha_nacimiento'],
                ":direccion" => $data['direccion'],
                ":telefono" => $data['telefono'],
                ":correo" => $data['correo']
            ]);

            return true;
        } catch (PDOException $e) {
            error_log("Error en la inserción: " . $e->getMessage());
            return false;
        }
    }

    public static function update($tabla, $id, $data) {
        $stmt = conexion::conectar()->prepare(
            "UPDATE $tabla SET 
                nombre = :nombre, 
                apellido = :apellido, 
                fecha_nacimiento = :fecha_nacimiento, 
                direccion = :direccion, 
                telefono = :telefono, 
                correo = :correo 
            WHERE id = :id"
        );

        return $stmt->execute([
            ":nombre" => $data['nombre'],
            ":apellido" => $data['apellido'],
            ":fecha_nacimiento" => $data['fecha_nacimiento'],
            ":direccion" => $data['direccion'],
            ":telefono" => $data['telefono'],
            ":correo" => $data['correo'],
            ":id" => $id
        ]);
    }

    public static function delete($tabla, $id) {
        $stmt = conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
