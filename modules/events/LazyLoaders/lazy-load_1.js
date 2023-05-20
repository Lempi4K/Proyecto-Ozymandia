if(document.getElementById("articles-container") != null){
    let articles_container = document.getElementById("articles-container");
    articles_container.addEventListener("scroll", async function (){
        await lz_load_1(articles_container);
    });
    articles_container.addEventListener("touchmove", async function (){
        await lz_load_1(articles_container);
    });
    articles_container.addEventListener("touchend", async function (){
        await lz_load_1(articles_container);
    });
    articles_container.addEventListener("touchstart", async function (){
        await lz_load_1(articles_container);
    });

    articles_container.addEventListener("AJAXLoad", e => {
        follow_event();
    });

    async function lz_load_1(objectAC){
        if(objectAC.offsetHeight + objectAC.scrollTop >= objectAC.scrollHeight){
            let articles = objectAC.getElementsByClassName("article")
            let lastArticle = articles[articles.length - 1];
            let firstArticle = articles[0];
            if(location.pathname == "/buscar"){
                if(objectAC.firstChild.nextSibling.classList.contains("aside_container")){
                    return;
                }
            }
            if(parseInt(lastArticle.dataset.eof) == 1){
                return;
            }

            let start = 0;
            if (parseInt(firstArticle.dataset.aid) > parseInt(lastArticle.dataset.aid)){
                start = parseInt(lastArticle.dataset.aid) - 1;
            }

            if (parseInt(firstArticle.dataset.aid) < parseInt(lastArticle.dataset.aid)){
                start = parseInt(lastArticle.dataset.aid) + 1;
            }

            if (parseInt(firstArticle.dataset.aid) == parseInt(lastArticle.dataset.aid)){
                return;
            }

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
            objectAC.innerHTML = objectAC.innerHTML + newContent;
            objectAC.dispatchEvent(AJAXLoad);

        }
    }
}

