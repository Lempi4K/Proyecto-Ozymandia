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

            $query = "select GRADO, GRUPO from ALUMNOS where USER_ID = " . $this->uid;
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
        }
    }

    $OPI = new OPI();
    echo $OPI->getJSON();
?>