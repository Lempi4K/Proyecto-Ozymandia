<?php
    require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
    use Firebase\JWT\JWT;
    function elementHandler($AEMobject, $theme){
        $bold = $AEMobject['bold'] ? 'article_bold' : '';
        $italic = $AEMobject['italic'] ? 'article_italic' : '';
        $underline = $AEMobject['underline'] ? 'article_underline' : '';

        $handler = array(
            "1" => <<< HTML
                <div class="article_text {$theme}_text cpeEditable {$bold} {$italic} {$underline}">
                    {$AEMobject['content']}
                </div>
                HTML,
            "2" => <<< HTML
                <a href="{$AEMobject['url']}" class="article_linkBtn {$theme}_linkBtn cpeEditable" target="_blank">
                    {$AEMobject['content']}
                </a>
                HTML,
            "3" => <<< HTML
                <div class="article_subtitle_1 {$theme}_subtitle_1 cpeEditable {$bold} {$italic} {$underline}">
                    {$AEMobject['content']}
                </div>
                HTML,
            "4" => <<< HTML
                <div class="article_subtitle_2 {$theme}_subtitle_2 cpeEditable {$bold} {$italic} {$underline}">
                    {$AEMobject['content']}
                </div>
                HTML,
            "5" => <<< HTML
                <div class="article_video {$theme}_video">
                    <hr>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{$AEMobject['url']}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                HTML,
            "6" => <<< HTML
                <div class="article_img {$theme}_img">
                    <hr>
                    <img src="{$AEMobject['img']}" alt="">
                </div>
                HTML,
            "7" => <<< HTML
                <div class="article_link_img {$theme}_link_img">
                    <hr>
                    <a href="{$AEMobject['url']}" target="_blank">
                        <img src="{$AEMobject['img']}" alt="">
                    </a>
                </div>
                HTML,
            "8" => <<< HTML
                <div class="article_pdf {$theme}_pdf">
                    <hr>
                    <iframe src="{$AEMobject['pdf']}" type="application/pdf" width="100%" height="100%"></iframe>
                </div>
                HTML,
            "9" => <<< HTML
                <div class="article_text {$theme}_text cpeEditable">
                    Enlace del OPI: {$AEMobject['url']}
                </div>
                HTML,
        );

        return $handler[$AEMobject["type"]];
    }

    function timeString($timestamp){
        $timestamp = (int) $timestamp;
        $minusTime = date("U") - $timestamp;
        if ($minusTime < 86400){
            if($minusTime >= 60 && $minusTime < 3600){
                return ((int) ($minusTime / 60)) . " min(s)";
            }
            if($minusTime >= 0 && $minusTime < 60){
                return ($minusTime) . " seg(s)";
            }
            return ((int) ($minusTime / 3600)) . " hr(s)";
        }
        return date("d-m-Y", $timestamp);
    }

    function mySublabel($sublabel){
        $dataT = JWT::decode($_COOKIE["token"], "P.O.");
        $uid = $dataT->uid;

        $sql = "select count(1) as EXIST from USER_LABELS where USER_ID = $uid and SUBLABEL_ID = $sublabel;";
        try{
            $db_handler = new S_MySQL("USER_DATA", 1);
            $data = $db_handler->console_FV($sql);
            return $data["EXIST"] != 0 ? true : false;
        }catch (Exception $e){
            return false;
        }
    }

    function articleDecoder($article, $single = false){
        $query = "select concat(ALU.NOMBRES, ' ', ALU.APELLIDOS) as NOM, USER, US.PERM from ALUMNOS as ALU join CREDENCIALES as CRED join USUARIOS as US where CRED.USER_ID = " . ($article["meta"]["autor_uid"]) . " and ALU.USER_ID = " . ($article["meta"]["autor_uid"]) . " and US.USER_ID = " . ($article["meta"]["autor_uid"]) . ";";
        $data = "";
        try{
            $db_handler = new S_MySQL("USER_DATA");
            
            $data = $db_handler ->console($query);
            $data->setFetchMode(PDO::FETCH_BOTH);
            $data = $data->fetch();
            if($data == null){
                $query = "select concat(DOCE.NOMBRES, ' ', DOCE.APELLIDOS) as NOM, USER, US.PERM from DOCENTES as DOCE join CREDENCIALES as CRED join USUARIOS as US where CRED.USER_ID = " . ($article["meta"]["autor_uid"]) . " and DOCE.USER_ID = " . ($article["meta"]["autor_uid"]) . " and US.USER_ID = " . ($article["meta"]["autor_uid"]) . ";";
                $data = $db_handler ->console($query);
                $data->setFetchMode(PDO::FETCH_BOTH);
                $data = $data->fetch();
                if($data == null){
                    $data = [
                        "USER" => "undefinded",
                        "NOM" => "undefined",
                        "PERM" => "-1"
                    ];
                }
            }
        }catch (Exception $e){
            $data = [
                "USER" => "undefinded",
                "NOM" => "undefined",
                "PERM" => "-1"
            ];
        }


        $charsPerms = array("-1" => "I","0" => "U", "1" => "A", "2" => "D", "3" => "M", "4" => "P", "5" => "J", "6" => "C");
        $namePerms = array("-1" => "Invitado", "0" => "Usuario", "1" => "Administrador", "2" => "Director", "3" => "Moderador", "4" => "Profesor", "5" => "Jefe de Grupo", "6" => "Creador");

        $pubdate = timeString($article['meta']['pub_date']);
        $header = <<< HTML
                    <div class="article_head">
                        <div class="article_userPic" data-perm={$charsPerms[strval($data['PERM'])]}>
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <div>
                            <div class="article_autor-id">
                                {$data['NOM']}
                                <div class="rol profile-rol c_default" title={$namePerms[strval($data['PERM'])]} data-perm={$charsPerms[strval($data['PERM'])]}><p class="no_select">{$charsPerms[strval($data['PERM'])]}</p></div>
                            </div>
                            <p>@{$data['USER']} | <time pubdate="{$pubdate}">{$pubdate}</time></p>
                        </div>
                        <div class="">
        HTML;
        if($article["meta"]["type"] == 1 && $article["meta"]["label"] != null){
            if($article["meta"]["label"] != 3){
                $query = "select NOMBRE from SUBETIQUETAS where LABEL_ID = " . $article["meta"]["label"] . " and SUBLABEL_ID = " . $article["meta"]["sublabel"] . ";";
                $label_name = "";
                try{
                    $db_handler = new S_MySQL("USER_DATA");
                    
                    $label_name = $db_handler ->console($query);
                    $label_name->setFetchMode(PDO::FETCH_BOTH);
                    $label_name = $label_name->fetch();
                    if($label_name == null){
                        $label_name = ["NOMBRE" => "undefined"];
                    }
                }catch (Exception $e){
                    $label_name = ["NOMBRE" => "undefined"];
                }
            } else {
                $label_name = ["NOMBRE" => "Invitado"];
            }
            
            $header .= <<< HTML
                            <div class="lblArticle lblArticle{$article['meta']['label']}">
                                <p>{$label_name["NOMBRE"]}</p>
                            </div>
            HTML;
        }
        if($article["meta"]["type"] == 1 && $article["meta"]["label"] == 2){
            $checked = mySublabel($article['meta']['sublabel']) ? "checked" : "";
            $header .= <<< HTML
                            <div class="article_followBtn">
                                <input type="checkbox" class="inpChckbxFollow{$article['meta']['sublabel']}" id="inpChckbxFollow{$article['meta']['id']}" value="{$article['meta']['sublabel']}" name="inpChckbxFollow" {$checked}>
                                <label for="inpChckbxFollow{$article['meta']['id']}">
                                    <i class="fa-solid fa-plus"></i>
                                </label>
                            </div>
            HTML;
        }
        if(!empty($_COOKIE["token"])){
            $dataT = JWT::decode($_COOKIE["token"], "P.O.");
            $perm = $dataT->prm;
            $id = $dataT->uid;
            if((($perm > 0 && $perm < 4) || (int) $article["meta"]["autor_uid"] == (int) $id) && $single){
                $header .= <<< HTML
                            <div class="article_AdminMenu">
                                <div data-aid="{$article['meta']['id']}" class="article_deleteBtn"><i class="fa-solid fa-trash"></i></div>
                                <div data-aid="{$article['meta']['id']}" class="article_EditBtn"><i class="fa-solid fa-pen"></i></div>
                            </div>
            HTML;
            }
        }

        $header .= <<< HTML
                        </div>
                    </div>
        HTML;

        

        $AEM = <<< HTML
        
        HTML;

        foreach($article["AEM"] as $item){
            if((int) $item["type"] == 9){
                if($item["url"] === "" || $item["url"] == null || !file_exists($_SERVER['DOCUMENT_ROOT'] . $item["url"])){
                    $AEM .= <<< HTML
                        <p>OPI No Configurado</p>
                    HTML;
                    continue;
                }
                try{
                    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
                    $client = new GuzzleHttp\Client([
                        "base_uri" => $url
                        ]
                    );
                    $uid = 0;
                    if(isset($_COOKIE["token"])){
                    $uid = (int) Firebase\JWT\JWT::decode($_COOKIE["token"], "P.O.")->uid;
                    }
                    $response = $client->request("GET", $item["url"], [
                        "query" => [
                            "uid" =>  $uid,
                            "theme" => $article['meta']['theme']
                        ]
                    ]);
                    $json = json_decode($response->getBody(), true);
                    //$HTML .= $response->getBody();
                    switch ($json["status"]){
                        case 0:{
                            $AEM .= <<< HTML
                                <p>Error en el OPI</p>
                            HTML;
                            break;
                        }
                        case 1:{
                            $AEM .= $json["data"]["HTML"];
                            break;
                        }
                        case 2:{
                            $AEM .= <<< HTML
                                <p>Error en los datos de la solicitud</p>
                            HTML;
                            break;
                        }
                    }
                } catch(Throwable $t){
                    $AEM .= $t->getMessage();
                }
                continue;
            }
            $AEM .= elementHandler($item, $article['meta']['theme']);
        }

        $click = ($single) ? "" : "c_click";
        $main_article = ($single) ? "" : "main-article";
        $base = array(
            "article_1" => <<< HTML
                <article class="article {$main_article} {$click}" id="article_{$article['meta']['id']}" data-aid="{$article['meta']['id']}">
                    $header
                    <div class="article_container {$article['meta']['theme']}">
                        <div class="article_title {$article['meta']['theme']}_title">
                            <p>{$article['meta']['title']}</p>
                            <p class="article_text">{$article['meta']['description']}</p>
                    </div>
                    <hr>
                    <div class="article_content {$article['meta']['theme']}_content">
                        <div class="{$article['meta']['theme']}_head">
                            <img src="/src/img/logo/logo.png" alt="">
                            <p>
                                CENTRO DE BACHILLERATO TECNOL&Oacute;GICO
                                <br>
                                industrial y de servicios N&uacute;m. 114
                            </p>
                            <hr>
                        </div>
                        <div class="article_main {$article['meta']['theme']}_main">
                            {$AEM}
                            <hr>
                            <p class="article_end {$article['meta']['theme']}_end">
                                ¡UNA VEZ LOBOS, SIEMPRE LOBOS!
                            </p>
                        </div>
                    </div>
                </div>
            </article>
            HTML,
            "article_2" => <<< HTML
            <article class="article {$main_article} {$click}" id="article_{$article['meta']['id']}" data-aid="{$article['meta']['id']}">
                $header
                <div class="article_container {$article['meta']['theme']}">
                    <div class="article_title {$article['meta']['theme']}_title">
                        <p>{$article['meta']['title']}</p>
                        <p class="article_text">{$article['meta']['description']}</p>
                    </div>
                    <hr>
                    <div class="article_content {$article['meta']['theme']}_content">
                        <div class="article_main {$article['meta']['theme']}_main">
                            {$AEM}
                        </div>
                    </div>
                </div>
            </article>
        HTML
        );

        return $base[$article['meta']['theme']];
    }
?>