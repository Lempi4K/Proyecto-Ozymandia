<?php
    class Login_View{
        //Funciones
        public static function sendData_AJAX($data, $errors = ""){
            echo json_encode(array("data" => $data, "errors" => $errors));
        }
    }
?>