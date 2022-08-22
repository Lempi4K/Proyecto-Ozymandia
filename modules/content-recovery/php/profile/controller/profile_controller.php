<?php 
    include("profile/view/profile_view.php");
    include("profile/model/profile_model.php");

    class ProfileController{
        //Miembros de datos
        private $model;
        private $view;


        //Constructor
        public function __construct(){
            $this->model = new ProfileModel();
            $this->view = new ProfileView($this->model);
        }

        //Funciones
        public function getHTML(){
            return $this->view->displayProfile();
        }
    }
?>