<?php
    include ("../db/MySQL_Class.php");
    include ("../db/dbConfig.php");
    if(isset($_COOKIE["token"])){
        $credenciales = new MySQL_Class($host, $dbname, $user, $pass);
        $token_ck = $_COOKIE["token"];
        $query = "select count(*) as T from TOKENS as T where T.TOKEN = '$token_ck'";
        $resultado = $credenciales->console_FV($query);
        if($resultado["T"]){
            echo json_encode(array("success" => 1));
        }else{
            echo json_encode(array("success" => 0));
        }
    }
    else{
        echo json_encode(array("success" => 0));
    }
?>