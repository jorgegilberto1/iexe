$("#form-empresas").submit(function(e) {
    e.preventDefault(); 
    var formData = new FormData($("#form-empresas")[0]);
    console.log(formData);
    $.ajax({
        url: "controladores/enterprises.controlador.php?opcion=saveenterprise",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos)
        {  
            console.log(datos)
            if (datos==1) {
                toastr.success('Empresa registrada con éxito')
                tablaempresas.ajax.reload();
                $('#form-empresas')[0].reset();
            }else {
                toastr.error(datos)
            }         
        }

    });
  
});

$("#form-admin-empresa").submit(function(e) {
    e.preventDefault(); 
    var formData = new FormData($("#form-admin-empresa")[0]);
    console.log(formData);
    $.ajax({
        url: "controladores/enterprises.controlador.php?opcion=saveuserenterprise",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos)
        {  
            console.log(datos)
            if (datos==1) {
                toastr.success('Usuario registrado con éxito')
                tablaempresas.ajax.reload();
                $('#form-admin-empresa')[0].reset();
            }else {
                toastr.error(datos)
            }         
        }

    });
  
});

$( "#registrarvalidacionadicional" ).click(function() {
    $("#mostrarregistrarvalidacionadicional").show();
    $("#cerrarinfoadicional").show();
  });

  $( "#registrarvalidacionadicionalempresa" ).click(function() {
    $("#registrarinfomostrar").show();
    $("#cerrarinfoadicionalempresa").show();
  });

$( "#cerrarinfoadicional" ).click(function() {
    $("#mostrarregistrarvalidacionadicional").hide();
    $("#cerrarinfoadicional").hide();
});

$( "#cerrarinfoadicionalempresa" ).click(function() {
    $("#registrarinfomostrar").hide();
    $("#cerrarinfoadicionalempresa").hide();
});

$("#descargar_plantilla").click(function(){
    $("#descargarcsv").trigger("click");
});

tablaempresas=$("#listadodeempresas").dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    buttons: [		          
		            /* 'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf' */
                ],
        "columnDefs": [
            { "width": "14%", "targets": 0 },
            { "width": "3%", "targets": 4 },
            { "width": "3%", "targets": 5 },
            { "width": "3%", "targets": 6 }
                ],
		"ajax":
				{
					url: 'controladores/enterprises.controlador.php?opcion=listenterprises',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
                },
        "language":{
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            buttons: {
                copyTitle: 'Tabla Copiada de manera Exitósa',
                copySuccess: {
                    _: 'Se copio %d filas',
                    1: 'Se copio 1 fila'
                }
            }					
        },
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
    }).DataTable();

    function suspender(idempresa) {
        $.post("controladores/enterprises.controlador.php?opcion=suspenderempresa",{idempresa : idempresa}, function(data, status)
	{
		if (data==1) {
            tablaempresas.ajax.reload();
        }
 	});
    }

    function activar(idempresa) {
        $.post("controladores/enterprises.controlador.php?opcion=activarempresa",{idempresa : idempresa}, function(data, status)
	{
		if (data==1) {
            tablaempresas.ajax.reload();
        }
 	});
    }

    $('#form-file').change(function(e){

        upload(e);
    });

    function browserSupportFileUpload() {
        var isCompatible = false;
        if (window.File && window.FileReader && window.FileList && window.Blob) {
        isCompatible = true;
        }
        return isCompatible;
    }


    function upload(evt) {
        if (!browserSupportFileUpload()) {
            msj = 'Las APIs no son soportadas por este explorador, por favor intenta con otro y si el problema persiste reportalo a <a href="mailto:soporte@makeitwork.tv">soporte@makeitwork.tv</a>';
            $(".danger_btn").data("message", msj);
            $(".danger_btn").trigger("click");	
        } else {
            var data = null;
            var file = evt.target.files[0];
            var reader = new FileReader();
            reader.readAsText(file, 'ISO-8859-1');
            reader.onload = function(event) {
                var csvData = event.target.result;
                data_plantilla = $.csv.toArrays(csvData);
                if (data_plantilla && data_plantilla.length > 0) {
                    $("#loader").fadeIn();
                    $("#form-file").val("");
                    var user=document.getElementById("plantilla_personal").value
                    $.ajax({
                        type: 'POST',
                        url: js_site+"gestion-empresas",
                        data:{
                            plantilla : true, 
                            csv : data_plantilla,
                            plantillapersonal: user
                        },
                        success:function(msj){	
                            if(msj !=1){
                                $("#loader").fadeOut();
                                $(".danger_btn").data("message", msj);
                                $(".danger_btn").trigger("click");
                            }
                            if(msj==1){
                                $("#loader").fadeOut();
                                mensaje = "<a href='#' class='notify-action'>Cerrar</a> Plantilla de trabajadores cargada de manera exitosa";
                                $(".success_btn").data("message", mensaje);
                                $(".success_btn").trigger("click");
                                setTimeout(function(){
                                    location.reload();
                                },3000);
                            }
                            setTimeout(function(){
                                    location.reload();
                                },5000);
                        }
                    });							
                } else {
                    msj = 'Favor de verificar que el archivo contiene información y al guardar el archivo seleccione guardar como CSV delimitado por comas, si el problema persiste reportalo a <a href="mailto:soporte@makeitwork.tv">soporte@makeitwork.tv</a>';
                    $(".danger_btn").data("message", msj);
                    $(".danger_btn").trigger("click");	
                }
            };
            reader.onerror = function() {
                alert('Unable to read ' + file.fileName);
            };
        }
    }