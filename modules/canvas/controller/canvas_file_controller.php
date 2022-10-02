<?php
    include("../view/canvas_view.php");

    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MongoDB_lib/Simple_MongoDB.php");


    $errors = "";

    $mongo = Simple_MongoDB::connection("ARTICLES_DATA", 1);
    $cursor = $mongo->ARTICLES_DATA->RECIPES->find();
    $article_id = 1;
    foreach($cursor as $item){
        $article_id++;
    }

    $routes = array();

    foreach($_FILES as $key => $value){
        $folder = $_SERVER['DOCUMENT_ROOT'] . "/media/$article_id/$key";
        if(!file_exists($folder)){
            mkdir($folder, 0777, true);
        }
        if(move_uploaded_file($value["tmp_name"], ($folder . "/" . $value["name"]))){
            $routes[$key] = "/media/$article_id/$key/" . $value["name"];
            continue;
        }
    }

    $data = array("article_id" => $article_id, "routes" => $routes);
    Canvas_View::sendData_AJAX($data, $errors);
?>