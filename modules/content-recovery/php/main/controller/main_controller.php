<?php 
    include("main/view/main_view.php");
    include("main/model/main_model.php");

    class MainController{
        //Miembros de datos
        private $section;
        public $article_id;
        private $model;
        private $view;
        private $start;
        private $HTML;

        //Constructor
        public function __construct($section, $article_id, $start){
            $this->section = (int)$section;
            $this->article_id = $article_id;
            $this->start = $start;
            $this->model = new MainModel($section, $article_id, $start);
            $this->view = new MainView($this->model);
        }

        //Funciones
        public function getHTML(){
            if(!empty($_COOKIE["token"])){
                if((int)$this->section != 0 && $this->article_id == 0){
                    return $this->view->displayArticles();
                }
    
                if($this->article_id == 0){
                    $this->HTML = <<< HTML
                        <div class="article_divisor divisor-events">
                            <div>
                                <input type="radio" name="inpRdbtnArtdiv" id="inpRdbtnArtdiv1" value="2">
                                <label for="inpRdbtnArtdiv1">General</label>
                            </div>
                            <div>
                                <input type="radio" name="inpRdbtnArtdiv" id="inpRdbtnArtdiv2" value="1" checked>
                                <label for="inpRdbtnArtdiv2">Administrativo</label>
                            </div>
                            <div>
                                <input type="radio" name="inpRdbtnArtdiv" id="inpRdbtnArtdiv3" value="3">
                                <label for="inpRdbtnArtdiv3">Siguiendo</label>
                            </div>
                        </div>
                        
                        <div class="articles-container" id="articles-container">
                    HTML;
                }else {
                    $this->HTML = <<< HTML
                        <div class="articles-container articles-container-single">
                    HTML;
                }
                $this->HTML .= $this->view->displayArticles();
                $this->HTML .= <<< HTML
                    </div>
                HTML;
                return $this->HTML;
            } else{
                $this->HTML = <<< HTML
                    <div class="articles-container articles-container-single">
                HTML;
                $this->HTML .= $this->view->displayArticles();
                $this->HTML .= <<< HTML
                    </div>
                HTML;
                return $this->HTML;
            }
        } 
    }
?>