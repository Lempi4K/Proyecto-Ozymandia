AdminTools.AproveArticle = class{
    static async getArticles(sublabel, start = 0){
        let url = "/modules/admin-tools/scripts/AproveArticle/getArticles.php";
        let params = {
            sublabel: sublabel,
            start: start,
        }

        let functions = {
            0: data => {
                for(let item of document.querySelectorAll(".atArticlesCointainer")){
                    item.innerHTML = data.HTML;
                }
            },
            1: data => {
                for(let item of document.querySelectorAll(".atArticlesCointainer")){
                    item.innerHTML += data.HTML;
                }
            }
        }

        let passFunction;
        if(start != 0){
            passFunction = functions[1];
        } else{
            passFunction = functions[0];
        }

        return await OzyTool.defaultAJAXListener(url, params, passFunction, functions[0]);
        

    }

    static ChargeEvents(){
        for(let item of document.querySelectorAll(".aaButtons > #aaDelete")){
            item.addEventListener("click", async e => {

                let url = "/modules/content-remove/content-remove.php";
                let params = {
                    aid: parseInt(item.value),
                }

                let response = await OzyTool.AJAX(url, params);
                console.log(response);
                if(!response.success){
                    console.log(response.response);
                    OzyTool.stream("Error fatal en el servdor", OzyTool.CONST.ERROR);
                    return; 
                }

                if(!response.response.data.successful){
                    OzyTool.stream("Error en la base de datos", OzyTool.CONST.ERROR);
                    return;
                }

                this.removeArticle(item.value);
                OzyTool.stream("Artículo rechazado", OzyTool.CONST.MESSAGE);

                ChargingAnimationStart("charging-display-container_articles");
                sublabel = parseInt(document.getElementById("aaSlctLabel").value);
                await AdminTools.AproveArticle.getArticles(sublabel, 0);
                AdminTools.AproveArticle.ChargeEvents();
                ChargingAnimationEnd_1("charging-display-container_articles");
            })
        }

        for(let item of document.querySelectorAll(".aaButtons > #aaApprove")){
            item.addEventListener("click", async e => {
                let url = "/modules/admin-tools/scripts/AproveArticle/approveArticle.php";
                let params = {
                    aid: parseInt(item.value),
                }

                OzyTool.defaultAJAXListener(url, params, async data => {
                    this.removeArticle(item.value);
                    OzyTool.stream("Artículo aprobado", OzyTool.CONST.MESSAGE);
    
                    ChargingAnimationStart("charging-display-container_articles");
                    sublabel = parseInt(document.getElementById("aaSlctLabel").value);
                    await AdminTools.AproveArticle.getArticles(sublabel, 0);
                    AdminTools.AproveArticle.ChargeEvents();
                    ChargingAnimationEnd_1("charging-display-container_articles");
                })
            })
        }
    }

    static removeArticle(id){
        let article = document.getElementById(id);
        if(article == null){
            return;
        }

        OzyTool.stream("Acción", OzyTool.CONST.ERROR);
        document.querySelector(".atArticlesCointainer").removeChild(article)
        article.remove;
        return;
    }

}

async function AproveArticle(){
    ChargingAnimationStart("charging-display-container_articles");
    sublabel = parseInt(document.getElementById("aaSlctLabel").value);
    await AdminTools.AproveArticle.getArticles(sublabel, 0);
    ChargingAnimationEnd_1("charging-display-container_articles");


    document.getElementById("aaSlctLabel").addEventListener("change", async e => {
        ChargingAnimationStart("charging-display-container_articles");
        await AdminTools.AproveArticle.getArticles(parseInt(e.target.value), 0);
        ChargingAnimationEnd_1("charging-display-container_articles");
        AdminTools.AproveArticle.ChargeEvents();

    })
    
    AdminTools.AproveArticle.ChargeEvents();

    for(let item of document.querySelectorAll(".atFrame")){
        item.addEventListener("scroll", async function(e){
            if(this.offsetHeight + this.scrollTop >= this.scrollHeight){
                let articles = Array.prototype.slice.call(document.querySelectorAll(".atArticlesCointainer > .aaArticle"));
                if(articles.length == 0){ return }
                let lastID = parseInt(articles[articles.length-1].id);

                sublabel = parseInt(document.getElementById("aaSlctLabel").value);
                await AdminTools.AproveArticle.getArticles(sublabel, lastID);
                AdminTools.AproveArticle.ChargeEvents();
            }
        })
    }

}

AproveArticle();