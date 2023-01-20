AdminTools.Database = class {
    static file = null;
}

function database(){
    document.getElementById("frmInpFileOzy").addEventListener("input", e => {
        let fileList = e.target.files;

        if(fileList.length > 1){
            OzyTool.stream("No puedes ingresar más de un archivo", OzyTool.CONST.ERROR);
            return;
        }

        if(fileList.length <= 0){
            OzyTool.stream("Debes seleccionar almenos un archivo", OzyTool.CONST.WARN);
            return;
        }

        let file = null;
        for(let item of fileList){
            file = item;
            break;
        }

        let filename = (file.name).toLowerCase();
        let regex = /^.*\.(ozy|Ozy)$/g;
        if(!regex.test(filename)){
            OzyTool.stream("Archivo con extensión inválida", OzyTool.CONST.WARN);
            return;
        }

        AdminTools.Database.file = file;
        AdminTools.openFrame(document.getElementById("athFrame1"));
        console.log("xddd");
    });

    document.getElementById("inpBtnATCloseFrame1").addEventListener("click", e => {
        AdminTools.Database.file = null;
        AdminTools.closeFrame(document.getElementById("athFrame1"));
    });

    document.getElementById("inpBtnATYes").addEventListener("click", async e => {
        let url = "/modules/admin-tools/scripts/Database/import.php";
        let body = new FormData();
        body.append("zip", AdminTools.Database.file);
        const options = {
            method : "POST",
            headers: {
                //'Content-Type': 'application/json'
            },
            body : body,
            
        };

        let response = "";

        document.getElementById("inpBtnATYes").disabled = true;
        document.getElementById("inpBtnATCloseFrame1").disabled = true;

        let text = "";
        try{
            let res = await fetch(url, options), json = await res.text();
            if (!res.ok){
                throw new Error("AJAX-Request-Failed");
            }
            text = json;
            response = JSON.parse(json);
        }catch(err){
            console.log(text);
            OzyTool.stream("Error en el servidor", OzyTool.CONST.ERROR);
            AdminTools.Database.file = null;
            AdminTools.closeFrame(document.getElementById("athFrame1"));
            document.getElementById("inpBtnATYes").disabled = false;
            document.getElementById("inpBtnATCloseFrame1").disabled = false;
            return;
        }

        if(response.error.indicator){
            console.log()
            OzyTool.stream("Error #"+ response.error.number + " :: " + response.error.message, OzyTool.CONST.ERROR);
            AdminTools.Database.file = null;
            AdminTools.closeFrame(document.getElementById("athFrame1"));
            document.getElementById("inpBtnATYes").disabled = false;
            document.getElementById("inpBtnATCloseFrame1").disabled = false;
            return;
        }

        OzyTool.stream(response.message, OzyTool.CONST.MESSAGE);
        AdminTools.Database.file = null;
        AdminTools.closeFrame(document.getElementById("athFrame1"));
        document.getElementById("inpBtnATYes").disabled = false;
        document.getElementById("inpBtnATCloseFrame1").disabled = false;
    });

    document.getElementById("inpBtnATDownload").addEventListener("click", async e => {
        document.getElementById("inpBtnATDownload").disabled = true;

        let url = "/modules/admin-tools/scripts/Database/export.php";

        let text;
        OzyTool.stream("Se ha iniciado la solicitud al servidor", OzyTool.CONST.MESSAGE);

        try{
            let res = await fetch(url), response = await res.blob();
            if (!res.ok){
                throw new Error("AJAX-Request-Failed");
            }

            text = response;

        }catch(err){
            OzyTool.stream("Error : " + err, OzyTool.CONST.ERROR);
        }


        OzyTool.stream("Comenzando descarga", OzyTool.CONST.MESSAGE);
        
        let file = text;

        file.name = "Backup.ozy";

        let link = document.createElement("a");
        link.download = file.name;
        link.href = URL.createObjectURL(file);
        link.click();
        URL.revokeObjectURL(link.href);
        
        document.getElementById("inpBtnATDownload").disabled = false;
    });
}

database();