tablaconsultores=$("#listadodeconsultores").dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    buttons: [		          
		            /* 'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf' */
		        ],
		"ajax":
				{
					url: 'controladores/consultores.controlador.php?opcion=listarconsultores',
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

    $("#form-registrar-consultor").submit(function(e) {
        e.preventDefault(); 
        var formData = new FormData($("#form-registrar-consultor")[0]);
        console.log(formData);
        $.ajax({
            url: "controladores/consultores.controlador.php?opcion=saveuser",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
    
            success: function(datos)
            {  
                if (datos==1) {
                    toastr.success('Consultor registrado con éxito')
                    tablaconsultores.ajax.reload();
                    $('#form-registrar-consultor')[0].reset();
                }else {
                    toastr.error(datos)
                }	          
            }
    
        });
      
    });