var base = {
    "article_1" : "",
    "article_2" : ""
};

function updateBase(){
    base = {
        "article_1" : `
            <article class="article">
                <div class="article_container ${article.meta.theme}">
                    <div class="article_title ${article.meta.theme}_title">
                        <p>${article.meta.title}</p>
                        <p class="article_text">${article.meta.description}</p>
                </div>
                <hr>
                <div class="article_content ${article.meta.theme}_content">
                    <div class="${article.meta.theme}_head">
                        <img src="/src/img/logo/logo.png" alt="">
                        <p>
                            CENTRO DE BACHILLERATO TECNOL&Oacute;GICO
                            <br>
                            industrial y de servicios N&uacute;m. 114
                        </p>
                        <hr>
                    </div>
                    <div class="article_main ${article.meta.theme}_main">
                    </div>
                </div>
            </div>
        </article>
        `,
        "article_2" : `
        <article class="article">
            <div class="article_container ${article.meta.theme}">
                <div class="article_title ${article.meta.theme}_title">
                    <p>${article.meta.title}</p>
                    <p class="article_text">${article.meta.description}</p>
                </div>
                <hr>
                <div class="article_content ${article.meta.theme}_content">
                    <div class="article_main ${article.meta.theme}_main">
                    </div>
                </div>
            </div>
        </article>
    `,
    };
}

function elementHandler(AEMobject){
    const Handler = {
        1 : `
            <p class="article_text ${article.meta.theme}_text cpeEditable ${AEMobject.bold?"article_bold":""} ${AEMobject.italic?"article_italic":""} ${AEMobject.underline?"article_underline":""}" contenteditable>
                ${AEMobject.content}
            </p>`,
        2 : `
            <a class="article_linkBtn ${article.meta.theme}_linkBtn cpeEditable" contenteditable>
                ${AEMobject.content}
            </a>`,
        3 : `
            <p class="article_subtitle_1 ${article.meta.theme}_subtitle_1 cpeEditable ${AEMobject.bold?"article_bold":""} ${AEMobject.italic?"article_italic":""} ${AEMobject.underline?"article_underline":""}" contenteditable>
                ${AEMobject.content}
            </p>`,
        4 : `
            <p class="article_subtitle_2 ${article.meta.theme}_subtitle_2 cpeEditable ${AEMobject.bold?"article_bold":""} ${AEMobject.italic?"article_italic":""} ${AEMobject.underline?"article_underline":""}" contenteditable>
                ${AEMobject.content}
            </p>`,
        5 : `
            <div class="article_video ${article.meta.theme}_video">
                <hr>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/${AEMobject.url}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>`,
        6 : `
            <div class="article_img ${article.meta.theme}_img">
                <hr>
                <img src="${AEMobject.img !== null ? URL.createObjectURL(AEMobject.img) : ""}" alt="">
            </div>`,
        7 : `
            <div class="article_link_img ${article.meta.theme}_link_img">
                <hr>
                <a>
                    <img src="${AEMobject.img !== null ? URL.createObjectURL(AEMobject.img) : ""}" alt="">
                </a>
            </div>`,
        8 : `
            <div class="article_pdf ${article.meta.theme}_pdf">
                <hr>
                <embed src="${AEMobject.pdf !== null ? URL.createObjectURL(AEMobject.pdf) : ""}" type="application/pdf" width="100%" height="100%">
            </div>`,
        9 : `<div class="article_text ${article.meta.theme}_text cpeEditable">
                Enlace de la API: ${AEMobject.url}
            </div>`,
    };

    return Handler["" + AEMobject.type]
}

function openFrames(edit=false, pub=false){
    let cnvPntFrames = pub ? document.getElementById("cnvPntSendFrames") : document.getElementById("cnvPntFrames");
    cnvPntFrames.style.display = "block";
    cnvPntFrames.animate(
        [
            {filter : "opacity(0)"},
            {filter : "opacity(1)"}
        ],
        {
            duration: 150,
            iterations: 1,
            easing: "ease-in-out",
        }
    );
    
    if(!pub){
        if(edit){
            document.getElementById("cpfElementData").style.display = "flex";
        }else{
            document.getElementById("cpfElementSelector").style.display = "block";
        }
    }
}

