function set_article_data(){
    const inpRdbtnFrmArtlType = document.getElementsByName("inpRdbtnFrmArtlType");
    for(let item of inpRdbtnFrmArtlType){
        item.addEventListener("change", e => {
            if(e.target.checked){
                article.meta.type = parseInt(e.target.value);
                console.log(article.meta.type);
            }
        });
    }

    const inpRdbtnFrmArtlTheme = document.getElementsByName("inpRdbtnFrmArtlTheme");
    for(let item of inpRdbtnFrmArtlTheme){
        item.addEventListener("change", e => {
            if(e.target.checked){
                article.meta.theme = e.target.value;
                console.log(article.meta.theme);
            }
        });
    }

    document.getElementById("inpTxtTitle").addEventListener("input", e => {
        article.meta.title = e.target.value;
    });

    document.getElementById("inpTxtDesc").addEventListener("input", e => {
        article.meta.description = e.target.value;
    });

    const inpRdbtnLbl = document.getElementsByName("inpRdbtnLbl");
    for(let item of inpRdbtnLbl){
        item.addEventListener("change", e => {
            if(e.target.checked){
                article.meta.label = e.target.value;
                console.log(article.meta.label);
            }
        });
    }

    const inpChckbxLbl = document.getElementsByClassName("inpChckbxLbl");
    for(let item of inpChckbxLbl){
        item.addEventListener("change", e => {
            if(e.target.checked){
                article.meta.sublabel = article.meta.sublabel + e.target.value + ";"
            } else{
                let str = new String(article.meta.sublabel);
                article.meta.sublabel = str.replace(e.target.value + ";", "");
            }
            console.log(article.meta.sublabel);
        });
    }

    document.getElementById("slctNav").addEventListener("change", function(e){
        article.meta.subtype = parseInt(this.value);
    });

    document.getElementById("inpRdbtnFrmArtlType1").addEventListener("change", e => {
        if(e.target.checked){
            document.getElementById("frmNavSelector").style.display = "flex";
            document.getElementById("frmFileSelector").style.display = "block";
        }
    });

    document.getElementById("inpRdbtnFrmArtlType2").addEventListener("change", e => {
        if(e.target.checked){
            document.getElementById("frmNavSelector").style.display = "none";
            document.getElementById("frmFileSelector").style.display = "none";
        }
    });

    document.getElementById("inpRdbtnFrmArtlType3").addEventListener("change", e => {
        if(e.target.checked){
            document.getElementById("frmNavSelector").style.display = "none";
            document.getElementById("frmFileSelector").style.display = "block";
        }
    });
}