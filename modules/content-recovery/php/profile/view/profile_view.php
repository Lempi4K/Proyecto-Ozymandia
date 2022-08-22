<?php 
    class ProfileView {
        //Miembros de Datos
        private $errors;
        private $model;

        //Constructor
        public function __construct($model_obj){
            $this->model = $model_obj->getData();
            $this->errors = $model_obj->getErrors();
        }

        //Funciones
        public function displayProfile(){
            $charsPerms = array("-1" => "I","0" => "U", "1" => "A", "2" => "D", "3" => "M", "4" => "P", "5" => "J");
            $namePerms = array("-1" => "Invitado", "0" => "Usuario", "1" => "Administrador", "2" => "Director", "3" => "Moderador", "4" => "Profesor", "5" => "Jefe deGrupo");
            $if = function ($condition, $true, $false){
                return (($condition)? $true : $false);
            };

            if ($this->model != null && $this->errors === ""){
                $id = <<<HTML
                HTML;
                $school = <<<HTML
                HTML;
                if(isset($this->model->N_CTRL) && isset($this->model->MAT)){
                    $id = <<<HTML
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
                    HTML;

                    $school = <<<HTML
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
                }
                
                $default = <<<HTML
                HTML;

                $HTML = <<<HTML
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
                        <div class="profile-div">
                            <div>
                                <input type="radio" name="inpRdbtnProfileDiv" id="inpRdbtnProfileDiv1" checked>
                                <label for="inpRdbtnProfileDiv1" class="c_click">
                                    Datos
                                </label>
                            </div>
                            <div>
                                <input type="radio" name="inpRdbtnProfileDiv" id="inpRdbtnProfileDiv2">
                                <label for="inpRdbtnProfileDiv2" class="c_click">
                                    Publicaciones
                                </label>
                            </div>
                        </div>
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
                            {$id}
                            {$school}
                            
                        </div>
                    </div>
                </div>
                HTML;

            } else{
                echo "Credentials Error";
            }
            return $HTML;
        }
    }
?>