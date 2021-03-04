<?php 
require_once "conexion.php";

class Administrarusuarios{

    public function listarusuariosdeempresa($rfc){
        
        $stmt = Conexion::conectar()->prepare("SELECT us.id,us.nombre,us.email,us.estatus 
                                                FROM usuarios AS us 
                                                JOIN empresas AS emp ON emp.id=us.id_empresa 
                                                WHERE emp.rfc=:rfc");

        $stmt->bindParam(":rfc", $rfc, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt;
        
        $stmt -> close();

        $stmt = null;
    }

    public function suspenderusuario($idusuario){
        
        $stmt = Conexion::conectar()->prepare("UPDATE usuarios
												SET estatus=0
												WHERE id=:id");

		$stmt->bindParam(":id", $idusuario, PDO::PARAM_INT);

		if($stmt->execute()){

			return 1;

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt -> close();
		
		$stmt = null;	
    }
    
    public function activarusuario($idusuario){
        
        $stmt = Conexion::conectar()->prepare("UPDATE usuarios
												SET estatus=1
												WHERE id=:id");

		$stmt->bindParam(":id", $idusuario, PDO::PARAM_INT);

		if($stmt->execute()){

			return 1;

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt -> close();
		
		$stmt = null;	
	}

}
