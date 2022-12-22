<?php

//use MongoDB\Client;
    require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
    include("tests/view/tests_view.php");
    include("tests/model/tests_model.php");
    //include("1.php");
    //include("2.php");
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


            $HTML = <<< HTML
                {$_SERVER["HTTP_HOST"]}
            HTML;
            try{
                $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
                $client = new GuzzleHttp\Client([
                    "base_uri" => $url
                    ]
                );
    
                $response = $client->request("GET", "/API/fijado/Biblioteca-Virtual/tabla.php", [
                    "query" => [
                        "uid" => (int) Firebase\JWT\JWT::decode($_COOKIE["token"], "P.O.")->uid,
                        "theme" => "article_2"
                    ]
                ]);
                $json = json_decode($response->getBody(), true);
                //$HTML .= $response->getBody();
                switch ($json["status"]){
                    case 0:{
                        $HTML .= <<< HTML
                            <p>Error en el OPI</p>
                        HTML;
                        break;
                    }
                    case 1:{
                        $HTML .= $json["data"]["HTML"];
                        break;
                    }
                    case 2:{
                        $HTML .= <<< HTML
                            <p>Error en los datos de la solicitud</p>
                        HTML;
                        break;
                    }
                }
            } catch(Throwable $t){
                $HTML .= $t->getMessage();
            }

            return $HTML;
        }
    }
?>