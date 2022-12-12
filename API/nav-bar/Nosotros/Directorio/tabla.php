<?php
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
            $query = "select * from DOCENTES order by APELLIDOS";
            try{
                $dbh = new S_MySQL("USER_DATA");
                $cursor = $dbh->console($query);
                if($cursor->rowCount()){
                    $this->HTML = <<< HTML
                        <table class="article_table  {$this->theme}_table">
                            <thead>
                                <tr>
                                    <th width="10%">Docente</th>
                                    <th width="45%">Apellido(s)</th>
                                    <th width="45%">Nombre(s)</th>
                                </tr>
                            </thead>
                            <tbody>
                    HTML;
                    foreach($cursor as $item){
                        $this->HTML .= <<< HTML
                                    <tr>
                                        <td>{$item["DOCE_ID"]}</td>
                                        <td>{$item["APELLIDOS"]}</td>
                                        <td>{$item["NOMBRES"]}</td>
                                    </tr>
                        HTML;
                    }
                    $this->HTML .= <<< HTML
                            </tbody>
                        </table>
                    HTML;
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