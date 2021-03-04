<?php

require_once '../libraries/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
session_start();
ob_start();

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de resultados</title>
    <style>
		
		.centrado{text-align:center;border:1px dotted #000; padding:8px;}
		div{width:50%;border:1px dotted #f00;padding:8px;margin:auto;}
		center{margin:16px 0;}
	</style>
</head>
<body>
    <h2 class="centrado">Reporte de resultados en la validación</h2>
    <h3 style="text-align: center">EJECUTIVO: <?php echo $_SESSION['nombre'] ?></h3>
    <h3 style="text-align: center">RFC: <?php echo $_SESSION['rfc'] ?></h3>
    <h3 style="text-align: center">Hallazgos 4</h3>
    <p> <?php echo $_GET['mensaje']; ?> </p>
    <P> Puedes ser acreedor a una sancion de acuerdo al Art. 184 fr. III LA y Art. 185 fr. II LA que va desde los
1800 hasta 2570. </P>
    <h3 style="color:red">Importe calculado de la sanción $<?php echo number_format(@$_GET['importetotal']); ?></h3>
</body>
</html>

<?php
$dompdf = new Dompdf();
$dompdf->loadhtml(ob_get_clean());
$dompdf->SetPaper('A4','porttrait');
$dompdf->render();
$dompdf->stream('reporte');

