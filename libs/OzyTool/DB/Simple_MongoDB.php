<?php
    namespace OzyTool\DB;
    require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
    use MongoDB;
    use Exception;
    /**
     * Devuelve una conexión a una base de datos de MongoDB
     */
    class Simple_MongoDB{
        
        /**
         * Devuelve el objeto para manejar la conexion a MongoDB
         */
        public static function connection($conection_string){                                
            try{
                return new MongoDB\Client($conection_string);
                //echo "<script>console.log('PHP: Conexion a $dbname en $host exitosa');</script>";
            } catch(Exception $e){
                return null;
            }
        }
    }
?>
