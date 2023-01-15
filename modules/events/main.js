for(let item of document.getElementsByClassName("main-article")){
    item.addEventListener("dblclick", e => {
        window.history.pushState({}, "xd", "/inicio" + "?id=" + item.dataset.aid);
        handleLocation();
    })
}

for(let item of document.getElementsByName("inpRdbtnArtdiv")){
    item.addEventListener("change", e => {
        handleLocation("articles-container", item.value, true);
    });
}



if(document.getElementById("articles-container") != null){
    document.getElementById("articles-container").addEventListener("AJAXLoad", e => {
        for(let item of document.getElementsByClassName("main-article")){
            item.addEventListener("dblclick", e => {
                window.history.pushState({}, "xd", "/inicio" + "?id=" + item.dataset.aid);
                handleLocation();
            })
        }
    });
}