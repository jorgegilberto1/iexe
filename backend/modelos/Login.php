<?php

require_once "conexion.php";

class Login{
    #validamos que el email y la contraseña sean correctas para logearse
    public function validatelogin($email,$password){
        
        $stmt = Conexion::conectar()->prepare("SELECT id,nombre,email,nivel
												FROM usuarios
												WHERE email=:email AND contrasena=:contrasena");

    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":contrasena", $password, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);
        
        $stmt -> close();

        $stmt = null;
    }
    
}
