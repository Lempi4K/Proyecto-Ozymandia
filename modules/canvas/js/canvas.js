let article = {
    id: 0,
    meta: {
        id: 0,
        type: 0,
        subtype: 1,
        theme: 1,
        autor_uid: 0,
        title: "",
        description: "",
        background_img: "",
        pub_date: "",
        label: "",
        sublabel: Array(),
    },
    AEM:[
        {//Borrar al terminar desarrollo
            content: "",
            url: "",
            img: "",
            pdf: "",
            type: 1,
            API_type: 0,
        },
    ],
    blocked: false,
}

window.addEventListener("load", e => {
    document.getElementById("replazable-content").addEventListener("AJAXLoad", e => {
        if(e.routeType != "lienzo"){
            return;
        }

        //Article Object
            //article.meta.id = AJAXmeta().articleID; Crear esto
            //article.meta.autor_uid = AJAXmeta().uid; Crear esto
        const date = new Date();
        article.meta.pub_date = `${date.getDate()}-${date.getMonth()}-${date.getFullYear()}`;
        console.log(article.meta.pub_date);

        frame_changer();

        navasidecard_canvas();

        set_article_data();
    });

});