<?php
    include("canvas/model/canvas_model.php");
    include("canvas/view/canvas_view.php");

    class CanvasController{
        //Miembros de datos
        private $article_id;
        private $model;
        private $view;

        //Constructor
        public function __construct($article_id){
            $this->article_id = $article_id;
            $this->model = new CanvasModel();
            $this->view = new CanvasView($this->model);
        }

        //Funciones
        public function getHTML(){
            return $this->view->displayCanvas();
        }
    }
?>