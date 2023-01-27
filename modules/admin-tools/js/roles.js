AdminTools.Roles = class {
    selectedID = null;

    static lazyEvents(){
        for(let item of document.querySelectorAll(".atTable > .article_table tbody tr")){
            item.addEventListener("click", e => {
                AdminTools.Roles.selectRow(item)
            });
        }
    }

    static selectRow(element){
        AdminTools.Roles.selectedID = element.id
        
        for(let item of document.querySelectorAll(".atTable > .article_table tbody tr")){
            item.className = "";
        }

        element.className = "selectedRow";

        document.getElementById("attButtonEdit").className = "";
    }

    static unselectRow(element){
        AdminTools.Roles.selectedID = null
        try{
            document.getElementById("attButtonEdit").className = "attButtonDisable";
        } catch(err){
            return;
        }


        if(element == null){
            return;
        }

        element.className = "";
    }

    static async requestFormElements(rol_id){
        let url = "/modules/admin-tools/scripts/Roles/formElements.php";
        let params = {
            "rol_id": rol_id,
        };

        await OzyTool.defaultAJAXListener(url, params, data => {
            console.log(data);
            document.getElementById("athFormElementsContainer").innerHTML = data.HTML;

            scriptHandler(document.getElementById("athFormElementsContainer"), document.querySelectorAll(".athFormElementsContainer script"));
    
            AdminTools.openFrame(document.getElementById("athFrame1"));
        });
    }
}

function Roles(){
    AdminTools.tableUpdater(4, "", 0, AdminTools.Roles.lazyEvents);

    document.querySelector(".atMainContainer").addEventListener("click", e => {
        AdminTools.Roles.unselectRow(document.querySelector(".selectedRow"));
    });
    for(let item of document.getElementsByClassName("atTopBar")){
        item.addEventListener("click", e => {
            AdminTools.Roles.unselectRow(document.querySelector(".selectedRow"));
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

    for(let item of document.querySelectorAll(".atFrame")){
        item.addEventListener("scroll", function (){
            if(this.offsetHeight + this.scrollTop >= this.scrollHeight){
                let rows = Array.prototype.slice.call(document.querySelectorAll(".atTable > .article_table tbody tr"));
                if(rows.length == 0){ return }
                let lastID = rows[rows.length-1].id;
                AdminTools.tableUpdater(4, "", lastID, AdminTools.Roles.lazyEvents);
            }
        })
    }

    document.getElementById("inpBtnATCloseFrame1").addEventListener("click", e => {
        AdminTools.closeFrame(document.getElementById("athFrame1"));
    });

    document.getElementById("attButtonEdit").addEventListener("click", async e => {
        if(AdminTools.Roles.selectedID == null){
            return;
        };

        await AdminTools.Roles.requestFormElements(AdminTools.Roles.selectedID);
    });

    document.getElementById("athForm").addEventListener("submit", async e => {
        let url = "/modules/admin-tools/scripts/Roles/editRoles.php";
        let param = {
            "rol_id": AdminTools.Roles.selectedID,
            "name": document.getElementById("inpTxtName").value,
            "perms": document.getElementById("txtPerms").value,
            "color": document.getElementById("inpClColor").value,
        };

        await OzyTool.defaultAJAXListener(url, param, data => {
            AdminTools.Roles.unselectRow(document.querySelector(".selectedRow"));
            AdminTools.tableUpdater(4, "", 0, AdminTools.Roles.lazyEvents);
            AdminTools.closeFrame(document.getElementById("athFrame1"));
        });
    });

}

Roles();