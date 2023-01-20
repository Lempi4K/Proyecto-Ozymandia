<?php
    use OzyTool\OzyTool;
    include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");
    $ozy_tool = new OzyTool(1);
    $response = $ozy_tool->defaultResponse();
    
    if(!isset($_FILES["zip"])){
        $response["error"]["indicator"] = true;
        $response["error"]["number"] = 1;
        $response["error"]["message"] = "Archivo inexistente";
        echo json_encode($response);
        die();
    }

    $zip = $_FILES["zip"];

    $tempFolder = $zip["tmp_name"];
    $archiveName = $zip["name"];

    $folder = $_SERVER['DOCUMENT_ROOT'] . "/temp";
    if(!file_exists($folder)){
        mkdir($folder, 0777, true);
    }

    $result = move_uploaded_file($tempFolder, $folder . "/" ."Backup.zip");

    if (!$result) {
        echo "Error";
        exit;
    }

    $zip = $ozy_tool->Zip();

    try{
        $zip->openFile($folder . "/" ."Backup.zip");

        $zip->extractTo($folder . "/");
    } catch(Exception $e){
        $response["error"]["indicator"] = true;
        $response["error"]["number"] = 1;
        $response["error"]["message"] = "Archivo Corrupto";
        echo json_encode($response);
        die();
    }

    if(!file_exists($folder . "/MySQL.sql") || !file_exists($folder . "/MongoDB/") || !file_exists($folder . "/media/") || !file_exists($folder . "/OPI/")){
        $response["error"]["indicator"] = true;
        $response["error"]["number"] = 2;
        $response["error"]["message"] = "Archivo incompleto";
        echo json_encode($response);
        die();
    }

    $restoreFile = $folder . "/MySQL.sql";
    $query = "mysql -u {$ozy_tool->db_user} --password={$ozy_tool->db_password} USER_DATA < {$restoreFile}";
    exec($query);

    $mongo = $ozy_tool->MongoDB();

    $mongo->ARTICLES_DATA->RECIPES->deleteMany([]);

    $mongorestore = $_SERVER['DOCUMENT_ROOT'] . "/modules/admin-tools/scripts/Database/mongorestore.exe";
    $user = $ozy_tool->db_user;
    $password = $ozy_tool->db_password;
    $host = $ozy_tool->db_host;
    $port = $ozy_tool->db_port;
    $query = sprintf('%s -u="%s" -p="%s" -h="%s:%s" --authenticationDatabase="admin" "%s/MongoDB/"',
        $mongorestore, $user, $password, $host, $port, $folder);
    
    exec($query);


    if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/media/")){
        $ozy_tool->rmDir_rf($_SERVER['DOCUMENT_ROOT'] . "/media");
    }
    $ozy_tool->full_copy($folder . "/media", $_SERVER['DOCUMENT_ROOT'] . "/media");


    if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/OPI/")){
        $ozy_tool->rmDir_rf($_SERVER['DOCUMENT_ROOT'] . "/OPI");
    }
    $ozy_tool->full_copy($folder . "/OPI", $_SERVER['DOCUMENT_ROOT'] . "/OPI");

    $zip->close();

    $ozy_tool->rmDir_rf($folder);

    flush();

    $response["message"] = "Base de datos reemplazada";
    echo json_encode($response);
?>