<?php
    class ProfileModel{
        //Miembros de datos
        private $data = null;
        private $cursor = null;
        private $db_handler;
        private $errors = "";
        private $start;

        //Constructor
        public function __construct($section, $start){
            $ozy_tool = new OzyTool\OzyTool();
            $this->start = $start;
            if(isset($_COOKIE["token"])){
                $dataT = $ozy_tool->jwt_decode($_COOKIE["token"]);

                $user_id = (int) $dataT->uid;

                if($section == 0 || $section == 1){
                    $perm = $dataT->prm;
                
                    if($perm == 0 || $perm == 5){
                        $query = "select ALU.*, USER.PERM, CRED.USER from ALUMNOS as ALU inner join USUARIOS as USER inner join CREDENCIALES as CRED where ALU.USER_ID = $user_id and USER.USER_ID = $user_id and CRED.USER_ID = $user_id";
                    } else{
                        $query = "select DOCE.*, USER.PERM, CRED.USER from DOCENTES as DOCE inner join USUARIOS as USER inner join CREDENCIALES as CRED where DOCE.USER_ID = $user_id and USER.USER_ID = $user_id and CRED.USER_ID = $user_id";
                    }
                    try{
                        $this->db_handler = new S_MySQL("USER_DATA");
                        
                        $this->data = $this->db_handler->console($query);
                        $this->data->setFetchMode(PDO::FETCH_OBJ);
                        $this->data = $this->data->fetch();
                        if($this->data == null){
                            $query = "select ALU.*, USER.PERM, CRED.USER from ALUMNOS as ALU inner join USUARIOS as USER inner join CREDENCIALES as CRED where ALU.USER_ID = $user_id and USER.USER_ID = $user_id and CRED.USER_ID = $user_id";
                            $this->data = $this->db_handler->console($query);
                            $this->data->setFetchMode(PDO::FETCH_OBJ);
                            $this->data = $this->data->fetch();
                        }
                    }catch (Exception $e){
                        $this->errors = $this->errors . "PHP.profile_model:Construct:DB-Error:" . $e->getMessage() . ";";
                    }
                } else{
                    $query = array(
                        '$and' => array(
                            array("meta.autor_uid" => $user_id),
                            array("meta.id" => array('$lte' => $start)),
                            array("delete" => false)
                        )
                    );

                    $options = [
                        "sort" => ["meta.id" => -1],
                        "limit" => 10
                    ];

                    try{
                        $mongo = Simple_MongoDB::connection("ARTICLES_DATA", 1);

                        if($start == 0){
                            $count = $mongo->ARTICLES_DATA->RECIPES->count();
                            $query['$and'][1]["meta.id"]['$lte'] = $count;
                            //$query['$and'][1]["meta.id"]['$lte'] = 5;
                        }
                        $this->cursor = $mongo->ARTICLES_DATA->RECIPES->find($query, $options);

                    }catch (Exception $e){
                        $this->errors = $this->errors . "PHP.profile_model:Construct:DB-Error:" . $e->getMessage() . ";";
                    }


                }


            } else{
                $this->errors = $this->errors . "PHP.profile_model:Construct:DB-Error:Cookie-Empty;";
            }
        }

        //setters & getters
        public function getData(){
            return $this->data;
        }
        public function getCursor(){
            return $this->cursor;
        }
        public function getStart(){
            return $this->start;
        }
        public function getErrors(){
            return $this->errors;
        }
    }
?>