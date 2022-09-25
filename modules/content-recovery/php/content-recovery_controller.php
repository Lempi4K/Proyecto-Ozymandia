<?php
    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MySQL_lib/Simple_MySQL.php");

    include($_SERVER['DOCUMENT_ROOT']."/libs/php-jwt-master/src/JWT.php");
    
    include("profile/controller/profile_controller.php");

    include("nav/controller/nav_controller.php");

    include("main/controller/main_controller.php");

    include("aside/controller/aside_controller.php");

    include("search/controller/search_controller.php");

    include("canvas/controller/canvas_controller.php");

    header("Content-type: application/json; charset=utf-8");
    $POST = json_decode(file_get_contents("php://input"), true);

    $type = $POST["type"];

    $section = (($type == 0) ? $POST["section"] : null);

    $article_id = ((($type != 1 && $type < 4) || $type == 5) ? $POST["article_id"] : null);
    
    $subtype = (($type == 2 || $type == 4) ? $POST["subtype"] : null);

    $search = (($type == 4) ? $POST["search"] : null);

    $content_controller = null;

    switch ($type){
        case 0:{
            $content_controller = new MainController($section, $article_id);
            break;
        }
        case 1:{
            $content_controller = new ProfileController();
            break;
        }
        case 2:{
            $content_controller = new NavController($article_id, $subtype);
            break;
        }
        case 3:{
            $content_controller = new AsideController($article_id);
            break;
        }
        case 4:{
            $content_controller = new SearchController($search, $subtype);
            break;
        }
        case 5:{
            $content_controller = new CanvasController($article_id);
            break;
        }
    }

    echo json_encode(array("HTML" => $content_controller->getHTML()));

?>