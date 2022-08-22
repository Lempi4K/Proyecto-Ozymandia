window.addEventListener("load", function(){
    async function AJAXrequest(){
        const url = "/modules/check-token/controller/check-token_controller.php";
        const params = {};
        const options = {
            method : "POST",
            body : JSON.stringify(params)
        };

        try{
            let res = await fetch (url, options), json = await res.json();
            if (!res.ok){
                throw new Error("AJAX-Request-Failed")
            }

            if(json.errors === ""){
                if (!json.data.token_lives){
                }
                else{
                    alert("Ya has iniciado sesion");
                    location.href = "/index.php";
                }
            } else{
                alert("Errores en en servidor:\n" +
                (new String(json.errors)).replace(";", '\n'));
            }
        } catch (err){
            console.log(`JavaScript.login_ajax:AJAX-Error: ${err}`)
        }
    }

    AJAXrequest();
});