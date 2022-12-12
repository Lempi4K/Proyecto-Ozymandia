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


            $query = "select GRADO, GRUPO from ALUMNOS where USER_ID = " . $payload->uid;
            try{
                $dbh = new S_MySQL("USER_DATA");
                $cursor = $dbh->console($query);
                if($cursor->rowCount()){
                    foreach($cursor as $item){
                        $this->HTML = <<< HTML
                            <iframe src="/API/nav-bar/Aplicaciones/AluHorarios/Horarios/{$item['GRADO']}{$item['GRUPO']}-V3.pdf" type="application/pdf" width="100%" height="100%"></iframe>
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