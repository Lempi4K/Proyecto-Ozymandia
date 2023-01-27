<?php
    use OzyTool\OzyTool;
    include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");
    $ozy_tool = new OzyTool();
    $POST = $ozy_tool->postData();

    //Funciones
    function baseElements($user_id){
        $ozy_tool = new OzyTool();
        if(!$ozy_tool->User()->hasPerm("Ozy.AdminTools.users.db.platformData.see")){ return ""; };
        $sql = $ozy_tool->MySQL();
        $platformData = [];
        if($user_id != 0){
            $query = "
                select CRED.USER as USUARIO, CRED.PASS as CONTRASENA, US.PERM as ROL, US.TIPO as TIPO 
                from CREDENCIALES as CRED join USUARIOS as US
                where CRED.USER_ID = $user_id and US.USER_ID = $user_id
            ";

            $cursor = $sql->console($query);
            $cursor->setFetchMode(PDO::FETCH_ASSOC);
            $first = [];
            foreach($cursor as $item){
                $first = $item;
                break;
            }

            $general_labels = ["G" => []];
            if($user_id != 0){
                $general_labels = $ozy_tool->User($user_id)->getSublabels();
            }

            $platformData = array_merge($first, $general_labels);

        } else{
            $platformData = [
                "USUARIO" => "",
                "CONTRASENA" => "",
                "ROL" => 0,
                "TIPO" => 1,
                "G" => []
            ];
        }

        $user = $ozy_tool->User();

        $if = function ($condition, $true, $false) { return $condition ? $true : $false; };
        
        $HTML = <<< HTML
                <h1 class="athSubtitle">Plataforma<hr></h1>
        HTML;

        $disabled = "";
        if(!$user->hasPerm("Ozy.AdminTools.users.db.platformData.user")){
            $disabled = "disabled";
        }
        $HTML .= <<< HTML
                <div class="frmInpText">
                    <input type="text" id="inpTxtUser" placeholder="User" pattern="[A-Za-z.0-9].[^@!#*%/()]{5,20}" value="{$platformData['USUARIO']}" {$disabled}>
                    <label for="inpTxtUser" class="no_select">Usuario</label>
                </div>
        HTML;

        if($user->hasPerm("Ozy.AdminTools.users.db.platformData.pass")){
            $HTML .= <<< HTML
                    <div class="frmInpText">
                        <input type="text" id="inpTxtPass" placeholder="Pass" pattern="[A-Za-z0-9@!#*%/]{5,20}" value="{$platformData['CONTRASENA']}">
                        <label for="inpTxtPass" class="no_select">Contraseña</label>
                    </div>
            HTML;
        }

        if($user->hasPerm("Ozy.AdminTools.users.db.platformData.rol") || $user->prm != $platformData["ROL"]){
            $HTML .= <<< HTML
                    <div class="frmNavSelector frmSelector" id="frmSelectorRol">
                        <p>Rol:</p>
                        <select id="slctPERM_ID" required>
            HTML;
            //Poner conforme permisos la query
            //$cursor = $sql->console("select * from PERMISOS where PERM_ID != 0 and PERM_ID > {$user->prm}");
            $cursor = $sql->console("select * from PERMISOS where PERM_ID != 0");
            foreach($cursor as $item){
                $selected = "";
                if((int) $platformData["ROL"] == (int) $item['PERM_ID']){
                    $selected = "selected";
                }
                $HTML .= <<< HTML
                    <option value="{$item['PERM_ID']}" {$selected}>{$item['NOMBRE']}</option>
                HTML;   
            }
            $HTML .= <<< HTML
                        </select>
                    </div>
            HTML;
        }

        if($user->hasPerm("Ozy.AdminTools.users.db.platformData.sublabel")){
            $HTML .= <<< HTML
                <div class="frmLabelSelector" id="frmLabelSelector">
                    <p>Etiquetas Permitidas: </p>
                    <ul>
                        <i id="flsReset" class="fa-solid fa-xmark"></i>
            HTML;

            $sublabels = $ozy_tool->User()->getSublabels();
            //var_dump($platformData);
            if(sizeof($sublabels) != 0){
                foreach($sublabels["G"] as $key => $value){
                    $checked = "";
                    if(isset($platformData["G"][$key])){
                        $checked = "checked";
                    }
                    $HTML .= <<< HTML
                        <li>
                            <input type="checkbox" class="inpChckbxSlbl iclGeneral" value="{$key}" id="inpChckbxSlbl{$key}" {$checked}>
                            <label for="inpChckbxSlbl{$key}" id="frmLabel">{$value}</label>
                        </li>
                    HTML;
                }
            }

            $HTML .= <<< HTML
                        </ul>
                    </div>
            HTML;
        }

        if($user->hasPerm("Ozy.AdminTools.users.db.platformData.userType")){
            $HTML .= <<< HTML
                <fieldset class="cnvEditElement APITypeElements frmRadioBtn">
                    <legend>Tipo de Usuario</legend>
                    <ul class="form-elements frmInpRdbtn">
                        <li>
                            <input type="radio" name="TIPO" class="inpRdbtnUserType" id="inpRdbtnUserType1" value="1" {$if($platformData["TIPO"] == 1, "checked", "")}>
                            <label for="inpRdbtnUserType1" class="no_select c_click"><i><i></i></i>Alumno</label>
                        </li>
                        <li>
                            <input type="radio" name="TIPO" class="inpRdbtnUserType" id="inpRdbtnUserType2" value="2" {$if($platformData['TIPO'] == 2, "checked", "")}>
                            <label for="inpRdbtnUserType2" class="no_select c_click"><i><i></i></i>Docente</label>
                        </li>
                    </ul>
                </fieldset>
            HTML;
        }
        $HTML .= <<< HTML
            <script src="/modules/admin-tools/scripts/Users/platformEvents.js"></script>
        HTML;

        return $HTML;
    }

    function dbElements($user_id, $type){
        $ozy_tool = new OzyTool();
        if(!$ozy_tool->User()->hasPerm("Ozy.AdminTools.users.db.personalData.see")){ return ""; };
        $sql = $ozy_tool->MySQL();
        if($type == 0){
            $type = $ozy_tool->User($user_id)->getType();
        }

        $types = [1 => "ALUMNOS", 2 => "DOCENTES"];
        $HTML = <<< HTML
                <h1 class="athSubtitle">Personal<hr></h1>
        HTML;

        $query = "
            SELECT *
            FROM information_schema.columns 
            WHERE table_schema = 'USER_DATA' AND table_name = '{$types[$type]}'
        ";

        $queryData = "
        select * 
        from {$types[$type]}
        where USER_ID = {$user_id};
        ";



        $personalData = [];

        $cursor = $sql->console($queryData);
        if($cursor->rowCount()){
            foreach($cursor as $item){
                $personalData = $item;
                break;
            }
        } else{
            foreach(range(0, $cursor->columnCount() - 1) as $column_index){
                $personalData[$cursor->getColumnMeta($column_index)["name"]] = "";
            }
        }


        $cursor = $sql->console($query);
        foreach($cursor as $item){
            if($item['COLUMN_NAME'] == "USER_ID" || $item['COLUMN_NAME'] == "DOCE_ID"){
                continue;
            }

            $HTML .= <<< HTML
                <div class="frmInpText">
                    <input type="text" id="inpTxt{$item['COLUMN_NAME']}" placeholder="{$item['COLUMN_NAME']}" name="{$item['COLUMN_NAME']}" required pattern="{$ozy_tool->regex_NOT}{1,{$item['CHARACTER_MAXIMUM_LENGTH']}}" value="{$personalData[$item['COLUMN_NAME']]}">
                    <label for="inpTxt{$item['COLUMN_NAME']}" class="no_select">{$item['COLUMN_NAME']}</label>
                </div>
            HTML;
        }

        $HTML .= <<< HTML
            <script src="/modules/admin-tools/scripts/Users/personalEvents.js"></script>
        HTML;

        return $HTML;
    }

    $user_id = $POST["user_id"];
    $type = $POST["type"];
    $section = $POST["section"];



    switch ($section){
        case 0:{
            $baseElements = baseElements($user_id);
            $dbElements = dbElements($user_id, $type);
            $HTML = <<< HTML
                <div class="frmPlatformData">
                    {$baseElements}
                </div>
                <div class="frmPersonalData">
                    {$dbElements}
                </div>
            HTML;
            break;
        }
        case 1:{
            $baseElements = baseElements($user_id);
            $HTML = <<< HTML
            {$baseElements}
            HTML;
            break;
        }
        case 2:{
            $dbElements = dbElements($user_id, $type);
            $HTML = <<< HTML
            {$dbElements}
            HTML;
            break;
        }
    }


    echo json_encode([
        "HTML" => $HTML,
    ])
?>