<?php
require_once "../modelos/Administrarusuarios.php";
session_start();
$administrarusuarios= new Administrarusuarios();

$opcion= @$_GET["opcion"];
$idusuario=@$_POST["idusuario"];


switch ($opcion) {
    case 'listarusuariosdeempresa':
        $rfc=$_SESSION['rfc'];
        $rspta=$administrarusuarios->listarusuariosdeempresa($rfc);
        $data=Array();
        while ($reg=$rspta->fetchObject()) {
            $data[]=array(
                "0"=>$reg->nombre,
                "1"=>$reg->email,
                "2"=>($reg->estatus)?'<i class="fas fa-check-circle fa-2x"></i>':'',
                "3"=>($reg->estatus)?'<button title="SUSPENDER USUARIO" class="btn btn-success btn-sm" onclick="suspenderusuariodeempresa('.$reg->id.')"><i class="fas fa-times-circle"></i></button> '.'<button title="EDITAR USUARIO" class="btn btn-info btn-sm" data-toggle="modal" onclick="editar('.$reg->id.')" data-target=".bd-example-modal-lg"><i class="fas fa-edit"></i></button>'.
                '  <button title="ELIMINAR USUARIO" class="btn btn-danger btn-sm" onclick="eliminar('.$reg->id.')"><i class="fas fa-trash"></i></button>':'<button title="ACTIVAR USUARIO" class="btn btn-warning btn-sm" onclick="activarusuariodeempresa('.$reg->id.')"><i class="fas fa-check-circle"></i></button> '.
                            '<button title="EDITAR USUARIO" class="btn btn-info btn-sm" data-toggle="modal" onclick="editar('.$reg->id.')" data-target=".bd-example-modal-lg"><i class="fas fa-edit"></i></button>'.
                            '  <button title="ELIMINAR USUARIO" class="btn btn-danger btn-sm" onclick="eliminar('.$reg->id.')"><i class="fas fa-trash"></i></button>'
            );
        }
        $results = array(
            "sEcho"=>1,  // informacion para el data table
            "iTotalRecords"=>count($data),//total registros
            "iTotalDisplayRecords"=>count($data),//total registos para visualizar
            "aaData"=>$data
        );
        echo json_encode($results);
        break;
    case 'suspenderusuariodeempresa':
        $rspta=$administrarusuarios->suspenderusuario($idusuario);
        break;
    case 'activarusuariodeempresa':
        $rspta=$administrarusuarios->activarusuario($idusuario);
        break;
    default:
        # code...
        break;
}