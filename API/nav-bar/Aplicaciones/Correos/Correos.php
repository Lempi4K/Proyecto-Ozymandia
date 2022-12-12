<?php
    use Firebase\JWT\JWT;
    include($_SERVER['DOCUMENT_ROOT']."/API/templete.php");
    class API extends API_Template{
        //Miembros de datos
        private $HTML;
        private $theme;

        //Constructor
        public function __construct($theme){
            $this->theme = $theme;
        }

        //Funciones implementadas
        public function getHTML(){
            $payload = JWT::decode($_COOKIE["token"], "P.O.");


            $query = "select USER, PASS from CREDENCIALES where USER_ID = " . $payload->uid;
            try{
                $dbh = new S_MySQL("USER_DATA");
                $cursor = $dbh->console($query);
                if($cursor->rowCount()){
                    foreach($cursor as $item){
                        $this->HTML = <<< HTML
                            <p class="article_subtitle_2 article_1_subtitle_2 cpeEditable">Correo: {$item["USER"]}@cbtis114.edu.mx</p>
                            <p class="article_subtitle_2 article_1_subtitle_2 cpeEditable">Contraseña: {$item["PASS"]}</p>
                        HTML;
                    }
                    return $this->HTML;
                } else{
                    $this->HTML = <<< HTML
                        <p class="article_subtitle_2 article_1_subtitle_2 cpeEditable">Base de datos vacia</p>
                    HTML;
                }
            }catch(Exception $e){
                $this->HTML = <<< HTML
                    <p class="article_subtitle_2 article_1_subtitle_2 cpeEditable">Error de programación</p>
                HTML;
            }
            return $this->HTML;
        }
    }
?>