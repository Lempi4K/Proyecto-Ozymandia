/**
 * Programación de eventos en la barra de búsqueda
 * @param DOMObject
 */
function searchEvents(container = document){
    let document = container;

    document.querySelector("#inpSrhBanner").value = getParameterByName("q") == 0 ? "" : getParameterByName("q");
    document.getElementById("inpRdbtnSchLabel" + getParameterByName("sublabel")).checked = true;

    for(let element of document.getElementsByName("inpRdbtnSchOrder")){
        if(element.value === ( getParameterByName("order") == 0 ? "-1" : getParameterByName("order") )){
            element.checked = true;
        }
    }

    /**
     * Prepara la orden para mandar a traer lo solicitado
     */
    function search(){
        let q = document.querySelector("#inpSrhBanner").value;
        let sublabel = 0;
        for(let element of document.getElementsByName("inpRdbtnSchLabel")){
            if(element.checked){
                sublabel = parseInt(element.value);
            }
        }
        let order = -1;
        for(let element of document.getElementsByName("inpRdbtnSchOrder")){
            if(element.checked){
                order = parseInt(element.value);
            }
        }

        window.history.pushState({}, "xd", "/buscar" + "?q=" + q + "&order=" + order + "&sublabel=" + sublabel);
        handleLocation();
    }
    document.querySelector("#btnSearch").addEventListener("click", e => {
        search();
    });

    document.querySelector("#inpSrhBanner").addEventListener("keypress", e => {
        if(e.keyCode === 13){
            search();
        }
        
    });

    document.querySelector(".search-container").addEventListener("click", e => {
        document.querySelector(".schBackBox").style.display = "block";
    });

    window.document.querySelector("html").addEventListener("click", e => {
        try{
            document.querySelector(".schBackBox").style.display = "none";
        }catch(e){
        }
    });

    document.querySelector("#search-propagation").addEventListener("click", e => {
        e.stopPropagation();
    });
}

searchEvents()
