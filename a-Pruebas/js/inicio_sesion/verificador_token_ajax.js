$(document).ready(function(e){
    $.ajax({
        type:"POST",
        url:"../../php/funcionamiento/inicio_sesion/verificador_token_ajax.php",
        data: {},
        success: function(response){
            alert(response);
            var jsonData = JSON.parse(response);
            if(jsonData.success == 0){
                alert("Hazme el favor de iniciar sesion >:v");
            }else{
                document.write("Ya has iniciado sesion");
                location.href = "/php/home.php";
            }
        },
        error: function(error){
            alert(`No se pudo hacer solicitud AJAX: ${error}`);
        }
    });
});