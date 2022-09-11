let article = {
    meta: {
        id: 0,
        type: 0,
        subtype: 1,
        theme: "article_2",
        autor_uid: 0,
        title: "Titulo",
        description: "Descripcion",
        background_img: "",
        pub_date: "",
        label: "",
        sublabel: new Array(),
    },
    AEM: new Array(),
    blocked: false,
}

let VirtualCanvas = {
    selectedIndex: 0,
    insert: -1
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

        set_article_data();

        frame_changer();

        navasidecard_canvas();

        canvas_function();

        renderArticle();
    });

});