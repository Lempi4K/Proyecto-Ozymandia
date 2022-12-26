/**
 * Hace la solicitud con las páginas y los permisos bloqueados
 * @param {string} path 
 * @returns void
 */
async function AJAXrequestChckToken(path){
    const blackList = {
        "/perfil": [-1, -1],
        "/aplicaciones": [-1, -1],
        "/iniciar-sesion": [-2, 0, 1, 2, 3, 4, 5],
        "/lienzo": [-1, 0]
    };
    const url = "/modules/check-token/controller/check-token_controller.php";
    const params = {
        blkPerm: blackList[path] || [-2, -2]
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
        if(json.errors === ""){
            console.log(json.data.result);
            return json.data.result;
        } else{
            throw new Error(new String((json.errors)).replace(";", '\n'));
        }
    } catch (err){
        console.log("JavaScript.login_ajax:AJAX-Error: " + err);
    }
}