<?php
require_once "../modelos/DataStage.php";
session_start();
$result= new DataStage();
$opcion= @$_GET["opcion"];
$campo=@$_POST['campo-0'];

switch ($opcion) {

    case 'guardardata':
        if ($_SESSION['rfc']==='0') {
            echo 2;
        }else {
        $idempresa=$result->getidenterprise($_SESSION['rfc']);
        $id_empresa=$idempresa['id'];
                        //comprobamos si se ha recibido el nombre del ZIP
            if (@$_FILES["datastage"]["name"]) {
                //obtenemos datos de nuestro ZIP
                $nombre = @$_FILES["datastage"]["name"];
                $ruta = @$_FILES["datastage"]["tmp_name"];
                $tipo = @$_FILES["datastage"]["type"];
            }
            switch ($tipo[0]) {

                case 'application/x-zip-compressed':
                    $zip = new ZipArchive;
                    //en la función open se le pasa la ruta de nuestro archivo (alojada en carpeta temporal)
                    foreach($_FILES["datastage"]['tmp_name'] as $key => $tmp_name){// iteramos cada archivo .zip
                        if ($zip->open($_FILES["datastage"]["tmp_name"][$key]) === TRUE) { //abrimos el zip
                            for($i = 0; $i < $zip->numFiles; $i++){ // iteramos cada archivo dentro del zip para obtener su hubicación y nombre
                                //obtenemos ruta que tendrán los documentos cuando los descomprimamos
                                $nombresFichZIP['tmp_name'][$i] = '../files/'.$zip->getNameIndex($i);
                                //obtenemos nombre del fichero
                                $nombresFichZIP['name'][$i] = $zip->getNameIndex($i);

                            }
                            $zip->extractTo('../files/');
                            foreach ($nombresFichZIP['tmp_name'] as $key => $value) { //iteramos cada archivo descomprimido para guardarlo en el registro correspondiente de la base de datos
                                $nombredata=$value;
                                $nombredata = explode("_", $nombredata);
                                $nombredata = $nombredata[1];
                                if (strpos($nombredata,'501')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('501_datos_generales',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'502')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('502_transporte_de_las_mercancias',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'503')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('503_guias',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'504')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('504_contenedores',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'505')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('505_facturas',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'506')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('506_fechas_del_pedimento',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'507')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('507_casos_del_pedimento',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'508')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('508_cuentas_aduaneras_de_garantia_del_pedimento',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'509')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('509_tasas_del_pedimento',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'510')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('510_contribuciones_del_pedimento',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'511')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('511_observaciones_del_pedimento',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'512')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('512_descargos_de_mercancia',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'514')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('514_movimientos_en_cuenta_aduanera',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'520')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('520_destinatarios_de_la_mercancia',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'551')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('551_partidas',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'552')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('552_mercancias',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'553')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('553_permisos_de_la_partida',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'554')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('554_casos_de_la_partida',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'555')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('555_cuentas_aduaneras_de_garantia',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'556')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('556_tasas_de_las_contribuciones_de_la_partida',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'557')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('557_contribuciones_de_la_partida',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'558')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('558_observaciones_de_la_partida',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'701')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('701_rectificaciones',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'702')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('702_diferencias_de_contribuciones_del_pedimento',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'Inci')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('incidencias_del_reconocimiento',$nuevoarchivo,$id_empresa);
                                }
                                if (strpos($nombredata,'Sel')!==false) {
                                    $nuevoarchivo=file_get_contents($value);
                                    $result->insertartexto('seleccion_automatizada',$nuevoarchivo,$id_empresa);
                                }
                                
                            }
                            $zip->close();
                        }
                        echo '1';
                    }
                    
                
                break;
                case 'text/plain'://archivos de texto plano con extensión .txt
                    foreach($_FILES["datastage"]['tmp_name'] as $key => $tmp_name){
                        $nombredata=$_FILES["datastage"]["name"][$key];
                        $nombredata = explode("_", $nombredata);
                        $nombredata = $nombredata[1];
                        if (strpos($nombredata,'501')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('501_datos_generales',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'502')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('502_transporte_de_las_mercancias',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'503')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('503_guias',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'504')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('504_contenedores',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'505')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('505_facturas',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'506')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('506_fechas_del_pedimento',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'507')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('507_casos_del_pedimento',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'508')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('508_cuentas_aduaneras_de_garantia_del_pedimento',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'509')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('509_tasas_del_pedimento',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'510')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('510_contribuciones_del_pedimento',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'511')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('511_observaciones_del_pedimento',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'512')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('512_descargos_de_mercancia',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'514')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('514_movimientos_en_cuenta_aduanera',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'520')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('520_destinatarios_de_la_mercancia',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'551')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('551_partidas',$nuevoarchivo,$id_empresa);
                            /* for ($i=1; $i <count($nuevoarchivo) ; $i++) {  //iteramos cada linea por un campo en especifico en este caso el campo 19 (origen destino)
                                $camposindividualesnuevo=explode("|",$nuevoarchivo[$i]);                    
                                $identificador=$camposindividualesnuevo[1].'|'.$camposindividualesnuevo[2].'|'.$camposindividualesnuevo[3];
                                $informacion=$camposindividualesnuevo[4].'|'.$camposindividualesnuevo[5].'|'.$camposindividualesnuevo[6].'|'.$camposindividualesnuevo[7].'|'.$camposindividualesnuevo[8].'|'.$camposindividualesnuevo[9].'|'.$camposindividualesnuevo[10].'|'.$camposindividualesnuevo[11].'|'.$camposindividualesnuevo[12].'|'.$camposindividualesnuevo[13].'|'.$camposindividualesnuevo[14].'|'.$camposindividualesnuevo[15].'|'.$camposindividualesnuevo[16].'|'.$camposindividualesnuevo[17].'|'.$camposindividualesnuevo[18].'|'.$camposindividualesnuevo[19].'|'.$camposindividualesnuevo[20].'|'.$camposindividualesnuevo[21].'|'.$camposindividualesnuevo[22].'|'.$camposindividualesnuevo[23].'|'.$camposindividualesnuevo[24].'|'.$camposindividualesnuevo[25].'|'.$camposindividualesnuevo[26].'|'.$camposindividualesnuevo[27].'|'.$camposindividualesnuevo[28].'|'.$camposindividualesnuevo[29].'|'.$camposindividualesnuevo[30];
                                $result->insertar('551_partidas',$identificador,$informacion);
                            } */
                        }
                        if (strpos($nombredata,'552')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('552_mercancias',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'553')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('553_permisos_de_la_partida',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'554')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('554_casos_de_la_partida',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'555')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('555_cuentas_aduaneras_de_garantia',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'556')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('556_tasas_de_las_contribuciones_de_la_partida',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'557')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('557_contribuciones_de_la_partida',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'558')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('558_observaciones_de_la_partida',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'701')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('701_rectificaciones',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'702')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('702_diferencias_de_contribuciones_del_pedimento',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'Inci')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('incidencias_del_reconocimiento',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'Sel')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('seleccion_automatizada',$nuevoarchivo,$id_empresa);
                        }
                    }
                break;

                case 'application/octet-stream'://archivos de texto plano con extension .asc .234. fdf etc
                    foreach($_FILES["datastage"]['tmp_name'] as $key => $tmp_name){
                        $nombredata=$_FILES["datastage"]["name"][$key];
                        $nombredata = explode("_", $nombredata);
                        $nombredata = $nombredata[1];
                        if (strpos($nombredata,'501')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('501_datos_generales',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'502')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('502_transporte_de_las_mercancias',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'503')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('503_guias',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'504')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('504_contenedores',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'505')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('505_facturas',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'506')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('506_fechas_del_pedimento',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'507')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('507_casos_del_pedimento',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'508')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('508_cuentas_aduaneras_de_garantia_del_pedimento',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'509')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('509_tasas_del_pedimento',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'510')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('510_contribuciones_del_pedimento',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'511')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('511_observaciones_del_pedimento',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'512')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('512_descargos_de_mercancia',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'514')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('514_movimientos_en_cuenta_aduanera',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'520')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('520_destinatarios_de_la_mercancia',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'551')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('551_partidas',$nuevoarchivo,$id_empresa);
                            /* for ($i=1; $i <count($nuevoarchivo) ; $i++) {  //iteramos cada linea por un campo en especifico en este caso el campo 19 (origen destino)
                                $camposindividualesnuevo=explode("|",$nuevoarchivo[$i]);                    
                                $identificador=$camposindividualesnuevo[1].'|'.$camposindividualesnuevo[2].'|'.$camposindividualesnuevo[3];
                                $informacion=$camposindividualesnuevo[4].'|'.$camposindividualesnuevo[5].'|'.$camposindividualesnuevo[6].'|'.$camposindividualesnuevo[7].'|'.$camposindividualesnuevo[8].'|'.$camposindividualesnuevo[9].'|'.$camposindividualesnuevo[10].'|'.$camposindividualesnuevo[11].'|'.$camposindividualesnuevo[12].'|'.$camposindividualesnuevo[13].'|'.$camposindividualesnuevo[14].'|'.$camposindividualesnuevo[15].'|'.$camposindividualesnuevo[16].'|'.$camposindividualesnuevo[17].'|'.$camposindividualesnuevo[18].'|'.$camposindividualesnuevo[19].'|'.$camposindividualesnuevo[20].'|'.$camposindividualesnuevo[21].'|'.$camposindividualesnuevo[22].'|'.$camposindividualesnuevo[23].'|'.$camposindividualesnuevo[24].'|'.$camposindividualesnuevo[25].'|'.$camposindividualesnuevo[26].'|'.$camposindividualesnuevo[27].'|'.$camposindividualesnuevo[28].'|'.$camposindividualesnuevo[29].'|'.$camposindividualesnuevo[30];
                                $result->insertar('551_partidas',$identificador,$informacion);
                            } */
                        }
                        if (strpos($nombredata,'552')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('552_mercancias',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'553')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('553_permisos_de_la_partida',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'554')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('554_casos_de_la_partida',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'555')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('555_cuentas_aduaneras_de_garantia',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'556')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('556_tasas_de_las_contribuciones_de_la_partida',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'557')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('557_contribuciones_de_la_partida',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'558')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('558_observaciones_de_la_partida',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'701')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('701_rectificaciones',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'702')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('702_diferencias_de_contribuciones_del_pedimento',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'Inci')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('incidencias_del_reconocimiento',$nuevoarchivo,$id_empresa);
                        }
                        if (strpos($nombredata,'Sel')!==false) {
                            $ext = explode(".", $_FILES["datastage"]["name"][$key]);
                            $archivo501 = round(microtime(true)) . '.' . end($ext);
                            move_uploaded_file($_FILES["datastage"]["tmp_name"][$key], "../files/" . $archivo501);
                            $nuevoarchivo=file_get_contents("../files/".$archivo501);
                            echo $result->insertartexto('seleccion_automatizada',$nuevoarchivo,$id_empresa);
                        }
                    }
                    break;
                
                default:
                    # code...
                    break;
            }
    }
    break;
    
    default:
        # code...
        break;
}

#$obtener=$result->obtener();

#echo json_encode($result);


