<?php

use OzyTool\User;

    include("admin-tools/view/admin-tools_view.php");
    include("admin-tools/model/admin-tools_model.php");
    class AdminToolsController{
        //Miembros de datos

        private $section;
        private $internal;
        private $model;
        private $view;

        //Constructor
        public function __construct($section, $internal){
            $this->section = (int) $section;
            $this->internal = $internal;

            $this->model = new AdminToolsModel();
            $this->view = new AdminToolsView($this->model);
        }

        //Funciones
        public function getHTML(){
            $ozy_tool = new OzyTool\OzyTool();
            $user = $ozy_tool->User();
            if(! $user->hasPerm("Ozy.AdminTools.see")){
                return $ozy_tool->displayErrorMessage(BLOCK_MESSAGE);
            }

            $HTML = <<< HTML
            
            HTML;

            $content = "";
            switch((int) $this->section){
                case 1: {
                    if(! $user->hasPerm("Ozy.AdminTools.users.see")){
                        $content = $ozy_tool->displayErrorMessage(BLOCK_MESSAGE);
                        break;
                    }

                    $content = $this->view->displayUsersView();
                    break;
                }
                case 2: {
                    if(! $user->hasPerm("Ozy.AdminTools.database.see")){
                        $content = $ozy_tool->displayErrorMessage(BLOCK_MESSAGE);
                        break;
                    }


                    $content = $this->view->displayDatabaseView();
                    break;
                }
                case 3: {
                }
                case 4: {
                }
                default: {
                    $content = <<< HTML
                        <div>No Programado</div>
                    HTML;
                    break;
                }
            }

            if(!$this->internal){
                $HTML = <<< HTML
                    <script src="/modules/admin-tools/js/admin-tools.js"></script>
                    <script src="/modules/admin-tools/js/header.js"></script>
                    <script src="/modules/admin-tools/js/initializer.js"></script>
                    <div class="atContainer">
                        <div class="atTopBar">
                            <div class="atHeader">
                                <div class="athHeaderTitle">
                                    <i class="fa-solid fa-screwdriver-wrench"></i> Ozymandia's AdminTools
                                </div>
                                <div class="atOpenMenu">
                                    <input type="checkbox" name="inpChckbxATOMenu" id="inpChckbxATOMenu1">
                                    <label for="inpChckbxATOMenu1">
                                        <i class="fa-solid fa-caret-down"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="atMenu">
                                <ul>
                                    <li>
                                        <input type="radio" name="inpRdbtnMenu" id="inpRdbtnMenu1" title="Usuarios" checked value="1">
                                        <label for="inpRdbtnMenu1">
                                            <i class="fa-solid fa-user"></i>
                                        </label>
                                    </li>
                                    <li>
                                        <input type="radio" name="inpRdbtnMenu" id="inpRdbtnMenu2" title="Base de Datos" value="2">
                                        <label for="inpRdbtnMenu2">
                                            <i class="fa-solid fa-database"></i>
                                        </label>
                                    </li>
                                    <li>
                                        <input type="radio" name="inpRdbtnMenu" id="inpRdbtnMenu3" title="Etiquetas" disabled value="3">
                                        <label for="inpRdbtnMenu3">
                                            <i class="fa-solid fa-tag"></i>
                                        </label>
                                    </li>
                                    <li>
                                        <input type="radio" name="inpRdbtnMenu" id="inpRdbtnMenu4" title="Roles" disabled value="4">
                                        <label for="inpRdbtnMenu4">
                                            <i class="fa-solid fa-key"></i>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="charging-display-container" id="charging-display-container_sub"><div></div></div>
                        <div class="atReplazableContainer" id="atReplazableContainer">
                            {$content}
                        </div>
                    </div>
                HTML;
            } else{
                $HTML = $content;
            }
            return $HTML;

        }
    }
?>