<?php
    use Firebase\JWT\JWT;
    class SearchModel{
        //Miembros de datos
        private $cursor;
        private $start;
        private $errors = "";
        private $aside_cursor;
        public $subtype;

        //Constructor
        public function __construct($q, $sublabel, $order, $start){
            $this->start = $start;
            $query = null;
            $options = null;

            $orderSTR = (int) $order == -1 ? '$lte' : '$gte';

            if($q == null && $sublabel == null && $order == -1){
                $query = array(
                    '$and' => array(
                        array("meta.type" => 3),
                        array("delete" => false)
                    )
                );

                $options = [
                    "sort" => ["meta.id" => 1]
                ];
            } else{
                $query = array(
                    '$and' => array(
                        array("meta.type" => 1),
                        array("meta.id" => array($orderSTR => (int) $start)),
                        array("delete" => false),
                        ['$text' => 
                            ['$search' => "\"$q\""]
                        ], 
                    )
                );
                if($q === ""){
                    array_pop($query['$and']);
                }

                if((int) $sublabel != 0){
                    array_push($query['$and'], ["meta.sublabel" => (int) $sublabel]);
                    array_push($query['$and'], ["meta.label" => 2]);
                } else{
                    if(isset($_COOKIE["token"])){
                        $dataT = JWT::decode($_COOKIE["token"], "P.O.");
                        $perm = (int) $dataT->prm;
                        //Bsucar forma de mejorar seguridad
                        array_push($query['$and'], ["meta.label" => 1]);

                        if($perm == 0 || $perm > 4){
                            array_push($query['$and'],
                                [   
                                    '$or' => [
                                        ["meta.sublabel" => 1],
                                        ["meta.sublabel" => 2]
                                    ]
                                ]
                            );
                        }
                        if($perm == 4){
                            array_push($query['$and'],
                                [   
                                    '$or' => [
                                        ["meta.sublabel" => 1],
                                        ["meta.sublabel" => 2],
                                        ["meta.sublabel" => 3]
                                    ]
                                ]
                            );
                        }
                    }
                }

                $options = [
                    "sort" => ["meta.id" => (int) $order],
                    "limit" => 10
                ];
            }



            try{

                $mongo = Simple_MongoDB::connection("ARTICLES_DATA", 1);
                if((int) $start == 0 && $query['$and'][0]["meta.type"] != 3){
                    if($order == -1){
                        $count = $mongo->ARTICLES_DATA->RECIPES->count();
                        $query['$and'][1]["meta.id"][$orderSTR] = $count;
                    } else{
                        $query['$and'][1]["meta.id"][$orderSTR] = 1;
                    }

                }
                $this->cursor = $mongo->ARTICLES_DATA->RECIPES->find($query, $options);
            } catch(Exception $e){
                $this->errors = $this->errors . "PHP.profile_model:Construct:DB-Error:" . $e->getMessage() . ";";
            }
        }


        //setters & getters
        public function getCursor(){
            return $this->cursor;
        }
        public function getStart(){
            return $this->start;
        }
        public function getAside_Cursor(){
            return $this->aside_cursor;
        }
        public function getErrors(){
            return $this->errors;
        }
    }
?>