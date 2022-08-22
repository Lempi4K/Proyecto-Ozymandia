<?php
    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MySQL_lib/Simple_MySQL.php");
    include($_SERVER['DOCUMENT_ROOT']."/libs/php-jwt-master/src/JWT.php");

    use Firebase\JWT\JWT;

    class ChkTkn_Model {
        //Miembros de datos
        private $result = true;
        private $db_handler;
        private $errors = "";

        //constructor
        public function __construct ($blkPerm){
            try{
                if(isset($_COOKIE["token"])){
                    $this->db_handler = new S_MySQL("USER_DATA");
                    
                    $token_ck = $_COOKIE["token"];
                    $query = "select count(*) as T from CREDENCIALES as CRED where CRED.TOKEN = '$token_ck'";
                    $token_lives = (($this->db_handler->console_FV($query)[0] == 1) ? true : false);
                    if($token_lives){
                        $user_id = (JWT::decode($_COOKIE["token"], "P.O.")->uid);
                        $query = "select PERM from USUARIOS where USER_ID = $user_id";
                        $perm = $this->db_handler->console_FV($query)["PERM"];
                        for($i = 0; $i < count($blkPerm); $i++){
                            if((int)$perm == (int)$blkPerm[$i]){
                                $this->result = false;
                                echo "AAA me doxxean";
                                break;
                            }
                        }
                    }
                }else if($blkPerm[0] == -2){
                    $this->result = true;
                }else {
                    $this->result = false;
                }
            }catch (Exception $e){
                $this->errors = $this->errors . 'PHP.check-token_model:Construct:DB-Error:' . $e->getMessage() . ';';
            }
        }

        //setters & getters
        public function getResult(){
            return $this->result;
        }
        public function getErrors(){
            return $this->errors;
        }
    }
?>