function route(item){
    window.history.pushState({}, "xd", item.dataset.url);
    handleLocation();
};

const titles = {
    "/inicio": "Inicio | Proyecto Ozymandia",
    "/perfil": "Perfil | Proyecto Ozymandia",
    "/nosotros": "Nosotros | Proyecto Ozymandia",
    "/oferta-educativa": "Oferta Educativa | Proyecto Ozymandia",
    "/departamentos": "Departamentos | Proyecto Ozymandia",
    "/docentes": "Docentes | Proyecto Ozymandia",
    "/transparencia": "Transparencia | Proyecto Ozymandia",
    "/aplicaciones": "Aplicaciones | Proyecto Ozymandia",
    "/contacto": "Contacto | Proyecto Ozymandia",
    "/aside": "Mas | Proyecto Ozymandia",
    "/buscar": "Buscar | Proyecto Ozymandia",
    "/lienzo": "Lienzo | Proyecto Ozymandia"
}

const eventType = {
    "/lienzo": "lienzo",
    "/inicio": "inicio",
    "/perfil": "perfil"
};

let AJAXLoad = new Event("AJAXLoad", {bubbles: false});

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? 0 : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function routeFabric(section = 0, start = 0){
    section = (getParameterByName("id") != 0 ? 4 : section)
    const routes = {
        "/inicio": {type: 0, section: section, article_id: getParameterByName("id"), start : start},
        "/perfil": {type: 1, section: section, start : start},
        "/nosotros": {type: 2, subtype: 1, article_id: getParameterByName("id")},
        "/oferta-educativa": {type: 2, subtype: 2, article_id: getParameterByName("id")},
        "/departamentos": {type: 2, subtype: 3, article_id: getParameterByName("id")},
        "/docentes": {type: 2, subtype: 4, article_id: getParameterByName("id")},
        "/transparencia": {type: 2, subtype: 5, article_id: getParameterByName("id")},
        "/aplicaciones": {type: 2, subtype: 6, article_id: getParameterByName("id")},
        "/contacto": {type: 2, subtype: 7, article_id: getParameterByName("id")},
        "/aside": {type: 3, article_id: getParameterByName("id")},
        "/buscar": {type: 4, subtype: 8, search: "", article_id: getParameterByName("id")},
        "/lienzo": {type: 5, article_id: getParameterByName("id")}
    }
    console.log(routes[window.location.pathname]);
    return routes[window.location.pathname];


}

async function handleLocation(container = "replazable-content", section = 0) {
    AJAXLoad.routeType = ""; 
    if(! await AJAXrequestChckToken(window.location.pathname)){
        document.getElementById("block-display-main").style.display = "flex";
        setInterval(() => {location.href="/inicio"}, 2800);
    } else{
        let idLoadAnimation = container === "replazable-content" ? "charging-display-content" : "charging-display-container_sub";
        console.log(idLoadAnimation);
        ChargingAnimationStart(idLoadAnimation);
        document.title = titles[window.location.pathname]
        const central_content = document.getElementById(container);
        let HTML = await AJAXrequestContent(routeFabric(section))
        central_content.innerHTML = HTML;

        AJAXLoad.routeType = eventType[window.location.pathname];
        central_content.dispatchEvent(AJAXLoad);
        //Script Charger
        /*
        for(let item of central_content.querySelectorAll("script")){
            let script = document.createElement("script");
            script.src = item.src;
            script.type = "module";
            central_content.removeChild(item);
            central_content.appendChild(script);
        }
        */

        ChargingAnimationEnd_1(idLoadAnimation);
    }
}

window.addEventListener("popstate", e => {
    handleLocation();

    let btnsck = document.querySelectorAll("input[type='radio'].frame_change");
    let locationStr = new String(window.location.pathname);
    for(let item of btnsck){
        itemUrl = item.dataset.url;
        if(locationStr.includes(itemUrl)){
            item.checked = true;
            if(getComputedStyle(document.getElementById("menu-hideNav")).display === "none"){
                break;
            }
        }
    }
});

function article_navasicard(url_n){
            obj = {
                dataset: {url: url_n}
            }
            route(obj);
            let btnsck = document.querySelectorAll("input[type='radio'].frame_change");
            for(let item of btnsck){
                item.checked = false;
            }
}

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

    let btnsa = document.querySelectorAll("a.frame_change");
    for(let item of btnsa){
        item.addEventListener("click", e => {
            route(item);
            let btnsck = document.querySelectorAll("input[type='radio'].frame_change");
            for(let item of btnsck){
                item.checked = false;
            }
        });
    }

    document.getElementById("replazable-content").addEventListener("AJAXLoad", e => {
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

        for(let item of document.getElementsByClassName("navBarLink")){
            item.addEventListener("click", e => {
                window.history.pushState({}, "xd", window.location.pathname + "?" + item.dataset.get);
                handleLocation();
            });
        }

        for(let item of document.getElementsByClassName("main-article")){
            item.addEventListener("dblclick", e => {
                window.history.pushState({}, "xd", window.location.pathname + "?id=" + item.dataset.aid);
                handleLocation();
            })
        }

        for(let item of document.getElementsByName("inpRdbtnArtdiv")){
            item.addEventListener("change", e => {
                handleLocation("articles-container", item.value);
            });
        }

        for(let item of document.getElementsByName("inpRdbtnProdiv")){
            item.addEventListener("change", e => {
                handleLocation("replazable-content_Profile", item.value, 0);
            });
        }

        if(document.getElementById("articles-container") != null){
            document.getElementById("articles-container").addEventListener("AJAXLoad", e => {
                for(let item of document.getElementsByClassName("main-article")){
                    item.addEventListener("dblclick", e => {
                        window.history.pushState({}, "xd", window.location.pathname + "?id=" + item.dataset.aid);
                        handleLocation();
                    })
                }
            });
        }

        if(e.routeType == "perfil"){
            document.getElementById("inpRdbtnProdiv2").addEventListener("change", e => {
                if(e.target.checked){
                    document.getElementById("replazable-content_Profile").addEventListener("AJAXLoad", e => {

                        let profile_mainData = document.querySelector(".profile-mainData").offsetHeight;
                        let profile_background = document.querySelector(".profile-background").offsetHeight;
                        let profile_content = document.querySelector(".profile-content").offsetHeight;
                        let height = (profile_content) - (profile_mainData + profile_background);
                        console.log(profile_content);
                        document.getElementById("articles-container").style.height = height + "px";
                        
                        for(let item of document.getElementsByClassName("article_deleteBtn")){
                            item.addEventListener("click", async e => {
                                let aid = item.dataset.aid
                
                                await removeArticle(aid);
                                let article = document.getElementById("article_" + aid);
                                article.style.display = "none";
                                article.nextSibling.nextSibling.style.display = "none";
                                console.log("Eliminado")
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
                    });
                }
            });
        }
    });

    for(let item of document.getElementsByClassName("AsideLink")){
        item.addEventListener("click", e => {
            window.history.pushState({}, "xd", "aside" + "?" + item.dataset.get);
            handleLocation();
        });
    }
});

if(window.location.pathname == "/" || window.location.pathname == "/index.php"){
    window.history.pushState({}, "", "/inicio");
}