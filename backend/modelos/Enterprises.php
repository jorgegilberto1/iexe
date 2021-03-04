<?php 
require_once "conexion.php";

class Enterprises{

	public function ifexist($rfc){
        
        $stmt = Conexion::conectar()->prepare("SELECT * 
												FROM empresas
												WHERE rfc=:rfc");

	$stmt->bindParam(":rfc", $rfc, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);
        
        $stmt -> close();

        $stmt = null;
	}

	public function uregistrados($id_empresa){
        
        $stmt = Conexion::conectar()->prepare("SELECT count(*) as registrados
												FROM usuarios
												WHERE id_empresa=:id_empresa");

	$stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);
        
        $stmt -> close();

        $stmt = null;
	}

	public function suspenderempresa($idempresa){
        
        $stmt = Conexion::conectar()->prepare("UPDATE empresas
												SET estatus=0
												WHERE id=:id");

		$stmt->bindParam(":id", $idempresa, PDO::PARAM_INT);

		if($stmt->execute()){

			return 1;

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt -> close();
		
		$stmt = null;	
	}

	public function activarempresa($idempresa){
        
        $stmt = Conexion::conectar()->prepare("UPDATE empresas
												SET estatus=1
												WHERE id=:id");

		$stmt->bindParam(":id", $idempresa, PDO::PARAM_INT);

		if($stmt->execute()){

			return 1;

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt -> close();
		
		$stmt = null;	
	}
	
	public function ifexistuser($user){
        
        $stmt = Conexion::conectar()->prepare("SELECT * 
												FROM usuarios
												WHERE email=:email");

		$stmt->bindParam(":email", $user, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);
        
        $stmt -> close();

        $stmt = null;
    }

    public function saveenterprise($nameenterprise,$nameuser,$user,$rfcenterprise,$iduser,$cupo){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.
		$pdo=Conexion::conectar();
		$stmt = $pdo->prepare("INSERT INTO empresas(nombre,contacto,email,id_usuario,rfc,cupo) VALUES (:nombre,:contacto,:email,:id_usuario,:rfc,:cupo)");

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":nombre", $nameenterprise, PDO::PARAM_STR);
		$stmt->bindParam(":contacto", $nameuser, PDO::PARAM_STR);
		$stmt->bindParam(":email", $user, PDO::PARAM_STR);
        $stmt->bindParam(":rfc", $rfcenterprise, PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $iduser, PDO::PARAM_INT);
		$stmt->bindParam(":cupo", $cupo, PDO::PARAM_INT);

		if($stmt->execute()){

			$lastInsertId = $pdo->lastInsertId();

			return $lastInsertId;

		}else{

			print_r($pdo->errorInfo());

		}

		$stmt -> close();
		
		$stmt = null;	

	}

	public function saveuserenterprise($user,$email,$password,$nivel,$id_empresa){
        #prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO usuarios(nombre,email,contrasena,nivel,id_empresa) VALUES (:nombre,:email,:contrasena,:nivel,:id_empresa)");

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":nombre", $user, PDO::PARAM_STR);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":contrasena", $password, PDO::PARAM_STR);
		$stmt->bindParam(":nivel", $nivel, PDO::PARAM_INT);
		$stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);

		if($stmt->execute()){

			return 1;

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt -> close();
		
		$stmt = null;	
	}
	
	public function listenterprises(){
        
        $stmt = Conexion::conectar()->prepare("SELECT em.id as idempresa,em.nombre as nombreempresa,em.rfc,em.contacto,em.email as emailempresa,cupo,em.estatus as estatusempresa,us.nombre as nombreconsultor
												FROM empresas as em
												JOIN usuarios as us on us.id=em.id_usuario");

        $stmt -> execute();

        return $stmt;
        
        $stmt -> close();

        $stmt = null;
	}

	public function listenterprisesconsultores($id_usuario){
        
        $stmt = Conexion::conectar()->prepare("SELECT * 
												FROM empresas
												WHERE id_usuario=:id_usuario");

	$stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt;
        
        $stmt -> close();

        $stmt = null;
	}
	public function getidenterprise($rfc){
        
        $stmt = Conexion::conectar()->prepare("SELECT * 
												FROM empresas
												WHERE rfc=:rfc");

		$stmt->bindParam(":rfc", $rfc, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);
        
        $stmt -> close();

        $stmt = null;
    }
}
