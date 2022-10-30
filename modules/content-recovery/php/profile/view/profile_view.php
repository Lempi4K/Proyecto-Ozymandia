<?php 
    class ProfileView {
        //Miembros de Datos
        private $errors;
        private $model;
        private $model_obj;
        private $HTML;
        public $count;

        //Constructor
        public function __construct($model_obj){
            $this->model_obj = $model_obj;
            $this->model = $model_obj->getData();
            $this->errors = $model_obj->getErrors();
        }

        //Funciones
        public function displayInterface(){
            $charsPerms = array("-1" => "I","0" => "U", "1" => "A", "2" => "D", "3" => "M", "4" => "P", "5" => "J");
            $namePerms = array("-1" => "Invitado", "0" => "Usuario", "1" => "Administrador", "2" => "Director", "3" => "Moderador", "4" => "Profesor", "5" => "Jefe deGrupo");

                $this->HTML = <<<HTML
                    <div class="profile-content">
                        <div class="profile-background" data-perm={$charsPerms[strval($this->model->PERM)]}>

                        </div>
                        <div class="profile-data">
                            <div class="profile-mainData">
                                <div class="profile-pic" data-perm={$charsPerms[strval($this->model->PERM)]}>
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    <img src="" alt="">
                                </div>
                                <div class="profile-name">
                                    {$this->model->NOMBRES} {$this->model->APELLIDOS}
                                    <div class="rol profile-rol c_default" title={$namePerms[strval($this->model->PERM)]} data-perm={$charsPerms[strval($this->model->PERM)]}><p class="no_select">{$charsPerms[strval($this->model->PERM)]}</p></div>
                                </div>
                                <p class="profile-user">@{$this->model->USER}</p>
                            </div>
                            <div class="profile-mainDiv">
                                <div class="profile-div">
                                    <div>
                                        <input type="radio" name="inpRdbtnProdiv" id="inpRdbtnProdiv1" checked value="1">
                                        <label for="inpRdbtnProdiv1" class="c_click">
                                            Datos
                                        </label>
                                    </div>
                                    <div>
                                        <input type="radio" name="inpRdbtnProdiv" id="inpRdbtnProdiv2" value="2">
                                        <label for="inpRdbtnProdiv2" class="c_click">
                                            Publicaciones
                                        </label>
                                    </div>
                                </div>
                                <div class="charging-display-container" id="charging-display-container_sub"><div></div></div>
                                <div class="replazable-content_Profile" id="replazable-content_Profile">
                                    {$this->displayProfileData()}
                                      <!--{$this->displayOwnArticles()}-->
                                </div>
                            </div>
                        </div>
                    </div>
                HTML;
            return $this->HTML;
        }

        public function displayProfileData(){
            if ($this->model != null && $this->errors === ""){
                $HTML = <<< HTML
                    <div class="profile-data-container">
                        <div class="profile-data-div">
                            <div class="profile-data-header">
                                <i class="fa-solid fa-person"></i>
                                <p>
                                    Personal
                                </p>
                            </div>
                            <div class="profile-data-item">
                                <p>{$this->model->F_NACIMIENTO}</p>
                                <p>Fecha de Nacimiento</p>
                            </div>
                            <div class="profile-data-item">
                                <p>{$this->model->CURP}</p>
                                <p>CURP</p>
                            </div>
                        </div>

                HTML;


                if(isset($this->model->N_CTRL) && isset($this->model->MAT)){
                    $HTML .= <<<HTML
                            <div class="profile-data-div">
                                <div class="profile-data-header">
                                    <i class="fa-solid fa-id-badge"></i>
                                    <p>
                                        Identificadores
                                    </p>
                                </div>
                                <div class="profile-data-item">
                                    <p>{$this->model->N_CTRL}</p>
                                    <p>N&uacute;mero de Control</p>
                                </div>
                                <div class="profile-data-item">
                                    <p>{$this->model->MAT}</p>
                                    <p>Matr&iacute;cula</p>
                                </div>
                            </div>
                            <div class="profile-data-div">
                                <div class="profile-data-header">
                                    <i class="fa-solid fa-school"></i>
                                    <p>
                                        Escuela
                                    </p>
                                </div>
                                <div class="profile-data-item">
                                    <p>{$this->model->GRADO} - {$this->model->GRUPO}</p>
                                    <p>Grado y Grupo</p>
                                </div>
                                <div class="profile-data-item">
                                    <p>{$this->model->CARRERA}</p>
                                    <p>Carrera</p>
                                </div>
                                <div class="profile-data-item">
                                    <p>{$this->model->A_INICIO} - {$this->model->A_GRAD}</p>
                                    <p>Generaci&oacute;n</p>
                                </div>
                            </div>
                    HTML;
                } else{

                }
                $HTML .= <<<HTML
                    </div>
                HTML;
            } else{
                $HTML = <<< HTML
                    Error en Credenciales
                HTML;
            }
                return $HTML;
        }

        public function displayOwnArticles(){
            if($this->model_obj->getCursor() == null){
                return <<< HTML
                        <h3>Error: {$this->model_obj->getErrors()}</h3>
                    HTML;
            }
            $cursor = $this->model_obj->getCursor()->toArray();
            $this->count = count( $cursor );

            $HTML = <<< HTML
            
            HTML;
            if($this->count > 0){
                foreach($cursor as $item){
                    if((empty($_COOKIE["token"]) xor $item["meta"]["label"] != 3) || !empty($_COOKIE["token"])){
                        $HTML .= articleDecoder($item, true);
                        $HTML .=  <<< HTML
                            <br>
                        HTML;
                    } else{
                        $HTML .=  <<< HTML
                            <h3>Contenido no disponible</h3>
                        HTML;
                    }
                }
            } else{
                if($this->model_obj->getStart() == 0){
                    $HTML .= <<< HTML
                        <h3>No hay contenido</h3>
                    HTML;
                }
                $HTML .= <<< HTML

                HTML;
            }
            return $HTML;
        }
    }
?>