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
    "/lienzo": "lienzo"
};

let AJAXLoad = new Event("AJAXLoad", {bubbles: false});

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? 0 : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function routeFabric(){
    const routes = {
        "/inicio": {type: 0, section: 2, article_id: getParameterByName("id")},
        "/perfil": {type: 1},
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

async function handleLocation() {
    AJAXLoad.routeType = ""; 
    if(! await AJAXrequestChckToken(window.location.pathname)){
        document.getElementById("block-display-main").style.display = "flex";
        setInterval(() => {location.href="/inicio"}, 2800);
    } else{
        ChargingAnimationStart();
        document.title = titles[window.location.pathname]
        const central_content = document.getElementById("replazable-content");
        let HTML = await AJAXrequestContent(routeFabric())
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

        ChargingAnimationEnd_1();
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
                let aid = item.dataset.aid
                window.history.pushState({}, "xd", "/lienzo" + "?id=" + aid);
                handleLocation();
            });
        }

        for(let item of document.getElementsByClassName("navBarLink")){
            item.addEventListener("click", e => {
                window.history.pushState({}, "xd", window.location.pathname + "?" + item.dataset.get);
                handleLocation();
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