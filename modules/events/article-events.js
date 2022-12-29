function article_buttons_events(){
    for(let item of document.getElementsByClassName("article_deleteBtn")){
        item.addEventListener("click", async e => {
            let aid = item.dataset.aid
    
            await removeArticle(aid);
            console.log("Eliminado")
            handleLocation();
        });
    }
    
    for(let item of document.getElementsByClassName("article_EditBtn")){
        item.addEventListener("click", e => {
            console.log("Ahhh me doxxean")
            let aid = item.dataset.aid
            window.history.pushState({}, "xd", "/lienzo" + "?id=" + aid);
            handleLocation();
            document.getElementById("inpRdbtnNav9").checked = true;
        });
    }
}

article_buttons_events()