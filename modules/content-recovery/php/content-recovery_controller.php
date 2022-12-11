<?php
    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MongoDB_lib/Simple_MongoDB.php");

    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MySQL_lib/Simple_MySQL.php");

    include($_SERVER['DOCUMENT_ROOT']."/libs/php-jwt-master/src/JWT.php");
    
    include("tests/controller/tests_controller.php");

    include("profile/controller/profile_controller.php");

    include("nav/controller/nav_controller.php");

    include("main/controller/main_controller.php");

    include("aside/controller/aside_controller.php");

    include("search/controller/search_controller.php");

    include("canvas/controller/canvas_controller.php");

    include("admin-tools/controller/admin-tools_controller.php");

    include("article-decoder.php");

    header("Content-type: application/json; charset=utf-8");
    $POST = json_decode(file_get_contents("php://input"), true);

    $type = $POST["type"];

    $section = $POST["section"] ?? 4;
    
    $start = isset($POST["start"]) ? $POST["start"] : 0;

    $article_id = (isset($POST["article_id"]) ? $POST["article_id"] : null);
    
    $subtype = (($type == 2 || $type == 4) ? $POST["subtype"] : null);

    $q = isset($POST["q"]) ? $POST["q"] : null;

    $sublabel = isset($POST["sublabel"]) ? $POST["sublabel"] : null;

    $order = isset($POST["order"]) ? $POST["order"] : null;


    $content_controller = null;

    switch ($type){
        case -1:{
            $content_controller = new TestsController();
            break;
        }
        case 0:{
            $content_controller = new MainController($section, $article_id, $start);
            break;
        }
        case 1:{
            $content_controller = new ProfileController($section, $start);
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
            $content_controller = new SearchController($q, $sublabel, $order, $start);
            break;
        }
        case 5:{
            $content_controller = new CanvasController($article_id);
            break;
        }
        case 6:{
            $content_controller = new AdminToolsController();
            break;
        }
    }

    echo json_encode(array("HTML" => $content_controller->getHTML(), "article_id" => $article_id));

?>