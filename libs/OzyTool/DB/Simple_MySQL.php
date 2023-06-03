<?php
namespace OzyTool\DB;
use PDO;
use Exception;
    /**
     * Simplifica el acceso a MySQL por PDO
     */
    class Simple_MySQL{
        //Miembros de datos
        /** 
         * Manejador de la base de datos
         * @var PDO
        */
        private $dbh;

        /** 
         * Resultado de la base de datos
         * @var PDOStatement
        */
        private $result;
        
        //Constructor
        public function __construct($connection_string, $user, $password){
            try{
                $this->dbh = new PDO($connection_string, $user, $password);
                //echo "<script>console.log('PHP: Conexion a $dbname en $host exitosa');</script>";
            } catch(Exception $e){
                return null;
            }
        }

        //Destructor
        public function __destruct(){
            $this->dbh = null;
            //echo "<script>console.log('PHP: Se ha cerrado la conexion a la base de datos');</script>";
        }

        //Metodos
        /** 
         * Simplifica la tarea de hacer peticiones a la base de datos
         * @param string $query
         * @param array $tasks
         * @return PDOStatement
         * @throws PDOException
        */
        public function console($query, $tasks = array()){
            $this->result = null;
            try{
                $this->result = $this->dbh->prepare($query);
                $this->result->execute($tasks);
                return $this->result;
            } catch(\Throwable $e){
                echo  $e->getMessage();
            }
        }

        /** 
         * Devuelve el primer valor de la petición
         * @param string $query
         * @param array $tasks
         * @return array
         * @throws PDOException
        */
        public function console_FV($query, $tasks = array()){
            $result_c = $this->console($query, $tasks);
            $result_c->setFetchMode(PDO::FETCH_BOTH);
            return $result_c->fetch();
        }

        /** 
         * Verifica si existe un valor en la tabla
         * @param mixed $value
         * @param string $column
         * @param string $table
         * @return boolean
         * @throws PDOException
        */
        public function exist($value, $column, $table){
            $query = "select count(1) as EXIST from $table where $column = $value;";
            return (($this->console_FV($query)["EXIST"] != 0)? true : false);
        }

        //Setters & Getters
        public function getDbh(){
            return $this->dbh;
        }
    }
?>