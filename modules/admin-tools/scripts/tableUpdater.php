<?php
    use OzyTool\OzyTool;
    include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");
    $ozy_tool = new OzyTool();
    $POST = $ozy_tool->postData();

    $user = $ozy_tool->User();
    $query = "";
    $section = $POST["section"];
    $search = $POST["search"];
    $start = $POST["start"];

    switch ($section){
        case 1:{
            $queryALU = "
            select ALU.USER_ID as ID, CONCAT('@', CRED.USER) as USUARIO, CONCAT(ALU.NOMBRES, ' ', ALU.APELLIDOS) as NOMBRE, PERM.NOMBRE as ROL 
            from CREDENCIALES as CRED, ALUMNOS as ALU, PERMISOS as PERM, USUARIOS as US
            where CRED.USER_ID = ALU.USER_ID and PERM.PERM_ID = US.PERM and US.USER_ID = ALU.USER_ID and US.ESTADO = 1
            ";

            $queryDOC = "
            select DOC.USER_ID as ID, CONCAT('@', CRED.USER) as USUARIO, CONCAT(DOC.NOMBRES, ' ', DOC.APELLIDOS) as NOMBRE, PERM.NOMBRE as ROL 
            from CREDENCIALES as CRED, DOCENTES as DOC, PERMISOS as PERM, USUARIOS as US
            where CRED.USER_ID = DOC.USER_ID and PERM.PERM_ID = US.PERM and US.USER_ID = DOC.USER_ID and US.ESTADO = 1
            ";

            $search_id = (int) $search;
            $where_order = "
                where TABLA.ID > {$start} and (TABLA.ID = {$search_id} or TABLA.USUARIO like '%{$search}%' or TABLA.NOMBRE like '%{$search}%') 
                order by TABLA.ID
            ";

            if($user->hasPerm("Ozy.AdminTools.db.*")){
                $query = "
                    select * from ($queryALU union $queryDOC) as TABLA
                    {$where_order}
                ";
                break;
            }

            if($user->hasPerm("Ozy.AdminTools.db.normal.see")){
                $query = "
                    select * from ($queryALU) as TABLA
                    {$where_order}
                ";
                break;
            }

            if($user->hasPerm("Ozy.AdminTools.db.admin.see")){
                $query = "
                    select * from ($queryDOC) as TABLA
                    {$where_order}
                ";
                break;
            }

            break;
        }
        case 3:{
            $query = "
                select SUBLABEL_ID as ID, NOMBRE, if(ESTADO = 1, 'Activo', 'Archivado') as ESTADO 
                from SUBETIQUETAS 
                where LABEL_ID = 2 and ESTADO = 1 order by SUBLABEL_ID asc;
            ";
            break;
        }
        case 4:{
            $query = "
                select PERM_ID as ID, NOMBRE 
                from PERMISOS 
                where ESTADO = 1 order by PERM_ID asc;
            ";
            break;
        }
        default:{
            $query = "";
            break;
        }
    }
    $limit = 30;
    $query .= " limit $limit";
    $cursor = $ozy_tool->MySQL()->console($query);
    $cursor->setFetchMode(PDO::FETCH_ASSOC);
    $HTML = <<< HTML

    HTML;

    foreach ($cursor as $item){
        $HTML .= <<< HTML
            <tr id="{$item['ID']}">
        HTML;
        foreach($item as $key => $value){
            $HTML .= <<< HTML
                <td>{$value}</td>
            HTML;
        }
        $HTML .= <<< HTML
            </tr>
        HTML;
    }
    echo json_encode(["HTML" => $HTML]);

?>