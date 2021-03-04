<?php
require_once "../modelos/Glosa.php";
session_start();
$glosa= new Glosa();
$opcion= @$_GET["opcion"];
$fechainicial= @$_POST["fechainicial"];
$fechafinal= @$_POST["fechafinal"];
switch ($opcion) {

    case 'getfechasgatastage':
        if ($_SESSION['rfc']==='0') {
            echo 2;
        } else {
            $idempresa=$glosa->getidenterprise($_SESSION['rfc']);
            $getdate=$glosa->getdate($idempresa['id']);
            $dateunique='';
            foreach ($getdate as $key => $value) {
                $arr = explode( PHP_EOL , $value['informacion']);
                unset($arr[0]);
                foreach ($arr as $key => $value2) {
                    $camposindividualesnuevo=explode("|",$value2);
                    if (count($camposindividualesnuevo)!=1) { //Se imprime un arreglo demás en cada campo el cual causa un offset evitamos la lectura para evadir el error
                    $camposindividualesnuevo=explode(" ",$camposindividualesnuevo[5]);
                    $mesesglosas = substr($camposindividualesnuevo[0], 0, -3);
                    $dateunique.=$mesesglosas.'|';
                    }   
                }
            }
            $dateunique = substr($dateunique, 0, -1);
            $dateunique=explode("|",$dateunique);
            $resultado = array_unique($dateunique);
            rsort($resultado, SORT_STRING);
            echo json_encode($resultado);

            /* $data=Array();
            while ($reg=(object)$resultado) {
                $data[]=array(
                    "0"=>$reg->nombre,
                    "1"=>$reg->rfc,
                    "2"=>'<button title="EDITAR EMPRESA" class="btn btn-info btn-sm" data-toggle="modal" onclick="editar('.$reg->id.')" data-target=".bd-example-modal-lg">EDITAR</button>'.
                                '  <button title="ELIMINAR EMPRESA" class="btn btn-danger btn-sm" onclick="eliminar('.$reg->id.')">ELIMINAR</button>'
                );
            }
            $results = array(
                "sEcho"=>1,  // informacion para el data table
                "iTotalRecords"=>count($data),//total registros
                "iTotalDisplayRecords"=>count($data),//total registos para visualizar
                "aaData"=>$data
            );
            echo json_encode($results); */

            }
        break;

    case 'downloadglosa':
        if ($_SESSION['rfc']==='0') {
            echo 2;
        } else {
            $rfc=$_SESSION['rfc'];
            $rspta=$glosa->getglosa($rfc,'501_datos_generales');
            $rspta1=$glosa->exportglosa($rspta,'glosa/501_Datos_generales.txt','Patente,Pedimento,SeccionAduanera,TipoOperacion,ClaveDocumento,SeccionAduaneraEntrada,CurpContribuyente,Rfc,CurpAgenteA,TipoCambio,TotalFletes,TotalSeguros,TotalEmbalajes,TotalIncrementables,TotalDeducibles,PesoBrutoMercancia,MedioTransporteSalida,MedioTransporteArribo,MedioTransporteEntrada_Salida,DestinoMercancia,NombreContribuyente,CalleContribuyente,NumInteriorContribuyente,NumExteriorContribuyente,CPContribuyente,MunicipioContribuyente,EntidadFedContribuyente,PaisContribuyente,TipoPedimento,FechaRecepcionPedimento,FechaPagoReal',30,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'502_transporte_de_las_mercancias');
            $rspta1=$glosa->exportglosa($rspta,'glosa/502_Transporte_de_las_mercancias.txt','Patente,Pedimento,SeccionAduanera,RfcTransportista,CurpTransportista,NombreTransportista,PaisTransporte,IdentificadorTransporte,FechaPagoReal',8,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'503_guias');
            $rspta1=$glosa->exportglosa($rspta,'glosa/503_Guias.txt','Patente,Pedimento,SeccionAduanera,NumeroGuia,TipoGuia,FechaPagoReal',5,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'504_contenedores');
            $rspta1=$glosa->exportglosa($rspta,'glosa/504_Contenedores.txt','Patente,Pedimento,SeccionAduanera,NumContenedor,TipoContenedor,FechaPagoReal',5,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'505_facturas');
            $rspta1=$glosa->exportglosa($rspta,'glosa/505_Facturas.txt','Patente,Pedimento,SeccionAduanera,FechaFacturacion,NumeroFactura,TerminoFacturacion,MonedaFacturacion,ValorDolares,ValorMonedaExtranjera,PaisFacturacion,EntidadFedFacturacion,IndentFiscalProveedor,ProveedorMercancia,CalleProveedor,NumInteriorProveedor,NumExteriorProveedor,CpProveedor,MunicipioProveedor,FechaPagoReal',18,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'506_fechas_del_pedimento');
            $rspta1=$glosa->exportglosa($rspta,'glosa/506_Fechas_del_pedimento.txt','Patente,Pedimento,SeccionAduanera,TipoFecha,FechaOperacion,FechaValidacionPagoR',5,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'507_casos_del_pedimento');
            $rspta1=$glosa->exportglosa($rspta,'glosa/507_Casos_del_pedimento.txt','Patente,Pedimento,SeccionAduanera,ClaveCaso,IdentificadorCaso,TipoPedimento,ComplementoCaso,FechaValidacionPagoR',7,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'508_cuentas_aduaneras_de_garantia_del_pedimento');
            $rspta1=$glosa->exportglosa($rspta,'glosa/508_Cuentas_aduaneras_de_garantia_del_pedimento.txt','Patente,Pedimento,SeccionAduanera,InstitucionEmisora,NumeroCuenta,FolioConstancia,FechaConstancia,TipoCuenta,ClaveGarantia,ValorUnitarioTitulo,TotalGarantia,CantidadUnidades,TitulosAsignados,FechaPagoReal',13,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'509_tasas_del_pedimento');
            $rspta1=$glosa->exportglosa($rspta,'glosa/509_Tasas_del_pedimento.txt','Patente,Pedimento,SeccionAduanera,ClaveContribucion,TasaContribucion,TipoTasa,TipoPedimento,FechaPagoReal',7,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'510_contribuciones_del_pedimento');
            $rspta1=$glosa->exportglosa($rspta,'glosa/510_Contribuciones_del_pedimento.txt','Patente,Pedimento,SeccionAduanera,ClaveContribucion,FormaPago,ImportePago,TipoPedimento,FechaPagoReal',7,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'511_observaciones_del_pedimento');
            $rspta1=$glosa->exportglosa($rspta,'glosa/511_Observaciones_del_pedimento.txt','Patente,Pedimento,SeccionAduanera,SecuenciaObservacion,Observaciones,TipoPedimento,FechaValidacionPagoR',6,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'512_descargos_de_mercancia');
            $rspta1=$glosa->exportglosa($rspta,'glosa/512_Descargos_de_mercancia.txt','Patente,Pedimento,SeccionAduanera,PatenteAduanalOrig,PedimentoOriginal,SeccionAduaneraDespOrig,DocumentoOriginal,FechaOperacionOrig,FraccionOriginal,UnidadMedida,MercanciaDescargada,TipoPedimento,FechaPagoReal',12,$fechainicial,$fechafinal);

            //$rspta=$glosa->getglosa($rfc,'514_movimientos_en_cuenta_aduanera');
            //$rspta1=$glosa->exportglosa($rspta,'glosa/514_Movimientos_en_cuenta_aduanera.txt','ENCABEZADOS',7,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'520_destinatarios_de_la_mercancia');
            $rspta1=$glosa->exportglosa($rspta,'glosa/520_Destinatarios_de_la_mercancia.txt','Patente,Pedimento,SeccionAduanera,IndentFiscalDestinatario,NombreDestinatarioMercancia,CalleDestinatario,NumInteriorDestinatario,NumExteriorDestinatario,CpDestinatario,MunicpioDestinatario,PaisDestinatario,FechaPagoReal',11,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'551_partidas');
            $rspta1=$glosa->exportglosa($rspta,'glosa/551_Partidas.txt','Patente,Pedimento,SeccionAduanera,Fraccion,SecuenciaFraccion,SubdivisionFraccion,DescripcionMercancia,PrecioUnitario,ValorAduana,ValorComercial,ValorDolares,CantidadUMComercial,UnidadMedidaComercial,CantidadUMTarifa,UnidadMedidaTarifa,ValorAgregado,ClaveVinculacion,MetodoValorizacion,CodigoMercanciaProducto,MarcaMercanciaProducto,ModeloMercanciaProducto,PaisOrigenDestino,PaisCompradorVendedor,EntidadFedOrigen,EntidadFedDestino,EntidadFedComprador,EntidadFedVendedor,TipoOperacion,ClaveDocumento,FechaPagoReal',29,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'552_mercancias');
            $rspta1=$glosa->exportglosa($rspta,'glosa/552_Mercancias.txt','Patente,Pedimento,SeccionAduanera,Fraccion,SecuenciaFraccion,VinNumeroSerie,KilometrajeVehiculo,FechaPagoReal',7,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'553_permisos_de_la_partida');
            $rspta1=$glosa->exportglosa($rspta,'glosa/553_Permisos_de_la_partida.txt','Patente,Pedimento,SeccionAduanera,Fraccion,SecuenciaFraccion,ClavePermiso,FirmaDescargo,NumeroPermiso,ValorComercialDolares,CantidadMUMTarifa,FechaPagoReal',10,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'554_casos_de_la_partida');
            $rspta1=$glosa->exportglosa($rspta,'glosa/554_Casos_de_la_partida.txt','Patente,Pedimento,SeccionAduanera,Fraccion,SecuenciaFraccion,ClaveCaso,IdentificadorCaso,ComplementoCaso,FechaPagoReal',8,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'555_cuentas_aduaneras_de_garantia');
            $rspta1=$glosa->exportglosa($rspta,'glosa/555_Cuentas_aduaneras_de_garantia.txt','Patente,Pedimento,SeccionAduanera,Fraccion,SecuenciaFraccion,InstitucionEmisora,NumeroCuenta,FolioConstancia,FechaConstancia,ClaveGarantia,ValorUnitarioTitulo,TotalGarantia,CantidadUnidadesMedida,TitulosAsignados,FechaPagoReal',14,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'556_tasas_de_las_contribuciones_de_la_partida');
            $rspta1=$glosa->exportglosa($rspta,'glosa/556_Tasas_de_las_contribuciones_de_la_partida.txt','Patente,Pedimento,SeccionAduanera,Fraccion,SecuenciaFraccion,ClaveContribucion,TasaContribucion,TipoTasa,FechaPagoReal',8,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'557_contribuciones_de_la_partida');
            $rspta1=$glosa->exportglosa($rspta,'glosa/557_Contribuciones_de_la_partida.txt','Patente,Pedimento,SeccionAduanera,Fraccion,SecuenciaFraccion,ClaveContribucion,FormaPago,ImportePago,FechaPagoReal',8,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'558_observaciones_de_la_partida');
            $rspta1=$glosa->exportglosa($rspta,'glosa/558_Observaciones_de_la_partida.txt','Patente,Pedimento,SeccionAduanera,Fraccion,SecuenciaFraccion,SecuenciaObservacion,Observaciones,FechaPagoReal',7,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'701_rectificaciones');
            $rspta1=$glosa->exportglosa($rspta,'glosa/701_Rectificaciones.txt','Patente,Pedimento,SeccionAduanera,ClaveDocumento,FechaPago,PedimentoAnterior,PatenteAnterior,SeccionAduaneraAnterior,DocumentoAnterior,FechaOperacionAnterior,PedimentoOriginal,PatenteAduanalOrig,SeccionAduaneraDespOrig,FechaPagoReal',13,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'702_diferencias_de_contribuciones_del_pedimento');
            $rspta1=$glosa->exportglosa($rspta,'glosa/702_Diferencias_de_contribuciones_del_pedimento.txt','Patente,Pedimento,SeccionAduanera,ClaveContribucion,FormaPago,ImportePago,TipoPedimento,FechaPagoReal',7,$fechainicial,$fechafinal);

            $rspta=$glosa->getglosa($rfc,'incidencias_del_reconocimiento');
            $rspta1=$glosa->exportglosa($rspta,'glosa/Incidencias_del_reconocimiento.txt','Patente,Pedimento,SeccionAduanera,ConsecutivoRemesa,NumeroSeleccion,FechaInicioReconocimiento,HoraInicioReconocimiento,FechaFinReconocimiento,HoraFinReconocimiento,Fraccion,SecuenciaFraccion,ClaveDocumento,TipoOperacion,GradoIncidencia,FechaSeleccion',5,$fechainicial,$fechafinal);
            
            $rspta=$glosa->getglosa($rfc,'seleccion_automatizada');
            $rspta1=$glosa->exportglosa($rspta,'glosa/Seleccion_automatizada.txt','Patente,Pedimento,SeccionAduanera,ConsecutivoRemesa,NumeroSeleccion,FechaSeleccion,HoraSeleccion,SemaforoFiscal,ClaveDocumento,TipoOperacion',5,$fechainicial,$fechafinal);

            }
        break;
    
    default:
        # code...
        break;
}