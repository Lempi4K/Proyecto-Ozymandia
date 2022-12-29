window.addEventListener("load", e => {
    handleLocation();

    let btns = document.querySelectorAll("input[type='radio'].frame_change");
    let locationStr = new String(window.location.pathname);
    for(let item of btns){
        item.addEventListener("input", e => {
            route(item)
        });
        itemUrl = item.dataset.url;
        if(locationStr.includes(itemUrl)){
            if(getComputedStyle(document.getElementById("menu-hideNav")).display === "none"){
                if(item.parentElement.parentElement.parentElement.className === "menu menu-main"){
                    item.checked = true;
                }
            }
            if(document.documentElement.offsetWidth <= 500){
                item.checked = true;
            }
        }
    }

    for(let item of document.querySelectorAll("#main-menu a.frame_change")){
        item.addEventListener("click", e => {
            route(item);
            let btnsck = document.querySelectorAll("input[type='radio'].frame_change");
            for(let item of btnsck){
                item.checked = false;
            }
        });
    }

    for(let item of document.getElementsByClassName("AsideLink")){
        item.addEventListener("click", e => {
            window.history.pushState({}, "xd", "fijado" + "?" + item.dataset.get);
            handleLocation();
            let btnsck = document.querySelectorAll("input[type='radio'].frame_change");
            for(let item of btnsck){
                item.checked = false;
            }
        });
    }
});