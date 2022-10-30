<?php
    include($_SERVER['DOCUMENT_ROOT']."/php/includes/def_1/search.php");
    
    class SearchController{
        //Miembros de datos
        private $search;
        private $subtype;
        private $model;
        private $view;
        private $HTML;


        //Constructor
        public function __construct($search_c, $subtype_c){
            $this->search = $search_c;
            $this->subtype = $subtype_c;
        }

        //Funciones
        public function getHTML(){
            $searchBar = displaySearchBar();

            $this->HTML = <<< HTML
                <div class="schTopBar-container">
                    {$searchBar}
                </div>
            HTML;

            return $this->HTML;
        }
    }
?>