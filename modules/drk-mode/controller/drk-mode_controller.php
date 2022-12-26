<?php
/**
 * Modifica el modo obscuro en el token
 */
    include("../model/drk-mode_model.php");
    include("../view/drk-mode_view.php");

    $model = new DrkModeModel();
    $data = array();
    $errors = $model->getErrors();

    header("Content-type: application/json; charset=utf-8");
    $POST = json_decode(file_get_contents("php://input"), true);

    $mode = $POST["mode"];
    $value = (($mode == 2) ? $POST["value"] : null);
    
    if($mode == 1){
        $data = array(
            "dkm" => $model->getDkm($value)
        );
    } else if($mode == 2){
        $model->setDkm($value);
    }

    DrkModeView::sendData_AJAX($data, $errors);
?>