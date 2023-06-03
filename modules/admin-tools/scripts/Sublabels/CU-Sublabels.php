<?php
    use OzyTool\OzyTool;
    include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");
    $ozy_tool = new OzyTool(1);
    $POST = $ozy_tool->postData();

    $sql = $ozy_tool->MySQL();

    $sql->getDbh()->beginTransaction();

    if($sql == null){
        $ozy_tool->killApp(1, "La conexión a la base de datos no es posible");
    }

    if(!isset($POST["name"])){
        $ozy_tool->killApp(1, "Solicitud con parametros incompletos");
    }

    $sublabel_id = 0;
    if(!isset($POST["sublabel_id"])){
        $query = "
            select (max(SUBLABEL_ID) + 1) as SUBLABEL_ID 
            from SUBETIQUETAS 
            where LABEL_ID = 2;
        ";

        $cursor = $sql->console($query);

        $ozy_tool->cursorVerificator($cursor, $sql);

        foreach($cursor as $item){
            $sublabel_id = $item['SUBLABEL_ID'];
            break;
        }

        $query = "
            insert into SUBETIQUETAS (LABEL_ID, SUBLABEL_ID, NOMBRE, ESTADO) values
            (2, {$sublabel_id}, '{$POST["name"]}', 1)

        ";


        $cursor = $sql->console($query);

        $ozy_tool->cursorVerificator($cursor, $sql);
    } else{
        $sublabel_id = $POST["sublabel_id"];
        $query = "
            update SUBETIQUETAS set NOMBRE = '{$POST["name"]}'
            where LABEL_ID = 2 and SUBLABEL_ID = {$sublabel_id}
        ";

        $cursor = $sql->console($query);

        $ozy_tool->cursorVerificator($cursor, $sql);
    }



    $sql->getDbh()->commit();
    $response = $ozy_tool->defaultResponse();
    $response["message"] = "Acción realizada con exito";
    echo json_encode($response);
?>