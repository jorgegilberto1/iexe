    $( ".forgotpasword" ).click(function() {
        $("#restorepasword").show();
        $("#loginusuario").hide();
    });

    $( ".gotologin" ).click(function() {
        $("#restorepasword").hide();
        $("#loginusuario").show();
        $("#registeruser").hide();
        $("#inputnewpassword").hide();
    });

    $( ".userregister" ).click(function() {
        $("#restorepasword").hide();
        $("#loginusuario").hide();
        $("#registeruser").show();
    });

    $( ".newpassword" ).click(function(e) {
        e.preventDefault();
        $("#restorepasword").hide();
        $("#inputnewpassword").show();
    });

    $("#form-login").submit(function(e) {
        e.preventDefault(); 
        var formData = new FormData($("#form-login")[0]);
        console.log(formData);
        $.ajax({
            url: "backend/controladores/login.php?opcion=login",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
    
            success: function(datos)
            {  
                console.log(datos)
                if (datos==1) {
                    window.location.href='backend';
                }
                if(datos==0){
                    alert('usuario y/o contraseña incorrecta');
                }              
            }
    
        });
      
    });


