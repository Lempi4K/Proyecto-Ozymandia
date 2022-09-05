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
                article.meta.type = e.target.value;
                console.log(article.meta.type);
            }
        });
    }

    document.getElementById("inpTxtTitle").addEventListener("input", e => {
        article.meta.title = document.getElementById("NavasicardTitle").textContent;
    });

    document.getElementById("inpTxtDesc").addEventListener("input", e => {
        article.meta.description = document.getElementById("NavasicardDesc").textContent;
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
}