function closeFrames(pub=false){
    let cnvPntFrames = pub ? document.getElementById("cnvPntSendFrames") : document.getElementById("cnvPntFrames");
    cnvPntFrames.animate(
        [
            {filter : "opacity(1)"},
            {filter : "opacity(0)"}
        ],
        {
            duration: 150,
            iterations: 1,
            easing: "ease-in-out",
        }
    ).onfinish = () => {
        cnvPntFrames.style.display = "none";
    };
    if(!pub){
        document.getElementById("cpfElementData").style.display = "none";
        document.getElementById("cpfElementSelector").style.display = "none";

        for(let item of document.getElementsByClassName("cnvEditElement")){
            item.style.display = "none";
        }

        document.getElementById("inpTxtLink").value = "";
        document.getElementById("inpFilePdfArticle").value = "";
        //document.getElementById("inpFileImgArticle").value = "";
        for(let item of document.getElementsByName("inpRdbtnAPIType")){
            item.checked = false;
        }

        renderArticle();
    }
}

function openEditBar(){
    let cnvPntEditBa = document.querySelector(".cnvPntEditBar");
    let cnvPaintWorkArea = document.getElementById("cnvPaintWorkArea");
    if(cnvPntEditBa.offsetHeight == 0){
        cnvPntEditBa.animate(
            [
                {height : "0px"},
                {height : "50px"}
            ],
            {
                duration: 150,
                iterations: 1,
                easing: "ease-in-out",
            }
        )
        .onfinish = () => {
            cnvPntEditBa.style.height = "50px";
        };

        cnvPaintWorkArea.animate(
            [
                {paddingTop : "15px"},
                {paddingTop : "65px"}
            ],
            {
                duration: 150,
                iterations: 1,
                easing: "ease-in-out",
            } 
        ).onfinish = () => {
            cnvPaintWorkArea.style.paddingTop = "65px";
        };
    }
}

function closeEditBar(){
    let cnvPntEditBa = document.querySelector(".cnvPntEditBar");
    if(cnvPntEditBa.offsetHeight == 50){
        cnvPntEditBa.animate(
            [
                {height : "50px"},
                {height : "0px"}
            ],
            {
                duration: 150,
                iterations: 1,
                easing: "ease-in-out",
            }
        )
        .onfinish = () => {
            cnvPntEditBa.style.height = "0px";
        };

        cnvPaintWorkArea.animate(
            [
                {paddingTop : "65px"},
                {paddingTop : "15px"}
            ],
            {
                duration: 150,
                iterations: 1,
                easing: "ease-in-out",
            } 
        ).onfinish = () => {
            cnvPaintWorkArea.style.paddingTop = "15px";
        };
    }
}

function editBarUpdate(){
    if(article.AEM.length != 0){
        if(VirtualCanvas.selectedIndex != -1){
            openEditBar();

            if(article.AEM[VirtualCanvas.selectedIndex].type <= 4 && article.AEM[VirtualCanvas.selectedIndex].type != 2){
                for(let item of document.getElementsByClassName("cpebText")){
                    item.style.display = "block";
                    for(let item of document.querySelectorAll(".cpebText > input")){
                        item.checked = article.AEM[VirtualCanvas.selectedIndex][item.value];
                    }
                }
                for(let item of document.getElementsByClassName("cpebOther")){
                    item.style.display = "none";
                }
                document.getElementById("cnvDeleteBtn").style.display = "block";
            } else{
                for(let item of document.getElementsByClassName("cpebText")){
                    item.style.display = "none";
                }
                for(let item of document.getElementsByClassName("cpebOther")){
                    item.style.display = "block";
                }
                document.getElementById("cnvDeleteBtn").style.display = "block";
            }

        }
        else{
            closeEditBar();
        }
        console.log(VirtualCanvas.selectedIndex);
    } else{
        for(let item of document.querySelectorAll(".cpebText > input")){
            item.checked = false;
        }
        closeEditBar();
    }
}

