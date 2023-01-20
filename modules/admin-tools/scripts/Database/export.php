<?php
    function rmDir_rf($carpeta){
      foreach(glob($carpeta . "/*") as $archivos_carpeta){             
        if (is_dir($archivos_carpeta)){
          rmDir_rf($archivos_carpeta);
        } else {
        unlink($archivos_carpeta);
        }
      }
      rmdir($carpeta);
     }

    use OzyTool\OzyTool;
    include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");
    $ozy_tool = new OzyTool(1);

    $folder = $_SERVER['DOCUMENT_ROOT'] . "/temp";
    if(!file_exists($folder)){
        mkdir($folder, 0777, true);
    }

    try {
        $query = "mysqldump -u {$ozy_tool->db_user} --password={$ozy_tool->db_password} --add-drop-database --add-drop-table --complete-insert --databases USER_DATA > {$folder}/MySQL.sql";
        exec($query);
    } catch (\Throwable $th) {
    }

    try {
        $output = [];

        $mongodump = $_SERVER['DOCUMENT_ROOT'] . "/modules/admin-tools/scripts/Database/mongodump.exe";
        $user = $ozy_tool->db_user;
        $password = $ozy_tool->db_password;
        $host = $ozy_tool->db_host;
        $port = $ozy_tool->db_port;
        $query = sprintf('%s -u="%s" -p="%s" -h="%s:%s" --authenticationDatabase="admin" --out="%s/MongoDB"',
            $mongodump, $user, $password, $host, $port, $folder);
        
        exec($query, $output);
        //echo $output;
    } catch (\Throwable $th) {
    }


    $zip = $ozy_tool->Zip();
    $zip->addDirRecursive($folder . "/");

    //$zip->addEmptyDir("/media");
    if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/media/")){
        $zip->addDirRecursive($_SERVER['DOCUMENT_ROOT'] . "/media/", "/media");
    }

    //$zip->addEmptyDir("/OPI");
    if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/OPI/")){
        $zip->addDirRecursive($_SERVER['DOCUMENT_ROOT'] . "/OPI/", "/OPI");
    }
    //$zip->setPassword($ozy_tool->zipPass);
    $zip->outputAsAttachment("archive.zip", 'application/zip');
    //$zip->saveAsFile("archive.zip");
    rmDir_rf($folder);

    flush();
?>