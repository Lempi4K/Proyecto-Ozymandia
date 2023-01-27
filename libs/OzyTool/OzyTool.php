<?php
namespace OzyTool;
require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

function ozy_autoload($classname){
    $namespace = explode("\\" , $classname)[0];
    if ($namespace == 'OzyTool') {
      $classname = str_replace ('\\', '/', $classname);
      $filename = "libs/". $classname .".php";
      require_once( $_SERVER['DOCUMENT_ROOT'] . '/' .  $filename);
    }
}
spl_autoload_register("OzyTool\ozy_autoload");

use Exception;
use OzyTool\User;
use OzyTool\DB\Simple_MySQL;
use OzyTool\DB\Simple_MongoDB;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PhpZip\ZipFile;

/**
 * Herramienta con la cual se desarrolla el Proyecto Ozymandia
 */
class OzyTool{
    /**
     * Nombre del usuario en la base de datos
     * @var string
     */
    public string $db_user;

    /**
     * Contraseña de la base de datos
     * @var string
     */
    public string $db_password;

    /**
     * Host de la base de datos
     * @var string
     */
    public string $db_host = "127.0.0.1";

    /**
     * Puerto de la base de datos
     * @var string
     */
    public string $db_port = "27017";

    /**
     * Contraseña con la cual se encripta un token
     * @var string
     */
    public $jwt_pass = "P.O.";

    /**
     * Algoritmo con el cual se encripta un token
     * @var string
     */
    public $jwt_alg = "HS256";

    /**
     * Contraseña del zip
     * @var string
     */
    public $zipPass = "P.O.";

    /**
     * Tipo de usuarios en las bases de datos
     * @var array
     */
    public $types = [1 => "ALUMNOS", 2 => "DOCENTES"];

    public $regex_NOT = "[^`;=]";

    public function __construct($conf = 0){
        switch ($conf){
            case 0:{
                $this->db_user = "User";
                $this->db_password = "090722User*";
                break;
            }
            case 1:{
                $this->db_user = "Admin";
                $this->db_password = "090722Admin*";
                break;
            }
            case 2:{
                $this->db_user = "Editor";
                $this->db_password = "090722Editor*";
                break;
            }
        }
    }

    /**
     * Devuelve un driver con conexión a la base de datos del proyecto en MongoDB
     * @return MongoDB\Client||null
     */
    public function MongoDB(){
        $conection_string = "mongodb://{$this->db_user}:{$this->db_password}@{$this->db_host}:{$this->db_port}/?authSource=admin";
        try{
            return Simple_MongoDB::connection($conection_string);
        } catch(Exception $e){
            return null;
        }
    }

    /**
     * Devuelve un objeto con herramientas que simplifican el manejo de una base de datos de tipo MySQL
     * @param string $db_name Nombre de la base de datos
     * @return Simple_MySQL||null
     */
    public function MySQL($db_name = "USER_DATA"){
        $conection_string = "mysql:host={$this->db_host};dbname={$db_name}";
        try{
            return new Simple_MySQL($conection_string, $this->db_user, $this->db_password);
        } catch(Exception $e){
            return null;
        }
    }

    /**
     * Devuelve un objeto con los datos relevantes al usuario que está usando el proyecto
     * @return OzyTool\User||null
     */
    public function User($uid = 0){
        try{
            return new User($this, $uid);
        } catch(Exception $e){
            return null;
        }
    }

    /**
     * Devuelve un objeto con el payload del token
     * @param string $token Cadena del token
     * @throws InvalidArgumentException
     * @return stdClass payload
     */
    public function jwt_decode(string $token){
        return JWT::decode($token, new key($this->jwt_pass, $this->jwt_alg));
    }

    /**
     * Convierte arreglo asociativo en un token
     * @param array $payload Arreglo asociativo con el payload del token
     * @throws InvalidArgumentException
     * @return string JWT
     */
    public function jwt_encode(array $payload){
        return JWT::encode($payload, $this->jwt_pass, $this->jwt_alg);
    }

    public function postData(){
        header("Content-type: application/json; charset=utf-8");
        return json_decode(file_get_contents("php://input"), true);
    }

    public function displayErrorMessage($message){
        return <<< HTML
            <div class='display-error-main'>
                <p>
                    {$message}
                </p>
            </div>
        HTML;
    }

    public function defaultResponse(){
        return [
            "success" => true,
            "message" => "",
            "data" => [

            ],
            "error" => [
                "indicator" => false,
                "number" => 0,
                "message" => "",
            ],
            "warn" => [
                "indicator" => false,
                "number" => 0,
                "message" => "",
            ],
        ];
    }

    public function killApp($errorCode, $errorMessage){
        $response = $this->defaultResponse();
        $response["success"] = false;
        $response["error"]["indicator"] = true;
        $response["error"]["number"] = $errorCode;
        $response["error"]["message"] = $errorMessage;
        echo json_encode($response);
        die();
    }

    public function cursorVerificator($cursor, &$sql, $transaction = true){
        if($cursor->errorCode() != "0000"){
            if($transaction){
                $sql->getDbh()->rollBack();
            }
            $this->killApp($cursor->errorInfo()[0], $cursor->errorInfo()[2]);
        }
        return;
    }

    public function warnApp($warnCode, $warnMessage, &$response){
        $response["success"] = true;
        $response["warn"]["indicator"] = true;
        $response["warn"]["number"] = $warnCode;
        $response["warn"]["message"] = $warnMessage;

    }

    public function Zip(){
        return new ZipFile();
    }

    public function rmDir_rf($folder){
        foreach(glob($folder . "/*") as $archives){             
            if (is_dir($archives)){
                $this->rmDir_rf($archives);
            } else{
                unlink($archives);
            }
        }
        rmdir($folder);
    }

    function full_copy( $source, $target ) {
        if ( is_dir( $source ) ) {
            @mkdir( $target );
            $d = dir( $source );
            while ( FALSE !== ( $entry = $d->read() ) ) {
                if ( $entry == '.' || $entry == '..' ) {
                    continue;
                }
                $Entry = $source . '/' . $entry; 
                if ( is_dir( $Entry ) ) {
                    $this->full_copy( $Entry, $target . '/' . $entry );
                    continue;
                }
                copy( $Entry, $target . '/' . $entry );
            }
     
            $d->close();
        }else {
            copy( $source, $target );
        }
    }
}
?>