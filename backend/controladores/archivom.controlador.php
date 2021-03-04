<?php
require_once "../modelos/Archivom.php";
session_start();
$result= new Archivom();
$opcion= @$_GET["opcion"];
$rfc= @$_POST['rfc'];

switch ($opcion) {

    case 'listselectrfc':
        $idusuario=$_SESSION['id'];
        $rspta=$result->listselectrfc($idusuario);
        echo json_encode($rspta);
        break;
    case 'validaterfc':
        if ($_SESSION['rfc']==='0') {
            echo '0';
        }
        else {
            $idempresa=$result->getidenterprise($_SESSION['rfc']);
            echo json_encode($idempresa);
        }
        break;
    case 'changerfc':
        $idempresa=$result->getidenterprise($rfc);
        $_SESSION['rfc']=$rfc;
        echo json_encode($idempresa);
        break;
    case 'ingresarjusti':

        $justificacion=$_POST['justificacion'];
        array_shift($_POST);//Obtenemos la justificación
        foreach ($_POST as $key => $value) {//obtenemos cada registro campo y el nuevo dato a ingresar en la tabla criterios
            $ingresarnuevoscriterios = explode("|", $value);
            $obtenerdatoscriterios=$result->obtenerdatoscriterios($ingresarnuevoscriterios[0],$ingresarnuevoscriterios[1]);
            foreach ($obtenerdatoscriterios as $key => $value2) {
                $value2.=$ingresarnuevoscriterios[2].'|';
                $actualizarnuevoscriterios=$result->actualizarnuevoscriterios($ingresarnuevoscriterios[0],$ingresarnuevoscriterios[1],$value2);
            }
        }
            echo 'la informacion se guardo con éxito';
        break;
    case 'guardarcriterios':
        $idempresa=$result->getidenterprise($_SESSION['rfc']);
        $id_empresa=$idempresa['id'];
        $getcriterioslineamientos=$result->getcriterioslineamientos();//obtenemos registro y campos de la tabla lineamientos los cuales se guardaran en criterios
        $obtenerdatostabla=$result->obtenerdatostabla('501_datos_generales',$id_empresa);//obtenemos la informacion en texto plano del regitro que establecimos relacionado a su rfc
        $obtenerdatostabla502=$result->obtenerdatostabla('502_transporte_de_las_mercancias',$id_empresa);//obtenemos la informacion en texto plano del regitro que establecimos relacionado a su rfc
        $obtenerdatostabla505=$result->obtenerdatostabla('505_facturas',$id_empresa);
        $obtenerdatostabla507=$result->obtenerdatostabla('507_casos_del_pedimento',$id_empresa);
        $obtenerdatostabla508=$result->obtenerdatostabla('508_cuentas_aduaneras_de_garantia_del_pedimento',$id_empresa);
        $obtenerdatostabla509=$result->obtenerdatostabla('509_tasas_del_pedimento',$id_empresa);
        $obtenerdatostabla510=$result->obtenerdatostabla('510_contribuciones_del_pedimento',$id_empresa);
        $obtenerdatostabla512=$result->obtenerdatostabla('512_descargos_de_mercancia',$id_empresa);
        $obtenerdatostabla520=$result->obtenerdatostabla('520_destinatarios_de_la_mercancia',$id_empresa);
        $obtenerdatostabla551=$result->obtenerdatostabla('551_partidas',$id_empresa);
        $obtenerdatostabla552=$result->obtenerdatostabla('552_mercancias',$id_empresa);
        $obtenerdatostabla553=$result->obtenerdatostabla('553_permisos_de_la_partida',$id_empresa);
        $obtenerdatostabla554=$result->obtenerdatostabla('554_casos_de_la_partida',$id_empresa);
        $obtenerdatostabla555=$result->obtenerdatostabla('555_cuentas_aduaneras_de_garantia',$id_empresa);
        $obtenerdatostabla556=$result->obtenerdatostabla('556_tasas_de_las_contribuciones_de_la_partida',$id_empresa);
        $obtenerdatostabla557=$result->obtenerdatostabla('557_contribuciones_de_la_partida',$id_empresa);
        $obtenerdatostabla558=$result->obtenerdatostabla('558_observaciones_de_la_partida',$id_empresa);
        $obtenerdatostabla701=$result->obtenerdatostabla('701_rectificaciones',$id_empresa);
        $obtenerdatostabla702=$result->obtenerdatostabla('702_diferencias_de_contribuciones_del_pedimento',$id_empresa);
        
        foreach($getcriterioslineamientos as $nombre_campo => $valor){ //obtenemos el registro y el campo de manera dinámica para trabajar con ellos ejemplo registro 501 en el campo 20
                $registro=$valor['registro'];
                $campo=$valor['campo'];
                switch ($registro) {
                    case '501':
                        $savecriterios501=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo+1,$savecriterios501,$id_empresa);
                    break;
                    case '502':
                        $savecriterios502=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla502);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios502,$id_empresa);
                    break;
                    //503 y 504 no estan en archivo M
                    case '505':
                        $savecriterios505=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla505);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios505,$id_empresa);
                        break;
                        //506 no esta en archivo M
                    case '507':
                        $savecriterios507=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla507);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios507,$id_empresa);
                        break;
                    case '508':
                        $savecriterios508=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla508);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios508,$id_empresa);
                        break;
                    case '509':
                        $savecriterios509=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla509);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios509,$id_empresa);
                        break;
                    case '510':
                        $savecriterios510=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla510);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios510,$id_empresa);
                        break;
                        //511 no esta en archivo M
                    case '512':
                        $savecriterios512=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla512);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios512,$id_empresa);
                        break;
                    case '520':
                        $savecriterios520=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla520);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios520,$id_empresa);
                        break;
                    case '551':
                        $savecriterios551=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla551);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios551,$id_empresa);
                        break;
                    case '552':
                        $savecriterios552=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla552);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios552,$id_empresa);
                        break;
                    case '553':
                        $savecriterios553=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla553);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios553,$id_empresa);
                        break;
                    case '554':
                        $savecriterios554=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla554);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios554,$id_empresa);
                        break;
                    case '555':
                        $savecriterios555=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla555);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios555,$id_empresa);
                        break;
                    case '556':
                        $savecriterios556=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla556);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios556,$id_empresa);
                        break;
                    case '557':
                        $savecriterios557=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla557);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios557,$id_empresa);
                        break;
                    case '558':
                        $savecriterios558=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla558);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios558,$id_empresa);
                        break;
                    case '701':
                        $savecriterios701=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla701);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo+1,$savecriterios701,$id_empresa);
                        break;
                    case '702':
                        $savecriterios702=$result->guardarcriteriosdedatastage($campo,$obtenerdatostabla702);
                        $guardarcriterios=$result->guardarcriterios($registro,$campo-1,$savecriterios702,$id_empresa);
                        break;
                    default:

                    break;
                }
         }
         echo '1';
    break;
    case 'validarm':
        $erorres501='';
        $erorres502='';
        $erorres503='';
        $erorres506='';
        $erorres551='';
        $sancion501='';
        $sancion502='';
        $sancion503='';
        $sancion506='';
        $sancion551='';
        $errores551='';
        $error=0;
        foreach ($_FILES["archivom"]['tmp_name'] as $key => $value) {//iteramos cada archivo m 
            move_uploaded_file($_FILES["archivom"]["tmp_name"][$key], "../files/" . $_FILES["archivom"]["name"][$key]);
            $nuevoarchivo=file("../files/".$_FILES["archivom"]["name"][$key]);//obtenemos el archivo m a validar mediante array de cada linea
            $idempresa=$result->getidenterprise($_SESSION['rfc']);
            $id_empresa=$idempresa['id'];
            $obtenercriterios=$result->obtenercriterios($id_empresa);//obtenemos los criterios gurdados registros campos
            $rectificacion=0;
            $importecalculado=0;
            $adicionarnuevoscriteriosenarray='';
            $nuevosdatosconcatenados=array();
                $linea=0;
                foreach ($nuevoarchivo as $key => $value2) {//iteramos cada linea del archivo M a validar
                    $linea++;
                    $camposindividualesnuevo=explode("|",$value2);//conevrtimos cada linea en arreglos separado por pipes
                    if ($camposindividualesnuevo[0]==='501') {
                        echo '<b>PEDIMENTO: '.$camposindividualesnuevo[3].'-'.$camposindividualesnuevo[1].'-'.$camposindividualesnuevo[2].'</b>.';
                    }
                    foreach ($obtenercriterios as $key => $value) {//iteramos cada linea de la tabla criterios
                        switch ($value['registro']) {
                            case '501':
                                $nombreregistro='Datos Generales';
                                $campoavalidar=$value['campo']-1;//en archivo M y datastage solo tienen diferencia en una unidad debido a que comienza por el indice 0
                                if ($camposindividualesnuevo[0]===$value['registro']){
                                    $datosdecriterios=explode("|",$value['datos']);
                                    if (in_array($camposindividualesnuevo[$campoavalidar], $datosdecriterios)) {
                                        
                                    }
                                    else {
                                        $error=1;
                                        $sancion=$result->obtenersancion($value['registro'],$value['campo']-1);//obtenemos la sancion de la tabla de lineamientos de infracciones enviandole registro y campo que presenta inconsistencia
                                        $nombrecampo = substr($sancion['campos'], 3);//extrae el nombre del campo escrito en la tabla lineamientos de validacion
                                        echo '<br><br>En <b>'.$nombreregistro.' </b>en el campo <b>'.$nombrecampo.'</b> de acuerdo a tus registros históricos la siguiente información es nueva: <b>'.$camposindividualesnuevo[$campoavalidar].'</b>.<br>';
                                        $erorres501.='<br> <b>PEDIMENTO '.$camposindividualesnuevo[3].'-'.$camposindividualesnuevo[1].'-'.$camposindividualesnuevo[2].'</b>. <br><br>En <b>'.$nombreregistro.' </b>en el campo <b>'.$nombrecampo.'</b> de acuerdo a tus registros históricos la siguiente información es nueva: <b>'.$camposindividualesnuevo[$campoavalidar].'</b>.<br>';//variable para mandar al PDF
                                        $adicionarnuevoscriterios=$value['registro'].'|'.$value['campo'].'|'.$camposindividualesnuevo[$campoavalidar].'|';//concatenamos los nuevos registros adicionar en caso de que se justifique
                                        array_push($nuevosdatosconcatenados,$adicionarnuevoscriterios);
                                        if ($sancion['fundamento1']!='') {
                                            //$sancion= '<br>Puedes ser acreedor a una sancion de acuerdo al  '.$sancion['fundamento1'].' y '.$sancion['fundamento2'].' que va desde los '.$sancion['sancionminima'].' hasta '.$sancion['sancionmaxima'].'. <br>';//imprimimos la posible sanción.
                                        }
                                        $sancion501 .='<br>Puedes ser acreedor a una sancion de acuerdo al  '.$sancion['fundamento1'].' y '.$sancion['fundamento2'].' que va desde los '.$sancion['sancionminima'].' hasta '.$sancion['sancionmaxima'].'. <br>';//variable para mandar al PDF
                                        //$importecalculado=$importecalculado+$sancion['sancionmaxima'];//total de la posible infracción
                                    }
                                    if(count($camposindividualesnuevo)!=31){
                                        echo 'los campos están incompletos en el registro 501 <br>';
                                    }
                                }
                            break;
                            case '502'://mismo código que registro 501 par al campo 4 indentificador de guía
                                
                            break;
                            case '503'://mismo código que registro 501 par al campo 4 indentificador de guía
                                $nombreregistro='Guias';
                                $campoavalidar=$value['campo']-1;//en archivo M y datastage solo tienen diferencia en una unidad debido a que comienza por el indice 0
                                if ($camposindividualesnuevo[0]===$value['registro']){
                                    $datosdecriterios=explode("|",$value['datos']);
                                    if (in_array($camposindividualesnuevo[$campoavalidar], $datosdecriterios)) {
                                        
                                    }
                                    else {
                                        $error=1;
                                        $sancion=$result->obtenersancion($value['registro'],$value['campo']-1);//obtenemos la sancion de la tabla de lineamientos de infracciones enviandole registro y campo que presenta inconsistencia
                                        $nombrecampo = substr($sancion['campos'], 3);//extrae el nombre del campo escrito en la tabla lineamientos de validacion
                                        echo '<br><br>En <b>'.$nombreregistro.' </b>en el campo <b>'.$nombrecampo.'</b> de acuerdo a tus registros históricos la siguiente información es nueva: <b>'.$camposindividualesnuevo[$campoavalidar].'</b>.<br>';
                                        $erorres501.='<br> <b>PEDIMENTO '.$camposindividualesnuevo[3].'-'.$camposindividualesnuevo[1].'-'.$camposindividualesnuevo[2].'</b>. <br><br>En <b>'.$nombreregistro.' </b>en el campo <b>'.$nombrecampo.'</b> de acuerdo a tus registros históricos la siguiente información es nueva: <b>'.$camposindividualesnuevo[$campoavalidar].'</b>.<br>';//variable para mandar al PDF
                                        $adicionarnuevoscriterios=$value['registro'].'|'.$value['campo'].'|'.$camposindividualesnuevo[$campoavalidar].'|';//concatenamos los nuevos registros adicionar en caso de que se justifique
                                        array_push($nuevosdatosconcatenados,$adicionarnuevoscriterios);
                                        if ($sancion['fundamento1']!='') {
                                            //$sancion= '<br>Puedes ser acreedor a una sancion de acuerdo al  '.$sancion['fundamento1'].' y '.$sancion['fundamento2'].' que va desde los '.$sancion['sancionminima'].' hasta '.$sancion['sancionmaxima'].'. <br>';//imprimimos la posible sanción.
                                        }
                                        $sancion501 .='<br>Puedes ser acreedor a una sancion de acuerdo al  '.$sancion['fundamento1'].' y '.$sancion['fundamento2'].' que va desde los '.$sancion['sancionminima'].' hasta '.$sancion['sancionmaxima'].'. <br>';//variable para mandar al PDF
                                        //$importecalculado=$importecalculado+$sancion['sancionmaxima'];//total de la posible infracción
                                    }
                                    if(count($camposindividualesnuevo)!=5){
                                        echo 'los campos están incompletos en el registro 503 <br>';
                                    }
                                }
                            break;
                            case '505'://mismo código que registro 501 par al campo 4 indentificador de guía
                                $nombreregistro='Facturas';
                                $campoavalidar=$value['campo']-1;//en archivo M y datastage solo tienen diferencia en una unidad debido a que comienza por el indice 0
                                if ($camposindividualesnuevo[0]===$value['registro']){
                                    $datosdecriterios=explode("|",$value['datos']);

                                   // echo $camposindividualesnuevo[$campoavalidar].'-----'.$datosdecriterios;
                                    if (in_array($camposindividualesnuevo[$campoavalidar], $datosdecriterios)) {
                                        
                                    }
                                    else {
                                        if ($camposindividualesnuevo[$value['campo']]==11) {
                                            # code...
                                        }
                                        $error=1;
                                        $sancion=$result->obtenersancion($value['registro'],$value['campo']-1);//obtenemos la sancion de la tabla de lineamientos de infracciones enviandole registro y campo que presenta inconsistencia
                                        $nombrecampo = substr($sancion['campos'], 3);//extrae el nombre del campo escrito en la tabla lineamientos de validacion
                                        echo '<br><br>En <b>'.$nombreregistro.' </b>en el campo <b>'.$nombrecampo.'</b> de acuerdo a tus registros históricos la siguiente información es nueva: <b>'.$camposindividualesnuevo[$campoavalidar].'</b>.<br>';
                                        $erorres501.='<br> <b>PEDIMENTO '.$camposindividualesnuevo[3].'-'.$camposindividualesnuevo[1].'-'.$camposindividualesnuevo[2].'</b>. <br><br>En <b>'.$nombreregistro.' </b>en el campo <b>'.$nombrecampo.'</b> de acuerdo a tus registros históricos la siguiente información es nueva: <b>'.$camposindividualesnuevo[$campoavalidar].'</b>.<br>';//variable para mandar al PDF
                                        $adicionarnuevoscriterios=$value['registro'].'|'.$value['campo'].'|'.$camposindividualesnuevo[$campoavalidar].'|';//concatenamos los nuevos registros adicionar en caso de que se justifique
                                        array_push($nuevosdatosconcatenados,$adicionarnuevoscriterios);
                                        if ($sancion['fundamento1']!='') {
                                            //$sancion= '<br>Puedes ser acreedor a una sancion de acuerdo al  '.$sancion['fundamento1'].' y '.$sancion['fundamento2'].' que va desde los '.$sancion['sancionminima'].' hasta '.$sancion['sancionmaxima'].'. <br>';//imprimimos la posible sanción.
                                        }
                                        $sancion501 .='<br>Puedes ser acreedor a una sancion de acuerdo al  '.$sancion['fundamento1'].' y '.$sancion['fundamento2'].' que va desde los '.$sancion['sancionminima'].' hasta '.$sancion['sancionmaxima'].'. <br>';//variable para mandar al PDF
                                        //$importecalculado=$importecalculado+$sancion['sancionmaxima'];//total de la posible infracción
                                    }
                                    if(count($camposindividualesnuevo)!=18){
                                        echo 'los campos están incompletos en el registro 505 <br>';
                                    }
                                }
                            break;
                            default:
                                
                                break;
                        }
                    }
                    if ($camposindividualesnuevo[0]==701) {
                        $rectificacion=1;
                    }
                }
            
            if ($error) {
                $inputsnuevoscriterios='';
                $indiceinputs=0;
                foreach ($nuevosdatosconcatenados as $key => $value) {
                    $indiceinputs++;
                    $inputsnuevoscriterios.='<input type="hidden" name="nama'.$indiceinputs.'" class="form-control" value="'.$value.'">';
                }
                echo '<br><br><h4 style="color:red">importe calculado de la sanción $'.number_format($importecalculado).'<h4><form id="form-justificacion" method="POST"> 
                                                                                                                <textarea class="form-control" name="justificacion" id="justificacioncampo" placeholder="Ingrese su justificación en caso de que los cambios sean correctos" rows="3"></textarea>'.
                                                                                                                $inputsnuevoscriterios.
                                                                                                                '<button type="submit" class="btn btn-primary">Guardar</button>'.
                                                                                                            '</form>'.
                                                                                                            ' <button type="button" class="btn btn-danger">Cancelar</button>'.
                                                                                                            ' <a href="controladores/pdf.php?mensaje='.$erorres501.'&importetotal='.$importecalculado.'" type="button" target="_blank" class="btn btn-secondary">PDF</a><br>'.
                                                                                                            '<script>$("#form-justificacion").submit(function(e){
                                                                                                                e.preventDefault();
                                                                                                                var formData = new FormData($("#form-justificacion")[0]);
                                                                                                                $.ajax({
                                                                                                                    url : "controladores/archivom.controlador.php?opcion=ingresarjusti",
                                                                                                                    method : "POST",
                                                                                                                    data: formData,
                                                                                                                    contentType:false,
                                                                                                                    processData:false,
                                                                                                                    success: function(data){
                                                                                                                        alert(data)
                                                                                                                        location.reload();
                                
                                                                                                                    },
                                                                                                                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                                                                                                                        console.log(textStatus);
                                                                                                                        $(".toastrDefaultError").trigger("click"); 
                                                                                                                    }
                                                                                                                })
                                                                                                                //$("#form-justificacion")[0].reset();
                                                                                                            });</script>';
            
            }
            if ($rectificacion==1) {
                echo 'Se encontro una rectificacion <br>';
                foreach ($nuevoarchivo as $key => $value) {
                    $camposindividualesnuevo=explode("|",$value);//consvertimos cada linea en array separado po pipe |
                    if($camposindividualesnuevo[0]==701){
                        $patentepedimentosecad=$camposindividualesnuevo[7].'|'.$camposindividualesnuevo[6].'|'.$camposindividualesnuevo[8];
                    }
                    switch ($camposindividualesnuevo[0]) {
                        case '501':
                            $obtenerdatostabla=$result->obtenerdatostabla('501_datos_generales');
                            foreach ($obtenerdatostabla as $key => $value) { //iteramos cada linea del registro x datastage para separar cada linea en arreglos
                                $arr = explode( PHP_EOL , $value['informacion']);
                                $res = array();
                                foreach($arr as $row) {
                                    $res[] = trim($row);
                                }
                                foreach ($res as $key => $value4) {
                                    if (strpos($value4, $patentepedimentosecad) !== false) {
                                        $lineadelregistrodatastage=explode("|",$value4);
                                        /* if (strcmp($camposindividualesnuevo[1], $lineadelregistrodatastage[0]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>501  '.$lineadelregistrodatastage[0].' ---> '.$camposindividualesnuevo[1];
                                        }
                                        if (strcmp($camposindividualesnuevo[2], $lineadelregistrodatastage[1]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>501  '.$lineadelregistrodatastage[1].' ---> '.$camposindividualesnuevo[2];
                                        }
                                        if (strcmp($camposindividualesnuevo[3], $lineadelregistrodatastage[2]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>501  '.$lineadelregistrodatastage[2].' ---> '.$camposindividualesnuevo[3];
                                        } */
                                        if (strcmp($camposindividualesnuevo[4], $lineadelregistrodatastage[3]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>501  '.$lineadelregistrodatastage[3].' ---> '.$camposindividualesnuevo[4];
                                        }
                                        if (strcmp($camposindividualesnuevo[5], $lineadelregistrodatastage[4]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>501  '.$lineadelregistrodatastage[4].' ---> '.$camposindividualesnuevo[5];
                                        }
                                        if (strcmp($camposindividualesnuevo[6], $lineadelregistrodatastage[5]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>501  '.$lineadelregistrodatastage[5].' ---> '.$camposindividualesnuevo[6];
                                        }
                                        /* if (strcmp($camposindividualesnuevo[7], $lineadelregistrodatastage[6]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>501  '.$lineadelregistrodatastage[6].' ---> '.$camposindividualesnuevo[7];
                                        }
                                        if (strcmp($camposindividualesnuevo[8], $lineadelregistrodatastage[7]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>501  '.$lineadelregistrodatastage[7].' ---> '.$camposindividualesnuevo[8];
                                        } */
                                        /* if (strcmp($camposindividualesnuevo[9], $lineadelregistrodatastage[8]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>501  '.$lineadelregistrodatastage[8].' ---> '.$camposindividualesnuevo[9];
                                        } */
                                        if (strcmp($camposindividualesnuevo[10], $lineadelregistrodatastage[9]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>501  '.$lineadelregistrodatastage[9].' ---> '.$camposindividualesnuevo[10];
                                        }
                                        if (strcmp($camposindividualesnuevo[11], $lineadelregistrodatastage[10]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>501  '.$lineadelregistrodatastage[10].' ---> '.$camposindividualesnuevo[11];
                                        }
                                        if (strcmp($camposindividualesnuevo[12], $lineadelregistrodatastage[11]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>501  '.$lineadelregistrodatastage[11].' ---> '.$camposindividualesnuevo[12];
                                        }
                                        if (strcmp($camposindividualesnuevo[13], $lineadelregistrodatastage[12]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>501  '.$lineadelregistrodatastage[12].' ---> '.$camposindividualesnuevo[13];
                                        }
                                        if (strcmp($camposindividualesnuevo[14], $lineadelregistrodatastage[13]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>501  '.$lineadelregistrodatastage[13].' ---> '.$camposindividualesnuevo[14];
                                        }
                                    }

                                }
                                
                            }
                            break;
                        case '502':
                            $obtenerdatostabla=$result->obtenerdatostabla('502_transporte_de_las_mercancias');
                            foreach ($obtenerdatostabla as $key => $value) { //iteramos cada linea del registro x datastage para separar cada linea en arreglos
                                $arr = explode( PHP_EOL , $value['informacion']);
                                $res = array();
                                foreach($arr as $row) {
                                    $res[] = trim($row);
                                }
                                foreach ($res as $key => $value4) {
                                    if (strpos($value4, $patentepedimentosecad) !== false) {
                                        $lineadelregistrodatastage=explode("|",$value4);
                                        /* if (strcmp($camposindividualesnuevo[1], $lineadelregistrodatastage[1]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>502  '.$lineadelregistrodatastage[1].' ---> '.$camposindividualesnuevo[1];
                                        } */
                                        if (strcmp($camposindividualesnuevo[2], $lineadelregistrodatastage[3]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>502  '.$lineadelregistrodatastage[3].' ---> '.$camposindividualesnuevo[2];
                                        }
                                        if (strcmp($camposindividualesnuevo[3], $lineadelregistrodatastage[4]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>502  '.$lineadelregistrodatastage[4].' ---> '.$camposindividualesnuevo[3];
                                        }
                                    }

                                }
                                
                            }
                            break;
                        case '503':
                            $obtenerdatostabla=$result->obtenerdatostabla('503_guias');
                            foreach ($obtenerdatostabla as $key => $value) { //iteramos cada linea del registro x datastage para separar cada linea en arreglos
                                $arr = explode( PHP_EOL , $value['informacion']);
                                $res = array();
                                foreach($arr as $row) {
                                    $res[] = trim($row);
                                }
                                foreach ($res as $key => $value4) {
                                    if (strpos($value4, $patentepedimentosecad) !== false) {
                                        $lineadelregistrodatastage=explode("|",$value4);
                                        /* if (strcmp($camposindividualesnuevo[1], $lineadelregistrodatastage[1]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>503  '.$lineadelregistrodatastage[1].' ---> '.$camposindividualesnuevo[1];
                                        } */
                                        if (strcmp($camposindividualesnuevo[2], $lineadelregistrodatastage[3]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>503  '.$lineadelregistrodatastage[3].' ---> '.$camposindividualesnuevo[2];
                                        }
                                        if (strcmp($camposindividualesnuevo[3], $lineadelregistrodatastage[4]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>503  '.$lineadelregistrodatastage[4].' ---> '.$camposindividualesnuevo[3];
                                        }
                                    }

                                }
                                
                            }
                            break;   
                        case '504':
                            $obtenerdatostabla=$result->obtenerdatostabla('504_contenedores');
                            foreach ($obtenerdatostabla as $key => $value) { //iteramos cada linea del registro x datastage para separar cada linea en arreglos
                                $arr = explode( PHP_EOL , $value['informacion']);
                                $res = array();
                                foreach($arr as $row) {
                                    $res[] = trim($row);
                                }
                                foreach ($res as $key => $value4) {
                                    if (strpos($value4, $patentepedimentosecad) !== false) {
                                        $lineadelregistrodatastage=explode("|",$value4);
                                        /* if (strcmp($camposindividualesnuevo[1], $lineadelregistrodatastage[1]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>504  '.$lineadelregistrodatastage[1].' ---> '.$camposindividualesnuevo[1];
                                        } */
                                        if (strcmp($camposindividualesnuevo[2], $lineadelregistrodatastage[3]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>504  '.$lineadelregistrodatastage[3].' ---> '.$camposindividualesnuevo[2];
                                        }
                                        if (strcmp($camposindividualesnuevo[3], $lineadelregistrodatastage[4]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>504  '.$lineadelregistrodatastage[4].' ---> '.$camposindividualesnuevo[3];
                                        }
                                    }

                                }
                                
                            }
                            break;  
                        case '505':
                            $obtenerdatostabla=$result->obtenerdatostabla('505_facturas');
                            foreach ($obtenerdatostabla as $key => $value) { //iteramos cada linea del registro x datastage para separar cada linea en arreglos
                                $arr = explode( PHP_EOL , $value['informacion']);
                                $res = array();
                                foreach($arr as $row) {
                                    $res[] = trim($row);
                                }
                                foreach ($res as $key => $value4) {
                                    if (strpos($value4, $patentepedimentosecad) !== false) {
                                        $lineadelregistrodatastage=explode("|",$value4);
                                        /* if (strcmp($camposindividualesnuevo[1], $lineadelregistrodatastage[1]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>505  '.$lineadelregistrodatastage[1].' ---> '.$camposindividualesnuevo[1];
                                        } */
                                        if (strcmp($camposindividualesnuevo[2], $lineadelregistrodatastage[3]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>505  '.$lineadelregistrodatastage[3].' ---> '.$camposindividualesnuevo[2];
                                        }
                                        if (strcmp($camposindividualesnuevo[3], $lineadelregistrodatastage[4]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>505  '.$lineadelregistrodatastage[4].' ---> '.$camposindividualesnuevo[3];
                                        }
                                    }

                                }
                                
                            }
                            break; 
                        case '506':
                            $obtenerdatostabla=$result->obtenerdatostabla('506_fechas_del_pedimento');
                            foreach ($obtenerdatostabla as $key => $value) { //iteramos cada linea del registro x datastage para separar cada linea en arreglos
                                $arr = explode( PHP_EOL , $value['informacion']);
                                $res = array();
                                foreach($arr as $row) {
                                    $res[] = trim($row);
                                }
                                foreach ($res as $key => $value4) {
                                    if (strpos($value4, $patentepedimentosecad) !== false) {
                                        $lineadelregistrodatastage=explode("|",$value4);
                                        /* if (strcmp($camposindividualesnuevo[1], $lineadelregistrodatastage[1]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>506  '.$lineadelregistrodatastage[1].' ---> '.$camposindividualesnuevo[1];
                                        } */
                                        if (strcmp($camposindividualesnuevo[2], $lineadelregistrodatastage[3]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>506  '.$lineadelregistrodatastage[3].' ---> '.$camposindividualesnuevo[2];
                                        }
                                        if (strcmp($camposindividualesnuevo[3], $lineadelregistrodatastage[4]) !== 0){//linea de archivo m vs datastage
                                            echo '<br>506  '.$lineadelregistrodatastage[4].' ---> '.$camposindividualesnuevo[3];
                                        }
                                    }

                                }
                                
                            }
                            break;  
                        case '507':
                            $obtenerdatostabla=$result->obtenerdatostabla('507_casos_del_pedimento');
                            foreach ($obtenerdatostabla as $key => $value) { //iteramos cada linea del registro x datastage para separar cada linea en arreglos
                                $arr = explode( PHP_EOL , $value['informacion']);
                                $res = array();
                                foreach($arr as $row) {
                                    $res[] = trim($row);
                                }                                
                            }

                            break;                   
                        default:
                            # code...
                            break;
                    }
                }
            }//rectificacion
        }//iteracion de cada archivo M
        break;
    
    default:
        # code...
        break;
}

#$obtener=$result->obtener();

#echo json_encode($result);


