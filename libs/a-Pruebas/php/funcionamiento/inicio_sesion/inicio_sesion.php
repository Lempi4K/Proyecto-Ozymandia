<?php
    include ("../db/MySQL_Class.php");
    include ("../db/dbConfig.php");
    $credenciales = new MySQL_Class($host, $dbname, $user, $pass);
    $usuario = $_POST["user"];
    $contra = $_POST["pass"];

    $query = "select count(*) as C from USER_PASS as UA WHERE UA.USER = '$usuario' and UA.PASS = '$contra'";
    $resultado = $credenciales->console_FV($query);

    if($resultado["C"]){
        $query = "select NUM_CONTROL as NC from USER_PASS as UA WHERE UA.USER = '$usuario' and UA.PASS = '$contra'";
        $num_control = $credenciales->console_FV($query)["NC"]; 

        $query = "select count(*) as T from TOKENS as T where T.NUM_CONTROL = '$num_control'";
        $n_token = $credenciales->console_FV($query);
        $token = "";

        if(!$n_token["T"]){
            $token = bin2hex(openssl_random_pseudo_bytes(15));
            $query = "insert into TOKENS (NUM_CONTROL, TOKEN) value ('$num_control', '$token');";
            $credenciales->console($query);
        }else{
            $query = "select TOKEN as T from TOKENS as T WHERE T.NUM_CONTROL = '$num_control'";
            $token = $credenciales->console_FV($query)["T"];
        }

        setcookie("token", $token, (time()+31536000), "/", "localhost", true);
        echo json_encode(array("success" => 1));
    }else{
        echo json_encode(array("success" => 0));
    }
?>
