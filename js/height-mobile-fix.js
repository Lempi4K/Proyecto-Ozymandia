/** 
 * Arregla el error de altura en la vista de un celular
*/
function documentHeight(){
    const doc = document.documentElement;
    doc.style.setProperty("--doc-height", window.innerHeight + "px");
}
window.addEventListener("resize", documentHeight);
documentHeight();