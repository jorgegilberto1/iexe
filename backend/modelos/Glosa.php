<?php 
require_once "conexion.php";

class Glosa{

    public function getglosa($rfc,$tabla){
        
    $stmt = Conexion::conectar()->prepare("SELECT informacion 
												FROM $tabla as dg
                                                JOIN empresas as emp on dg.id_empresa=emp.id
												WHERE emp.rfc=:rfc");

	$stmt->bindParam(":rfc", $rfc, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        
        $stmt -> close();

        $stmt = null;
    }

    public function exportglosa($rspta,$registrodata,$encabezado,$fechadepagoreal,$fechainicial,$fechafinal){
        $file = fopen($registrodata, "w");
        $fechainicial.='-01';//obtenemos el primer día del mes
        $aux = date('Y-m-d', strtotime("$fechafinal + 1 month"));
        $fechafinal = date('Y-m-d', strtotime("$aux - 1 day"));//obtenemos el último día del mes

        fwrite($file,$encabezado . PHP_EOL);
            foreach ($rspta as $key => $value) {//obtenemos las lineas del datastage
                $arr = explode( PHP_EOL , $value['informacion']);
                $res = array();
                foreach($arr as $row) {//limpiamos las lineas
                    $res[] = trim($row);
                }
                foreach ($res as $key => $value2) {// separamos cada linea por pipe |
                    $value2='"'.$value2;//agregamos un " entrecomillado al principio de la linea
                    $camposdelineas=explode("|",$value2);
                    if (count($camposdelineas)!=1) { //Se imprime un arreglo demás en cada campo el cual causa un offset evitamos la lectura para evadir el error
                        $fecha=explode(" ",$camposdelineas[$fechadepagoreal]);
                        if($fechainicial<=$fecha[0] && $fechafinal>=$fecha[0]){
                            $value2 = str_replace("|", '","', $value2);
                            $value2 = substr($value2, 0, -2);//evitamos los dos ultimos caracteres 
                            fwrite($file,$value2 . PHP_EOL);//Escribimos en el archivo y damos salto de linea
                       }
                    }
                }
            }
        fclose($file);

            $zip = new ZipArchive;
            if ($zip->open('glosa/glosa.zip') === TRUE) {
                $zip->addFile($registrodata);
                $zip->close();
                echo 'ok';
            } else {
                echo 'failed';
            }
    }

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
    
    public function getdate($id_empresa){
	
		$stmt = Conexion::conectar()->prepare("SELECT * 
												FROM 506_fechas_del_pedimento
												WHERE id_empresa=:id_empresa");

		$stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll(PDO::FETCH_ASSOC);
		
		$stmt -> close();

		$stmt = null;
	}


}
