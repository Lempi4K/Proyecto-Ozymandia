<?php
    use Firebase\JWT\JWT;
    class ProfileModel{
        //Miembros de datos
        private $data = null;
        private $db_handler;
        private $errors = "";

        //Constructor
        public function __construct(){
            if(isset($_COOKIE["token"])){
                $token_ck = $_COOKIE["token"];
                $dataT = JWT::decode($_COOKIE["token"], "P.O.");

                $user_id = $dataT->uid;

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
                $this->errors = $this->errors . "PHP.profile_model:Construct:DB-Error:Cookie-Empty;";
            }
        }

        //setters & getters
        public function getData(){
            return $this->data;
        }
        public function getErrors(){
            return $this->errors;
        }
    }
?>