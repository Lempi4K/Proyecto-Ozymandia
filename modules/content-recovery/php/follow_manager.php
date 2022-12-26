<?php
/**
 * Maneja los temas seguidos en un usuario
 */
    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MySQL_lib/Simple_MySQL.php");

    include($_SERVER['DOCUMENT_ROOT']."/libs/php-jwt-master/src/JWT.php");
    use Firebase\JWT\JWT;
    
    header("Content-type: application/json; charset=utf-8");
    $POST = json_decode(file_get_contents("php://input"), true);

    $sublabel_id = $POST["sublabel_id"] ?? 0;
    $action = $POST["action"] ?? 0;

    $success = false;

    $dataT = JWT::decode($_COOKIE["token"], "P.O.");
    $uid = $dataT->uid;

    $sql = "";
    if($action){
        $sql = "insert into USER_LABELS (USER_ID, LABEL_ID, SUBLABEL_ID) value ($uid, 2, $sublabel_id);";
    } else{
        $sql = "delete from USER_LABELS where USER_ID = $uid and SUBLABEL_ID = $sublabel_id;";
    }

    try{
        $db_handler = new S_MySQL("USER_DATA", 1);
        $data = $db_handler->console($sql);
        $success = true;
    }catch (Exception $e){
        $success = false;
    }

    echo json_encode(array("success" => $success, "sublabel" => $uid));
?>