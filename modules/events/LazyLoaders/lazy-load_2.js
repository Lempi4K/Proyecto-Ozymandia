if(document.getElementById("inpRdbtnProdiv2").checked && document.getElementById("articles-container") != null){
    let articles_container = document.getElementById("articles-container");
    articles_container.addEventListener("scroll", async function (){
        await lz_load_2(articles_container);
    });
    articles_container.addEventListener("touchmove", async function (){
        await lz_load_2(articles_container);
    });
    articles_container.addEventListener("touchstart", async function (){
        await lz_load_2(articles_container);
    });
    articles_container.addEventListener("touchend", async function (){
        await lz_load_2(articles_container);
    });

    async function lazy_load_2(articles_container){
        if(articles_container.offsetHeight + articles_container.scrollTop >= articles_container.scrollHeight){
            let articles = articles_container.getElementsByClassName("article")
            let lastArticle = articles[articles.length - 1];
            if(parseInt(lastArticle.dataset.eof) == 1){
                return;
            }
            let start = parseInt(lastArticle.dataset.aid) - 1;
            if(start != 0){
                let section;
                for(let item of document.getElementsByName("inpRdbtnArtdiv")){
                    if (item.checked){
                        section = parseInt(item.value);
                    }
                }

                let newContent = await AJAXrequestContent(routeFabric(4, start));
                console.log("Nuevo contenido: " + start);
                if(newContent == ""){
                    newContent = "<article class='article' data-eof='1'><h3>No hay nada más que mostrar...</h3></article>";
                }
                articles_container.innerHTML = articles_container.innerHTML + newContent;
                articles_container.dispatchEvent(AJAXLoad);
            } else {
                articles_container.innerHTML = articles_container.innerHTML + "<article class='article' data-eof='1'><h3>No hay nada más que mostrar...</h3></article>";
                articles_container.dispatchEvent(AJAXLoad);
            }
        }
    }

    articles_container.addEventListener("AJAXLoad", e=> {
        article_buttons_events()

        follow_event()
    });
}

follow_event() 