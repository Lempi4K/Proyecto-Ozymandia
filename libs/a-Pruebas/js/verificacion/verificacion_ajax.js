$(document).ready(function(e){
    $.ajax({
        type:"POST",
        url:"../../php/funcionamiento/verificacion/verificacion.php",
        data: {},
        success: function(response){
            alert(response);
            var jsonData = JSON.parse(response);
            if(jsonData.success == 1){
            }else{
                document.write("No has iniciado sesion");
                location.href = "/index.php";
            }
        },
        error: function(error){
            alert(`No se pudo hacer solicitud AJAX: ${error}`);
        }
    });
});