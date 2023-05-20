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

        function warnApp($warnCode, $warnMessage, &$response){
            $response["success"] = true;
            $response["warnI"] = true;
            $response["warn"] = [];
            $response["warn"]["number"] = $warnCode;
            $response["warn"]["message"] = $warnMessage;
        }

        $user_data = $POST["user_data"];

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

        $sql = $ozy_tool->MySQL();

        $user = $ozy_tool->User();

        /* Primer Anillo De Seguridad
        if(!$user->hasPerm("Ozy.AdminTools.users.db.alterLTE")){
            if(!isset($user_data["PERM_ID"])){

            } else{

            }
        }*/

        //var_dump($POST);

        $sql->getDbh()->beginTransaction();

        if(!isset($user_data["TIPO"])  && $user_data["USER_ID"] != 0){
            $user_data["TIPO"] = $ozy_tool->User($user_data["USER_ID"])->getType();
        } 
        
        if(!isset($user_data["TIPO"])  && $user_data["USER_ID"] = 0){
            $sql->getDbh()->rollBack();
            killApp(1611, "Datos corruptos");
        }

        if($user_data["USER_ID"] == 0){
            $columns = implode(", ", array_keys($user_data["FORM"]));
            $values = "\"";
            $values .= implode("\", \"", array_values($user_data["FORM"]));
            $values .= "\"";
            $query = "
                insert into {$ozy_tool->types[ $user_data['TIPO'] ]} 
                ({$columns}) values ({$values})
            ";
            $cursor = $sql->console($query);
            cursorVerificator($cursor, $sql);
        } else{
            $set = "";

            foreach($user_data["FORM"] as $key => $value){
                $set .= "$key = '$value', ";
            }

            $set = substr($set, 0, -2);

            $query = "
                update {$ozy_tool->types[ $user_data['TIPO'] ]} 
                set $set
                where USER_ID = {$user_data["USER_ID"]}
            ";
            $cursor = $sql->console($query);
            cursorVerificator($cursor, $sql);
        }


        if($user_data["USER_ID"] == 0){
            $query = "select MAX(USER_ID) as USER_ID from USUARIOS";
            $cursor = $sql->console($query);
            cursorVerificator($cursor, $sql);

            foreach($cursor as $item){
                $user_data["USER_ID"] = $item["USER_ID"];
            }
        }

        $where = "where USER_ID = {$user_data["USER_ID"]}";

        if(isset($user_data["USER"]) && $user_data["USER"] != false){
            if(!$user->hasPerm("Ozy.AdminTools.users.db.platformData.user")){
                killApp(0, "No puedes hacer eso");
            }
            $query = "update CREDENCIALES set USER = '{$user_data["USER"]}' $where";
            $cursor = $sql->console($query);
            cursorVerificator($cursor, $sql);
        }

        $query = "select USER from CREDENCIALES where USER_ID != {$user_data["USER_ID"]} and USER = (select USER from CREDENCIALES $where)";
        $cursor = $sql->console($query);
        cursorVerificator($cursor, $sql);

        if($cursor->rowCount() != 0){
            $user_str = "";
            foreach($cursor as $item){
                $user_str = $item["USER"];
            }
            $randInt = random_int(1000, 9999);
            $user_str .= ".{$randInt}";

            $query = "update CREDENCIALES set USER = '{$user_str}' $where";
            $cursor = $sql->console($query);
            cursorVerificator($cursor, $sql);
            warnApp(1, "Se ha encontrado un usuario repetido, se va a cambiar...", $response);
        }
        
        if(isset($user_data["TIPO"])){
            $query = "update USUARIOS set TIPO = {$user_data["TIPO"]} $where";
            $cursor = $sql->console($query);
            cursorVerificator($cursor, $sql);
        }

        if(isset($user_data["PERM_ID"])){
            $query = "update USUARIOS set PERM = {$user_data["PERM_ID"]} $where";
            $cursor = $sql->console($query);
            cursorVerificator($cursor, $sql);
        }

        if(isset($user_data["PASS"]) && $user_data["PASS"] != false){
            $query = "update CREDENCIALES set PASS = '{$user_data["PASS"]}' $where";
            $cursor = $sql->console($query);
            cursorVerificator($cursor, $sql);
        }

        if(isset($user_data["SUBLABELS"])){
            $query = "select JSON from PERM_LABELS $where";
            $cursor = $sql->console($query);

            if($cursor->rowCount() == 0){
                $sql->getDbh()->rollBack();
                killApp(1611, "Datos corruptos");
            }

            $json = 0;
            foreach($cursor as $item){
                $json = json_decode($item["JSON"], true);
                break;
            }

            $json["G"] = $user_data["SUBLABELS"];

            $jsonStr = json_encode($json);

            $query = "update PERM_LABELS set JSON = '{$jsonStr}' $where";
            $cursor = $sql->console($query);
            cursorVerificator($cursor, $sql);
        }

        $sql->getDbh()->commit();
        echo json_encode($response);
?>