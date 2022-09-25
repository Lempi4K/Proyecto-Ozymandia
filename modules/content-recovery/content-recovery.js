async function AJAXrequestContent(query){
    const url = "/modules/content-recovery/php/content-recovery_controller.php";
    let params = query;
    const options = {
        method : "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body : JSON.stringify(params)
    };
    try{
        let res = await fetch (url, options), json = await res.json();
        console.log(json);

        if (!res.ok){
            throw new Error("AJAX-Request-Failed");
        }
        return json.HTML;
    } catch (err){
        let HTML = "<div class='display-error-main'><p>" + `JavaScript.login_ajax:AJAX-Error: ${err.message}` +"<br><u>Recarga la página o contacta al webmaster<u></p></div>";
        return HTML;
    }
}