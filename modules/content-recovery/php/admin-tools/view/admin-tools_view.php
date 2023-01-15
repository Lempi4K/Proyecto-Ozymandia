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
                                        <h1 class="athSubtitle">Plataforma<hr></h1>
                                        <div class="frmInpText">
                                            <input type="text" id="inpTxtUser" placeholder="User" required pattern="[A-Za-z]">
                                            <label for="inpTxtUser" class="no_select">Usuario</label>
                                        </div>
                                        <div class="frmInpText">
                                            <input type="text" id="inpTxtPass" placeholder="Pass" required>
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
                                            <select name="" id="slctRol" required>
                                                <option value="0">Usuario</option>
                                                <option value="1">Administrador</option>
                                                <option value="2">Director</option>
                                                <option value="3">Moderador</option>
                                                <option value="4">Profesor</option>
                                                <option value="5">Jefe de Grupo</option>
                                                <option value="6">Creador</option>
                                            </select>
                                        </div>
                                        <fieldset class="cnvEditElement APITypeElements frmRadioBtn">
                                            <legend>Tipo de Usuario</legend>
                                            <ul class="form-elements frmInpRdbtn">
                                                <li>
                                                    <input type="radio" name="inpRdbtnUserType" class="inpRdbtnUserType" id="inpRdbtnUserType1" value="1" checked>
                                                    <label for="inpRdbtnUserType1" class="no_select c_click"><i><i></i></i>Alumno</label>
                                                </li>
                                                <li>
                                                    <input type="radio" name="inpRdbtnUserType" class="inpRdbtnUserType" id="inpRdbtnUserType2" value="2">
                                                    <label for="inpRdbtnUserType2" class="no_select c_click"><i><i></i></i>Docente</label>
                                                </li>
                                            </ul>
                                        </fieldset>
                                        <h1 class="athSubtitle">Personal<hr></h1>
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