<?php
require_once "../modelos/Enterprises.php";
session_start();
$enterprises= new Enterprises();
$opcion= @$_GET["opcion"];

$nameenterprise= @$_POST["nameenterprise"];
$rfcenterprise= @$_POST["rfcenterprise"];
$nameuser= @$_POST["nameuser"];
$user= @$_POST["user"];
$pasw= @$_POST["pasw"];
$repitpasw= @$_POST["repitpasw"];
$idempresa= @$_POST["idempresa"];
$cupo= @$_POST["cupo"];
$error='';


switch ($opcion) {
    case 'saveenterprise':
        $rspta=$enterprises->ifexist($rfcenterprise);
        $rspta2=$enterprises->ifexistuser($user);
        if ($rspta) {
            $error.= '<li>El RFC ingresado ya existe</li>';
        }
        if ($rspta2) {
            $error.= '<li>El Email ingresado ya existe</li>';
        }
        if (strcmp($pasw, $repitpasw) !== 0) {
            $error.='<li>Las contraseñas no coinciden</li>';
        }
        if ($cupo<=0) {
            $error.='<li>Debe establecer un cupo mayor o igual a cero</li>';
        }
        if ($error==''){
            $iduser=$_SESSION['id'];
            $pasw=hash('SHA256',$pasw);
            $rspta4=$enterprises->saveenterprise($nameenterprise,$nameuser,$user,$rfcenterprise,$iduser,$cupo);
            $rspta3=$enterprises->saveuserenterprise($nameuser, $user, $pasw,3,$rspta4);
            echo $rspta3;
        }
        echo $error;
        break;
    case 'suspenderempresa':
        $rspta=$enterprises->suspenderempresa($idempresa);
        echo $rspta;
        break;
    case 'activarempresa':
        $rspta=$enterprises->activarempresa($idempresa);
        echo $rspta;
        break;
    case 'saveuserenterprise':
            $rspta2=$enterprises->ifexistuser($user);
            $id_empresa=$enterprises->getidenterprise($_SESSION['rfc']);
            $uregistrados=$enterprises->uregistrados($id_empresa['id']);
            $disponible=$id_empresa['cupo']-$uregistrados['registrados'];
            if ($disponible<=0) {
                $error.= '<li>Has alcanzado el número máximo de usuarios permitidos en tu cuenta</li>';
            }
            if ($rspta2) {
                $error.= '<li>El Email ingresado ya existe</li>';
            }
            if (strcmp($pasw, $repitpasw) !== 0) {
                $error.='<li>Las contraseñas no coinciden</li>';
            }
            if ($error==''){
                $pasw=hash('SHA256',$pasw);
                $rspta3=$enterprises->saveuserenterprise($nameuser, $user, $pasw,3,$id_empresa['id']);
                echo $rspta3;
            }
            echo $error;
            break;
    case 'listenterprises':
        if ($_SESSION['nivel']==1) {
            $rspta=$enterprises->listenterprises();
            $data=Array();
            while ($reg=$rspta->fetchObject()) {
                $uregistrados=$enterprises->uregistrados($reg->idempresa);
                $data[]=array(
                    "0"=>$reg->nombreempresa,
                    "1"=>$reg->rfc,
                    "2"=>$reg->contacto,
                    "3"=>$reg->emailempresa,
                    "4"=>$reg->cupo,
                    "5"=>$uregistrados['registrados'],
                    "6"=>$reg->cupo-$uregistrados['registrados'],
                    "7"=>$reg->nombreconsultor,
                    "8"=>($reg->estatusempresa)?'<i class="fas fa-check-circle fa-2x"></i>':'',
                    "9"=>($reg->estatusempresa)?'<button title="SUSPENDER EMPRESA" class="btn btn-success btn-sm" onclick="suspender('.$reg->idempresa.')"><i class="fas fa-times-circle"></i></button> '.'<button title="EDITAR EMPRESA" class="btn btn-info btn-sm" data-toggle="modal" onclick="editar('.$reg->idempresa.')" data-target=".bd-example-modal-lg"><i class="fas fa-edit"></i></button>'.
                    '  <button title="ELIMINAR EMPRESA" class="btn btn-danger btn-sm" onclick="eliminar('.$reg->idempresa.')"><i class="fas fa-trash"></i></button>':'<button title="ACTIVAR EMPRESA" class="btn btn-warning btn-sm" onclick="activar('.$reg->idempresa.')"><i class="fas fa-check-circle"></i></button> '.
                                '<button title="EDITAR EMPRESA" class="btn btn-info btn-sm" data-toggle="modal" onclick="editar('.$reg->idempresa.')" data-target=".bd-example-modal-lg"><i class="fas fa-edit"></i></button>'.
                                '  <button title="ELIMINAR EMPRESA" class="btn btn-danger btn-sm" onclick="eliminar('.$reg->idempresa.')"><i class="fas fa-trash"></i></button>'
                );
            }
            $results = array(
                "sEcho"=>1,  // informacion para el data table
                "iTotalRecords"=>count($data),//total registros
                "iTotalDisplayRecords"=>count($data),//total registos para visualizar
                "aaData"=>$data
            );
            echo json_encode($results);
        }
        if ($_SESSION['nivel']==2) {
            $id_usuario=$_SESSION['id'];
            $rspta=$enterprises->listenterprisesconsultores($id_usuario);
            $data=Array();
            while ($reg=$rspta->fetchObject()) {
                $uregistrados=$enterprises->uregistrados($reg->id);
                $data[]=array(
                    "0"=>$reg->nombre,
                    "1"=>$reg->rfc,
                    "2"=>$reg->contacto,
                    "3"=>$reg->email,
                    "4"=>$reg->cupo,
                    "5"=>$uregistrados['registrados'],
                    "6"=>$reg->cupo-$uregistrados['registrados'],
                    "7"=>($reg->estatus)?'<i class="fas fa-check-circle fa-2x"></i>':'',
                    "8"=>($reg->estatus)?'<button title="SUSPENDER EMPRESA" class="btn btn-success btn-sm" onclick="suspender('.$reg->id.')"><i class="fas fa-times-circle"></i></button> '.'<button title="EDITAR EMPRESA" class="btn btn-info btn-sm" data-toggle="modal" onclick="editar('.$reg->id.')" data-target=".bd-example-modal-lg"><i class="fas fa-edit"></i></button>'.
                    '  <button title="ELIMINAR EMPRESA" class="btn btn-danger btn-sm" onclick="eliminar('.$reg->id.')"><i class="fas fa-trash"></i></button>':'<button title="ACTIVAR EMPRESA" class="btn btn-warning btn-sm" onclick="activar('.$reg->id.')"><i class="fas fa-check-circle"></i></button> '.
                                '<button title="EDITAR EMPRESA" class="btn btn-info btn-sm" data-toggle="modal" onclick="editar('.$reg->id.')" data-target=".bd-example-modal-lg"><i class="fas fa-edit"></i></button>'.
                                '  <button title="ELIMINAR EMPRESA" class="btn btn-danger btn-sm" onclick="eliminar('.$reg->id.')"><i class="fas fa-trash"></i></button>'
                );
            }
            $results = array(
                "sEcho"=>1,  // informacion para el data table
                "iTotalRecords"=>count($data),//total registros
                "iTotalDisplayRecords"=>count($data),//total registos para visualizar
                "aaData"=>$data
            );
            echo json_encode($results);
        }

        break;
    
    default:
        # code...
        break;
}
