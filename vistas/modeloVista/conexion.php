<?php
class Conexion{
    public static function conectar(){
        $usuario="root";
        $db="api-pacientes";
        $pass="";
        $host="localhost";

        $link=new PDO("mysql:host=".$host.";dbname=".$db,$usuario,$pass);
        $link->exec("set names utf8");
        return $link;
    }
}

?>