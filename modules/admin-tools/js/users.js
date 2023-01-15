
AdminTools.Users = class {
    static selectedID = 0;

    static SUBLABELS = [];

    static lazyEvents(){
        for(let item of document.querySelectorAll(".atTable > .article_table tbody tr")){
            item.addEventListener("click", e => {
                AdminTools.Users.selectRow(item)
            });
        }
    }

    static selectRow(element){
        AdminTools.Users.selectedID = element.id
        
        for(let item of document.querySelectorAll(".atTable > .article_table tbody tr")){
            item.className = "";
        }

        element.className = "selectedRow";

        document.getElementById("attButtonEdit").className = "";
        document.getElementById("attButtonDelete").className = "";
    }

    static unselectRow(element){
        AdminTools.Users.selectedID = 0
        try{
            document.getElementById("attButtonEdit").className = "attButtonDisable";
            document.getElementById("attButtonDelete").className = "attButtonDisable";
        } catch(err){
            return;
        }


        if(element == null){
            return;
        }

        element.className = "";
    }

    static async requestFormElements(user_id, type, section = 0){
        let url = "/modules/admin-tools/scripts/Users/formElements.php";
        let params = {
            "type": type,
            "user_id": user_id,
            "section": section,
        };

        let response = await  OzyTool.AJAX(url, params);

        if(!response.success){
            console.log(response.response);
            OzyTool.stream("Error en el servidor", OzyTool.CONST.ERROR);
            return;
        }
        document.getElementById("athFormElementsContainer").innerHTML = response.response.HTML;

        scriptHandler(document.getElementById("athFormElementsContainer"), document.querySelectorAll(".athFormElementsContainer script"));

        AdminTools.openFrame(document.getElementById("athFrame1"));
    }
}

