<?php
    class MySQL_Class{
        //Miembros de datos
        private $dbh;
        private $result;
        
        //Constructor
        public function __construct($host, $dbname, $user, $pass){
            try{
                $this->dbh = new PDO("mysql:host=$host;dbname=$dbname",
                                          $user, $pass);
                //echo "Conexion a $dbname en $host exitosa";
            } catch(PDOException $e){
                //echo "Conexion a $dbname en $host no posible: " . $e->getMessage();
            }
        }

        //Destructor
        public function __destruct(){
            $this->dbh = null;
            //echo "<br>Se ha cerrado la conexion";
        }

        //Metodos
        public function console($query, $tasks = array()){
            $this->result = null;
            try{
                $this->result = $this->dbh->prepare($query);
                $this->result->execute($tasks);
                return $this->result;
            } catch(PDOException $e){
                echo "Accion CRUD no posible: $e->getMessage()";
            }

        }

        public function console_FV($query, $tasks = array()){
            $result_c = $this->console($query, $tasks);
            $result_c->setFetchMode(PDO::FETCH_BOTH);
            return $result_c->fetch();
        }

        //Setters & Getters
        public function getDbh(){
            return $this->dbh;
        }
    }
?>