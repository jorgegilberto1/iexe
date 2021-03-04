<?php

require_once "conexion.php";

class DataStage{

		#statement: obtencion de los registros de archivos datastage
    public function obtener(){
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM data_stage");

        $stmt -> execute();

        return $stmt -> fetchAll();
        
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
		#statement: declaración guardamos los data stage en la base de datos
    public function insertartexto($tabla,$informacion,$id_empresa){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(informacion,id_empresa) VALUES (:informacion,:id_empresa)");

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":informacion", $informacion, PDO::PARAM_STR);
		$stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);

		if($stmt->execute()){

			return 1;

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt -> close();
		
		$stmt = null;	

	}
    
} 

/* define("DB_HOST","localhost");

//Nombre de la base de datos
define("DB_NAME", "meta");

//Usuario de la base de datos
define("DB_USERNAME", "root");

//Contraseña del usuario de la base de datos
define("DB_PASSWORD", "");

//definimos la codificación de los caracteres
define("DB_ENCODE","utf8");

define("PORT", 3307);

$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

mysqli_query( $conexion, 'SET NAMES "'.DB_ENCODE.'"');

//Si tenemos un posible error en la conexión lo mostramos
if (mysqli_connect_errno())
{
	printf("Falló conexión a la base de datos: %s\n",mysqli_connect_error());
	exit();
}

if (!function_exists('ejecutarConsulta'))
{
	function ejecutarConsulta($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);
		return $query;
	}

	function validarsiexiste($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);
		return $query;
	}

	function ejecutarConsultaSimpleFila($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);		
		$row = $query->fetch_assoc();
		return $row;
	}

	function ejecutarConsulta_retornarID($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);		
		return $conexion->insert_id;			
	}

	function limpiarCadena($str)
	{
		global $conexion;
		$str = mysqli_real_escape_string($conexion,trim($str));
		return htmlspecialchars($str);
	}
}

class DataStage
{
	public function __construct()
	{

	}
	public function insertar($tabla,$indetificador,$informacion)
	{
		$sql="INSERT INTO $tabla (id,informacion)
		VALUES ('$indetificador','$informacion')";
		return ejecutarConsulta($sql);
	}
	public function insertarlong($tabla,$informacion)
	{
		$sql="INSERT INTO $tabla (informacion)
		VALUES ('$informacion')";
		return ejecutarConsulta($sql);
	}
	public function insertartexto($tabla,$informacion)
	{
		$sql="INSERT INTO $tabla (informacion)
		VALUES ('$informacion')";
		return ejecutarConsulta($sql);
	}
} */

?>