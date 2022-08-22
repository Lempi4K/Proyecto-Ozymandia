<?php
    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MySQL_lib/Simple_MySQL.php");
    include($_SERVER['DOCUMENT_ROOT']."/libs/php-jwt-master/src/JWT.php");
    use Firebase\JWT\JWT;

    class IndexModel{
        //Miembros de datos
        private $db_handler;
        private $perm;
        private $name;
        private $valid_token = true;
        private $errors = "";

        //Constructor
        public function __construct(){
            if(isset($_COOKIE["token"])){
                $token = $_COOKIE["token"];
                try{
                    $tokenData = JWT::decode($token, "P.O.");
                }catch (Exception $e){
                    $this->valid_token = false;
                    return;
                }
                if(($tokenData->exp - time()) <= 0){
                    $this->valid_token = false;
                }
                $this->perm = $tokenData->prm;

                try{
                    $this->db_handler =  new S_MySQL("USER_DATA");

                    if(! $this->db_handler->exist("'" . $token . "'", "TOKEN", "CREDENCIALES")){
                        $this->valid_token = false;
                    }
                    

                    $query = "select NOMBRES from " . (($this->perm == 0 || $this->perm == 5)? "ALUMNOS" : "DOCENTES") . " where USER_ID = " . $tokenData->uid . ";";
                    $names = ($this->db_handler->console_FV($query))["NOMBRES"];
                    //echo "<script> console.log('". $names . "') </script>";
                    if($names == null){
                        $query = "select NOMBRES from ALUMNOS where USER_ID = " . $tokenData->uid . ";";
                        $names = ($this->db_handler->console_FV($query))["NOMBRES"];
                    }
                    if(strpos($names, " ")){
                        $this->name = explode($names, " ")[0];
                    }else{
                        $this->name = $names;
                    }
                } catch(Exception $e){
                    $this->errors = $this->errors . "PHP.profile_model:Construct:DB-Error:" . $e.getMessage() . ";";
                }
            }
            else{
                $this->perm = -1;
            }
        }

        //Setters & Getters
        public function getPerm(){
            return $this->perm;
        }
        public function getName(){
            return $this->name;
        }
        public function getErrors(){
            return $this->errors;
        }
        public function getValid_token(){
            return $this->valid_token;
        }
    }
?>