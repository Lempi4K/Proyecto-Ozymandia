<?php
    use Firebase\JWT\JWT;
    class NavModel{
        //Miembros de datos
        private $cursor;
        private $errors = "";
        public $subtype;

        //Constructor
        public function __construct($article_id, $subtype){
            $article_id = (int) $article_id;
            $this->subtype = $subtype;
            if(isset($_COOKIE["token"])){
                $dataT = JWT::decode($_COOKIE["token"], "P.O.");
                $perm = $dataT->prm;
                $visibility = ($perm > 4 || $perm < 1) ? 2 : 3;

                try{
                    $mongo = Simple_MongoDB::connection("ARTICLES_DATA", 1);
                    $query = array();
                    if($article_id == null){
                        $query = array(
                            '$and' => array(
                                array("meta.type" => 2),
                                array("meta.subtype" => $subtype),
                                array("delete" => false),
                                array(
                                    '$or' => array(   
                                        array("meta.visibility" => 1),
                                        array("meta.visibility" => $visibility)
                                    )
                                )
                            )
                        );
                        if($perm == 1){
                            $query = array(
                                '$and' => array(
                                    array("meta.type" => 2),
                                    array("meta.subtype" => $subtype),
                                    array("delete" => false),
                                    array(
                                        '$or' => array(   
                                            array("meta.visibility" => 1),
                                            array("meta.visibility" => 2),
                                            array("meta.visibility" => 3)
                                        )
                                    )
                                )
                            );
                        }
                    } else{
                        $query = array(
                            '$and' => array(
                                array("meta.type" => 2),
                                array("meta.subtype" => $subtype),
                                array("meta.id" => $article_id),
                                array("delete" => false),
                                array(
                                    '$or' => array(   
                                        array("meta.visibility" => 1),
                                        array("meta.visibility" => $visibility)
                                    )
                                )
                            )
                        );

                        if($perm == 1){
                            $query = array(
                                '$and' => array(
                                    array("meta.type" => 2),
                                    array("meta.subtype" => $subtype),
                                    array("meta.id" => $article_id),
                                    array("delete" => false),
                                    array(
                                        '$or' => array(   
                                            array("meta.visibility" => 1),
                                            array("meta.visibility" => 2),
                                            array("meta.visibility" => 3)
                                        )
                                    )
                                )
                            );
                        }
                    }
                    $this->cursor = $mongo->ARTICLES_DATA->RECIPES->find($query);
                }catch (Exception $e){
                    $this->errors = $this->errors . "PHP.profile_model:Construct:DB-Error:" . $e->getMessage() . ";";
                }
            } else{
                try{
                    $mongo = Simple_MongoDB::connection("ARTICLES_DATA", 1);
                    $query = array();
                    if ($article_id == null){
                        $query = array(
                            '$and' => array(
                                array("meta.type" => 2),
                                array("meta.subtype" => $subtype),
                                array("meta.visibility" => 1),
                                array("delete" => false),
                                )
                            );
                    } else{
                        $query = array(
                            '$and' => array(
                                array("meta.type" => 2),
                                array("meta.subtype" => $subtype),
                                array("meta.id" => $article_id),
                                array("meta.visibility" => 1),
                                array("delete" => false),
                                )
                            );
                    }
                    $this->cursor = $mongo->ARTICLES_DATA->RECIPES->find($query);
                }catch (Exception $e){
                    $this->errors = $this->errors . "PHP.profile_model:Construct:DB-Error:" . $e->getMessage() . ";";
                }
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