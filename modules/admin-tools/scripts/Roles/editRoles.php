<?php
        use OzyTool\OzyTool;
        include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");
        $ozy_tool = new OzyTool(1);
        $POST = $ozy_tool->postData();
    
        if(!isset($POST["rol_id"]) || !isset($POST["name"]) || !isset($POST["perms"]) || !isset($POST["color"])){
            $ozy_tool->killApp(1, "Solicitud con parametros incompletos");
        }

        if($POST["rol_id"] == 1){
            $ozy_tool->killApp(1, "No puedes modificar el rol: 1");
        }

        $sql = $ozy_tool->MySQL();
    
        $sql->getDbh()->beginTransaction();
    
        if($sql == null){
            $ozy_tool->killApp(1, "La conexión a la base de datos no es posible");
        }
    
        $query = "
            update PERMISOS set NOMBRE = '{$POST["name"]}', PERMISOS = '{$POST["perms"]}', COLOR = '{$POST["color"]}' 
            where PERM_ID = {$POST["rol_id"]}
        ";

        $cursor = $sql->console($query);

        $ozy_tool->cursorVerificator($cursor, $sql);


        $sql->getDbh()->commit();
        $response = $ozy_tool->defaultResponse();
        $response["message"] = "Acción realizada con exito";
        echo json_encode($response);
?>