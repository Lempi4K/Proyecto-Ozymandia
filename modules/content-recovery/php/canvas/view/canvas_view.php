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
                                    <input type="radio" name="inpRdbtnFrmArtlType" id="inpRdbtnFrmArtlType1" value="2" disabled>
                                    <label for="inpRdbtnFrmArtlType1" class="no_select">
                                        <i class="fa-solid fa-compass"></i>
                                        <p class="no_select">Nav. Bar</p>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" name="inpRdbtnFrmArtlType" id="inpRdbtnFrmArtlType2" value="0" checked>
                                    <label for="inpRdbtnFrmArtlType2" class="no_select">
                                        <i class="fa-solid fa-house-user"></i>
                                        <p class="no_select">Principal</p>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" name="inpRdbtnFrmArtlType" id="inpRdbtnFrmArtlType3" value="3">
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
                                    <input type="radio" name="inpRdbtnFrmArtlTheme" id="inpRdbtnFrmArtlTheme1" value="article_2" checked>
                                    <label for="inpRdbtnFrmArtlTheme1" class="no_select">
                                        <i class="fa-brands fa-affiliatetheme"></i>
                                        <p class="no_select">Normal</p>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" name="inpRdbtnFrmArtlTheme" id="inpRdbtnFrmArtlTheme2" value="article_1">
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
                <div class="canvas-frame" id="cnvFrmData">
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
                            <div class="frmLabelSelector">
                                <p>Elige las etiquetas:</p>
                                <ul>
                                    <li>
                                        <input type="radio" name="inpRdbtnLbl" value="administrativo" id="inpRdbtnLbl1">
                                        <label for="inpRdbtnLbl1" id="frmLabelAdmin">Administrativo</label>
                                        <ul class="subLabels">
                                            <li>
                                                <input type="checkbox" id="inpChckbxLbl1" class="inpChckbxLbl" value="1">
                                                <label for="inpChckbxLbl1" class="frmSubLabel">Grupo 1</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="inpChckbxLbl2" class="inpChckbxLbl" value="2">
                                                <label for="inpChckbxLbl2" class="frmSubLabel">Grupo 2</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="inpChckbxLbl3" class="inpChckbxLbl" value="3">
                                                <label for="inpChckbxLbl3" class="frmSubLabel">Grupo 3</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="inpChckbxLbl4" class="inpChckbxLbl" value="4">
                                                <label for="inpChckbxLbl4" class="frmSubLabel">Grupo 4</label>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <input type="radio" name="inpRdbtnLbl" value="general" id="inpRdbtnLbl2">
                                        <label for="inpRdbtnLbl2" id="frmLabelGene">General</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="inpRdbtnLbl" value="invitado" id="inpRdbtnLbl3">
                                        <label for="inpRdbtnLbl3" id="frmLabelGuest">Invitado</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="frmNavSelector">
                                <p>Elige el apartado:</p>
                                <select name="" id="slctNav">
                                    <option value="1">Nosotros</option>
                                    <option value="2">Oferta Educativa</option>
                                    <option value="3">Departamentos</option>
                                    <option value="4">Docentes</option>
                                    <option value="5">Transparencia</option>
                                    <option value="6">Aplicaciones</option>
                                    <option value="7">Contacto</option>
                                </select>
                            </div>
                            <div class="frmFileSelector">
                                <p>Elige la im&aacute;gen de fondo:</p>
                                <input type="file" name="" id="inpFileNavasicard" accept=".jpg, .jpeg, .png">
                                <label class="article article_navasicard cnvFrmNavasicard" for="inpFileNavasicard">
                                    <a class="c_click">
                                        <div class="article_container article_navasicard_container">
                                            <div class="article_title article_navasicard_title">
                                                <p id="NavasicardTitle">T&iacute;tulo</p>
                                                <p class="article_text article_navasicard_text" id="NavasicardDesc">Descripci&oacute;n</p>
                                            </div>
                                            <hr>
                                        </div>
                                        <i class="fa-solid fa-image"></i>
                                    </a>
                                    <img alt="" class="article_navasicard_background">
                                </label>
                            </div>
                        </div>
                        <div class="frmChangeButtons">
                            <input type="button" value="Atras" class="cnvFrmBackBtn">
                            <input type="button" value="Siguiente" class="cnvFrmNextBtn">
                        </div>
                    </div>
                </div>
                <div class="canvas-frame canvas-painter frame-active" id="cnvFrmData">
                    <div class="frmBody">
                        <div class="cnvPntFrames">
                            <div class="cpFrame" id="cpfElementSelector">

                            </div>
                            <div class="cpFrame" id="cpfElementData">

                            </div>
                        </div>
                        <div class="cnvPntEditBar">
                            <ul>
                                <li>
                                    <input type="checkbox" id="cnvTextType1">
                                    <label for="cnvTextType1">
                                        <i class="fa-solid fa-bold"></i>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="cnvTextType2">
                                    <label for="cnvTextType2">
                                        <i class="fa-solid fa-italic"></i>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="cnvTextType3">
                                    <label for="cnvTextType3">
                                        <i class="fa-solid fa-underline"></i>
                                    </label>
                                </li>
                                <li>
                                    <label for="">
                                        <i class="fa-solid fa-pen"></i>
                                    </label>
                                </li>
                                <li>
                                    <label for="">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="cnvPaintWorkArea">
                            <article class="article">
                                <div class="article_container article_1">
                                    <div class="article_title article_1_title">
                                        <p>Template 1</p>
                                        <p class="article_text article_2_text">Texto de titulo</p>
                                    </div>
                                    <hr>
                                    <div class="article_content article_1_content">
                                        <div class="article_1_head">
                                            <img src="/src/img/logo/logo.png" alt="">
                                            <p>
                                                CENTRO DE BACHILLERATO TECNOL&Oacute;GICO
                                                <br>
                                                industrial y de servicios N&uacute;m. 114
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="article_main article_1_main">
                                            <div class="cpElement">
                                                <input type="radio" name="cpeSelector" id="cpeSelector0" value="0">
                                                <label for="cpeSelector0">
                                                    <div class="cpeCreateBtns cpecbTop">
                                                        <div>
                                                            <i class="fa-solid fa-plus"></i>
                                                        </div>
                                                    </div>
                                                    <p class="article_subtitle_1 article_1_subtitle_1">
                                                        Subtitulo 1
                                                    </p>
                                                    <div class="cpeCreateBtns cpecbBottom">
                                                        <div>
                                                            <i class="fa-solid fa-plus"></i>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="cpElement">
                                                <input type="radio" name="cpeSelector" id="cpeSelector1" value="1">
                                                <label for="cpeSelector1">
                                                    <div class="cpeCreateBtns cpecbTop">
                                                        <div>
                                                            <i class="fa-solid fa-plus"></i>
                                                        </div>
                                                    </div>
                                                    <p class="article_subtitle_1 article_1_subtitle_1">
                                                        Subtitulo 2
                                                    </p>
                                                    <div class="cpeCreateBtns cpecbBottom">
                                                        <div>
                                                            <i class="fa-solid fa-plus"></i>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            <hr>
                                            <p class="article_end article_1_end">
                                                ¡UNA VEZ LOBOS, SIEMPRE LOBOS!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </article>
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