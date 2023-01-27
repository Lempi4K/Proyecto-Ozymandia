AdminTools.Sublabels = class {
    selectedID = null;

    static lazyEvents(){
        for(let item of document.querySelectorAll(".atTable > .article_table tbody tr")){
            item.addEventListener("click", e => {
                AdminTools.Sublabels.selectRow(item)
            });
        }
    }

    static selectRow(element){
        AdminTools.Sublabels.selectedID = element.id
        
        for(let item of document.querySelectorAll(".atTable > .article_table tbody tr")){
            item.className = "";
        }

        element.className = "selectedRow";

        document.getElementById("attButtonEdit").className = "";
        document.getElementById("attButtonDelete").className = "";
    }

    static unselectRow(element){
        AdminTools.Sublabels.selectedID = null
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

    static async requestFormElements(sublabel_id){
        let url = "/modules/admin-tools/scripts/Sublabels/formElements.php";
        let params = {
            "sublabel_id": sublabel_id,
        };

        await OzyTool.defaultAJAXListener(url, params, data => {
            console.log(data);
            document.getElementById("athFormElementsContainer").innerHTML = data.HTML;

            scriptHandler(document.getElementById("athFormElementsContainer"), document.querySelectorAll(".athFormElementsContainer script"));
    
            AdminTools.openFrame(document.getElementById("athFrame1"));
        });
    }
}

function Sublabels(){
    AdminTools.tableUpdater(3, "", 0, AdminTools.Sublabels.lazyEvents);

    document.querySelector(".atMainContainer").addEventListener("click", e => {
        AdminTools.Sublabels.unselectRow(document.querySelector(".selectedRow"));
    });
    for(let item of document.getElementsByClassName("atTopBar")){
        item.addEventListener("click", e => {
            AdminTools.Sublabels.unselectRow(document.querySelector(".selectedRow"));
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
                AdminTools.tableUpdater(3, "", lastID, AdminTools.Sublabels.lazyEvents);
            }
        })
    }

    document.getElementById("inpBtnATCloseFrame1").addEventListener("click", e => {
        AdminTools.closeFrame(document.getElementById("athFrame1"));
    });

    document.getElementById("attButtonAdd").addEventListener("click", async e => {
        AdminTools.Sublabels.unselectRow(document.querySelector(".selectedRow"));
        await AdminTools.Sublabels.requestFormElements(null);
    });

    document.getElementById("attButtonEdit").addEventListener("click", async e => {
        if(AdminTools.Sublabels.selectedID == null){
            return;
        };

        await AdminTools.Sublabels.requestFormElements(AdminTools.Sublabels.selectedID);
    });

    document.getElementById("attButtonDelete").addEventListener("click", e => {
        if(AdminTools.Sublabels.selectedID == null){
            return;
        };

        AdminTools.openFrame(document.getElementById("athFrame2"));
    });

    document.getElementById("inpBtnATCloseFrame2").addEventListener("click", e => {
        AdminTools.closeFrame(document.getElementById("athFrame2"));
    });

    document.getElementById("athForm").addEventListener("submit", async e => {
        let url = "/modules/admin-tools/scripts/Sublabels/CU-Sublabels.php";
        let param = {
            "sublabel_id": AdminTools.Sublabels.selectedID,
            "name": document.getElementById("inpTxtName").value,
        };

        await OzyTool.defaultAJAXListener(url, param, data => {
            AdminTools.Sublabels.unselectRow(document.querySelector(".selectedRow"));
            AdminTools.tableUpdater(3, "", 0, AdminTools.Sublabels.lazyEvents);
            AdminTools.closeFrame(document.getElementById("athFrame1"));
        });
    });

    document.getElementById("inpBtnATYes").addEventListener("click", async e => {
        let url = "/modules/admin-tools/scripts/Sublabels/archiveSublabels.php";
        let param = {
            "sublabel_id": AdminTools.Sublabels.selectedID,
        };

        await OzyTool.defaultAJAXListener(url, param, data => {
            AdminTools.Sublabels.unselectRow(document.querySelector(".selectedRow"));
            AdminTools.tableUpdater(3, "", 0, AdminTools.Sublabels.lazyEvents);
            AdminTools.closeFrame(document.getElementById("athFrame2"));
        });
    });

}

Sublabels();