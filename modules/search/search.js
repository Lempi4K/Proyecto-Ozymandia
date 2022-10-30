function searchEvents(container = document){
    let document = container
    document.getElementById("btnSearch").addEventListener("click", e => {
        let q = document.getElementById("inpSrhBanner").value;
        let sublabel = 0;
        for(let element of document.getElementsByName("inpRdbtnSchLabel")){
            if(element.checked){
                sublabel = parseInt(element.value);
            }
        }
        if(q !== "" || sublabel != 0){
            window.history.pushState({}, "xd", "/buscar" + "?q=" + q + "&sublabel=" + sublabel);
        }
    });

    document.querySelector(".search-container").addEventListener("click", e => {
        document.querySelector(".schBackBox").style.display = "block";
    });

    window.document.querySelector("html").addEventListener("click", e => {
        document.querySelector(".schBackBox").style.display = "none";
    });

    document.getElementById("search-propagation").addEventListener("click", e => {
        e.stopPropagation();
    });
}

window.addEventListener("load", e => {
    searchEvents()
});