<?php
require_once "../modelos/Criterios.php";
$criterios= new Criterios();
$opcion= @$_GET["opcion"];
$rfc=@$_POST["rfc"];
switch ($opcion) {
    case 'obtenercriterios':
        $obtenercriterios=$criterios->obtenercriterios($rfc);
        echo json_encode($obtenercriterios);
    break;
    
    default:
        # code...
        break;
}
