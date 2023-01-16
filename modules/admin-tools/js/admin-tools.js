var AdminTools = {
    Header: null,
    Users: null,
    Database: null,

    tableUpdater: async (section, search, start = 1, func = ()=>{}) => {
        let url = "/modules/admin-tools/scripts/tableUpdater.php"
        let params = {
            "section": section,
            "search": search,
            "start": start
        };
        let response = await OzyTool.AJAX(url, params);

        if(!response.success){
            console.log(response);
            OzyTool.stream("Error al actualizar la tabla", OzyTool.CONST.ERROR);
            return;
        }

        for(let item of document.querySelectorAll(".atTable > .article_table tbody")){
            if(start == 0 || search != ""){
                item.innerHTML = response.response.HTML;
            } else{
                item.innerHTML += response.response.HTML;
            }

            func()
        }
    },

    openFrame: (element) => {
        let container = document.querySelector(".atHideFrames");
        container.style.display = "flex";
        element.style.display = "block";
        container.animate(
            [
                {filter : "opacity(0)"},
                {filter : "opacity(1)"}
            ],
            {
                duration: 150,
                iterations: 1,
                easing: "ease-in-out",
                fill: "forwards"
            }
        );
    },
    closeFrame: (element) => { 
        let container = document.querySelector(".atHideFrames");


        container.animate(
            [
                {filter : "opacity(1)"},
                {filter : "opacity(0)"}
            ],
            {
                duration: 150,
                iterations: 1,
                easing: "ease-in-out",
                fill: "forwards"
            }
        ).onfinish = () => {
            element.scrollTop = 0;
            element.style.display = "none";
            container.style.display = "none";
        };
    }
}