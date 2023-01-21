/**
 * Artículo en crudo
 * @var object
 */
var article = null;

/**
 * Variables internas del canvas
 * @var object
 */
var VirtualCanvas = {
    selectedIndex: -1,
    insert: -1
}

/**
 * Hace la solicitud para mandar a traer el artículo
 * @param {int} id 
 * @returns {object} object
 */
async function AJAX_RecoveryObject(id){
    const url = "/modules/canvas/controller/canvas_recovery.php";

    let params = {
        aid: id,
    };

    const options = {
        method : "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body : JSON.stringify(params),
    };
    try{
        let res = await fetch (url, options), json = await res.json();
        
        if (!res.ok){
            throw new Error("AJAX-Request-Failed");
        }

        return json.data.article;
    } catch (err){
        return article;
    }
}

/**
 * Función principal del módulo
 */
async function canvas(){
//window.addEventListener("load", async e => {
    //document.getElementById("replazable-content").addEventListener("AJAXLoad", async e => {
    //    if(e.routeType != "lienzo"){
    //        return;
    //    }
        article = {
            meta: {
                id: 0,
                type: 1,
                subtype: 1,
                visibility: 1,
                theme: "article_2",
                autor_uid: 0,
                title: "Titulo",
                description: "",
                background_img: null,
                pub_date: "",
                label: null,
                sublabel: null,
                gen_label: null
            },
            AEM: new Array(),
            blocked: false,
            delete: false,
            approved: false,
        };

        if(getParameterByName("id") != ""){

            activeFrame = 3;

            let frames = document.getElementsByClassName("canvas-frame")
            frames[0].classList.toggle("frame-active")
            frames[3].classList.toggle("frame-active")
            
            article = await AJAX_RecoveryObject(getParameterByName("id"));
            article._id = undefined;

            document.getElementById("inpRdbtnFrmArtlType" + article.meta.type).checked = true;
            for(let i = 0; i < article.AEM.length; i++){
                if(article.AEM[i].type == "6" || article.AEM[i].type == "7"){
                    let ext = getExtension(article.AEM[i].img);
                    article.AEM[i].img = await fetch(article.AEM[i].img).then(r => r.blob());
                    article.AEM[i].img.name = i + "." + ext;
                    console.log(article.AEM[i].img);
                }
                if(article.AEM[i].type == "8"){
                    let ext = getExtension(article.AEM[i].pdf);
                    article.AEM[i].pdf = await fetch(article.AEM[i].pdf).then(r => r.blob());
                    article.AEM[i].pdf.name = i + "." + ext;
                }
            }

            if(article.meta.background_img != null){
                let ext = getExtension(article.meta.background_img);
                article.meta.background_img = await fetch(article.meta.background_img).then(r => r.blob());
                article.meta.background_img.name = "background_img." + ext;

            }



            if((article.meta.sublabel == null || article.meta.label == null) && article.meta.type == 1){
                document.getElementById("cnvFrmPubBtn").value = "Guardar";
                document.querySelector(".cpsfMessage").innerHTML = "Seguro que quieres guardar el borrador";
            } else{
                document.getElementById("cnvFrmPubBtn").value = "Editar";
                document.querySelector(".cpsfMessage").innerHTML = "Seguro que quieres editar el art&iacute;culo?";
            }

            initialData(); //set-article-data.js
        }
        set_article_data();
    
        frame_changer();
        console.log("Cargado xddd")
    
        navasidecard_canvas();
    
        canvas_function();
    
        canvas_send();
    
        renderArticle();
    
    
    //});
//});
}
canvas();
/*
import {set_article_data} from "./set-article-data";
import {frame_changer} from "./frame-changer";
import {navasidecard_canvas} from "./navasidcard-canvas";
import {canvas_function, renderArticle} from "./canvas-functions";
import {canvas_send} from "./canvas-send";
*/
