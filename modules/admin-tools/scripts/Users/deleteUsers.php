<?php
    use OzyTool\OzyTool;
    include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");
    $ozy_tool = new OzyTool(1);
    $POST = $ozy_tool->postData();

    function killApp($errorCode, $errorMessage){
        $response["success"] = false;
        $response["error"] = [];
        $response["error"]["number"] = $errorCode;
        $response["error"]["message"] = $errorMessage;
        echo json_encode($response);
        die();
    }

    function cursorVerificator($cursor, &$sql){
        if($cursor->errorCode() != "0000"){
            $sql->getDbh()->rollBack();
            killApp($cursor->errorInfo()[0], $cursor->errorInfo()[2]);
        }
        return;
    }

    $response = [
        "success" => true,
        "error" => [
            "number" => 0,
            "message" => "",
        ],
        "warn" => [
            "number" => 0,
            "message" => "",
        ],
        "warnI" => false,
    ];

    $user_id = $POST["USER_ID"];

    $user = $ozy_tool->User();

    if(!$user->hasPerm("Ozy.AdminTools.users.db.delete")){
        killApp(1, "No tienes permiso para hacer esto");
    }

    $sql = $ozy_tool->MySQL();

    $query = "select PERM from USUARIOS where USER_ID = {$user_id}";
    $cursor = $sql->console($query);
    cursorVerificator($cursor, $sql);
    if($cursor->rowCount() == 0){
        killApp(1, "Usuario inexistente");
    }
    $user_Str = "";
    foreach($cursor as $item){
        $user_Str = $item["PERM"];
    }

    if($user->prm <= ((int) $user_Str)){
        if(!$user->hasPerm("Ozy.AdminTools.users.db.alterLTE")){
            killApp(1, "No puedes alterar usuarios con rangos iguales o más poderosos que tú");
        }
    }

    $query = "update USUARIOS set ESTADO = 0 where USER_ID = {$user_id}";
    $cursor = $sql->console($query);
    cursorVerificator($cursor, $sql);

    echo json_encode($response);
?>