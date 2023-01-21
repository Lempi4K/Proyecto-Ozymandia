<?php
    use OzyTool\OzyTool;
    include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");

    class ChkTkn_Model {
        //Miembros de datos
        /**
         * Resultado de la verificación
         * @var boolean
         */
        private $result;

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
            $ozy_tool = new OzyTool();
            $this->result = $ozy_tool->User()->hasPerm($blkPerm);
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