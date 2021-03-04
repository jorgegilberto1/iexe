$.post("controladores/archivom.controlador.php?opcion=listselectrfc", function(data) {
    var data = JSON.parse(data);
    $("#selectrfc").append("<option>Elije...<option/>")
      $.each(data,function(index,element) {
        $("#selectrfc").append("<option value="+ element.rfc +">" + element.nombre+'-'+ element.rfc + "<option/>")
      });
  });


  $("#selectrfc").change(function() {
    var rfc = $( this ).val();
    $('#dir').show();
    $.post("controladores/archivom.controlador.php?opcion=changerfc",{rfc : rfc}, function(data){
        var data = JSON.parse(data);
        $("#statusrfc").html('RFC: '+data.rfc);
        $("#muestrarfc").html(data.rfc);
        $("#muestraempresa").html(data.nombre);
    });
  });

$.post("controladores/archivom.controlador.php?opcion=validaterfc", function(data, status){
    if (data==0) {
        $("#statusrfc").html('Seleccionar RFC');
        $("#muestrarfc").html('Seleccionar Empresa');
    }
    else{
        var data = JSON.parse(data);
        $("#statusrfc").html('RFC: '+data.rfc);
        $("#muestrarfc").html(data.rfc);
        $("#muestraempresa").html(data.nombre);
    }
 });

$('#contact-form0').submit(function(e){ //guardamos los criterios de validacion registo campo
    e.preventDefault();
    var formData = new FormData($("#contact-form0")[0]);
    $.ajax({
        url : "controladores/criterios.controlador.php?opcion=obtenercriterios",
        method : "POST",
        data: formData,
        contentType:false,
        processData:false,
        success: function(data){
            data = JSON.parse(data);
            /* $.each(data, function(i, item) {
                if (i>0) {
                    $( "#AgregarCampos" ).trigger( "click" );
                    $("#selecregistro"+i+"").val(item.registro).trigger('change');
                    $("#campo"+i+"").val(item.campo);
                }
                if (i==0) {
                    $("#selecregistro").val(item.registro).trigger('change');
                    $("#campo").val(item.campo);
                }
                //alert(item.registro +' '+ item.campo);
                /* $("#campo").val('Aduana-sección de Despacho');
                $("#campo1").val('Identificador de Guía ');
                $("#campo2").val('RFC del Importador o Exportador');
                $("#campo3").val('Fracción Arancelaria ');
                $("#campo4").val('Clave del Identificador'); */
            /*});*/
            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log(textStatus);
            $(".toastrDefaultError").trigger("click"); 
        }
    })
});
$('#contact-form').submit(function(e){ //guardamos los criterios de validacion registo campo
    e.preventDefault();
    var formData = new FormData($("#contact-form")[0]);
    $.ajax({
        url : "controladores/archivom.controlador.php?opcion=guardarcriterios",
        method : "POST",
        data: formData,
        contentType:false,
        processData:false,
        success: function(data){
            console.log(data);
            if (data==1) {
                $(".toastrDefaultSuccess").trigger("click");
            } else {
                $(".toastrDefaultError").trigger("click"); 
                $(".justifica").trigger("click");
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log(textStatus);
            $(".toastrDefaultError").trigger("click"); 
        }
    })
    $("#contact-form")[0].reset();
});
$('#form-validar-m').submit(function(e){
    e.preventDefault();
    var formData = new FormData($("#form-validar-m")[0]);
    $.ajax({
        url : "controladores/archivom.controlador.php?opcion=validarm",
        method : "POST",
        data: formData,
        contentType:false,
        processData:false,
        success: function(data){
            console.log(data);
            $("#resultadosm").show();
            $("#resultadosmmostrar").html(data);
            $(".toastrDefaultSuccess").trigger("click");

            if (data.indexOf("rectificacion") > -1) {
                $("#recti").show();
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log(textStatus);
            $(".toastrDefaultError").trigger("click"); 
        }
    })
    $("#contact-form2")[0].reset();
});
$('#form-justificacion').submit(function(e){
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
            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log(textStatus);
            $(".toastrDefaultError").trigger("click"); 
        }
    })
    //$("#form-justificacion")[0].reset();
});
$('.toastrDefaultSuccess').click(function() {
    toastr.success('Guardado con éxito')
});
$('.toastrDefaultError').click(function() {
    toastr.error('el archivo contiene un error')
});
var nextinput=0;
$('#AgregarCampos').click(function(e) {
    e.preventDefault();
    nextinput++;//utilzamos este contador para llevar un control del numero de campos a enviar y eliminarlos
    campo = '<div id="divarchivo'+nextinput+'" class="row">'+
                '<div class="col-sm-3 col-lg-4">'+
                    '<div class="form-group">'+
                        '<select id="selecregistro'+nextinput+'" name="registro-'+nextinput+'" class="form-control select2" style="">'+
                            '<option selected="selected" value="501">501 Datos Generales</option>'+
                            '<option value="502">502_Transporte_de_las_mercancias</option>'+
                            '<option value="503">503_Guias</option>'+
                            '<option value="504">504_Contenedores</option>'+
                            '<option value="505">505_Facturas</option>'+
                            '<option value="506">506_Fechas_del_pedimento</option>'+
                            '<option value="507">507_Casos_del_pedimento</option>'+
                            '<option value="508">508_Cuentas_Aduaneras_de_Garantia_del_Pedimento</option>'+
                            '<option value="509">509_Tasas_de_pedimento</option>'+
                            '<option value="510">510_Contribuciones_del_pedimento</option>'+
                            '<option value="511">511_Observaciones_del_pedimento</option>'+
                            '<option value="512">512_Descargos_de_mercancia</option>'+
                            '<option value="514">514_Movimientos_en_cuenta_audanera</option>'+
                            '<option value="520">520_Destinatarios_de_la_mercancia</option>'+
                            '<option value="551">551_Partidas</option>'+
                            '<option value="552">552_Mercancias</option>'+
                            '<option value="553">553_Permisos_de_la_partida</option>'+
                            '<option value="554">554_Casos_de_la_partida</option>'+
                            '<option value="555">555_Cuentas_Aduaneras_de_Garantia</option>'+
                            '<option value="556">556_Tasas_de_las_contribuciones_de_la_partida</option>'+
                            '<option value="557">557_Contribuciones_de_la_partida</option>'+
                            '<option value="558">558_Observaciones_de_la_partida</option>'+
                            '<option value="701">701_Rectificaciones</option>'+
                            '<option value="702">702_Diferencias_de_Contribuciones_del_pedimento</option>'+
                        '</select>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-3 col-lg-2">'+
                    '<input id="campo'+nextinput+'" name="campo-'+nextinput+'" type="text" class="form-control" placeholder="Campo" required>'+
                '</div>'+
            '</div>';
    $("#InputsDinamicos").append(campo);
    $('.select2').select2()
});
$("#EliminarCampos").click(function(e) {
    e.preventDefault();
    $("#divarchivo"+nextinput).remove();
    $("#divcampo"+nextinput).remove();
    nextinput--;
});

//Initialize Select2 Elements
$('.select2').select2()

//Initialize Select2 Elements
$('.select2bs4').select2({
  theme: 'bootstrap4'
})
