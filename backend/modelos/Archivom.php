<?php

require_once "conexion.php";

class Archivom{

	public function listselectrfc($idusuario){
        
        $stmt = Conexion::conectar()->prepare("SELECT * 
												FROM empresas
												WHERE id_usuario=:id_usuario");

	$stmt->bindParam(":id_usuario", $idusuario, PDO::PARAM_INT);
        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        
        $stmt -> close();

        $stmt = null;
	}
	
	#statement: obtencion de los registros de archivos datastage
	public function getidenterprise($rfcempresa){
	
		$stmt = Conexion::conectar()->prepare("SELECT * 
												FROM empresas
												WHERE rfc=:rfc");

		$stmt->bindParam(":rfc", $rfcempresa, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch(PDO::FETCH_ASSOC);
		
		$stmt -> close();

		$stmt = null;
	}
	
	public function obtenerdatostabla($tabla,$id_empresa){
        
        $stmt = Conexion::conectar()->prepare("SELECT * 
												FROM $tabla
												WHERE id_empresa=:id_empresa");
		
		$stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        
        $stmt -> close();

        $stmt = null;
    }
		#statement: declaración guardamos los data stage en la base de datos
    public function guardarcriterios($registro,$campo,$datos,$id_empresa){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO criterios(registro,campo,datos,id_empresa) VALUES (:registro,:campo,:datos,:id_empresa)");

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":registro", $registro, PDO::PARAM_INT);
		$stmt->bindParam(":campo", $campo, PDO::PARAM_INT);
		$stmt->bindParam(":datos", $datos, PDO::PARAM_STR);
		$stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);

		if($stmt->execute()){

			return 1;

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt -> close();
		
		$stmt = null;	

	}
	public function obtenercriterios($id_empresa){
        
        $stmt = Conexion::conectar()->prepare("SELECT * 
												FROM criterios
												WHERE id_empresa=:id_empresa");

		$stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt -> fetchAll();
        
        $stmt -> close();

        $stmt = null;
	}

	public function getcriterioslineamientos(){
        
        $stmt = Conexion::conectar()->prepare("SELECT registro, campo 
												FROM lineamientos_de_revision
												WHERE validacion='Si'");

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        
        $stmt -> close();

        $stmt = null;
	}

	public function obtenerdatoscriterios($registro,$campo){
        
        $stmt = Conexion::conectar()->prepare("SELECT datos 
												FROM criterios
												WHERE registro=:registro AND campo=:campo");
		
		$stmt->bindParam(":registro", $registro, PDO::PARAM_STR);
		$stmt->bindParam(":campo", $campo, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);
        
        $stmt -> close();

        $stmt = null;
	}
	
	public function obtenersancion($registro,$campo){
        
        $stmt = Conexion::conectar()->prepare("SELECT * 
												FROM lineamientos_de_revision
												WHERE registro=:registro AND campo=:campo");

	$stmt->bindParam(":registro", $registro, PDO::PARAM_STR);
	$stmt->bindParam(":campo", $campo, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);
        
        $stmt -> close();

        $stmt = null;
    }
	
	public function actualizarnuevoscriterios($registro,$campo,$actualizarhistorico){
        
        $stmt = Conexion::conectar()->prepare("UPDATE criterios
												SET datos=:datos
												WHERE registro=:registro AND campo=:campo");

		$stmt->bindParam(":registro", $registro, PDO::PARAM_STR);
		$stmt->bindParam(":campo", $campo, PDO::PARAM_STR);
		$stmt->bindParam(":datos", $actualizarhistorico, PDO::PARAM_STR);

		if($stmt->execute()){

			return 1;

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt -> close();
		
		$stmt = null;	
	}
	
	public function guardarcriteriosdedatastage($campo,$obtenerdatostabla502){
		$campo=$campo-1;
		$infocampos='';
		$informacion='';
		foreach ($obtenerdatostabla502 as $key => $value) { //iteramos cada linea del registro x datastage para separar cada linea en arreglos
			$arr = explode( PHP_EOL , $value['informacion']);
			$res = array();
			foreach($arr as $row) {
				$res[] = trim($row);
			}
			$arreglodecampos = array();
			foreach ($res as $key => $value2) {
				$camposindividualesnuevo=explode("|",$value2);
				if (count($camposindividualesnuevo)!=1) { //Se imprime un arreglo demás en cada campo el cual causa un offset evitamos la lectura para evadir el error
					array_push($arreglodecampos, $camposindividualesnuevo[$campo]);
				}   
			}
			$resultado = array_unique($arreglodecampos);//quitamos elementos repetidos de campos
			unset($resultado[0]);//eliminamos el rimer elemento que contiene el nombre de cada campo para dejar los puros valores
			foreach ($resultado as $key => $value) { // iteramos el array de los campos únicos para meterlos en una cadena y poder separarlos por pipe(|) para ingresarlos a la base de datos
				$infocampos.=$value.'|';
			}
		}
		$quitarrepetidos=explode("|",$infocampos);
		$quitarrepetidos1 = array_unique($quitarrepetidos);
		foreach ($quitarrepetidos1 as $key => $value3) {
			$informacion.=$value3.'|';
		}
		return $informacion;
	}
    
} 