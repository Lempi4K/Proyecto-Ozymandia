<?php
    class AdminToolsView{
        //Miembros de datos
        private $model;

        //constructor
        public function __construct($model){
            $this->model = $model;
        }

        //Funciones
        public function displayUsersView(){
            $HTML = <<< HTML
                <div class="atUsersContainer atMainContainer">
                    <div class="atusToolBar atToolBar">
                        <div class="atusSearch">
                            <input type="search" name="inpSearchDataBase" id="inpSearchDataBase1">
                            <i class="fa-brands fa-searchengin"></i>
                        </div>
                        <div class="attbusButtons attButtons">
                            <ul>
                                <li id="attButtonAdd">
                                    <i class="fa-solid fa-plus"></i>
                                </li>
                                <li id="attButtonEdit" class="attButtonDisable">
                                    <i class="fa-solid fa-pen"></i>
                                </li>
                                <li id="attButtonDelete" class="attButtonDisable">
                                    <i class="fa-solid fa-trash"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="atFrame">
                        <div class="atusTable atTable">
                            <table class="article_table">
                                <thead>
                                    <th width="10%">ID</th>
                                    <th width="30%">USUARIO</th>
                                    <th width="30%">NOMBRE</th>
                                    <th width="30%">ROL</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="atHideFrames">
                        <div class="athFrame">
                            <div class="athTitle">
                                Datos
                            </div>
                            <div class="athBody">
                                <form class="athForm" id="athForm" onsubmit="return false">
                                    <div class="athFormElementsContainer">
                                        <h1 class="athSubtitle">Plataforma<hr></h1>
                                        <div class="frmInpText">
                                            <input type="text" id="inpTxtUser" placeholder="User">
                                            <label for="inpTxtUser" class="no_select">Usuario</label>
                                        </div>
                                        <div class="frmInpText">
                                            <input type="text" id="inpTxtPass" placeholder="Pass">
                                            <label for="inpTxtPass" class="no_select">Contraseña</label>
                                        </div>
                                        <div class="frmLabelSelector" id="frmLabelSelector">
                                            <p>Etiquetas Permitidas: </p>
                                            <ul>
                                                <i id="flsReset" class="fa-solid fa-xmark"></i>
                                                <li>
                                                    <input type="radio" name="inpRdbtnLbl" value="1" id="inpRdbtnLbl1">
                                                    <label for="inpRdbtnLbl1" id="frmLabel">General</label>
                                                    <ul class="subLabels">
                                                        <li>
                                                            <input type="radio" id='inpRdbtnSlbl1' class="inpRdbtnSlbl" value='1' name='inpRdbtnSlbl'>
                                                            <label for='inpRdbtnSlbl1' class="frmSubLabel">PRONAFOLE</label>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="frmNavSelector frmSelector" id="frmSelectorRol">
                                            <p>Rol:</p>
                                            <select name="" id="slctRol">
                                                <option value="0">Usuario</option>
                                                <option value="1">Administrador</option>
                                                <option value="2">Director</option>
                                                <option value="3">Moderador</option>
                                                <option value="4">Profesor</option>
                                                <option value="5">Jefe de Grupo</option>
                                                <option value="6">Creador</option>
                                            </select>
                                        </div>
                                        <h1 class="athSubtitle">Personal<hr></h1>
                                    </div>
                                    <div class="athButtons">
                                        <input type="submit" value="Guardar" id="inpBtnATSave">
                                        <input type="button" value="Cancelar" id="inpBtnATSave">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="/modules/admin-tools/js/users.js"></script>
            HTML;

            return $HTML;
        }

        public function displayDatabaseView(){
            $HTML = <<< HTML
                <div class="atDBContainer atMainContainer">
                    <div class="atFrame">
                        <div class="atSingleFrame">
                            <div class="athTitle">
                                Base de Datos
                            </div>
                            <h1 class="athSubtitle">Importar<hr></h1>
                            <div class="athBody">
                                <div class="frmInpFile" id="frmInpFileOzy">
                                    <input type="file" id="inpFileOzy" accept=".ozy">
                                    <label for="inpFileOzy">
                                        <p>
                                            <i class="fa-solid fa-file-zipper"></i>
                                            OZY
                                        </p>
                                        <div>
                                            Elige un archivo ozy
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <br>
                            <h1 class="athSubtitle">Exportar<hr></h1>
                            <div class="athButtons">
                                <input type="button" value="Descargar" id="inpBtnATSave" onclick="OzyTool.stream('Llamen a Dios', OzyTool.CONST.WARN)")>
                            </div>
                        </div>
                    <div class="atHideFrames">
                        <div class="athFrame">
                        </div>
                    </div>
                </div>
            HTML;

            return $HTML;
        }
    }
?>