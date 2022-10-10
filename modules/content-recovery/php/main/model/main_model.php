<?php
    use Firebase\JWT\JWT;
    class MainModel{
        //Miembros de datos
        private $cursor;
        private $errors = "";
        public $subtype;
        public $article_id;

        //Constructor
        public function __construct($section = 0, $article_id, $start = 0){
            $this->article_id = (int) $article_id;
            $query = array(
                '$and' => array(
                    array("meta.type" => 1),
                    array("meta.label" => 0),
                    array("meta.id" => array('$lte' => $start)),
                    array("delete" => false),
                    array(
                        '$or' => array(   
                        )
                    )
                )
            );
            switch ($section){
                case (0):{}
                case (1):{
                    $query['$and'][1]["meta.label"] = 1;
                    array_push($query['$and'][4]['$or'], array( "meta.sublabel" => 1 ));

                    if(!empty($_COOKIE["token"])){
                        $dataT = JWT::decode($_COOKIE["token"], "P.O.");
                        $perm = $dataT->prm;

                        if($perm > 0 && $perm < 3){
                            array_push($query['$and'][4]['$or'], array("meta.sublabel" => 2));
                            array_push($query['$and'][4]['$or'], array("meta.sublabel" => 3));
                            break;
                        }
                        if($perm == 4){
                            array_push($query['$and'][4]['$or'], array("meta.sublabel" => 3));
                            break;
                        }
                        if($perm == 0 || $perm > 4){
                            array_push($query['$and'][4]['$or'], array("meta.sublabel" => 2));
                            break;
                        }
                    } else{
                        $query['$and'][1]["meta.label"] = 3;
                        array_pop($query['$and']);
                    }
                    break;
                }
                case (2):{
                    $query['$and'][1]["meta.label"] = 2;
                    array_pop($query['$and']);
                    break;
                }
                case (3):{
                    try{
                        $query['$and'][1]["meta.label"] = 2;
                        $dataT = JWT::decode($_COOKIE["token"], "P.O.");
                        $uid = $dataT->uid;
                        $sql = "select LABEL_ID as LABEL, SUBLABEL_ID as SUBLABEL from USER_LABELS where USER_ID = $uid;";

                        $db_handler = new S_MySQL("USER_DATA");
                        $data = $db_handler->console($sql);

                        if($data == null){
                            array_push($query['$and'][4]['$or'], array( "meta.sublabel" => 0 ));
                            break;
                        }

                        $data->setFetchMode(PDO::FETCH_BOTH);

                        while($row = $data->fetch()){
                            array_push($query['$and'][4]['$or'], array( "meta.sublabel" => (int)$row["SUBLABEL"] ));
                        }

                    }catch (Exception $e){
                        array_push($query['$and'][4]['$or'], array( "meta.sublabel" => 0 ));
                        break;
                    }
                    break;
                }
                default: {
                    if($article_id != 0){
                        $query = array(
                            '$and' => array(
                                array("meta.type" => 1),
                                array("meta.id" => $this->article_id),
                                array("delete" => false)
                            )
                        );
                        break;
                    }
                }
            }

            $options = [
                    "sort" => ["meta.id" => -1],
                    "limit" => 10
                ];

            try{
                $mongo = Simple_MongoDB::connection("ARTICLES_DATA", 1);

                if($start == 0){
                    $count = $mongo->ARTICLES_DATA->RECIPES->count();
                    $query['$and'][2]["meta.id"]['$lte'] = $count;
                }
                $this->cursor = $mongo->ARTICLES_DATA->RECIPES->find($query, $options);
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