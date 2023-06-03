<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/OPI/OPI-DevKit.php");

    class OPI extends OPI_DevKit{
        //Constructor
        public function __construct(){
            $uid = $_GET["uid"] ?? 0;
            $thm = $_GET["theme"] ?? "";
            parent::__construct($uid, $thm);
        }

        //Funciones implementadas
        public function createHTML(){

            $query = "select USER, PASS from CREDENCIALES where USER_ID = " . $this->uid;
            try{
                $dbh = new S_MySQL("USER_DATA");
                $cursor = $dbh->console($query);
                if($cursor->rowCount()){
                    foreach($cursor as $item){
                        $this->HTML = <<< HTML
                            <p class="article_subtitle_2 article_1_subtitle_2 cpeEditable">Correo: {$item["USER"]}@cbtisXXX.edu.mx</p>
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
        }
    }

    $OPI = new OPI();
    echo $OPI->getJSON();
?>