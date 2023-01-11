var AdminTools = {
    Header: null,
    Users: null,

    tableUpdater: async (section, search, start = 1, func = ()=>{}) => {
        $url = "/modules/admin-tools/scripts/tableUpdater.php"
        $params = {
            "section": section,
            "search": search,
            "start": start
        };
        let response = await OzyTool.AJAX($url, $params);

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
    }
}