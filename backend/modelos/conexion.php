<?php
class Conexion{

    #PDO("nombre sel servidor; nombre de la base de datos", "usuario", "contraseña");
    
    static public function conectar(){

        $link = new PDO("mysql:host=localhost;dbname=iexe",
                        "root",
                        "");
        $link->exec("set names utf8");
        return $link;
    
    }

}


