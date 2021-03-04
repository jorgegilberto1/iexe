tablausuariosempresa=$("#listadodeusuariosempresa").dataTable(
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
					url: 'controladores/administrarusuarios.controlador.php?opcion=listarusuariosdeempresa',
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


    function suspenderusuariodeempresa(idusuario) {
        $.post("controladores/administrarusuarios.controlador.php?opcion=suspenderusuariodeempresa",{idusuario : idusuario}, function(data, status)
	{
		
        tablausuariosempresa.ajax.reload();
 	});
    }

    function activarusuariodeempresa(idusuario) {
        $.post("controladores/administrarusuarios.controlador.php?opcion=activarusuariodeempresa",{idusuario : idusuario}, function(data, status)
	{
		
        tablausuariosempresa.ajax.reload();
 	});
    }