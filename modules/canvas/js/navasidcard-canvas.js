function changeIMG(e){
    let files = e.target.files;
    for(let file of files){
        let img = document.querySelector(".cnvFrmNavasicard > img");
        article.meta.background_img = file;
        img.src = URL.createObjectURL(file);
    }

}

function editTitle(e){
    const NavasicardTitle = document.getElementById("NavasicardTitle");
    if(e.target.value === ""){
        NavasicardTitle.innerHTML = "T&iacute;tulo"
    }else{
        NavasicardTitle.textContent = e.target.value;
    }
}

function editDesc(e){
    const NavasicardDesc = document.getElementById("NavasicardDesc");

    if(e.target.value === ""){
        NavasicardDesc.innerHTML = "Descripci&oacute;n"
    }else{
        NavasicardDesc.textContent = e.target.value;
    }
}

function navasidecard_canvas(){
    document.getElementById("inpFileNavasicard").addEventListener("change", e => {
        changeIMG(e);
    });

    document.getElementById("inpTxtTitle").addEventListener("input", e => {
        editTitle(e);
    });

    document.getElementById("inpTxtDesc").addEventListener("input", e => {
        editDesc(e);
    });
}

