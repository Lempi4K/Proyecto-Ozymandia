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
            $this->HTML = <<< HTML
                <div class="article_pdf {$this->theme}">
                    <iframe src="/API/prueba/pdf.php" type="application/pdf" width="100%" height="100%">
                </div>
            HTML;
            return $this->HTML;
        }
    }
?>