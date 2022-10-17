<?php
    class MainView{
        //Miembros de datos
        private $model;
        public $count;
        private $HTML;

        //constructor
        public function __construct($model){
            $this->model = $model;
        }

        //Funciones
        public function displayArticles(){
            if($this->model->getCursor() == null){
                return <<< HTML
                        <h3>Error: {$this->model->getErrors()}</h3>
                    HTML;
            }
            $cursor = $this->model->getCursor()->toArray();
            $this->count = count( $cursor );
            if($this->count > 0){
                foreach($cursor as $item){
                    if((empty($_COOKIE["token"]) xor $item["meta"]["label"] != 3) || !empty($_COOKIE["token"])){
                        $this->HTML .= articleDecoder($item, ($this->model->article_id == 0 ? false : true));
                        $this->HTML .=  <<< HTML
                            <br>
                        HTML;
                    } else{
                        $this->HTML .=  <<< HTML
                            <h3>Contenido no disponible</h3>
                        HTML;
                    }
                }
            } else{
                if($this->model->getStart() == 0){
                    $this->HTML .= <<< HTML
                        <h3>No hay contenido</h3>
                    HTML;
                }
                $this->HTML .= <<< HTML

                HTML;
            }
            return $this->HTML;
        }
    }
?>