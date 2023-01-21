/**
 * Hace la solicitud con las páginas y los permisos bloqueados
 * @param {string} path 
 * @returns void
 */
async function AJAXrequestChckToken(path){
    const blackList = {
        "/perfil": "Ozy.Profile.see",
        "/aplicaciones": "Ozy.Aplications.see",
        "/iniciar-sesion": "Ozy.Login.see",
        "/lienzo": "Ozy.Canvas.see",
        "/pruebas": "Ozy.Tests.see"
    };
    const url = "/modules/check-token/controller/check-token_controller.php";
    const params = {
        blkPerm: blackList[path] || "",
    };
    //console.log(params.blkPerm)
    const options = {
        method : "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body : JSON.stringify(params)
    };
    try{
        let res = await fetch (url, options), json = await res.json();
        if (!res.ok){
            throw new Error("AJAX-Request-Failed")
        }
        console.log(json)
        if(json.errors === ""){
            console.log(json.data.result);
            return json.data.result;
        } else{
            throw new Error(new String((json.errors)).replace(";", '\n'));
        }
    } catch (err){
        let res = await fetch (url, options), json = await res.text();
        console.log(json);
        console.log("JavaScript.login_ajax:AJAX-Error: " + err);
    }
}