/**
 * Solicitud al servidor para removr artículos
 * @param {int} aid 
 */
async function removeArticle(aid){
    const url = "/modules/content-remove/content-remove.php";
    const params = {
        aid: aid,
    };
    const options = {
        method : "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body : JSON.stringify(params)
    };
    console.log(aid)
    
    try{
        let res = await fetch(url, options), json = await res.text();
        if (!res.ok){
            throw new Error("AJAX-Request-Failed")
        }

        console.log(json)

    } catch (err){
        console.log(`JavaScript.login_ajax:AJAX-Error: ${err}`)
    }
}