<?php

//use MongoDB\Client;
    require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
    include("tests/view/tests_view.php");
    include("tests/model/tests_model.php");
    class TestsController{
        //Miembros de datos


        //Constructor
        public function __construct(){
        }

        //Funciones

        public function getHTML(){
            $ozy_tool = new OzyTool\OzyTool();
            $cursor = $ozy_tool->MySQL()->console("
            SELECT JSON_EXTRACT(JSON, '$.2[2]') as JSON
            FROM PERM_LABELS
            WHERE USER_ID = 1");
            $HTML = <<< HTML
            
            HTML;

            foreach($cursor as $item){
                $HTML .= <<< HTML
                    JSON:{$item["JSON"]}<br>
                HTML;

            }

            return $HTML;
        }
    }
?>