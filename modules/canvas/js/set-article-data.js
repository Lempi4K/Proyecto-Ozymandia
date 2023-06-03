/**
 * Reemplaza en la cadena los caracteres que coincidan con la expresión regular
 * @param {string} string 
 * @param {regex} regex 
 * @returns {string}
 */
function regexReplace(string, regex = /[`;=<>]/g){
    //La "g" final es para que se haga con toda la cadena y no con la primera coincidencia
    return string.replace(regex, '');
}

/**
 * Función principal del módulo
 */
function set_article_data(){
    const inpRdbtnFrmArtlType = document.getElementsByName("inpRdbtnFrmArtlType");
    for(let item of inpRdbtnFrmArtlType){
        item.addEventListener("change", e => {
            if(e.target.checked){
                article.meta.type = parseInt(e.target.value);
                if(article.meta.type == 1){
                    if(article.meta.sublabel == null || article.meta.label == null){
                        document.getElementById("cnvFrmPubBtn").value = "Guardar";
                        document.querySelector(".cpsfMessage").innerHTML = "Seguro que quieres guardar el borrador";
                    } else{
                        if(article.meta.id == 0){
                            document.getElementById("cnvFrmPubBtn").value = "Publicar";
                            document.querySelector(".cpsfMessage").innerHTML = "Seguro que quieres publicar el art&iacute;culo";
                        } else{
                            document.getElementById("cnvFrmPubBtn").value = "Editar";
                            document.querySelector(".cpsfMessage").innerHTML = "Seguro que quieres editar el art&iacute;culo";
                        }
                    }
                } else{
                    if(article.meta.id == 0){
                        document.getElementById("cnvFrmPubBtn").value = "Publicar";
                        document.querySelector(".cpsfMessage").innerHTML = "Seguro que quieres publicar el art&iacute;culo";
                    } else{
                        document.getElementById("cnvFrmPubBtn").value = "Editar";
                        document.querySelector(".cpsfMessage").innerHTML = "Seguro que quieres editar el art&iacute;culo";
                    }
                }
            }
        });
    }

    const inpRdbtnFrmArtlTheme = document.getElementsByName("inpRdbtnFrmArtlTheme");
    for(let item of inpRdbtnFrmArtlTheme){
        item.addEventListener("change", e => {
            if(e.target.checked){
                article.meta.theme = e.target.value;
            }
        });
    }

    document.getElementById("inpTxtTitle").addEventListener("input", e => {
        e.target.value = regexReplace(e.target.value);
        article.meta.title = e.target.value;
    });
    

    document.getElementById("inpTxtTitle").addEventListener("blur", e => {
        if(e.target.value == "" || e.target.value == " "){
            e.target.value = "Título";
            document.getElementById("NavasicardTitle").innerHTML = e.target.value;
            article.meta.title = e.target.value;
        }
    });

    document.getElementById("inpTxtDesc").addEventListener("input", e => {
        e.target.value = regexReplace(e.target.value);
        article.meta.description = e.target.value;
    });

    document.getElementById("flsReset").addEventListener("click", e => {
        for(let item of document.querySelectorAll(".inpRdbtnSlbl")){
            item.checked = false;
        }
        for(let item of document.getElementsByName("inpRdbtnLbl")){
            item.checked = false;
        }

        article.meta.sublabel = null;
        article.meta.label = null;
        if(article.meta.type == 1){
            document.getElementById("cnvFrmPubBtn").value = "Guardar";
            document.querySelector(".cpsfMessage").innerHTML = "Seguro que quieres guardar el borrador";
        }
    });

    for(let item of document.getElementsByName("inpRdbtnLbl")){
        item.addEventListener("change", e => {
            if(e.target.checked){
                for(let item of document.querySelectorAll(".inpRdbtnSlbl")){
                    item.checked = false;
                }

                if(e.target.value == "3"){
                    document.getElementById("cnvFrmPubBtn").value = "Publicar";
                    document.querySelector(".cpsfMessage").innerHTML = "Seguro que quieres publicar el art&iacute;culo";
                } else{
                    document.getElementById("cnvFrmPubBtn").value = "Guardar";
                    document.querySelector(".cpsfMessage").innerHTML = "Seguro que quieres guardar el borrador";
                }
                article.meta.sublabel = null;
                article.meta.label = parseInt(e.target.value);
                console.log(e.target.value);
            }
        });
    }

    const inpRdbtnSlbl = document.getElementsByClassName("inpRdbtnSlbl");
    for(let item of inpRdbtnSlbl){
        item.addEventListener("change", e => {
            if(e.target.checked){
                article.meta.sublabel = parseInt(e.target.value);

                if(article.meta.id == 0){
                    document.getElementById("cnvFrmPubBtn").value = "Publicar";
                    document.querySelector(".cpsfMessage").innerHTML = "Seguro que quieres publicar el art&iacute;culo";
                } else{
                    document.getElementById("cnvFrmPubBtn").value = "Editar";
                    document.querySelector(".cpsfMessage").innerHTML = "Seguro que quieres editar el art&iacute;culo";
                }
            }

            console.log(article.meta.sublabel);
        });
    }

    document.getElementById("slctNav").addEventListener("change", function(e){
        article.meta.subtype = parseInt(this.value);
    });

    document.getElementById("slctNavVisibility").addEventListener("change", function(e){
        article.meta.visibility = parseInt(this.value);
    });
    

    document.getElementById("inpRdbtnFrmArtlType1").addEventListener("change", e => {
        if(e.target.checked){
            document.getElementById("frmNavVisibility").style.display = "flex";
            document.getElementById("frmLabelSelector").style.display = "none";
            document.getElementById("frmNavSelector").style.display = "flex";
            document.getElementById("frmFileSelector").style.display = "block";
        }
    });

    document.getElementById("inpRdbtnFrmArtlType2").addEventListener("change", e => {
        if(e.target.checked){
            document.getElementById("frmNavVisibility").style.display = "none";
            document.getElementById("frmLabelSelector").style.display = "block";
            document.getElementById("frmNavSelector").style.display = "none";
            document.getElementById("frmFileSelector").style.display = "none";
        }
    });

    document.getElementById("inpRdbtnFrmArtlType3").addEventListener("change", e => {
        if(e.target.checked){
            document.getElementById("frmNavVisibility").style.display = "none";
            document.getElementById("frmLabelSelector").style.display = "none";
            document.getElementById("frmNavSelector").style.display = "none";
            document.getElementById("frmFileSelector").style.display = "block";
        }
    });

}

/**
 * Inicializa los datos según el artículo
 */
function initialData(){
    for(let item of document.getElementsByName("inpRdbtnFrmArtlType")){
        if(item.value == article.meta.type){
            item.checked = true;
            switch (item.value){
                case "1":{
                    document.getElementById("frmNavVisibility").style.display = "none";
                    document.getElementById("frmLabelSelector").style.display = "block";
                    document.getElementById("frmNavSelector").style.display = "none";
                    document.getElementById("frmFileSelector").style.display = "none";
                    break;
                }
                case "2":{
                    document.getElementById("frmNavVisibility").style.display = "flex";
                    document.getElementById("frmLabelSelector").style.display = "none";
                    document.getElementById("frmNavSelector").style.display = "flex";
                    document.getElementById("frmFileSelector").style.display = "block";
                    break;
                }
                case "3":{
                    document.getElementById("frmNavVisibility").style.display = "none";
                    document.getElementById("frmLabelSelector").style.display = "none";
                    document.getElementById("frmNavSelector").style.display = "none";
                    document.getElementById("frmFileSelector").style.display = "block";
                    break;
                }
            }
        }
    }
    for(let item of document.getElementsByName("inpRdbtnFrmArtlTheme")){
        if(item.value == article.meta.theme){
            item.checked = true;
        }
    }

    document.getElementById("inpTxtTitle").value = article.meta.title;
    document.getElementById("NavasicardTitle").innerHTML = article.meta.title || "T&iacute;tulo";

    document.getElementById("inpTxtDesc").value = article.meta.description;
    document.getElementById("NavasicardDesc").innerHTML =  article.meta.description || "";

    const labelsName = {
        "1":"Administrativo",
        "2":"General",
        "3":"Invitado"
    }

    for(let item of document.getElementsByName("inpRdbtnLbl")){
        if(item.value == article.meta.label){
            item.checked = true;
            console.log(item.value);
            if(article.meta.sublabel != null){
                for(let items of document.getElementsByClassName("icl" + labelsName[item.value])){
                    if(article.meta.sublabel == parseInt(items.value)){
                        items.checked = true;
                    }
                }
            }

        }
    }

    document.getElementById("slctNav").value = article.meta.subtype;

    document.getElementById("slctNavVisibility").value = article.meta.visibility;

    if(article.meta.background_img != null){
        document.querySelector(".cnvFrmNavasicard > img").src = URL.createObjectURL(article.meta.background_img);
    }
}
