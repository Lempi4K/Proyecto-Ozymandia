if(document.getElementById("inpRdbtnProdiv2").checked && document.getElementById("articles-container") != null){
    let articles_container = document.getElementById("articles-container");
    articles_container.addEventListener("scroll", async function (){
        if(this.offsetHeight + this.scrollTop >= this.scrollHeight){
            let articles = this.getElementsByClassName("article")
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
                this.innerHTML = this.innerHTML + newContent;
                this.dispatchEvent(AJAXLoad);
            } else {
                this.innerHTML = this.innerHTML + "<article class='article' data-eof='1'><h3>No hay nada más que mostrar...</h3></article>";
                this.dispatchEvent(AJAXLoad);
            }
        }
    });

    articles_container.addEventListener("AJAXLoad", e=> {
        article_buttons_events()

        follow_event()
    });
}

follow_event() 