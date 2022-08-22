function route(item){
    window.history.pushState({}, "xd", item.dataset.url);
    handleLocation();
};

const routes = {
    "/inicio": {type: 0, section: 2, article_id: 0},
    "/perfil": {type: 1},
    "/nosotros": {type: 2, subtype: 1, article_id: 0},
    "/oferta-educativa": {type: 2, subtype: 2, article_id: 0},
    "/departamentos": {type: 2, subtype: 3, article_id: 0},
    "/docentes": {type: 2, subtype: 4, article_id: 0},
    "/transparencia": {type: 2, subtype: 5, article_id: 0},
    "/aplicaciones": {type: 2, subtype: 6, article_id: 0},
    "/contacto": {type: 2, subtype: 7, article_id: 0},
    "/aside": {type: 3, article_id: 0},
    "/buscar": {type: 4, subtype: 8, search: ""},
    "/lienzo": {type: 5, article_id: 0}
}
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
    "/lienzo": "Crear | Proyecto Ozymandia"
}

async function handleLocation() {
    const path = window.location.pathname;

    if(! await AJAXrequestChckToken(path)){
        document.getElementById("block-display-main").style.display = "flex";
        setInterval(() => {location.href="/inicio"}, 2800);
    } else{
        ChargingAnimationStart();
        document.title = titles[path]
        const central_content = document.getElementById("replazable-content");
        let HTML = await AJAXrequestContent(routes[path])
        central_content.innerHTML = HTML;
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
});

if(window.location.pathname == "/" || window.location.pathname == "/index.php"){
    window.history.pushState({}, "", "/inicio");
}