<?php
    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MySQL_lib/Simple_MySQL.php");
    class Login_Model{
        //Miembros de datos
        private $validate = false;
        private $user_id;
        private $token = false;
        private $perm = 0;
        private $db_handler;
        private $errors = "";

        //Constructor
        public function __construct($user, $pass){
            if(!(empty($user) && empty($pass))){
                try{
                    $this->db_handler = new S_MySQL("USER_DATA");

                    $query = "select count(*) as C from CREDENCIALES as CRED where CRED.USER = '$user' and CRED.PASS = '$pass'";
                    $this->validate = (($this->db_handler->console_FV($query)["C"] > 0)? true : false);

                    if($this->validate){
                        $query = "select USER_ID as UID from CREDENCIALES as CRED where CRED.USER = '$user' and CRED.PASS = '$pass'";
                        $this->user_id = $this->db_handler->console_FV($query)["UID"]; 
    
                        $query = "select count(*) as C from CREDENCIALES as CRED where CRED.USER_ID = " . $this->user_id . " and CRED.TOKEN is not null";
                        $this->token = (($this->db_handler->console_FV($query)["C"] > 0)? true : false);

                        $query = "select PERM from USUARIOS as US where US.USER_ID = " . $this->user_id;
                        $this->perm = $this->db_handler->console_FV($query)["PERM"];
                    }
                } catch(Exception $e){
                    $this->errors = $this->errors . 'PHP.login_model:Construct:DB-Error:' . $e->getMessage() . ';';
                }
            } else{
                $this->errors = $this->errors . 'PHP.login_model:Construct:User-Pass empty;';
            }
        }

        //setters & getters
        public function setToken($nToken){
            if(!empty($nToken)){
                try{
                    $query = "update CREDENCIALES as CRED set CRED.TOKEN = '$nToken' where CRED.USER_ID = " . $this->user_id . ";";
                    $this->db_handler->console($query);
                } catch(Exception $e){
                    $this->errors = $this->errors . 'PHP.login_model:F_setToken():DB-Error:' . $e->getMessage() . ';';
                }
            } else {
                $this->errors = $this->errors . 'PHP.login_model:F_setToken():$nToken empty;';
            }
        }
        public function getTokenStr(){
            try{
                $query = "select TOKEN as T from CREDENCIALES as CRED where CRED.USER_ID = " . $this->user_id;
                return $this->db_handler->console_FV($query)["T"];
            } catch(Exception $e){
                $this->errors = $this->errors . 'PHP.login_model:F_getTokenStr():DB-Error:' . $e->getMessage() . ';';
            }
        }
        public function getToken(){
            return $this->token;
        }
        public function getValidate(){
            return $this->validate;
        }
        public function getUser_id(){
            return $this->user_id;
        }
        public function getErrors(){
            return $this->errors;
        }
        public function setErrors($error){
            $this->errors = $this->errors . "" . $error;
        }
        public function getPerm(){
            return $this->perm;
        }
    }

?>