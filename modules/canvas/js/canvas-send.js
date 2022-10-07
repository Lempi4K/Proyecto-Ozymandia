function getExtension(filename) {
    let filenameSTR = new String(filename);
    return filenameSTR.slice((filenameSTR.lastIndexOf(".") - 1 >>> 0) + 2);
}

async function AJAX_FilesUpCanvas(articleJSON, id = 0){
    let files = new FormData();

    for(let i = 0; i < articleJSON.AEM.length; i++){
        let file = null;
        if(article.AEM[i].type == 6 || article.AEM[i].type == 7){
            file = article.AEM[i].img;
        }
        if(article.AEM[i].type == 8){
            file = article.AEM[i].pdf;
        }
        if(file != null){
            files.append(`${i}`, file, `${i}.${getExtension(file.name)}`)
        }
    }

    if(articleJSON.meta.type != 1  && articleJSON.meta.background_img != null){
        let file = articleJSON.meta.background_img;
        console.log(getExtension(articleJSON.meta.background_img));
        files.append("background_img", file, "background_img." + getExtension(file.name));
    }

    files.append("aid", id)

    const url = "/modules/canvas/controller/canvas_file_controller.php";

    const options = {
        method : "POST",
        headers: {
            //'Content-Type': 'application/json'
        },
        body : files,
        
    };
    try{
        let res = await fetch (url, options), json = await res.json();
        
        if (!res.ok){
            throw new Error("AJAX-Request-Failed");
        }
        console.log(json)

        articleJSON.meta.id = json.data.article_id;
        for(let i = 0; i < articleJSON.AEM.length; i++){
            if(article.AEM[i].type == 6 || article.AEM[i].type == 7){
                articleJSON.AEM[i].img = json.data.routes[i];
            }
            if(article.AEM[i].type == 8){
                articleJSON.AEM[i].pdf = json.data.routes[i];
            }
        }
        if(articleJSON.meta.type != 1 && articleJSON.meta.background_img != null){
            articleJSON.meta.background_img = json.data.routes["background_img"];
        }
        return articleJSON;
    } catch (err){
        console.log(err);
    }
}

async function AJAX_SendCanvas(articleJSON, id=0){
    console.log(id)
    articleJSON = await AJAX_FilesUpCanvas(articleJSON, id);
    const url = "/modules/canvas/controller/canvas_controller.php";

    let params = {
        article: articleJSON,
        aid: id
    };

    const options = {
        method : "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body : JSON.stringify(params),
    };
    try{
        let res = await fetch (url, options), json = await res.json();
        
        if (!res.ok){
            throw new Error("AJAX-Request-Failed");
        }
        console.log(json);
        return json.data.success;
    } catch (err){
        return false;
    }
}

function canvas_send(){
    document.getElementById("cnvFrmPubBtn").addEventListener("click", e => {
        openFrames(false, true);
    });

    document.getElementById("cnvFrmBackPubBtn").addEventListener("click", e => {
        closeFrames(true);
    });

    document.getElementById("cnvFrmNextPubBtn").addEventListener("click", async e => {
        console.log(article);
        if(await AJAX_SendCanvas(article, parseInt(getParameterByName("id")))){
            window.history.pushState({}, "", "/inicio");
            handleLocation();
            document.getElementById("inpRdbtnNav1").checked = true;
        } else{
            console.log("Error al mandar articulo")
        }
    });
}