<?php
    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MySQL_lib/Simple_MySQL.php");
    include($_SERVER['DOCUMENT_ROOT']."/libs/php-jwt-master/src/JWT.php");

    use Firebase\JWT\JWT;
    class DrkModeModel{
        //Miembros de datos
        private $token;
        private $data;
        private $dkm;
        private $db_handler;
        private $errors = "";

        //constructor
        public function __construct (){
            try{
                if(isset($_COOKIE["token"])){
                    $this->token = $_COOKIE["token"];
                    $this->data = JWT::decode($this->token, "P.O.");
                    $this->dkm = $this->data->dkm;

                    $this->db_handler = new S_MySQL("USER_DATA");
                }else{
                    $this->dkm = 3;
                }
            }catch (Exception $e){
                $this->errors = $this->errors . 'PHP.drk-mode_model:Construct:DB-Error:' . $e->getMessage() . ';';
            }
        }

        //setters & getters
        public function getData(){
            return $this->data;
        }
        public function getDkm(){
            return $this->dkm;
        }
        public function getErrors(){
            return $this->errors;
        }
        public function setToken($nToken){
            if(!empty($nToken)){
                try{
                    $query = "update CREDENCIALES as CRED set CRED.TOKEN = '$nToken' where CRED.USER_ID = " . $this->data->uid . ";";
                    $this->db_handler->console($query);
                } catch(Exception $e){
                    $this->errors = $this->errors . 'PHP.drk-mode_model:F_setToken():DB-Error:' . $e->getMessage() . ';';
                }
            } else {
                $this->errors = $this->errors . 'PHP.drk-mode_model:F_setToken():$nToken empty;';
            }
        }
        public function setDkm($nDkm){
            if(!empty($nDkm)){
                $this->data->dkm = $nDkm;
                $nToken = JWT::encode((array) $this->data, "P.O.");
                try{
                    $query = "update CREDENCIALES as CRED set CRED.TOKEN = '$nToken' where CRED.USER_ID = " . $this->data->uid . ";";
                    $this->db_handler->console($query);
                    setcookie("token", $nToken, $this->data->exp, "/", $_SERVER["HTTP_HOST"], false, true);
                } catch(Exception $e){
                    $this->errors = $this->errors . 'PHP.drk-mode_model:F_setDkm():DB-Error:' . $e->getMessage() . ';';
                }
            } else {
                $this->errors = $this->errors . 'PHP.drk-mode_model:F_setDkm():$nDkm empty;';
            }
        }
    }
?>