function Users (){
    AdminTools.tableUpdater(1, "", 0, AdminTools.Users.lazyEvents);

    for(let item of document.querySelectorAll(".atFrame")){
        item.addEventListener("scroll", function (){
            if(this.offsetHeight + this.scrollTop >= this.scrollHeight){
                let rows = Array.prototype.slice.call(document.querySelectorAll(".atTable > .article_table tbody tr"));
                if(rows.length == 0){ return }
                let lastID = rows[rows.length-1].id;
                AdminTools.tableUpdater(1, "", lastID, AdminTools.Users.lazyEvents);
            }
        })
    }

    document.getElementById("inpSearchDataBase1").addEventListener("input", e => {
        let regex = /[`;=<>]/g;
        if(regex.test(e.target.value)){
            e.target.value = new String(e.target.value).replace(regex, "");
            return;
        }
        AdminTools.tableUpdater(1, e.target.value, 0, AdminTools.Users.lazyEvents);
        AdminTools.Users.unselectRow(document.querySelector(".selectedRow"));
    });

    document.querySelector(".atUsersContainer").addEventListener("click", e => {
        AdminTools.Users.unselectRow(document.querySelector(".selectedRow"));
    });
    for(let item of document.getElementsByClassName("atTopBar")){
        item.addEventListener("click", e => {
            AdminTools.Users.unselectRow(document.querySelector(".selectedRow"));
        })
    }
    for(let item of document.getElementsByClassName("article_table")){
        item.addEventListener("click", e => {
            e.stopPropagation();
        })
    }
    for(let item of document.getElementsByClassName("atToolBar")){
        item.addEventListener("click", e => {
            e.stopPropagation();
        })
    };
    for(let item of document.getElementsByClassName("atHideFrames")){
        item.addEventListener("click", e => {
            e.stopPropagation();
        })
    };

    document.getElementById("attButtonAdd").addEventListener("click", async e => {
        AdminTools.Users.unselectRow(document.querySelector(".selectedRow"));
        await AdminTools.Users.requestFormElements(0, 1);
    });

    document.getElementById("attButtonEdit").addEventListener("click", async e => {
        if(AdminTools.Users.selectedID == 0){
            return;
        };

        await AdminTools.Users.requestFormElements(AdminTools.Users.selectedID, 0);
    });

    document.getElementById("inpBtnATCloseFrame1").addEventListener("click", e => {
        AdminTools.closeFrame(document.getElementById("athFrame1"));
    });

    document.getElementById("athForm").addEventListener("submit", async e => {
        let formData = new FormData(document.getElementById("athForm"));

        let user_object = [];
        user_object["FORM"] = [];
        for(let item of formData.entries()){
            if(item[0] == "TIPO"){
                console.log("Chido Carnal")
                continue;
            }
            user_object["FORM"][item[0]] = item[1];
        }
        user_object["FORM"] = Object.assign({}, user_object["FORM"]);
        AdminTools.Users.SUBLABELS.sort();
        user_object["SUBLABELS"] = AdminTools.Users.SUBLABELS;
        user_object["USER_ID"] = parseInt(AdminTools.Users.selectedID);
        for(let item of document.querySelectorAll("#inpTxtPass")){
            user_object["PASS"] = item.value;
        }
        for(let item of document.querySelectorAll("#slctPERM_ID")){
            user_object["PERM_ID"] = parseInt(item.value);
        }
        for(let item of document.querySelectorAll(".inpRdbtnUserType")){
            if(item.checked){
                user_object["TIPO"] = parseInt(item.value);
            }
        }
        for(let item of document.querySelectorAll("#inpTxtUser")){
            if(!item.disabled){
                user_object["USER"] = item.value;
            }
        }
        console.log(user_object);
        let param = {
            "user_data": Object.assign({}, user_object),
        }
        
        let url = "/modules/admin-tools/scripts/Users/CU-Users.php";

        let response = await OzyTool.AJAX(url, param);

        if(!response.success){
            OzyTool.stream("Error en el servidor", OzyTool.CONST.ERROR);
            console.log(response.response);
            return;
        }

        if(!response.response.success){
            OzyTool.stream("MySQL Error " + response.response.error.number + " :: " + response.response.error.message, OzyTool.CONST.ERROR);
            return;
        }

        if(response.response.warnI){
            OzyTool.stream("Advertencia " + response.response.warn.number + " :: " + response.response.warn.message, OzyTool.CONST.WARN);
        } else{
            OzyTool.stream("Solicitud realizada con exito", OzyTool.CONST.MESSAGE);
        }



        AdminTools.Users.unselectRow(document.querySelector(".selectedRow"));
        AdminTools.tableUpdater(1, "", 0, AdminTools.Users.lazyEvents);
        AdminTools.closeFrame(document.getElementById("athFrame1"));
    });

    document.getElementById("attButtonDelete").addEventListener("click", e => {
        if(AdminTools.Users.selectedID == 0){
            return;
        };
        AdminTools.openFrame(document.getElementById("athFrame2"));
    });

    document.getElementById("inpBtnATCloseFrame2").addEventListener("click", e => {
        AdminTools.closeFrame(document.getElementById("athFrame2"));
    });

    document.getElementById("inpBtnATYes").addEventListener("click", async e => {
        let param = {
            "USER_ID": AdminTools.Users.selectedID,
        }
        
        let url = "/modules/admin-tools/scripts/Users/deleteUsers.php";

        let response = await OzyTool.AJAX(url, param);

        if(!response.success){
            OzyTool.stream("Error en el servidor", OzyTool.CONST.ERROR);
            console.log(response.response);
            return;
        }

        if(!response.response.success){
            OzyTool.stream("MySQL Error " + response.response.error.number + " :: " + response.response.error.message, OzyTool.CONST.ERROR);
            return;
        }

        if(response.response.warnI){
            OzyTool.stream("Advertencia " + response.response.warn.number + " :: " + response.response.warn.message, OzyTool.CONST.WARN);
        } else{
            OzyTool.stream("Usuario con exito", OzyTool.CONST.MESSAGE);
        }

        AdminTools.Users.unselectRow(document.querySelector(".selectedRow"));
        AdminTools.tableUpdater(1, "", 0, AdminTools.Users.lazyEvents);
        AdminTools.closeFrame(document.getElementById("athFrame2"));
    })


}
Users();