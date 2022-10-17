<?php
    require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
    class Simple_MongoDB{
        
        //Constructor
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
            } catch(PDOException $e){
                //echo "<script>console.log('PHP: Conexion a $dbname no posible: " . $e->getMessage() . "');</script>";
            }
        }
    }
?>
