<?php

require_once "conexion.php";

class Criterios{
		#statement: declaración guardamos los data stage en la base de datos
    public function guardarcriterios($datos,$registro,$campo){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO criterios(registro,campo,datos) VALUES (:registro,:campo,:datos)");

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":campo", $campo, PDO::PARAM_INT);
		$stmt->bindParam(":registro", $registro, PDO::PARAM_INT);
		$stmt->bindParam(":datos", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return 1;

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt -> close();
		
		$stmt = null;	

	}
	public function obtenercriterios($rfc){
        
        $stmt = Conexion::conectar()->prepare("SELECT registro,campo
												 FROM criterios 
												 WHERE idrfc=:idrfc");
		$stmt->bindParam(":idrfc", $rfc, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();
        
        $stmt -> close();

        $stmt = null;
    }
    
} 