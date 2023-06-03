<?php
    use OzyTool\OzyTool;
    include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");
    $ozy_tool = new OzyTool();
    $POST = $ozy_tool->postData();

    $name = "";
    if(isset($POST["sublabel_id"])){
        $query = "select NOMBRE from SUBETIQUETAS where SUBLABEL_ID = {$POST['sublabel_id']} and LABEL_ID = 2";

        $mysql = $ozy_tool->MySQL();

        if($mysql == null){
            $ozy_tool->killApp(1, "La conexión a la base de datos no es posible");
        }

        $cursor = $mysql->console($query);

        $ozy_tool->cursorVerificator($cursor, $mysql, false);

        if($cursor->rowCount() != 1){
            $ozy_tool->killApp(1, "Subetiqueta no disponible o válida");
        }

        foreach($cursor as $item){
            $name = $item['NOMBRE'];
            break;
        }
    }

    $HTML = <<< HTML
        <div class="frmPlatformData">
            <h1 class="athSubtitle">Subetiqueta<hr></h1>
            <div class="frmInpText">
                <input type="text" id="inpTxtName" name="name" placeholder="name" pattern="{$ozy_tool->regex_NOT}{1,20}" value="{$name}">
                <label for="inpTxtName" class="no_select">Nombre</label>
            </div>
        </div>
    HTML;

    $response = $ozy_tool->defaultResponse();

    $response["data"] = [
        "HTML" => $HTML
    ];

    echo json_encode($response);
?>