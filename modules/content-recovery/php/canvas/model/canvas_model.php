<?php

use OzyTool\OzyTool;

    class CanvasModel{
        //Miembros de datos
        public $labels = array();
        public $labels_id = array();
        private $perm;
        private $sections = array();
        private $db_handler;
        private $errors = "";

        //Constructor
        public function __construct(){
            $ozy_tool = new OzyTool();
            if(isset($_COOKIE["token"])){
                $token_ck = $_COOKIE["token"];
                $dataT = $ozy_tool->jwt_decode($_COOKIE["token"], "P.O.");

                $user_id = $dataT->uid;

                $this->perm = $dataT->prm;
                $this->db_handler = $ozy_tool->MySQL();
                $user = $ozy_tool->User();
                $user->getSublabels();


                try{
                    $query = "select * from ETIQUETAS";
                    $cursor = $this->db_handler->console($query);
                    foreach($cursor as $item){
                        $this->labels_id[$item["NOMBRE"]] = $item["LABEL_ID"];
                    }


                    if($user->hasPerm("Ozy.Labels.Admin")){
                        $query = "select * from ETIQUETAS where LABEL_ID = 1";
                        $cursor = $this->db_handler->console($query);
    
                        $name = "";
                        foreach($cursor as $item){
                            $name = $item["NOMBRE"];
                            break;
                        }
                        $this->labels[$name] = [];
    
                        $query = "select * from SUBETIQUETAS where LABEL_ID = 1 and SUBLABEL_ID != 4 and SUBLABEL_ID != 0";
                        $cursor = $this->db_handler->console($query);

                        foreach($cursor as $item){
                            $this->labels[$name][$item["SUBLABEL_ID"]] = $item["NOMBRE"];
                        }
                    }
                    if($user->hasPerm("Ozy.Labels.Group", false) && !$user->hasPerm("Ozy.Labels.Admin")){
                        $query = "select * from ETIQUETAS where LABEL_ID = 1";
                        $cursor = $this->db_handler->console($query);
    
                        $name = "";
                        foreach($cursor as $item){
                            $name = $item["NOMBRE"];
                            break;
                        }
                        $this->labels[$name] = [];
    
                        $query = "select * from SUBETIQUETAS where LABEL_ID = 1 and SUBLABEL_ID = 4";
                        $cursor = $this->db_handler->console($query);

                        foreach($cursor as $item){
                            $this->labels[$name][$item["SUBLABEL_ID"]] = $item["NOMBRE"];
                        }
                    }

                    $general = $user->getSublabels()["G"];
                    $query = "select * from ETIQUETAS where LABEL_ID = 2";
                    $cursor = $this->db_handler->console($query);

                    $name = "";
                    foreach($cursor as $item){
                        $name = $item["NOMBRE"];
                        break;
                    }
                    $this->labels[$name] = $general;

                    if($user->hasPerm("Ozy.Labels.Invit")){
                        $query = "select * from ETIQUETAS where LABEL_ID = 3";
                        $cursor = $this->db_handler->console($query);
    
                        $name = "";
                        foreach($cursor as $item){
                            $name = $item["NOMBRE"];
                            break;
                        }
                        $this->labels[$name] = [];
                    }

                }catch (Exception $e){
                    $this->errors = $this->errors . "PHP.canvas_model:Construct:DB-Error:" . $e->getMessage() . ";";
                }
            } else{
                $this->errors = $this->errors . "PHP.canvas_model:Construct:DB-Error:Cookie-Empty;";
            }
        }

        public function getPerm(){
            return $this->perm;
        }

        public function getLabels(){
            return $this->labels;
        }

        public function getPermitedLabel($type){
            for($i = 0; $i < count($this->labels); $i++){
                if($this->labels[$i]["LABEL"] == $type){
                    return true;
                }
            }  
            return false;
        }

        public function getPermitedLabelName($type){
            for($i = 0; $i < count($this->labels); $i++){
                if($this->labels[$i]["LABEL"] == $type){
                    return $this->labels[$i]["LABEL_N"];
                }
            }  
            return "N/A";
        }

        public function getErrors(){
            return $this->errors;
        }
    }
?>