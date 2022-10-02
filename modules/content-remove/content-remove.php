<?php
    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MongoDB_lib/Simple_MongoDB.php");

    header("Content-type: application/json; charset=utf-8");
    $POST = json_decode(file_get_contents("php://input"), true);

    try{
        $query1 = array(
            "meta.id" => (int)$POST["aid"],
            "delete" => false
        );
        $query2 = array(
            '$set' => array(
                "delete" => true
            )
        );
    
        $mongo = Simple_MongoDB::connection("ARTICLES_DATA", 1);
        $mongo->ARTICLES_DATA->RECIPES->updateOne($query1, $query2);
        $data = array("successful" => true);
    }catch (Exception $e){
        $data = array("successful" => false);
    }

    echo json_encode(array("data" => $data));
?>