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
                <div class="canvas-frame" id="cnvFrmTitle">
                    <div class="frmHead">
                        <h1>Lienzo</h1>
                    </div>
                    <div class="frmBody">
                        <i class="fa-solid fa-palette"></i>
                        <input type="button" value="Crear" class="cnvFrmNextBtn cnvFrmCreate">
                    </div>
                </div>
                <div class="canvas-frame" id="cnvFrmType">
                    <div class="frmHead">
                        <h1>Tipo</h1>
                    </div>
                    <div class="frmBody">
                        <div class="frmSelect">
                            <ul>
                                <li>
                                    <input type="radio" name="inpRdbtnFrmArtlType" id="inpRdbtnFrmArtlType1" disabled>
                                    <label for="inpRdbtnFrmArtlType1" class="no_select">
                                        <i class="fa-solid fa-compass"></i>
                                        <p class="no_select">Nav. Bar</p>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" name="inpRdbtnFrmArtlType" id="inpRdbtnFrmArtlType2" checked>
                                    <label for="inpRdbtnFrmArtlType2" class="no_select">
                                        <i class="fa-solid fa-house-user"></i>
                                        <p class="no_select">Principal</p>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" name="inpRdbtnFrmArtlType" id="inpRdbtnFrmArtlType3">
                                    <label for="inpRdbtnFrmArtlType3" class="no_select">
                                        <i class="fa-solid fa-thumbtack"></i>
                                        <p class="no_select">Fijado</p>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="frmChangeButtons">
                            <input type="button" value="Atras" class="cnvFrmBackBtn">
                            <input type="button" value="Siguiente" class="cnvFrmNextBtn">
                        </div>
                    </div>
                    
                </div>
                <div class="canvas-frame" id="cnvFrmTheme">
                    <div class="frmHead">
                        <h1>Tema</h1>
                    </div>
                    <div class="frmBody">
                        <div class="frmSelect">
                            <ul>
                                <li>
                                    <input type="radio" name="inpRdbtnFrmArtlTheme" id="inpRdbtnFrmArtlTheme1" checked>
                                    <label for="inpRdbtnFrmArtlTheme1" class="no_select">
                                        <i class="fa-brands fa-affiliatetheme"></i>
                                        <p class="no_select">Normal</p>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" name="inpRdbtnFrmArtlTheme" id="inpRdbtnFrmArtlTheme2" disabled>
                                    <label for="inpRdbtnFrmArtlTheme2" class="no_select">
                                        <i class="fa-brands fa-themeco"></i>
                                        <p class="no_select">Pro</p>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="frmChangeButtons">
                            <input type="button" value="Atras" class="cnvFrmBackBtn">
                            <input type="button" value="Siguiente" class="cnvFrmNextBtn">
                        </div>
                    </div>
                </div>
                <div class="canvas-frame frame-active" id="cnvFrmData">
                    <div class="frmHead">
                        <h1>Datos Principales</h1>
                    </div>
                    <div class="frmBody">
                        <div class="frmDataElements fdeText">
                            <div class="frmInpText">
                                <input type="text" id="inpTxtTitle" placeholder="title">
                                <label for="inpTxtTitle" calass="no_select">T&iacute;tulo</label>
                            </div>
                            <div class="frmInpText">
                                <input type="text" id="inpTxtDesc" placeholder="Desc">
                                <label for="inpTxtDesc" class="no_select">Descripci&oacute;n</label>
                            </div>
                        </div>
                        <div class="frmChangeButtons">
                            <input type="button" value="Atras" class="cnvFrmBackBtn">
                            <input type="button" value="Siguiente" class="cnvFrmNextBtn">
                        </div>
                    </div>
                </div>
            </div>
            HTML;
            return $HTML;
        }
    }
?>