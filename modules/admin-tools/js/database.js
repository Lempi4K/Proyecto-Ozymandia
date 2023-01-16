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
    });

    document.getElementById("inpBtnATCloseFrame1").addEventListener("click", e => {
        AdminTools.Database.file = null;
        AdminTools.closeFrame(document.getElementById("athFrame1"));
    });

    document.getElementById("inpBtnATYes").addEventListener("click", e => {
        OzyTool.stream("Se ha completado con satisfacción", OzyTool.CONST.MESSAGE);
        AdminTools.Database.file = null;
        AdminTools.closeFrame(document.getElementById("athFrame1"));
    });

    document.getElementById("inpBtnATDownload").addEventListener("click", async e => {
        let url = "/modules/admin-tools/scripts/Database/export.php";
        let body = new FormData();
        const options = {
            method : "POST",
            headers: {
                //'Content-Type': 'application/json'
            },
            body : body,
            
        };


        let text;
        try{
            let res = await fetch(url), response = await res.text();
            if (!res.ok){
                throw new Error("AJAX-Request-Failed");
            }

            text = response;

            let file = new Blob()
            console.log(text);

        }catch(err){

        }



        OzyTool.stream("Comenzando descarga", OzyTool.CONST.MESSAGE);
        /*
        let file = new Blob();
        file.name = "xd.txt";

        let link = document.createElement("a");
        link.download = file.name;
        link.href = URL.createObjectURL(file);
        link.click();
        URL.revokeObjectURL(link.href);
        */
    });
}

database();