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
            $perm = $ozy_tool->User()->getPersonalData()->fetch()["NOMBRES"];
            $HTML = <<< HTML
                {$perm}
            HTML;

            return $HTML;
        }
    }
?>