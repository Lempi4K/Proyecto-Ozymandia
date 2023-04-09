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
            $query = "select USER_ID, USER, PASS from CREDENCIALES order by USER_ID asc";
            try{
                $dbh = new S_MySQL("USER_DATA");
                $cursor = $dbh->console($query);
                if($cursor->rowCount()){
                    $this->HTML = <<< HTML
                        <table class="article_table  {$this->theme}_table">
                            <thead>
                                <tr>
                                    <th width="10%">ID</th>
                                    <th width="45%">USUARIO</th>
                                    <th width="45%">CONTRASEÑA</th>
                                </tr>
                            </thead>
                            <tbody>
                    HTML;
                    foreach($cursor as $item){
                        $this->HTML .= <<< HTML
                            <tr>
                                <td>{$item["USER_ID"]}</td>
                                <td>{$item["USER"]}</td>
                                <td>{$item["PASS"]}</td>
                            </tr>
                        HTML;
                    }
                            $this->HTML .= <<< HTML
                            </tbody>
                        </table>
                    HTML;
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