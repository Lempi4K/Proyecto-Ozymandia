<?php
/**
 * Controla el acceso a la base de datos de MongoDB (Agrega o actualiza)
 */
    include("../model/canvas_model.php");
    include("../view/canvas_view.php");

    header("Content-type: application/json; charset=utf-8");
    $POST = json_decode(file_get_contents("php://input"), true);

    $data = array();
    $errors = "";

    if($POST["aid"] == 0){
        $model = new Canvas_Model($POST["article"]);
    
        $data = array();
        $errors = $model->getErrors();

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
        
            $mongo = Simple_MongoDB::connection("ARTICLES_DATA", 1);
            $mongo->ARTICLES_DATA->RECIPES->replaceOne($query1, $query2);
            $data = array("success" => true, "count" => ($POST["article"]["meta"]["id"]));
        }catch (Exception $e){
            $data = array("success" => false);
            $errors = $e->getMessage();
        }
    }
    

    Canvas_View::sendData_AJAX($data, $errors);
?>