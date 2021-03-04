$('#datastage-contact-form').submit(function(e){
    e.preventDefault();
    $(".progress").show();
    $(".mensajeprogreso").html("Subiendo ... 10%");
    $(".progress-bar").removeClass("bg-primary");
    var formData = new FormData($("#datastage-contact-form")[0]);
    var archivos = document.getElementById('exampleFormControlFile1').files.length;
    $.ajax({
        url : "controladores/datastage.controlador.php?opcion=guardardata",
        method : "POST",
        data: formData,
        contentType:false,
        processData:false,
        success: function(data){
            console.log(data);
            if (data==2) {
                toastr.warning('Seleccione una empresa para comenzar a subir un DataStage');
                $(".progress").hide();
            } else {
                var indices = [];
                for(var i = 0; i < data.length; i++) {
                    if (data[i].toLowerCase() === "1") indices.push(i);
                }
                console.log(indices.length);
                console.log(archivos);
                if (indices.length==archivos) { //comparamos si el numero de archivos subidos (archivos) coinciden con los archivos que se guardaron correctamente (indices.length) significa que el almacenamiento fue exitoso
                    $.post("controladores/archivom.controlador.php?opcion=guardarcriterios", function(data, status)
                        {
                            
                        });
                    toastr.success('Guardado con éxito')
                    $(".progress-bar").css("width", "100%");
                    $(".mensajeprogreso").html("100%");
                    $(".progress-bar").addClass("bg-success");
                } else {
                    $(".toastrDefaultError").trigger("click");
                    $(".mensajeprogreso").html("ERROR");
                    $(".progress-bar").addClass("bg-danger");
                }
            }

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log(textStatus);
            toastr.error('Ocurrio un error al subir el archivo') 
        }
    })
    $("#datastage-contact-form")[0].reset();
});






