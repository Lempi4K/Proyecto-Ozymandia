<?php
    include("admin-tools/view/admin-tools_view.php");
    include("admin-tools/model/admin-tools_model.php");
    class AdminToolsController{
        //Miembros de datos


        //Constructor
        public function __construct(){
        }

        //Funciones
        public function getHTML(){
            $HTML = <<< HTML
                <h3>Ozymandia´s Admin Tools</h3>
            HTML;
            return $HTML;
        }
    }
?>