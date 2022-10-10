window.addEventListener("load", e => {
    document.getElementById("replazable-content").addEventListener("AJAXLoad", e => {
        if(document.getElementById("articles-container") != null){
            let articles_container = document.getElementById("articles-container");
            articles_container.addEventListener("scroll", async function (){
                if(this.offsetHeight + this.scrollTop >= this.scrollHeight){
                    let articles = this.getElementsByClassName("article")
                    let lastArticle = articles[articles.length - 1];
                    if(parseInt(lastArticle.dataset.eof) == 1){
                        return;
                    }
                    let start = parseInt(lastArticle.dataset.aid) - 1;

                    let section;
                    for(let item of document.getElementsByName("inpRdbtnArtdiv")){
                        if (item.checked){
                            section = parseInt(item.value);
                        }
                    }

                    let newContent = await AJAXrequestContent(routeFabric(section, start));
                    if(newContent == ""){
                        newContent = "<article class='article' data-eof='1'><h3>No hay nada más que mostrar...</h3></article>";
                    }
                    this.innerHTML = this.innerHTML + newContent;
                    this.dispatchEvent(AJAXLoad);
                }
            });

            articles_container.addEventListener("AJAXLoad", e => {
                for(let item of document.getElementsByName("inpChckbxFollow")){
                    item.addEventListener("change", async e => {
                        let sublabel_id = e.target.value;
                        console.log(sublabel_id);
                        let action = false;
                        if(e.target.checked){
                            action = true;
                        } else{
                            action = false;
                        }
                        (await AJAXEditFollow(sublabel_id, action));
                    });
                }
            });
        }

        for(let item of document.getElementsByName("inpChckbxFollow")){
            item.addEventListener("change", async e => {
                let sublabel_id = e.target.value;
                console.log(sublabel_id);
                let action = false;
                if(e.target.checked){
                    action = true;
                } else{
                    action = false;
                }
                (await AJAXEditFollow(sublabel_id, action));
            });
        }
    });
});

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