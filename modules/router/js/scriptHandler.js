/*function scriptHandler(target, scripts, index = 0){
    if(scripts.length > 0 && index < scripts.length){
        let script = document.createElement("script");
        target.appendChild(script);
        script.addEventListener("load", e => {
            scriptHandler(target, scripts, index + 1);
        })
        script.src = scripts[index].src;
        target.removeChild(scripts[index]);
    }
}*/

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

    } else{
        scripts = undefined;
    }
}
