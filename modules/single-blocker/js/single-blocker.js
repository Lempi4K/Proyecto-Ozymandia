/** 
 * Bloquea páginas según se tenga contemplado
 * @param event
*/
window.addEventListener("load", async e => {
    const path = window.location.pathname;
    console.log( await AJAXrequestChckToken(path));
    if(! await AJAXrequestChckToken(path)){
        document.getElementById("block-display-main").style.display = "flex";
        setInterval(() => {location.href="/inicio"}, 2800);
    }
});