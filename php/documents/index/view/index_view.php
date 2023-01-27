<?php
    use OzyTool\OzyTool;
    class IndexView{
        //Miembros de datos
        /** 
         * Index Model
         * @var IndexModel
        */
        private $model;

        //Constructor
        public function __construct($i_model){
            $this->model = $i_model;
        }

        //Funciones
        /** 
         * Crea el HTML de la parte superior de la página
         * @return HTML
        */
        public function displayTopBar(){
            $ozy_tool = new OzyTool();
            $user = $ozy_tool->User();
            $charsPerms = array("-1" => "I","0" => "U", "1" => "A", "2" => "D", "3" => "M", "4" => "P", "5" => "J", "6" => "C");
            $name = ($this->model->getPerm() == -1) ? "Invitado" : $this->model->getName();
            $HTML = <<< HTML
                <div class="top-bar">
                    <header>
                        <div class="logo">
                            <a href="/inicio" >
                                <img src="/src/img/logo/logo.png" alt="">
                                <p class="no_select">CBTIS 114</p>
                            </a>
                        </div>
                        <div class="user" id="user-FoBl">
                            <label for="inpChkbxUser">
                                <div class="user-button" id="UserButton" data-perm='{$charsPerms[$this->model->getPerm()]}'>
                                    <i class="fa-solid fa-user"></i>
                                    <p class='c_click no_select'>{$name}</p>
                                </div>
                                <input type="checkbox" id="inpChkbxUser">
                            </label>
                            <div id="user-hide-menu">
                                <ul id="main-menu">
            HTML;

            if($user->hasPerm("Ozy.Profile.see")){
                $HTML .= <<< HTML
                                    <li>
                                        <a class="c_click no_select frame_change" data-url="perfil">
                                            <i class="fa-solid fa-address-card"></i>
                                            Perfil
                                        </a>
                                    </li>
                HTML;

            }

            $HTML .= <<< HTML
                                    <li id="settings" class="UHM-submenu-Obtn">
                                        <a class="c_click no_select">
                                            <i class="fa-solid fa-gear"></i>
                                            Configuraci&oacute;n
                                        </a>
                                    </li>
            HTML;

            if($user->hasPerm("Ozy.AdminTools.see")){
                $HTML .= <<< HTML
                                        <li>
                                            <a class="c_click no_select frame_change" data-url="herramientas">
                                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                                Ozymandia's AdminTools
                                            </a>
                                        </li>
                HTML;
            }

            if($user->hasPerm("Ozy.Test.see")){
                $HTML .= <<< HTML
                                        <li>
                                            <a class="c_click no_select frame_change" data-url="pruebas">
                                                <i class="fa-solid fa-star"></i>
                                                Pruebas
                                            </a>
                                        </li>
                HTML;
            }

            if($user->hasPerm("Ozy.Login.see") && !$user->hasPerm("Ozy.*")){
                $HTML .= <<< HTML
                                        <li>
                                            <a class="c_click no_select" href="/iniciar-sesion">
                                                <i class="fa-solid fa-right-to-bracket"></i>
                                                Iniciar Sesi&oacute;n
                                            </a>
                                        </li>
                HTML;
            } else{
                $HTML .= <<< HTML
                                        <li>
                                            <a class="c_click no_select" id="inpBtnLogout">
                                                <i class="fa-solid fa-right-from-bracket"></i>
                                                Cerrar Sesi&oacute;n
                                            </a>
                                        </li>
                HTML;
            }

            $HTML .= <<< HTML
                                </ul>

                                <ul id="settings_Menu" class="UHM-submenu">
                                    <div>
                                        <a id="settings_Menu_bck" class="UHM-submenu-Bbtn c_click">
                                            <i class="fa-solid fa-arrow-left"></i>
                                            <h3 class="no_select c_default">Configuraci&oacute;n</h3>
                                        </a>
                                    </div>
                                    <li>
                                        <i class="fa-solid fa-moon"></i>
                                        <h4 class="no_select c_default">Modo Obscuro</h4>
                                        <p class="no_select c_default">Puedes modificar la paleta de colores del sitio web a una mas obscura</p>
                                        <ul class="form-elements">
                                            <li>   
                                                <input type="radio" name="drkMode" class="DrkMode" id="inpRdbtnDrkMode1">
                                                
                                                <label for="inpRdbtnDrkMode1" class="no_select c_click"><i><i></i></i>Activado</label>
                                            </li>
                                            <li>
                                                <input type="radio" name="drkMode" class="DrkMode" id="inpRdbtnDrkMode2">
                                                <label for="inpRdbtnDrkMode2" class="no_select c_click"><i><i></i></i>Desactivado</label>
                                            </li>
                                            <li>
                                                <input type="radio" name="drkMode" class="DrkMode" id="inpRdbtnDrkMode3">
                                                <label for="inpRdbtnDrkMode3" class="no_select c_click"><i><i></i></i>Sistema</label>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </header>
                </div> 
            HTML;
            return $HTML;
        }

        /** 
         * Crea el HTML de la parte de navegación de la página
         * @return HTML
        */
        public function displayNavigation(){
            $HTML = <<< HTML
                <nav class="navigation">
                    <ul class="menu menu-main">
                        <li>
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNav1" class="c_click frame_change" data-url="inicio">
                                <label for="inpRdbtnNav1">
                                    <i class="fa-solid fa-house"></i>
                                    <p class="no_select">Inicio</p>
                                </label>
                            </a>
                        </li>
            HTML;

            if(isset($_COOKIE["token"])){
                $HTML .= <<< HTML
                        <li>
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNav10" class="c_click frame_change" data-url="buscar">
                                <label for="inpRdbtnNav10">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                    <p class="no_select">Buscar</p>
                                </label>
                            </a>
                        </li>
                HTML;
            }

            $HTML .= <<< HTML
                        <li class="nav-hide">
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNav2" class="c_click frame_change" data-url="nosotros">
                                <label for="inpRdbtnNav2">
                                    <i class="fa-solid fa-people-group no_select"></i>
                                    <p class="no_select">Nosotros</p>
                                </label>
                            </a>
                        </li>
                        <li class="nav-hide">
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNav3" class="c_click frame_change" data-url="oferta-educativa">
                                <label for="inpRdbtnNav3">
                                    <i class="fa-solid fa-graduation-cap no_select"></i>
                                    <p class="no_select">Oferta Educativa</p>
                                </label>
                            </a>
                        </li>
                        <li class="nav-hide">
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNav4" class="c_click frame_change" data-url="departamentos">
                                <label for="inpRdbtnNav4">
                                    <i class="fa-solid fa-handshake-angle no_select"></i>
                                    <p class="no_select">Departamentos</p>
                                </label>
                            </a>
                        </li>
                        <li class="nav-hide">
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNav5" class="c_click frame_change" data-url="docentes">
                                <label for="inpRdbtnNav5">
                                    <i class="fa-solid fa-chalkboard-user no_select"></i>
                                    <p class="no_select">Docentes</p>
                                </label>
                            </a>
                        </li>
                        <li class="nav-hide">
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNav6" class="c_click frame_change" data-url="transparencia">
                                <label for="inpRdbtnNav6">
                                    <i class="fa-solid fa-check-to-slot no_select"></i>
                                    <p class="no_select">Transparencia</p>
                                </label>
                            </a>
                        </li>
            HTML;

            if($this->model->getPerm() != -1){
                $HTML .= <<< HTML
                        <li class="nav-hide">
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNav7" class="c_click frame_change" data-url="aplicaciones">
                                <label for="inpRdbtnNav7">
                                    <i class="fa-solid fa-cubes no_select"></i>
                                    <p class="no_select">Aplicaciones</p>
                                </label>
                            </a>
                        </li>
                HTML;
            }

            $HTML .= <<< HTML
                        <li class="nav-hide">
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNav8" class="c_click frame_change" data-url="contacto">
                                <label for="inpRdbtnNav8">
                                    <i class="fa-solid fa-address-book no_select"></i>
                                    <p class="no_select">Contacto</p>
                                </label>
                            </a>
                        </li>
            HTML;
            if($this->model->getPerm() != -1 && $this->model->getPerm() != 0){
                $HTML .= <<< HTML
                        <li class="navLastItem">
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNav9" class="c_click frame_change" data-url="lienzo">
                                <label for="inpRdbtnNav9">
                                    <i class="fa-solid fa-plus"></i>
                                    <p class="no_select">Crear</p>
                                </label>
                            </a>
                        </li>
                HTML;
            }

            $HTML .= <<< HTML
                        <li id="nav-OpenerMenu">
                            <a class="no_select">
                                <input type="checkbox" name="inpChkbxNav" id="inpChkbxNav1" class="c_click">
                                <label for="inpChkbxNav1">
                                <i class="fa-solid fa-bars" id="lblChkbxNav1"></i>
                                </label>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu menu-hideNav" id="menu-hideNav">
                        <li>
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNavH2" class="c_click frame_change" data-url="nosotros">
                                <label for="inpRdbtnNavH2">
                                    <i class="fa-solid fa-people-group no_select"></i>
                                </label>
                            </a>
                        </li>
                        <li>
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNavH3" class="c_click frame_change" data-url="oferta-educativa">
                                <label for="inpRdbtnNavH3">
                                    <i class="fa-solid fa-graduation-cap no_select"></i>
                                </label>
                            </a>
                        </li>
                        <li>
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNavH4" class="c_click frame_change" data-url="departamentos">
                                <label for="inpRdbtnNavH4">
                                    <i class="fa-solid fa-handshake-angle no_select"></i>
                                </label>
                            </a>
                        </li>
                        <li>
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNavH5" class="c_click frame_change" data-url="docentes">
                                <label for="inpRdbtnNavH5">
                                    <i class="fa-solid fa-chalkboard-user no_select"></i>
                                </label>
                            </a>
                        </li>
                        <li>
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNavH6" class="c_click frame_change" data-url="transparencia">
                                <label for="inpRdbtnNavH6">
                                    <i class="fa-solid fa-check-to-slot no_select"></i>
                                </label>
                            </a>
                        </li>
            HTML;

            if($this->model->getPerm() != -1){
                $HTML .= <<< HTML
                        <li>
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNavH7" class="c_click frame_change" data-url="aplicaciones">
                                <label for="inpRdbtnNavH7">
                                    <i class="fa-solid fa-cubes no_select"></i>
                                </label>
                            </a>
                        </li>
                HTML;
            }

            $HTML .= <<< HTML
                        <li>
                            <a class="no_select">
                                <input type="radio" name="inpRdbtnNav" id="inpRdbtnNavH8" class="c_click frame_change" data-url="contacto">
                                <label for="inpRdbtnNavH8">
                                    <i class="fa-solid fa-address-book no_select"></i>
                                </label>
                            </a>
                        </li>
                    </ul>
                </nav>
            HTML;

            return $HTML;
        }

        /** 
         * Crea el HTML del contenido fijado
         * @return HTML
        */
        public function displayLateralContent(){
            $HTML = <<< HTML
                    <aside class="lateral-content">
                        <div class="aside_container">
            HTML;

            $cursor = $this->model->getAside_cursor()->toArray();
            if(count( $cursor ) > 0){
                foreach($cursor as $item){
                    $HTML .= <<< HTML
                        <article class="article article_navasicard">
                            <a class="AsideLink frame_change" data-get="id={$item['meta']['id']}">
                                <div class="article_container article_navasicard_container">
                                    <div class="article_title article_navasicard_title">
                                        <p>{$item['meta']['title']}</p>
                                        <p class="article_text article_navasicard_text">{$item['meta']['description']}</p>
                                    </div>
                                    <hr>
                                </div>
                            </a>
                            <img src="{$item['meta']['background_img']}" alt="" class="article_navasicard_background">
                        </article>
                    HTML;
                }
            } else{
                $HTML .= <<< HTML
                    <h3>No hay contenido</h3>
                HTML;
            }
            
            $HTML .= <<< HTML

                        </div>
                    </aside>
            HTML;

            return $HTML;
        }

        /** 
         * Une las funciones anteriores para formar la página
         * @return HTML
        */
        public function displayPage(){
            $HTML = <<< HTML
                <div class="all-container">
            HTML;

            if($this->model->getValid_token()){
                $HTML .= <<< HTML
                    {$this->displayTopBar()}
                    <main class="main-container">
                        {$this->displayNavigation()}
                        <section id="central-content">
                            <div class="charging-display-container" id="charging-display-content"><div></div></div>
                            <div id="replazable-content"></div>
                            <div class="spot"><div class="spotMessageText"></div></div>
                        </section>
                        {$this->displayLateralContent()}
                    </main>
                HTML;
            } else{
                $HTML .= <<< HTML
                    <div class='display-error-main'>
                        <p>Error en tus credenciales (Intentaste hacer algo malo?)
                            <br>
                            <u>Redirigiendo a la p&aacute;gina de inicio de sesi&oacute;n</u>
                        </p>
                    </div>
                    <script>
                        setInterval(() => {location.href="/iniciar-sesion"}, 2000);
                    </script>
                HTML;
            }

            $HTML .= <<< HTML
                </div>
            HTML;

            return $HTML;
        }
    }
?>