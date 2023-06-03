<?php
    use OzyTool\OzyTool;
    include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");
    $ozy_tool = new OzyTool();
    $POST = $ozy_tool->postData();

    if(!isset($POST["rol_id"])){
        $ozy_tool->killApp(1, "Soicitud incompleta");
    }

    $query = "select * from PERMISOS where PERM_ID = {$POST["rol_id"]} and ESTADO = 1";

    $sql = $ozy_tool->MySQL();

    if($sql == null){
        $ozy_tool->killApp(1, "La conexión a la base de datos no es posible");
    }

    $cursor = $sql->console($query);

    $ozy_tool->cursorVerificator($cursor, $sql, false);

    if($cursor->rowCount() != 1){
        $ozy_tool->killApp(1, "Rol no disponible para edición");
    }

    $HTML = <<< HTML

    HTML;

    foreach($cursor as $item){
        $HTML .= <<< HTML
            <div class="frmPlatformData">
                <h1 class="athSubtitle">Subetiqueta<hr></h1>
                <div class="frmInpText">
                    <input type="text" id="inpTxtName" name="name" placeholder="name" pattern="{$ozy_tool->regex_NOT}{1,20}" value="{$item['NOMBRE']}">
                    <label for="inpTxtName" class="no_select">Nombre</label>
                </div>
                <br>
                <div class="frmTextArea">
                    <label for="txtPerms" class="no_select">Permisos</label>
                    <textarea id="txtPerms" name="perms" placeholder="Permisos" pattern="{$ozy_tool->regex_NOT}{1,20}">{$item['PERMISOS']}</textarea>
                </div>
                <br>
                <div class="frmInpColor">
                    <label for="inpClColor" class="no_select">Color</label>
                    <input type="color" id="inpClColor" name="color" placeholder="Color" value="{$item['COLOR']}">
                </div>
            </div>
        HTML;
        break;
    }

    $response = $ozy_tool->defaultResponse();

    $response["data"] = [
        "HTML" => $HTML
    ];

    echo json_encode($response);
?>