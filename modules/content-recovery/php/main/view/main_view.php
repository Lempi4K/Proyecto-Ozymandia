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
                        <h3>No hay contenido: {$this->model->getErrors()}</h3>
                    HTML;
            }
            $cursor = $this->model->getCursor()->toArray();
            $this->count = count( $cursor );
            if($this->count > 0){
                foreach($cursor as $item){
                    if(empty($_COOKIE["token"]) xor $item["meta"]["label"] != 3){
                        $this->HTML .= articleDecoder($item, ($this->model->article_id == 0 ? false : true));
                        $this->HTML .=  <<< HTML
                            <br>
                        HTML;
                    }
                }
            } else{
                $this->HTML .= <<< HTML

                HTML;
            }
            return $this->HTML;
        }
    }
?>