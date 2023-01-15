/**
 * Función recursiva que carga dinámicamente scripts de una petición del servidor
 * @param DOMObject
 * @param array
 */
function scriptHandler(target, scripts){
    scripts = Array.prototype.slice.call(scripts);
    if(scripts.length > 0){
        let item = scripts.shift();
        let script = document.createElement("script");
        target.appendChild(script);
        script.addEventListener("load", e => {
            scriptHandler(target, scripts);
        })
        script.src = item.src;
        //target.removeChild(item);
        console.log("xasd")

    } else{
        scripts = undefined;
    }
}
