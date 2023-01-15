function platformEvents(){
    AdminTools.Users.SUBLABELS = [];

    for(let item of document.querySelectorAll("#flsReset")){
        item.addEventListener("click", e => {
            for(let item of document.querySelectorAll(".inpChckbxSlbl")){
                item.checked = false;
            }
            AdminTools.Users.SUBLABELS = [];
        })
    }

    for(let item of document.getElementsByClassName("inpRdbtnUserType")){
        item.addEventListener("change", async e => {
            if(e.target.checked){
                let url = "/modules/admin-tools/scripts/Users/formElements.php";
                let params = {
                    "type": parseInt(e.target.value),
                    "user_id": AdminTools.Users.selectedID,
                    "section": 2,
                };

                document.getElementById("inpBtnATSave").disabled = true;

                let response = await  OzyTool.AJAX(url, params);
        
                if(!response.success){
                    console.log(response.response);
                    OzyTool.stream("Error en el servidor", OzyTool.CONST.ERROR);
                    return;
                }
                document.querySelector(".frmPersonalData").innerHTML = response.response.HTML;
                document.getElementById("inpBtnATSave").disabled = false;
        
                //scriptHandler(document.getElementById("athFormElementsContainer"), document.querySelectorAll(".athFormElementsContainer script"));
        
                //AdminTools.openFrame(document.getElementById("athFrame1"));
            }
        });
    }

    for(let item of document.querySelectorAll(".inpChckbxSlbl")){
        item.addEventListener("change", e => {
            if(item.checked){
                let value = parseInt(e.target.value);
                if(!AdminTools.Users.SUBLABELS.includes(value)){
                    AdminTools.Users.SUBLABELS.push(parseInt(e.target.value));
                }

            } else{
                let value = parseInt(e.target.value);
                if(AdminTools.Users.SUBLABELS.includes(value)){
                    let index = AdminTools.Users.SUBLABELS.indexOf(value);
                    AdminTools.Users.SUBLABELS.splice(index, 1);
                }

            }
        });
        if(item.checked){
            AdminTools.Users.SUBLABELS.push(parseInt(item.value));
        }
    }

    console.log(AdminTools.Users.SUBLABELS);


}

platformEvents();