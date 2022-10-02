<?php
    include("aside/view/aside_view.php");
    include("aside/model/aside_model.php");

    class AsideController{
        //Miembros de datos
        private $article_id;
        private $model;
        private $view;
        private $HTML;


        //Constructor
        public function __construct($article_id){
            $this->article_id = $article_id;
            $this->model = new AsideModel($article_id);
            $this->view = new AsideView($this->model);
        }

        //Funciones
        public function getHTML(){
            return $this->view->displayArticle();
        }
    }
?>