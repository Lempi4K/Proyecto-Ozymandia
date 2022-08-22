<?php
    include("../model/check-token_model.php");
    include("../view/check-token_view.php");

    header("Content-type: application/json; charset=utf-8");
    $POST = json_decode(file_get_contents("php://input"), true);

    $model = new ChkTkn_Model($POST["blkPerm"]);
    $data = array("result" => $model->getResult());
    $errors = $model->getErrors();

    ChkTkn_View::sendData_AJAX($data, $errors);

?>