$(document).ready(function(e){
    $("#inpBtnCS").click(function (e){
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"../../php/funcionamiento/cerrar_sesion/cerrar_sesion.php",
            data: {},
            success: function(response){
                var jsonData = JSON.parse(response);
                if(jsonData.success == 1){
                    document.write("Se cerró sesion");
                    location.href = "/index.php";
                }
            },
            error: function(error){
                alert(`No se pudo hacer solicitud AJAX: ${error}`);
            }
        });
    });
});