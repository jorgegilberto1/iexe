<?php 
require_once "conexion.php";

class Consultores
{
    public function lista_proyectos($id_alumno){
        
        $stmt = Conexion::conectar()->prepare("SELECT * 
												FROM proyectos
												WHERE id_alumno=:id_alumno");
        $stmt->bindParam(":id_alumno", $id_alumno, PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt;
        
        $stmt -> close();

        $stmt = null;
    }

    public function lista_alumnos(){
        
        $stmt = Conexion::conectar()->prepare("SELECT * 
												FROM usuarios 
                                                WHERE nivel=2");

        $stmt -> execute();

        return $stmt;
        
        $stmt -> close();

        $stmt = null;
    }

    public function lista_proyectos_alumnos(){
        
        $stmt = Conexion::conectar()->prepare("SELECT proy.nombre_proyecto AS nombreproyecto,proy.tecnologia_usada,proy.asignatura_desarrollo,proy.fechaini_fechafin,proy.listado_habilidades,us.nombre AS nombrealumno
                                                FROM proyectos as proy
                                                JOIN usuarios as us on us.id=proy.id_alumno
                                                WHERE us.nivel=2");

        $stmt -> execute();

        return $stmt;
        
        $stmt -> close();

        $stmt = null;
    }
    
    public function registraralumno($nombre_alumno,$email,$contrasena,$nivel){
        #prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO usuarios(nombre,email,contrasena,nivel) VALUES (:nombre,:email,:contrasena,:nivel)");

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":nombre", $nombre_alumno, PDO::PARAM_STR);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
        $stmt->bindParam(":nivel", $nivel, PDO::PARAM_INT);

		if($stmt->execute()){

			return 1;

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt -> close();
		
		$stmt = null;	
    }

    public function guardarproyecto($nombre_proyecto,$tecnologia_usada,$asignatura_desarrollo,$fechaini_fechafin,$listado_habilidades,$idalumno){
        #prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO proyectos(nombre_proyecto,tecnologia_usada,asignatura_desarrollo,fechaini_fechafin,listado_habilidades,id_alumno) VALUES (:nombre_proyecto,:tecnologia_usada,:asignatura_desarrollo,:fechaini_fechafin,:listado_habilidades,:id_alumno)");

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":nombre_proyecto", $nombre_proyecto, PDO::PARAM_STR);
		$stmt->bindParam(":tecnologia_usada", $tecnologia_usada, PDO::PARAM_STR);
        $stmt->bindParam(":asignatura_desarrollo", $asignatura_desarrollo, PDO::PARAM_STR);
        $stmt->bindParam(":fechaini_fechafin", $fechaini_fechafin, PDO::PARAM_STR);
        $stmt->bindParam(":listado_habilidades", $listado_habilidades, PDO::PARAM_STR);
        $stmt->bindParam(":id_alumno", $idalumno, PDO::PARAM_INT);

		if($stmt->execute()){

			return 1;

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt -> close();
		
		$stmt = null;	
    }
    #verificamos si el email ya esta registrado
    public function ifexist($email){
        
        $stmt = Conexion::conectar()->prepare("SELECT * 
												FROM usuarios
												WHERE email=:email");

	$stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);
        
        $stmt -> close();

        $stmt = null;
    }
}
