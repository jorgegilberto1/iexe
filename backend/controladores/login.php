<?php
session_start();
require_once "../modelos/Login.php";
$login= new Login();
$opcion= @$_GET["opcion"];

$email= @$_POST["email"];
$password= @$_POST["password"];

switch ($opcion) {
    case 'login':
        $password=hash('SHA256',$password);
        $rspta=$login->validatelogin($email,$password);
        $estatuslogin=0;//0 contraseña o email incorrecto, 1 login correcto, 2 suspendido
        if ($rspta) {//validamos que el usuario y la contraseña sean correctas
            $_SESSION['id']=$rspta['id'];
            $_SESSION['nombre']=$rspta['nombre'];
            $_SESSION['email']=$rspta['email'];
            $_SESSION['nivel']=$rspta['nivel'];
            $estatuslogin=1;
            if ($rspta['nivel']==='2') {//verificamos si quien esta ingresando es alumno
                

            }
            
        }else {
            $estatuslogin=0;
        }   
        echo $estatuslogin;
        break;
    case 'logout':
                    session_unset();
                    session_destroy();
                    header('Location: ../../');  
        break;
    
    default:
        # code...
        break;
}