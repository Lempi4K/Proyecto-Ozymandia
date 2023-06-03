/**
 * Cambia la url y la interpreta
 * @param DOMObject
 */
function route(item){
    window.history.pushState({}, "xd", item.dataset.url);
    handleLocation();


    blur_menu(1);

};

/**
 * Nombre de la página
 * @var string
 */
let pageName = "Proyecto Ozymandia"

/**
 * Lista de tiulos que aparecerán en la pagina según la url
 * @var object
 */
const titles = {
    "/pruebas": `Pruebas | ${pageName}`,
    "/inicio": `Inicio | ${pageName}`,
    "/perfil": `Perfil | ${pageName}`,
    "/nosotros": `Nosotros | ${pageName}`,
    "/oferta-educativa": `Oferta Edutcativa | ${pageName}`,
    "/departamentos": `Departamentos | ${pageName}`,
    "/docentes": `Docentes | ${pageName}`,
    "/transparencia": `Transparencia | ${pageName}`,
    "/aplicaciones": `Aplicaciones | ${pageName}`,
    "/contacto": `Contacto | ${pageName}`,
    "/fijado": `Fijado | ${pageName}`,
    "/buscar": `Buscar | ${pageName}`,
    "/lienzo": `Lienzo | ${pageName}`,
    "/herramientas": `Herramientas | ${pageName}`
}

/**
 * Tipo de evento a despachar según la url
 * @var object
 */
const eventType = {
    "/lienzo": "lienzo",
    "/inicio": "inicio",
    "/perfil": "perfil",
    "/buscar": "buscar",
};

/**
 * Evento a despachar
 * @var Event
 */
let AJAXLoad = new Event("AJAXLoad", {bubbles: false});

/**
 * Obtiene de la url los datos GET
 * @param string
 * @return string
 */
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? 0 : decodeURIComponent(results[1].replace(/\+/g, " "));
}

/**
 * Genera la orden que despachará el servidor
 * @param int
 * @param int
 * @return object
 */
function routeFabric(section = 0, start = 0, internal = false){
    section = (getParameterByName("id") != 0 ? 4 : section)
    const routes = {
        "/pruebas": {type: -1},
        "/inicio": {type: 0, section: section, article_id: getParameterByName("id"), start : start, internal: internal},
        "/perfil": {type: 1, section: section, start : start},
        "/nosotros": {type: 2, subtype: 1, article_id: getParameterByName("id")},
        "/oferta-educativa": {type: 2, subtype: 2, article_id: getParameterByName("id")},
        "/departamentos": {type: 2, subtype: 3, article_id: getParameterByName("id")},
        "/docentes": {type: 2, subtype: 4, article_id: getParameterByName("id")},
        "/transparencia": {type: 2, subtype: 5, article_id: getParameterByName("id")},
        "/aplicaciones": {type: 2, subtype: 6, article_id: getParameterByName("id")},
        "/contacto": {type: 2, subtype: 7, article_id: getParameterByName("id")},
        "/fijado": {type: 3, article_id: getParameterByName("id")},
        "/buscar": {type: 4, subtype: 8, q: getParameterByName("q"), sublabel: getParameterByName("sublabel"), article_id: getParameterByName("id"), start : start, order: ( parseInt(getParameterByName("order")) == 0 ? -1 : parseInt(getParameterByName("order")) )},
        "/lienzo": {type: 5, article_id: getParameterByName("id")},
        "/herramientas": {type: 6, section: section, internal: internal}
    }
    console.log(JSON.stringify(routes[window.location.pathname]));
    return routes[window.location.pathname];


}

/**
 * Manda una orden y recibe una cadena con el HTML a reemplazar
 * @param string
 * @param int
 */
async function handleLocation(container = "replazable-content", section = (getParameterByName("section") == 0 ? 0 : getParameterByName("section")), internal = false) {
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
        console.log(central_content.id);
        let HTML = await AJAXrequestContent(routeFabric(section, 0, internal));
        central_content.innerHTML = HTML;

        AJAXLoad.routeType = eventType[window.location.pathname];
        scriptHandler(central_content, central_content.querySelectorAll("script"));
        central_content.dispatchEvent(AJAXLoad);
        
        document.getElementById(container).scroll({
                top: 0,
            }
        )
        document.getElementById(container).scrollTop;

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
        } else{
            item.checked = false;
        }
    }
});

/**
 * Maneja los navasidecard 
 * @param string
 */
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

if(window.location.pathname == "/" || window.location.pathname == "/index.php"){
    window.history.pushState({}, "", "/inicio");
}