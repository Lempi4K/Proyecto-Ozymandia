<?php
    include("nav/view/nav_view.php");
    include("nav/model/nav_model.php");

    class NavController{
        //Miembros de datos
        private $article_id;
        private $subtype;
        private $model;
        private $view;
        private $HTML;


        //Constructor
        public function __construct($article_id, $subtype){
            $this->article_id = $article_id;
            $this->model = new NavModel($article_id, $subtype);
            $this->view = new NavView($this->model);
        }

        //Funciones
        public function getHTML(){
            if($this->article_id == null){
                return $this->view->displayCards();
            } else{
                return $this->view->displayArticle();
            }
        }
    }
?>