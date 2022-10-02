var article = {
    meta: {
        id: 0,
        type: 1,
        subtype: 1,
        visibility: 1,
        theme: "article_2",
        autor_uid: 0,
        title: "Titulo",
        description: "Descripcion",
        background_img: null,
        pub_date: "",
        label: "",
        sublabel: new Array(),
    },
    AEM: new Array(),
    blocked: false,
    delete: false
}

var VirtualCanvas = {
    selectedIndex: -1,
    insert: -1
}

window.addEventListener("load", e => {
    document.getElementById("replazable-content").addEventListener("AJAXLoad", e => {
        if(e.routeType != "lienzo"){
            return;
        }
        set_article_data();
    
        frame_changer();
    
        navasidecard_canvas();
    
        canvas_function();
    
        canvas_send();
    
        renderArticle();
    
    
    });
});

/*
import {set_article_data} from "./set-article-data";
import {frame_changer} from "./frame-changer";
import {navasidecard_canvas} from "./navasidcard-canvas";
import {canvas_function, renderArticle} from "./canvas-functions";
import {canvas_send} from "./canvas-send";
*/
