for(let item of document.getElementById("replazable-content").getElementsByClassName("navBarLink")){
    item.addEventListener("click", e => {
        let pathName = window.location.pathname !== "/buscar" ? window.location.pathname : "/fijado";
        window.history.pushState({}, "xd", pathName + "?" + item.dataset.get);
        handleLocation();
    });
}