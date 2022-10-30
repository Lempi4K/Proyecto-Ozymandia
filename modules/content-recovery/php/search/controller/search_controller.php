<?php
    include($_SERVER['DOCUMENT_ROOT']."/php/includes/def_1/search.php");
    include("search/view/search_view.php");
    include("search/model/search_model.php");
    class SearchController{
        //Miembros de datos
        private $q;
        private $sublabel;
        private $order;
        private $start;
        private $model;
        private $view;
        private $HTML;


        //Constructor
        public function __construct($q, $sublabel, $order, $start){
            $this->q = $q;
            $this->sublabel = $sublabel;
            $this->order = $order;
            $this->start = $start;
            $this->model = new SearchModel($q, $sublabel, $order, $start);
            $this->view = new SearchView($this->model);
        }

        //Funciones
        public function getHTML(){
            if($this->start == 0){
                $this->HTML = <<< HTML
                    <div class="schTopBar-container">
                HTML;
                $this->HTML .= displaySearchBar();
                $this->HTML .= <<< HTML
                    </div>
                HTML;
                $this->HTML .= <<< HTML
                        <div class="articles-container" id="articles-container">
                HTML;

                if($this->q == null && $this->sublabel == null){
                    $this->HTML .= <<< HTML
                            <div class="aside_container aside_container_search">
                                <h1>Atados</h1>
                    HTML;

                    $this->HTML .= $this->view->displayCards();

                    $this->HTML .= <<< HTML
                            </div>
                    HTML;
                } else{
                    $this->HTML .= $this->view->displayArticles();
                }

                $this->HTML .= <<< HTML
                        </div>
                HTML;
            } else{
                $this->HTML .= $this->view->displayArticles();
            }
            return $this->HTML;
        }
    }
?>