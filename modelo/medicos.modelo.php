<?php
require_once "conexion.php";

class ModeloMedico
{
    public static function index($tabla) {
        $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public static function getByUsername($username) {
        $stmt = conexion::conectar()->prepare("SELECT * FROM medicos WHERE username = :username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function show($tabla, $id) {
        $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function create($tabla, $data) {
        $conexion = conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO $tabla (nombre, apellido, especialidad, telefono, correo, username, password) 
                                    VALUES (:nombre, :apellido, :especialidad, :telefono, :correo, :username, :password)");
        try {
            $stmt->execute([
                ":nombre" => $data['nombre'],
                ":apellido" => $data['apellido'],
                ":especialidad" => $data['especialidad'],
                ":telefono" => $data['telefono'],
                ":correo" => $data['correo'],
                ":username" => $data['username'],
                ":password" => password_hash($data['password'], PASSWORD_DEFAULT)
            ]);
            return $conexion->lastInsertId();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    public static function update($tabla, $id, $data) {
        $conexion = conexion::conectar();
    
        // Verifica si se proporciona una nueva contraseña y hashea la contraseña si es necesario
        $passwordQuery = "";
        $params = [
            ":id" => $id,
            ":nombre" => $data['nombre'],
            ":apellido" => $data['apellido'],
            ":especialidad" => $data['especialidad'],
            ":telefono" => $data['telefono'],
            ":correo" => $data['correo']
        ];
    
        // Solo agrega la contraseña a la consulta si se proporciona
        if (!empty($data['password'])) {
            $passwordQuery = ", password = :password";
            $params[":password"] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
    
        // Actualiza la consulta para incluir la contraseña si se proporciona
        $stmt = $conexion->prepare("UPDATE $tabla SET nombre = :nombre, apellido = :apellido, especialidad = :especialidad, 
                                    telefono = :telefono, correo = :correo $passwordQuery WHERE id = :id");
        try {
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    

    public static function delete($tabla, $id) {
        $stmt = conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>