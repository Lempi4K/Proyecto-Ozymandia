function addElementBefore(btnCreate){
    document.getElementById("cnvArtWindow").style.display = "block";

    let element = document.createElement("div");
    element.classList.add("cnvArtElement");
    element.innerHTML = "Texto Agregado xdddd"

    btnCreate.parentElement.parentElement.insertBefore(element, btnCreate.parentElement);
}

window.addEventListener("load", e => {
    document.getElementById("cnvArtWindow").style.display = "none";

    let eventElements;

    document.getElementById("cnvArticleCrtBtnFirst").addEventListener("click", function(){
        addElementBefore(this);
        document.delete
        this.parentElement.parentElement.removeChild(this.parentElement);
        console.log(this.parentElement.classList.toString());
    });

    eventElements = document.querySelectorAll("#cnvArtWinSelectElement ul > li");
    for(let item of eventElements){
    }
});