<?php 
    include("profile/view/profile_view.php");
    include("profile/model/profile_model.php");

    class ProfileController{
        //Miembros de datos
        private $model;
        private $view;
        private $section;
        private $start;
        private $HTML;


        //Constructor
        public function __construct($section, $start){
            $this->section = $section;
            $this->start = $start;
            $this->model = new ProfileModel($section, $start);
            $this->view = new ProfileView($this->model);
        }

        //Funciones
        public function getHTML(){
            if($this->section == 0){
                return $this->view->displayInterface();
            }
            if($this->section == 1){
                return $this->view->displayProfileData();
            }
            
            if($this->start != 0){
                return $this->view->displayOwnArticles();
            }

            if($this->section == 2){

                return <<< HTML
                <div class="articles-container articles-container_Profile" id="articles-container">
                    {$this->view->displayOwnArticles()}
                </div>
            HTML;
            }
        }
    }
?>