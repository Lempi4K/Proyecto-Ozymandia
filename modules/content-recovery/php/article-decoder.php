<?php
    use Firebase\JWT\JWT;
    function elementHandler($AEMobject, $theme){
        $bold = $AEMobject['bold'] ? 'article_bold' : '';
        $italic = $AEMobject['italic'] ? 'article_italic' : '';
        $underline = $AEMobject['underline'] ? 'article_underline' : '';

        $handler = array(
            "1" => <<< HTML
                <p class="article_text {$theme}_text cpeEditable {$bold} {$italic} {$underline}">
                    {$AEMobject['content']}
                </p>
                HTML,
            "2" => <<< HTML
                <a href="{$AEMobject['url']}" class="article_linkBtn {$theme}_linkBtn cpeEditable" target="_blank">
                    {$AEMobject['content']}
                </a>
                HTML,
            "3" => <<< HTML
                <p class="article_subtitle_1 {$theme}_subtitle_1 cpeEditable {$bold} {$italic} {$underline}">
                    {$AEMobject['content']}
                </p>
                HTML,
            "4" => <<< HTML
                <p class="article_subtitle_2 {$theme}_subtitle_2 cpeEditable {$bold} {$italic} {$underline}">
                    {$AEMobject['content']}
                </p>
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
                    <embed src="{$AEMobject['pdf']}" type="application/pdf" width="100%" height="100%">
                </div>
                HTML,
            "9" => <<< HTML
                <div class="article_text {$theme}_text cpeEditable">
                    Enlace de la API: {$AEMobject['url']}
                </div>
                HTML,
        );

        return $handler[$AEMobject["type"]];
    }

    function articleDecoder($article){
        $query = "select concat(ALU.NOMBRES, ' ', ALU.APELLIDOS) as NOM, USER from ALUMNOS as ALU join CREDENCIALES as CRED where CRED.USER_ID = " . ($article["meta"]["autor_uid"]) . " and ALU.USER_ID = " . ($article["meta"]["autor_uid"]) . ";";
        $data = "";
        try{
            $db_handler = new S_MySQL("USER_DATA");
            
            $data = $db_handler ->console($query);
            $data->setFetchMode(PDO::FETCH_BOTH);
            $data = $data->fetch();
            if($data == null){
                $query = "select concat(DOCE.NOMBRES, ' ', DOCE.APELLIDOS) as NOM, USER from DOCENTES as DOCE join CREDENCIALES as CRED where CRED.USER_ID = " . ($article["meta"]["autor_uid"]) . " and DOCE.USER_ID = " . ($article["meta"]["autor_uid"]) . ";";
                $data = $db_handler ->console($query);
                $data->setFetchMode(PDO::FETCH_BOTH);
                $data = $data->fetch();
            }
        }catch (Exception $e){
        }
        $header = <<< HTML
                    <div class="article_head">
                        <i class="fa-solid fa-user-astronaut article_userPic"></i>
                        <div>
                            <p>{$data['NOM']}</p>
                            <p>@{$data['USER']} | <time pubdate="{$article['meta']['pub_date']}">{$article['meta']['pub_date']}</time></p>
                        </div>
                        <div class="">
        HTML;

        if($article["meta"]["type"] == 0){
            $header .= <<< HTML
                            <input type="button" value="Seguir">
            HTML;
        }
        if(!empty($_COOKIE["token"])){
            $dataT = JWT::decode($_COOKIE["token"], "P.O.");
            $perm = $dataT->prm;
            $id = $dataT->uid;
            if(($perm > 0 && $perm < 4) || $article["meta"]["autor_uid"] == $id){
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
            $AEM .= elementHandler($item, $article['meta']['theme']);
        }

        $base = array(
            "article_1" => <<< HTML
                <article class="article" id="article_{$article['meta']['id']}">
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
            <article class="article" id="article_{$article['meta']['id']}">
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