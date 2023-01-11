<?php
    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MySQL_lib/Simple_MySQL.php");
    //include($_SERVER['DOCUMENT_ROOT']."/libs/php-jwt-master/src/JWT.php");
    require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    class ChkTkn_Model {
        //Miembros de datos
        /**
         * Resultado de la verificación
         * @var boolean
         */
        private $result = true;

        /**
         * Manejadror de la base de datos
         * @var S_MySQL
         */
        private $db_handler;

        /**
         * Errores de la clase
         * @var string
         */
        private $errors = "";

        //constructor
        public function __construct ($blkPerm){
            try{
                if(isset($_COOKIE["token"])){
                    $this->db_handler = new S_MySQL("USER_DATA");
                    try{
                        $token_ck = $_COOKIE["token"];
                        $query = "select count(*) as T from CREDENCIALES as CRED where CRED.TOKEN = '$token_ck'";
                        $token_lives = (($this->db_handler->console_FV($query)[0] == 1) ? true : false);
                        if($token_lives){
                            $user_id = (int) (JWT::decode($_COOKIE["token"], new Key("P.O.", "HS256"))->uid);
                            $query = "select PERM from USUARIOS where USER_ID = $user_id";
                            $perm = $this->db_handler->console_FV($query)["PERM"];

                            $this->result =  array_key_exists($perm, $blkPerm);
                            //echo "AAA me doxxean";
                        }
                    }catch (Exception $e){
                        $this->result = false;
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