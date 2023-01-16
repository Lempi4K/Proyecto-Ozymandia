<?php
    class AsideModel{
        //Miembros de datos
        private $cursor;
        private $errors = "";

        //Constructor
        public function __construct($article_id){
            try{
                $article_id = (int) $article_id;
                $query = array(
                    '$and' => array(
                        array("meta.type" => 3),
                        array("meta.id" => $article_id),
                        array("delete" => false)
                    )
                );
                $mongo = Simple_MongoDB::connection("ARTICLES_DATA", 1);
                $this->cursor = $mongo->ARTICLES_DATA->RECIPES->find($query);
            }catch (Exception $e){
                $this->errors = $this->errors . "PHP.profile_model:Construct:DB-Error:" . $e->getMessage() . ";";
            }
        }

        //setters & getters
        public function getCursor(){
            return $this->cursor;
        }
        public function getErrors(){
            return $this->errors;
        }
    }
?>