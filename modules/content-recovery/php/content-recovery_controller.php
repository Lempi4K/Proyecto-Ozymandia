<?php
/**
 * Es el controlador del trafico de ordenes para actualizar contenido dinámicamente
 */
    include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");

    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MongoDB_lib/Simple_MongoDB.php");

    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MySQL_lib/Simple_MySQL.php");
    
    include("tests/controller/tests_controller.php");

    include("profile/controller/profile_controller.php");

    include("nav/controller/nav_controller.php");

    include("main/controller/main_controller.php");

    include("aside/controller/aside_controller.php");

    include("search/controller/search_controller.php");

    include("canvas/controller/canvas_controller.php");

    include("admin-tools/controller/admin-tools_controller.php");

    include("article-decoder.php");

    const BLOCK_MESSAGE = "Contenido no disponible para tí";

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
    
    $internal = isset($POST["internal"]) ? $POST["internal"] : null;


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
            $content_controller = new AdminToolsController($section, $internal);
            break;
        }
    }

    $HTML = $content_controller->getHTML();
    if($article_id != null && $article_id > 0){
        $HTML .=  <<< HTML
            <script src="/modules/events/article-events.js"></script>
        HTML;
    }
    echo json_encode(array("HTML" => $HTML, "article_id" => $article_id));

?>