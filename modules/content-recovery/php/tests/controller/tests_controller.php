<?php
    include("tests/view/tests_view.php");
    include("tests/model/tests_model.php");
    class TestsController{
        //Miembros de datos


        //Constructor
        public function __construct(){
        }

        //Funciones
        public function timeString($timestamp){
            $timestamp = (int) $timestamp;
            $minusTime = date("U") - $timestamp;
            if ($minusTime < 86400){
                if($minusTime >= 60 && $minusTime < 3600){
                    return ((int) ($minusTime / 60)) . " min(s)";
                }
                if($minusTime >= 0 && $minusTime < 60){
                    return ($minusTime) . " seg(s)";
                }
                return ((int) ($minusTime / 3600)) . " hr(s)";
            }
            return date("d-m-Y", $timestamp);
        }

        public function getHTML(){
            //$x = $this->timeString(date("U", date("U") - 86399));
            $x = gettype("asdd");
            //actual: 1670614481
            $HTML = <<< HTML
                <script src="/modules/content-recovery/php/tests/js/1.js"></script>
                <script src="/modules/content-recovery/php/tests/js/2.js"></script>
                <script src="/modules/content-recovery/php/tests/js/3.js"></script>
                <p>Tiempo: {$x}</p>
            HTML;
            return $HTML;
        }
    }
?>