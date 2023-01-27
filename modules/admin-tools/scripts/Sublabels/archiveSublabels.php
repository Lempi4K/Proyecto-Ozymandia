<?php
        use OzyTool\OzyTool;
        include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");
        $ozy_tool = new OzyTool();
        $POST = $ozy_tool->postData();

        if(!isset($POST['sublabel_id'])){
            $ozy_tool->killApp(1, "Solicitud incompleta");
        }

        $sql = $ozy_tool->MySQL();

        $sql->getDbh()->beginTransaction();

        if($sql == null){
            $ozy_tool->killApp(1, "La conexión a la base de datos no es posible");
        }

        $query = "
            update SUBETIQUETAS set ESTADO = 0 
            where LABEL_ID = 2 and SUBLABEL_ID = {$POST['sublabel_id']}
        ";

        $cursor = $sql->console($query);

        $ozy_tool->cursorVerificator($cursor, $sql);

        $sql->getDbh()->commit();
        $response = $ozy_tool->defaultResponse();
        echo json_encode($response);
?>