<?php
    use OzyTool\User;
    class AdminToolsView{
        //Miembros de datos
        private $model;
        private $ozy_tool;

        //constructor
        public function __construct($model){
            $this->model = $model;
            $this->ozy_tool = new OzyTool\OzyTool();
        }

        //Funciones
        public function displayUsersView(){
            $user = $this->ozy_tool->User();
            $HTML = <<< HTML
                <div class="atUsersContainer atMainContainer">
                    <div class="atusToolBar atToolBar">
                        <div class="atusSearch">
                            <input type="search" name="inpSearchDataBase" id="inpSearchDataBase1">
                            <i class="fa-brands fa-searchengin"></i>
                        </div>
                        <div class="attbusButtons attButtons">
                            <ul>
            HTML;
            if($user->hasPerm("Ozy.AdminTools.users.db.add")){
                $HTML .= <<< HTML
                                <li id="attButtonAdd">
                                    <i class="fa-solid fa-plus"></i>
                                </li>
                HTML;
            }
            if($user->hasPerm("Ozy.AdminTools.users.db.edit")){
                $HTML .= <<< HTML
                                <li id="attButtonEdit" class="attButtonDisable">
                                    <i class="fa-solid fa-pen"></i>
                                </li>
                HTML;
            }
            if($user->hasPerm("Ozy.AdminTools.users.db.delete")){
                $HTML .= <<< HTML
                                <li id="attButtonDelete" class="attButtonDisable">
                                    <i class="fa-solid fa-trash"></i>
                                </li>
                HTML;
            }

            $HTML .= <<< HTML
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
                        <div class="athFrame" id="athFrame1">
                            <div class="athTitle">
                                Datos
                            </div>
                            <div class="athBody">
                                <form class="athForm" id="athForm" onsubmit="return false">
                                    <div class="athFormElementsContainer" id="athFormElementsContainer">

                                    </div>
                                    <div class="athButtons">
                                        <input type="button" value="Cancelar" id="inpBtnATCloseFrame1">
                                        <input type="submit" value="Guardar" id="inpBtnATSave">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="athFrame" id="athFrame2">
                            <div class="athText">
                                Seguro que quieres eliminar este usuario?
                            </div>
                            <div class="athButtons">
                                <input type="button" value="No" id="inpBtnATCloseFrame2">
                                <input type="submit" value="Si" id="inpBtnATYes">
                            </div>
                        </div>
                    </div>
                </div>
                <script src="/modules/admin-tools/js/users.js"></script>
            HTML;

            return $HTML;
        }

        public function displayAproveArticles(){
            $HTML = <<< HTML
                <div class="atAAContainer atMainContainer">
                    <div class="aaToolBar atToolBar">
                        <label class="aaSlctLabel" for="aaSlctLabel">
                            <select name="label" id="aaSlctLabel">
            HTML;
            $sublabels = $this->ozy_tool->User()->getSublabels();

            foreach($sublabels["G"] as $key => $value){
                $HTML .= <<< HTML
                    <option value="{$key}">{$value}</option>
                HTML;
            }
            $HTML .= <<< HTML
                            </select>
                        </label>
                    </div>
                    <div class="atFrame">
                        <div class="atCentralText">
                            Nada por aprobar<br>*Maqueta*
                        </div>
                    </div>
                </div>
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
                                <input type="button" value="Descargar" id="inpBtnATDownload">
                            </div>
                        </div>
                    <div class="atHideFrames">
                        <div class="athFrame" id="athFrame1">
                            <div class="athText">
                                Se va a reemplazar el contenido de las bases de datos<br>¿Quieres continuar?
                            </div>
                            <div class="athButtons">
                                <input type="button" value="No" id="inpBtnATCloseFrame1">
                                <input type="submit" value="Si" id="inpBtnATYes">
                            </div>
                        </div>
                    </div>
                </div>
                <script src="/modules/admin-tools/js/database.js"></script>
            HTML;

            return $HTML;
        }
    }
?>