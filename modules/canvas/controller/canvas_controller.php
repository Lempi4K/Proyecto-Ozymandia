<?php
    include("../model/canvas_model.php");
    include("../view/canvas_view.php");

    header("Content-type: application/json; charset=utf-8");
    $POST = json_decode(file_get_contents("php://input"), true);

    $model = new Canvas_Model($POST["article"]);
    
    $data = array();
    $errors = $model->getErrors();

    if($errors === ""){
        $data = array("success" => $model->sendArticle());
    } else{
        $data = array("success" => false);
    }

    Canvas_View::sendData_AJAX($data, $errors);
?>