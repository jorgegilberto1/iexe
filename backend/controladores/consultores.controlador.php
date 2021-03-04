<?php
require_once "../modelos/Consultores.php";
session_start();
$consultores= new Consultores();

$opcion= @$_GET["opcion"];

$nombre_alumno= @$_POST["nombre_alumno"];
$email= @$_POST["email"];
$contrasena1= @$_POST["contrasena1"];
$contrasena2= @$_POST["contrasena2"];

$nombre_proyecto= @$_POST["nombre_proyecto"];
$tecnologia_usada= @$_POST["tecnologia_usada"];
$asignatura_desarrollo= @$_POST["asignatura_desarrollo"];
$fechaini_fechafin= @$_POST["fechaini_fechafin"];
$listado_habilidades= @$_POST["listado_habilidades"];

$error='';

switch ($opcion) {

    case 'guardarproyecto':
        $rspta=$consultores->guardarproyecto($nombre_proyecto,$tecnologia_usada,$asignatura_desarrollo,$fechaini_fechafin,$listado_habilidades,$_SESSION['id']);
        echo $rspta;
        break;

    case 'saveuser':
        $rspta=$consultores->ifexist($email);
        if ($rspta) {
            $error.= '<li>El Email ingresado ya existe intente con otro</li>';
        }
        if (strcmp ($contrasena1 , $contrasena2 ) !== 0) {
            $error.='<li>Las contraseñas no coinciden</li>';
        }
        if ($error=='') {
            $contrasena1=hash('SHA256',$contrasena1);
            $rspta=$consultores->registraralumno($nombre_alumno,$email,$contrasena1,2);
            echo $rspta;
        }
        echo $error;
        break;

    case 'lista_proyectos':
        $rspta=$consultores->lista_proyectos($_SESSION['id']);
        $data=Array();
        while ($reg=$rspta->fetchObject()) {
            $data[]=array(
                "0"=>$reg->nombre_proyecto,
                "1"=>$reg->tecnologia_usada,
                "2"=>$reg->asignatura_desarrollo,
                "3"=>$reg->fechaini_fechafin,
                "4"=>$reg->listado_habilidades
            );
        }
        $results = array(
            "sEcho"=>1,  // informacion para el data table
            "iTotalRecords"=>count($data),//total registros
            "iTotalDisplayRecords"=>count($data),//total registos para visualizar
            "aaData"=>$data
        );
        echo json_encode($results);
        # code...
        break;
    case 'lista_alumnos':
        $rspta=$consultores->lista_alumnos();
        $data=Array();
        while ($reg=$rspta->fetchObject()) {
            $data[]=array(
                "0"=>$reg->nombre,
                "1"=>$reg->email,
                "2"=>$reg->fecha
            );
        }
        $results = array(
            "sEcho"=>1,  // informacion para el data table
            "iTotalRecords"=>count($data),//total registros
            "iTotalDisplayRecords"=>count($data),//total registos para visualizar
            "aaData"=>$data
        );
        echo json_encode($results);
        # code...
        break;

    case 'lista_proyectos_alumnos':
        $rspta=$consultores->lista_proyectos_alumnos();
        $data=Array();
        while ($reg=$rspta->fetchObject()) {
            $data[]=array(
                "0"=>$reg->nombreproyecto,
                "1"=>$reg->tecnologia_usada,
                "2"=>$reg->asignatura_desarrollo,
                "3"=>$reg->fechaini_fechafin,
                "4"=>$reg->listado_habilidades,
                "5"=>$reg->nombrealumno
            );
        }
        $results = array(
            "sEcho"=>1,  // informacion para el data table
            "iTotalRecords"=>count($data),//total registros
            "iTotalDisplayRecords"=>count($data),//total registos para visualizar
            "aaData"=>$data
        );
        echo json_encode($results);
        # code...
        break;
    
    default:
        # code...
        break;
}