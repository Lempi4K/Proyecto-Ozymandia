<?php
    use OzyTool\OzyTool;
    include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");
    $ozy_tool = new OzyTool(1);
    $POST = $ozy_tool->postData();
    $response = $ozy_tool->defaultResponse();

    if(!isset($POST["aid"])){
        $ozy_tool->killApp(1, "Faltan argumentos en la solicitud");
    }

    $query1 = array(
        "meta.id" => (int)$POST["aid"],
        "delete" => false,
        "approved" => false
    );
    $query2 = array(
        '$set' => array(
            "approved" => true
        )
    );


    $mongo = $ozy_tool->MongoDB();

    if($mongo == null){
        $ozy_tool->killApp(1, "MongoException");
    }

    try {
        $mongo->ARTICLES_DATA->RECIPES->updateOne($query1, $query2);
    } catch (\Throwable $th) {
        KillApp(1, "MongoDB Exception", "Error al hacer la solicitud: {$th->getMessage()}");
    }

    $response["message"] = "Artículo aprobado";
    echo json_encode($response);
    die();
?>