function renderEvents(){
    for(let item of document.getElementsByName("cpeSelector")){
        item.addEventListener("input", e => {
            if(e.target.checked){
                VirtualCanvas.selectedIndex = e.target.value;
                editBarUpdate();
            }
        });
    }

    document.querySelector(".article_main").addEventListener("click", e => {
        e.stopPropagation();
    });

    for(let item of document.getElementsByClassName("cpeEditable")){
        item.addEventListener("blur", e => {
            if(e.target.innerHTML === ""){
                e.target.innerHTML = "Elemento";
                let id = new String(item.parentNode.parentNode.id);
                article.AEM[parseInt(id.replace("cpe", ""))].content = item.innerHTML;
            }
        })
        item.addEventListener("input", e => {
            let id = new String(item.parentNode.parentNode.id);
            article.AEM[parseInt(id.replace("cpe", ""))].content = item.innerHTML;
        })
    }

    for(let item of document.getElementsByClassName("cpeCreateBtns")){
        item.addEventListener("click", e => {
            if(item.classList.contains("cpecbTop")){
                VirtualCanvas.insert = -1;
            } else if(item.classList.contains("cpecbBottom")){
                VirtualCanvas.insert = 1;
            } else{
                VirtualCanvas.insert = 0;
            }

            openFrames();
        });
    }
}

function renderArticle(test=false){
    updateBase();
    document.getElementById("cnvPaintWorkArea").innerHTML = base[article.meta.theme];

    let article_main = document.querySelector(".article_main");
    let elementStr = "";
    //1 = text
    //2 = Enlace
    //3 = Subtitulo 1
    //4 = Subtitulo 2
    //5 = Video
    //6 = img
    //7 = Img/enlace
    //8 = Pdf
    //9 = API
    for(let i = 0; i < article.AEM.length; i++){
        elementStr += `
        <div class="cpElement" id="cpe${i}">
            <input type="radio" name="cpeSelector" id="cpeSelector${i}" value="${i}" ${(VirtualCanvas.selectedIndex == i) ? "checked" : ""}>
            <label for="cpeSelector${i}">
                <div class="cpeCreateBtns cpecbTop">
                    <div>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
        `;
        elementStr += elementHandler(article.AEM[i]);
        elementStr += `
                <div class="cpeCreateBtns cpecbBottom">
                    <div>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
            </label>
        </div>

        `;
    }

    if(article.AEM.length == 0){
        elementStr += `
        <div class="cpeCreateBtns cpecbMain">
            <div>
                <i class="fa-solid fa-plus"></i>
            </div>
        </div>`
    }

    if(article.meta.theme === "article_1"){
        elementStr += `
        <hr>
        <p class="article_end ${article.meta.theme}_end">
            ¡UNA VEZ LOBOS, SIEMPRE LOBOS!
        </p>`
    }
    article_main.innerHTML = elementStr;

    VirtualCanvas.insert = 0;

    renderEvents();

    editBarUpdate();
}

function createElements(nType){
    let AEMobject = {
        content: "Elemento",
        url: "",
        img: null,
        pdf: null,
        type: nType,
        API_type: 0,
        bold: false,
        italic: false,
        underline: false,
        list: false,

    }
    if(article.AEM.length == 0){
        VirtualCanvas.selectedIndex = 0;
    }
    if(VirtualCanvas.insert > 0){
        article.AEM.splice(VirtualCanvas.selectedIndex + 1, 0, AEMobject);
        VirtualCanvas.selectedIndex++;
        console.log("E no mames")
    } else if(VirtualCanvas.insert < 0){
        article.AEM.splice(VirtualCanvas.selectedIndex, 0, AEMobject);
    } else{
        article.AEM[0] = AEMobject;
    }

    VirtualCanvas.insert = 0;
    if(article.AEM[VirtualCanvas.selectedIndex].type > 4 || article.AEM[VirtualCanvas.selectedIndex].type == 2){
        renderArticle();
        document.getElementById("cpfElementData").style.display = "flex";
        document.getElementById("cpfElementSelector").style.display = "none";
        editElements();
    } else{
        editBarUpdate();
        closeFrames();
    }
}

