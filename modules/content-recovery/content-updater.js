/**
 * LazyLoad al scrollear la página 
 */

function follow_event(){
    for(let item of document.getElementsByName("inpChckbxFollow")){
        item.addEventListener("change", async e => {
            let sublabel_id = e.target.value;
            console.log(sublabel_id);
            let action = e.target.checked;

            for(let items of document.getElementsByClassName(item.classList.toString())){
                items.checked = action;
            }
            (await AJAXEditFollow(sublabel_id, action));
        });
    }
}

/**
 * Solicitud para actualizar los temas seguidos
 * @param {int} sublabel_id 
 * @param {boolean} action 
 * @returns {boolean} json.success
 */
async function AJAXEditFollow(sublabel_id, action = false){
    const url = "/modules/content-recovery/php/follow_manager.php";
    let params = {
        sublabel_id: sublabel_id,
        action: action
    };
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
            throw new Error("AJAX-Request-Failed");
        }
        console.log(json.sublabel)
        return json.success;
    } catch (err){
        let HTML = "<div class='display-error-main'><p>" + `JavaScript.Content_ajax:AJAX-Error: ${err.message}` +"<br><u>Recarga la página o contacta al webmaster<u></p></div>";
        return HTML;
    }
}