    
$('#reservation').daterangepicker()

$("#form-agregar-proyecto").submit(function(e) {
    e.preventDefault(); 
    var formData = new FormData($("#form-agregar-proyecto")[0]);
    console.log(formData);
    $.ajax({
        url: "controladores/consultores.controlador.php?opcion=guardarproyecto",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos)
        {  
            if (datos==1) {
                toastr.success('Proyecto registrado con éxito')
                $('#form-agregar-proyecto')[0].reset();
            }else {
                toastr.error(datos)
            }	          
        }

    });
  
});

$("#form-registrar-alumno").submit(function(e) {
    e.preventDefault(); 
    var formData = new FormData($("#form-registrar-alumno")[0]);
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
                toastr.success('Alumno registrado con éxito')
                lista_alumnos.ajax.reload();
                $('#form-registrar-alumno')[0].reset();
            }else {
                toastr.error(datos)
            }	          
        }

    });
  
});

lista_proyectos_alumnos=$("#lista_proyectos_alumnos").dataTable(
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
					url: 'controladores/consultores.controlador.php?opcion=lista_proyectos_alumnos',
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


lista_proyectos=$("#lista_proyectos").dataTable(
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
					url: 'controladores/consultores.controlador.php?opcion=lista_proyectos',
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

lista_alumnos=$("#lista_alumnos").dataTable(
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
                    url: 'controladores/consultores.controlador.php?opcion=lista_alumnos',
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