var objectProperties = {
    1 : [],
    2 : [0],
    3 : [],
    4 : [],
    5 : [0],
    6 : [2],
    7 : [0, 2],
    8 : [3],
    9 : [0,1],
};

function editElements(){
    let cnvEditElement = document.getElementsByClassName("cnvEditElement");
    for(let i = 0; i < cnvEditElement.length; i++){
        for(let item of objectProperties[article.AEM[VirtualCanvas.selectedIndex].type]){
            if(item == i){
                cnvEditElement[i].style.display = "block";
            }
        }
    }

    document.getElementById("inpTxtLink").value = article.AEM[VirtualCanvas.selectedIndex].url;
    for(let item of document.getElementsByName("inpRdbtnAPIType")){
        if(article.AEM[VirtualCanvas.selectedIndex].API_type == parseInt(item.value)){
            item.checked = true;
        }
    }
}

function deleteElements(){
    article.AEM.splice(VirtualCanvas.selectedIndex, 1);
    VirtualCanvas.selectedIndex = -1;
    renderArticle();
}

function canvas_function(){
    document.querySelector(".cnvPntFrames > button").addEventListener("click", e => {
        closeFrames();
        VirtualCanvas.insert = 0;
    })

    document.getElementById("cnvEditBtn").addEventListener("click", e => {
        if(article.AEM[VirtualCanvas.selectedIndex].type >= 5 || article.AEM[VirtualCanvas.selectedIndex].type == 2){
            openFrames(true);
            editElements();
        }
    });

    document.getElementById("cnvDeleteBtn").addEventListener("click", deleteElements);

    for(let item of document.getElementsByClassName("cpesBtn")){
        item.addEventListener("click", e => {
            let type = item.dataset.type;
            createElements(type);
        });
    }

    document.getElementById("inpTxtLink").addEventListener("input", e => {
        if(article.AEM[VirtualCanvas.selectedIndex].type == 5){
            let value = new String(e.target.value);

            e.target.value = value.substring(value.length-11, value.length);
            console.log(e.target.value);
        }

        article.AEM[VirtualCanvas.selectedIndex].url = e.target.value;
    });

    document.getElementById("inpFileImgArticle").addEventListener("change", e => {
        let files = e.target.files;
        for(let file of files){
            article.AEM[VirtualCanvas.selectedIndex].img = file;
            console.log(file);
            document.querySelector(`#cpe${VirtualCanvas.selectedIndex} img`).src = URL.createObjectURL(article.AEM[VirtualCanvas.selectedIndex].img);
        }
    });

    document.getElementById("inpFilePdfArticle").addEventListener("change", e => {
        let files = e.target.files;
        for(let file of files){
            article.AEM[VirtualCanvas.selectedIndex].pdf = file;
            document.querySelector(`#cpe${VirtualCanvas.selectedIndex} embed`).src = URL.createObjectURL(article.AEM[VirtualCanvas.selectedIndex].pdf);
        }
    });

    for(let item of document.getElementsByName("inpRdbtnAPIType")){
        item.addEventListener("change", e => {
            if(e.target.checked){
                article.AEM[VirtualCanvas.selectedIndex].API_type = parseInt(e.target.value);
            }
        });
    }

    for(let item of document.querySelectorAll(".cpebText > input")){
        item.addEventListener("change", e =>{
            if(e.target.checked){
                article.AEM[VirtualCanvas.selectedIndex][e.target.value] = true;
            } else{
                article.AEM[VirtualCanvas.selectedIndex][e.target.value] = false;
            }
            renderArticle();
        });
    }

    
    document.querySelector("html").addEventListener("click", e => {
        if(article.AEM.length != 0){
            try {
                document.getElementById("cpeSelector" + VirtualCanvas.selectedIndex).checked = false;
            } catch (error) {
                
            }
        }
        VirtualCanvas.selectedIndex = -1;
        editBarUpdate();
    });

    for(let item of document.querySelectorAll(".cnvPntFrames")){
        item.addEventListener("click", e => {
            e.stopPropagation();
        });
    }

    document.querySelector(".cnvPntEditBar").addEventListener("click", e => {
        e.stopPropagation();
    });
}
