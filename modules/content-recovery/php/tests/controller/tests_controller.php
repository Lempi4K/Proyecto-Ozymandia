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
            $HTML = <<< HTML
                <script src="/modules/content-recovery/php/tests/js/1.js"></script>
                <script src="/modules/content-recovery/php/tests/js/2.js"></script>
                <script src="/modules/content-recovery/php/tests/js/3.js"></script>
            HTML;

            return $HTML;
        }
    }
?>