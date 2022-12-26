<?php
/**
 * Recupera el artículo según su id
 */
    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MongoDB_lib/Simple_MongoDB.php");

    header("Content-type: application/json; charset=utf-8");
    $POST = json_decode(file_get_contents("php://input"), true);

    try{
        $query = array(
            "meta.id" => (int)$POST["aid"],
            "delete" => false
        );
    
        $mongo = Simple_MongoDB::connection("ARTICLES_DATA", 1);
        $cursor = $mongo->ARTICLES_DATA->RECIPES->findOne($query);
        if($cursor != null){
            $data = array("successful" => true, "article" => $cursor);
        } else{
            $data = array("successful" => false);
        }

    }catch (Exception $e){
        $data = array("successful" => false);
    }

    echo json_encode(array("data" => $data));
?>