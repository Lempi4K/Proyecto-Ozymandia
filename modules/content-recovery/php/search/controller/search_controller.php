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
                    <script src="/modules/search/search.js"></script>
                    <div class="schTopBar-container">
                HTML;
                $this->HTML .= displaySearchBar();
                $this->HTML .= <<< HTML
                    </div>
                HTML;
                $this->HTML .= <<< HTML
                        <div class="articles-container" id="articles-container">
                HTML;

                if(empty($this->q) && $this->sublabel == null){
                    $this->HTML .= <<< HTML
                            <h1>Fijados</h1>
                            <div class="aside_container aside_container_search">
                    HTML;

                    $this->HTML .= $this->view->displayCards();

                    $this->HTML .= <<< HTML
                            </div>
                    HTML;
                } else{
                    $this->HTML .= <<< HTML
                        <script src="/modules/events/LazyLoaders/lazy-load_1.js"></script>
                        <script src="/modules/events/main.js"></script>
                    HTML;
                    $this->HTML .= $this->view->displayArticles();
                }

                $this->HTML .= <<< HTML
                        </div>
                HTML;
            } else{
                $this->HTML .= <<< HTML
                    <script src="/modules/events/main.js"></script>
                HTML;
                $this->HTML .= $this->view->displayArticles();
            }
            return $this->HTML;
        }
    }
?>