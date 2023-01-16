<?php
    class AsideView{
        //Miembros de datos
        private $model;
        private $HTML;

        //constructor
        public function __construct($model){
            $this->model = $model;
        }

        //Funciones

        public function displayArticle(){
            $this->HTML = <<< HTML
                <div class="articles-container articles-container-single">
            HTML;
            $cursor = $this->model->getCursor()->toArray();
            if(count( $cursor ) > 0){
                foreach($cursor as $item){
                    $this->HTML .= articleDecoder($item, true);
                }
            } else{
                $this->HTML .= <<< HTML
                    <h3>No hay contenido</h3>
                HTML;
            }
            $this->HTML .= <<< HTML
                </div>
            HTML;
            return $this->HTML;
        }
    }
?>