<?php
    class CanvasView{
        //Miembros de datos
        private $model;
        private $errors;

        //Constructor
        public function __construct($model){
            $this->model = $model;
        }

        //Funciones
        public function displayCanvas(){
            $HTML = <<< HTML
            <div>Crear Documentos: El apartado xdddd, neta ponganme la letal</div>
            HTML;
            return $HTML;
        }
    }
?>