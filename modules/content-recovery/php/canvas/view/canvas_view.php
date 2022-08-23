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
            <div class="canvas-container">
                <div class="canvas-background"></div>
                <div class="canvas-frame frame-active" id="cnvFrmTitle">
                    <div class="frmHead">
                        <h1>Lienzo</h1>
                    </div>
                    <div class="frmBody">
                        <input type="button" value="Crear" class="cnvFrmNextBtn">
                    </div>
                </div>
                <div class="canvas-frame" id="cnvFrmType">
                    <div class="frmHead">
                        <h1>Tipo</h1>
                    </div>
                    <div class="frmBody">
                        <input type="button" value="Atras" class="cnvFrmBackBtn">
                        <input type="button" value="Siguiente" class="cnvFrmNextBtn">

                    </div>
                </div>
            </div>
            HTML;
            return $HTML;
        }
    }
?>