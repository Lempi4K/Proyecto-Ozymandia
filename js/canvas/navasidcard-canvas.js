function changeIMG(e){
    let files = e.target.files;
    for(let file of files){
        var img = document.querySelector(".cnvFrmNavasicard > img");
        img.src = URL.createObjectURL(file);
        console.log("asdsd")
    }
}

window.addEventListener("load", e => {
    document.getElementById("replazable-content").addEventListener("AJAXLoad", e => {
        document.getElementById("inpFileNavasicard").addEventListener("change", e => {
            changeIMG(e);
        });

        document.getElementById("inpTxtTitle").addEventListener("input", e => {
            if(e.target.value === ""){
                document.getElementById("NavasicardTitle").innerHTML = "T&iacute;tulo"
            }else{
                document.getElementById("NavasicardTitle").textContent = e.target.value;
            }
        });

        document.getElementById("inpTxtDesc").addEventListener("input", e => {
            if(e.target.value === ""){
                document.getElementById("NavasicardDesc").innerHTML = "Descripci&oacute;n"
            }else{
                document.getElementById("NavasicardDesc").textContent = e.target.value;
            }
        });
    });
});