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
                case 0: {
                    if(! $user->hasPerm("Ozy.AdminTools.approveArticles.see")){
                        $content = $ozy_tool->displayErrorMessage(BLOCK_MESSAGE);
                        break;
                    }

                    $content = $this->view->displayAproveArticles();
                    break;
                }
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
                    if(! $user->hasPerm("Ozy.AdminTools.sublabels.see")){
                        $content = $ozy_tool->displayErrorMessage(BLOCK_MESSAGE);
                        break;
                    }


                    $content = $this->view->displaySublabelsView();
                    break;
                }
                case 4: {
                    if(! $user->hasPerm("Ozy.AdminTools.roles.see")){
                        $content = $ozy_tool->displayErrorMessage(BLOCK_MESSAGE);
                        break;
                    }


                    $content = $this->view->displayRolesView();
                    break;
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
                HTML;
                    $HTML .= <<< HTML
                                        <li>
                                            <input type="radio" name="inpRdbtnMenu" id="inpRdbtnMenu0" checked value="0">
                                            <label for="inpRdbtnMenu0" title="Publicaciones Pendientes">
                                                <i class="fa-solid fa-square-check"></i>
                                            </label>
                                        </li>
                    HTML;
                    $HTML .= <<< HTML
                                        <li>
                                            <input type="radio" name="inpRdbtnMenu" id="inpRdbtnMenu1" checked value="1">
                                            <label for="inpRdbtnMenu1" title="Usuarios">
                                                <i class="fa-solid fa-user"></i>
                                            </label>
                                        </li>
                    HTML;
                    $HTML .= <<< HTML
                                        <li>
                                            <input type="radio" name="inpRdbtnMenu" id="inpRdbtnMenu2" value="2">
                                            <label for="inpRdbtnMenu2" title="Base de Datos">
                                                <i class="fa-solid fa-database"></i>
                                            </label>
                                        </li>
                    HTML;
                    $HTML .= <<< HTML
                                        <li>
                                            <input type="radio" name="inpRdbtnMenu" id="inpRdbtnMenu3" value="3">
                                            <label for="inpRdbtnMenu3" title="Etiquetas">
                                                <i class="fa-solid fa-tag"></i>
                                            </label>
                                        </li>
                    HTML;
                    $HTML .= <<< HTML
                                        <li>
                                            <input type="radio" name="inpRdbtnMenu" id="inpRdbtnMenu4" value="4">
                                            <label for="inpRdbtnMenu4" title="Roles">
                                                <i class="fa-solid fa-key"></i>
                                            </label>
                                        </li>
                    HTML;
                $HTML .= <<< HTML
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