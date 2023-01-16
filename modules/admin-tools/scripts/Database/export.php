<?php
    use OzyTool\OzyTool;
    include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");
    $ozy_tool = new OzyTool(1);

    $folder = $_SERVER['DOCUMENT_ROOT'] . "/temp";
    if(!file_exists($folder)){
        mkdir($folder, 0777, true);
    }

    try {
        $query = "mysqldump -u {$ozy_tool->db_user} --password={$ozy_tool->db_password} --all-databases --add-drop-database --add-drop-table --complete-insert > {$folder}/USER_DATA.sql";
        exec($query);
    } catch (\Throwable $th) {
        echo "xd1";
    }

    try {
        $output = "";
        $uri = "mongodb://{$ozy_tool->db_user}:{$ozy_tool->db_password}@127.0.0.1:27017/db-name?ssl=false&authSource=admin";
        $query = "mongodump -u='{$ozy_tool->db_user}' -p='{$ozy_tool->db_password}' -h='127.0.0.1:27017' --authenticationDatabase='admin' --out='{$folder}/MongoDB'";
        $query = 'mongodump -u="Admin" -p="090722Admin*" -h="127.0.0.1:56078" --authenticationDatabase="admin" --out="C:/wamp64/www/temp/MongoDB"';
        echo $query;
        
        $proceso = proc_open($query, [["pipe", "r"], ["pipe", "w"], ["pipe", "w"]], $pipes); //abrimos el proceso cmd.exe proceso con 3 pipes, stdin, stdout y stderr
        if (is_resource($proceso)) { //si se ha creado el proceso...
           fwrite($pipes[0], "'$query'"); //enviamos comando
           fclose($pipes[0]); //cerramos el pipe stdin...
           echo stream_get_contents($pipes[1]); //mostramos el output del pipe stdout
           fclose($pipes[1]); //cerramos el pipe stdout
           echo stream_get_contents($pipes[2]); //mostramos el output del pipe stderr
           fclose($pipes[1]); //cerramos el pipe stderr
           echo proc_close($proceso); //cerramos el proceso
        }
        
        system($query, $output);
        echo $output;
    } catch (\Throwable $th) {
        echo "xd1";
    }


?>