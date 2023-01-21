<?php
/**
 * Controla el acceso a la base de datos de MongoDB (Agrega o actualiza)
 */
    use OzyTool\OzyTool;
    include("../model/canvas_model.php");
    include("../view/canvas_view.php");
    include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");
    $ozy_tool = new OzyTool(1);

    header("Content-type: application/json; charset=utf-8");
    $POST = json_decode(file_get_contents("php://input"), true);

    $data = array();
    $errors = "";

    if($POST["aid"] == 0){
        
        if($ozy_tool->User()->hasPerm("Ozy.Articles.pubArticleWithoutAprovation") || $POST["article"]["meta"]["label"] != 2){
            $POST["article"]["approved"] = true;
        }
        
        $model = new Canvas_Model($POST["article"]);
    
        $data = array();
        $errors = $model->getErrors();

        if($POST)

        if($errors === ""){
            $data = array("success" => $model->sendArticle());
        } else{
            $data = array("success" => false);
        }
    } else{
        try{
            $query1 = array(
                "meta.id" => (int)$POST["aid"]
            );
            $query2 = $POST["article"];
        
            $mongo = $ozy_tool->MongoDB();
            $mongo->ARTICLES_DATA->RECIPES->replaceOne($query1, $query2);
            $data = array("success" => true, "count" => ($POST["article"]["meta"]["id"]));
        }catch (Exception $e){
            $data = array("success" => false);
            $errors = $e->getMessage();
        }
    }
    

    Canvas_View::sendData_AJAX($data, $errors);
?>