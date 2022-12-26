<?php
    require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
    /**
     * Devuelve una conexión a una base de datos de MongoDB
     */
    class Simple_MongoDB{
        
        /**
         * Devuelve el objeto para manejar la conexion a MongoDB
         */
        public static function connection($dbname = "admin", $conf = 0, $host = "127.0.0.1", $port = "27017"){
            $user = "";
            $pass = "";
            switch ($conf){
                case 0:{
                    $user = "User";
                    $pass = "090722User*";
                    break;
                }
                case 1:{
                    $user = "Admin";
                    $pass = "090722Admin*";
                    break;
                }
                case 2:{
                    $user = "Editor";
                    $pass = "090722Editor*";
                    break;
                }
            }

            $conection_string = "mongodb://$user:$pass@$host:$port/?authSource=admin";
            //$conection_string = "mongodb://127.0.0.1:27017/"; 
                                
            try{
                return new MongoDB\Client($conection_string);
                //echo "<script>console.log('PHP: Conexion a $dbname en $host exitosa');</script>";
            } catch(Exception $e){
                //echo "<script>console.log('PHP: Conexion a $dbname no posible: " . $e->getMessage() . "');</script>";
            }
        }
    }
?>
