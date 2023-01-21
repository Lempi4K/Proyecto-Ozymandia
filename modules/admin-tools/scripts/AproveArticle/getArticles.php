<?php
    use OzyTool\OzyTool;

    function killApp($code, $message, $htmlMessage){
        $ozy_tool = new OzyTool();
        $response["error"]["indicator"] = true;
        $response["error"]["number"] = $code;
        $response["error"]["message"] = $message;
        $response["data"]["HTML"] = $ozy_tool->displayErrorMessage($htmlMessage);
        echo json_encode($response);
        die();
    }

    include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");
    $ozy_tool = new OzyTool(1);
    $POST = $ozy_tool->postData();
    $response = $ozy_tool->defaultResponse();

    if(!isset($POST["sublabel"]) || !isset($POST["start"])){
        KillApp(1, "Error de programación", "Faltan argumentos en la solicitud");
    }

    $sublabel = $POST["sublabel"];
    $start = $POST["start"];

    $query = [
        '$and' => [
            [
                "meta.id" => [
                    '$gt' => $start
                ],
                "meta.sublabel" => $sublabel,
                "approved" => false,
                "delete" => false
            ]

        ]
    ];

    $options = [
        "sort" => ["meta.id" => 1],
        "limit" => 10
    ];

    $mongo = $ozy_tool->MongoDB();

    if($mongo == null){
        KillApp(1, "MongoDB Exception", "No se puede conectar a la base de datos");
    }

    $cursor = null;
    try {
        $cursor = $mongo->ARTICLES_DATA->RECIPES->find($query, $options);
    } catch (\Throwable $th) {
        KillApp(1, "MongoDB Exception", "Error al hacer la solicitud: {$th->getMessage()}");
    }

    if($cursor == null){
        KillApp(1, "MongoDB Exception", "Error al hacer la solicitud: Cursor vacio");
    }

    $cursor = $cursor->toArray();

    if(sizeof($cursor) == 0 && $start == 0){
        $response["data"]["HTML"] = <<< HTML
            No hay nada que aprobar
        HTML;
        echo json_encode($response);
        die();
    }

    if(sizeof($cursor) == 0 && $start != 0){
        $response["data"]["HTML"] = <<< HTML
            
        HTML;
        echo json_encode($response);
        die();
    }

    include($_SERVER['DOCUMENT_ROOT'] . "/modules/content-recovery/php/article-decoder.php");

    $HTML = <<< HTML

    HTML;

    foreach($cursor as $item){
        $HTML .= <<< HTML
            <div class="aaArticle" id="{$item['meta']['id']}">
        HTML;
        $HTML .= articleDecoder($item, false, false);
        $HTML .= <<< HTML
                <div class="aaButtonsContainer">
                    <div class="aaButtons">
                        <button type="button" id="aaDelete" value="{$item['meta']['id']}">
                            <i class="fa-solid fa-thumbs-down"></i>
                        </button>
                        <button type="button" id="aaApprove" value="{$item['meta']['id']}">
                            <i class="fa-solid fa-thumbs-up"></i>
                        </button>
                    </div>
                </div>
            </div>
            <br>
    HTML;
    }

    $response["data"]["HTML"] = $HTML;

    echo json_encode($response);
    die();
?>