<?php
    include("../model/login_model.php");
    include("../view/login_view.php");
    include($_SERVER['DOCUMENT_ROOT']."/libs/php-jwt-master/src/JWT.php");

    use Firebase\JWT\JWT;

    header("Content-type: application/json; charset=utf-8");
    $POST = json_decode(file_get_contents("php://input"), true);

    $user = $POST["user"];
    $pass = $POST["pass"];

    $model = new Login_Model($user, $pass);

    $data = array();
    $errors = "";

    if($model->getValidate() && $model->getErrors() === ""){
        $a_time = 604800;
        $key = "P.O.";
        $time = time();
        $token = "";

        if($model->getToken()){
            $token = $model->getTokenStr();
            $dataT = (JWT::decode($token, $key));
            if(($dataT->exp - $time) <= 0){
                $dataT->iat = $time;
                $dataT->exp = $time + $a_time;
                $token = JWT::encode((array) $dataT, $key);

                $model->setToken($token);
            }

            $a_time =$dataT->exp - $time;
        } else{
            $token = bin2hex(openssl_random_pseudo_bytes(15));

            $dataT = array("uid" => $model->getUser_id(),
                          "iat" => $time,
                          "exp" => $time + $a_time,
                          "iss" => "server",
                          "prm" => $model->getPerm(),
                          "dkm" => 3);
            $token = JWT::encode($dataT, $key);


            $model->setToken($token);
        }

        setcookie("token", $token, ($time + $a_time), "/", $_SERVER["HTTP_HOST"], false, true);
        $data = array("success" => true);
    }else{
        if ($model->getErrors() != ""){
            $model->getErrors('PHP.login_controller:Main:Forwarding by error in \"login_model\";\n');
        }
        $data = array("success" => false);
    }

    $errors = $model->getErrors();

    Login_View::sendData_AJAX($data, $errors);
?>