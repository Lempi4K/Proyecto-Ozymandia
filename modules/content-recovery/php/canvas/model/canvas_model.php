<?php
    use Firebase\JWT\JWT;

    class CanvasModel{
        //Miembros de datos
        private $labels = array();
        private $perm;
        private $sections = array();
        private $db_handler;
        private $errors = "";

        //Constructor
        public function __construct(){
            if(isset($_COOKIE["token"])){
                $token_ck = $_COOKIE["token"];
                $dataT = JWT::decode($_COOKIE["token"], "P.O.");

                $user_id = $dataT->uid;

                $this->perm = $dataT->prm;

                $query = "";
                switch ((int) $this->perm){
                    case 0:{
                        break;
                    }
                    case 1:{
                    }
                    case 2:{
                    }
                    case 3:{
                        $query = "select ET.NOMBRE as LABEL_N, ET.LABEL_ID as 'LABEL', SUET.NOMBRE as SUBLABEL_N , SUET.SUBLABEL_ID as 'SUBLABEL' from ETIQUETAS as ET join SUBETIQUETAS as SUET where ET.LABEL_ID = SUET.LABEL_ID and SUET.SUBLABEL_ID != 0 and SUET.SUBLABEL_ID != 4";
                        break;
                    }
                    case 4:{
                    }
                    case 6:{
                        $query = "select ET.NOMBRE as LABEL_N, PL.LABEL_ID as 'LABEL', SUET.NOMBRE as SUBLABEL_N , PL.SUBLABEL_ID as 'SUBLABEL' from PERM_LABELS as PL join ETIQUETAS as ET join SUBETIQUETAS as SUET where PL.USER_ID = $user_id and PL.LABEL_ID = ET.LABEL_ID and PL.LABEL_ID = SUET.LABEL_ID and PL.SUBLABEL_ID = SUET.SUBLABEL_ID;";
                        break;
                    }
                    case 5:{
                        $query = "select ET.NOMBRE as LABEL_N, SUET.LABEL_ID as 'LABEL', SUET.NOMBRE as SUBLABEL_N , SUET.SUBLABEL_ID as 'SUBLABEL' from ETIQUETAS as ET join SUBETIQUETAS as SUET where ET.LABEL_ID = 1 and SUET.LABEL_ID = 1 and SUET.SUBLABEL_ID = 4";
                        break;
                    }
                }
                
                try{
                    $this->db_handler = new S_MySQL("USER_DATA");
                    
                    $data = $this->db_handler->console($query);
                    $data->setFetchMode(PDO::FETCH_BOTH);
                    if(!$data == null){
                        while($row = $data->fetch()){
                            if($row["SUBLABEL_N"] === "*" && $row["LABEL"] != 3){
                                $label_id = $row["LABEL"];
                                $query = "select ET.NOMBRE as LABEL_N, SUET.LABEL_ID as 'LABEL', SUET.NOMBRE as SUBLABEL_N , SUET.SUBLABEL_ID as 'SUBLABEL' from SUBETIQUETAS as SUET join ETIQUETAS as ET where SUET.LABEL_ID = $label_id and SUET.SUBLABEL_ID != 0 and ET.LABEL_ID = SUET.LABEL_ID;";
                                
                                $this->db_handler = new S_MySQL("USER_DATA");
                                $data_addi = $this->db_handler->console($query);
                                $data_addi->setFetchMode(PDO::FETCH_BOTH);

                                while($row_addi = $data_addi->fetch()){
                                    array_push($this->labels, $row_addi);
                                }
                                continue;
                            }
                            array_push($this->labels, $row);
                        }
                    }

                    $this->db_handler = new S_MySQL("ARTICLES");
                    $data = $this->db_handler->console($query);
                    $data->setFetchMode(PDO::FETCH_BOTH);
                    if(!$data == null){
                        while($row = $data->fetch()){
                            array_push($this->sections, $row);
                        }
                    } else{

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