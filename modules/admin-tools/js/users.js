
AdminTools.Users = class {
    static selectedID = 0;

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
        document.getElementById("attButtonEdit").className = "attButtonDisable";
        document.getElementById("attButtonDelete").className = "attButtonDisable";

        if(element == null){
            return;
        }

        element.className = "";
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

    document.querySelector("HTML").addEventListener("click", e => {
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
}
Users();