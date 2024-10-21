<?php
require_once "conexion.php";
class ModeloCita{

        // Método para obtener todos los medicos
        public static function index($tabla) {
            $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS); 
        }

        // Método para obtener mediante ID
        public static function show($tabla, $id) {
            $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

    
        // Método para crear una nuevea cita
        public static function create($tabla, $data) {
            $conexion = conexion::conectar();
            $stmt = $conexion->prepare(
                "INSERT INTO $tabla (paciente_id, medico_id, fecha_hora, motivo, estado) 
                VALUES (:paciente_id, :medico_id, :fecha_hora, :motivo, :estado)"
            );

            // Asociar los datos con los parámetros de la consulta
            $stmt->execute([
                ":paciente_id" => $data['paciente_id'],
                ":medico_id" => $data['medico_id'],
                ":fecha_hora" => $data['fecha_hora'],  
                ":motivo" => $data['motivo'],
                ":estado" => $data['estado']
            ]);

            // Retornar el ID del nuevo registro
            // return $conexion->lastInsertId();  
        }

        // Método para actualizar un medico
        public static function update($tabla, $id, $data) {
            $conexion = conexion::conectar();
            $stmt = $conexion->prepare(
                "UPDATE $tabla SET 
                    paciente_id = :paciente_id, 
                    medico_id = :medico_id, 
                    fecha_hora = :fecha_hora, 
                    correo = :correo,
                    motivo = :motivo
                    estado = :estado,
                WHERE id = :id"
            );

            // Arreglo con los datos para la actualización
            $array = [
                ":paciente_id" => $data['paciente_id'],
                ":medico_id" => $data['medico_id'],
                ":fecha_hora" => $data['fecha_hora'],  
                ":motivo" => $data['motivo'],
                ":estado" => $data['estado'],
                ":id" => $id
            ];

            // Vinculación de los array y ejecución
            return $stmt->execute($array); 
        }

        // Método para eliminar un cita
        public static function delete($tabla, $id) {
            $stmt = conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            return $stmt->execute(); 
        }



}






?>