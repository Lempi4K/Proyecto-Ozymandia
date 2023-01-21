<?php
    use OzyTool\OzyTool;
    class IndexModel{
        //Miembros de datos
        /** 
         * Manejador de la base de datos
         * @var PDO
        */
        private $db_handler;

        /** 
         * Permiso del usuario
         * @var int
        */
        private $perm;

        /** 
         * Nombre del usuario
         * @var string
        */
        private $name;

        /** 
         * Cursor de los articulos fijados
         * @var MongoDB_Cursor
        */
        private $aside_cursor;

        /** 
         * Validez del token
         * @var boolean
        */
        private $valid_token = true;

        /** 
         * Errores de la clase
         * @var string
        */
        private $errors = "";

        //Constructor
        public function __construct(){
            $ozy_tool = new OzyTool();
            if(isset($_COOKIE["token"])){

                $token = $_COOKIE["token"];
                try{
                    $tokenData = $ozy_tool->jwt_decode($token);
                }catch (Exception $e){
                    $this->valid_token = false;
                    return;
                }
                if(($tokenData->exp - time()) <= 0){
                    $this->valid_token = false;
                }
                $this->perm = (int) $tokenData->prm;

                try{
                    $this->db_handler =  $ozy_tool->MySQL();

                    if(! $this->db_handler->exist("'" . $token . "'", "TOKEN", "CREDENCIALES")){
                        $this->valid_token = false;
                    }
                    

                    $query = "select NOMBRES from " . (($this->perm > 0 && $this->perm < 5)? "DOCENTES" : "ALUMNOS") . " where USER_ID = " . $tokenData->uid . ";";
                    $names = $this->db_handler->console_FV($query);
                    //echo "<script> console.log('". $names . "') </script>";
                    if($names == null){
                        $query = "select NOMBRES from ALUMNOS where USER_ID = " . $tokenData->uid . ";";
                        $names = ($this->db_handler->console_FV($query));
                    }

                    $names = $names["NOMBRES"];
                    //echo "<h3>" . explode($names, " ") .  "</h3>";
                    if(strpos($names, " ") ){
                        $this->name = substr($names, 0, strpos($names, " "));
                    }else{
                        $this->name = $names;
                    }

                    $query = array(
                        '$and' => array(
                            array("meta.type" => 3),
                            array("delete" => false)
                        )
                    );
                    $mongo = $ozy_tool->MongoDB();
                    $this->aside_cursor = $mongo->ARTICLES_DATA->RECIPES->find($query);
                } catch(Exception $e){
                    $this->errors = $this->errors . "PHP.profile_model:Construct:DB-Error:" . $e->getMessage() . ";";
                }
            }
            else{
                $this->perm = -1;
                try{
                    $query = array(
                        '$and' => array(
                            array("meta.type" => 3),
                            array("delete" => false)
                        )
                    );
                    $mongo = $ozy_tool->MongoDB();
                    $this->aside_cursor = $mongo->ARTICLES_DATA->RECIPES->find($query);
                } catch(Exception $e){
                    $this->errors = $this->errors . "PHP.profile_model:Construct:DB-Error:" . $e->getMessage() . ";";
                }
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
        public function getAside_cursor(){
            return $this->aside_cursor;
        }
    }
?>