/**
 * Hace la solicitud de iniciar sesión
 */
async function AJAXrequest(){
    const url = "/modules/login/controller/login_controller.php";
    const params = {
        user: document.getElementById("inpTxtUser").value,
        pass: document.getElementById("inpPassPassword").value
    };
    const options = {
        method : "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body : JSON.stringify(params)
    };
    
    try{
        let res = await fetch(url, options), json = await res.json();
        if (!res.ok){
            throw new Error("AJAX-Request-Failed")
        }
        if(json.errors === ""){
            if (json.data.success){
                sucessStyle()
                setInterval(() => {location.href = "/"}, 500)
            }
            else{
                errorStyle()
            }
        } else{
            errorStyle()
            //alert("Errores en en servidor:\n" +
            //(new String(json.errors)).replace(";", '\n'));
        }
    } catch (err){
        errorStyle()
        console.log(`JavaScript.login_ajax:AJAX-Error: ${err}`)
    }
}

function errorStyle(){
    document.getElementById("inpTxtUser").style.boxShadow = "red 0px 0px 10px";
    document.getElementById("inpTxtUser").style.borderColor = "red";
    document.getElementById("inpPassPassword").style.boxShadow = "red 0px 0px 10px";
    document.getElementById("inpPassPassword").style.borderColor = "red";

    document.getElementById("inpBtnLogin").disabled=true;
}

function sucessStyle(){
    document.getElementById("inpTxtUser").style.boxShadow = "green 0px 0px 10px";
    document.getElementById("inpTxtUser").style.borderColor = "green";
    document.getElementById("inpPassPassword").style.boxShadow = "green 0px 0px 10px";
    document.getElementById("inpPassPassword").style.borderColor = "green";

    document.getElementById("inpBtnLogin").disabled=true;
}

window.addEventListener("load", function(){
    document.getElementById("inpBtnLogin").addEventListener("click", function(){
        AJAXrequest();
    });
    document.querySelector(".login-form").addEventListener("keypress", e => {
        if(e.keyCode === 13){
            AJAXrequest();
        }
    })
});