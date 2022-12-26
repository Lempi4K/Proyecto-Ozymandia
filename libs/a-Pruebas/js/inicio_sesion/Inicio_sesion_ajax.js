$(document).ready(function() {
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "../../php/funcionamiento/inicio_sesion/inicio_sesion.php",
            data: {"user" : document.getElementById("inpTxtUser").value,
                   "pass" : document.getElementById("inpPassPassword").value},
            success: function(response){
                alert(response);
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1"){
                    location.href = "php/home.php";
                }
                else{
                    alert("No pasa");
                }
           },
           error: function(error){
            alert(`No se pudo hacer solicitud AJAX: ${error}`);
           }
       });
     });
});