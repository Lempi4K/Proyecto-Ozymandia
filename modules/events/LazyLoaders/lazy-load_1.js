if(document.getElementById("articles-container") != null){
    let articles_container = document.getElementById("articles-container");
    articles_container.addEventListener("scroll", async function (){
        if(this.offsetHeight + this.scrollTop >= this.scrollHeight){
            let articles = this.getElementsByClassName("article")
            let lastArticle = articles[articles.length - 1];
            let firstArticle = articles[0];
            if(location.pathname == "/buscar"){
                if(this.firstChild.nextSibling.classList.contains("aside_container")){
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
            this.innerHTML = this.innerHTML + newContent;
            this.dispatchEvent(AJAXLoad);
        }
    });

    articles_container.addEventListener("AJAXLoad", e => {
        follow_event();
    });
}

