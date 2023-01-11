<?php
    namespace OzyTool;
    use Firebase\JWT\JWT;
    use Firebase\JWT\SignatureInvalidException;
    use Firebase\JWT\BeforeValidException;
    use Firebase\JWT\ExpiredException;
    use DomainException;
    use InvalidArgumentException;
    use UnexpectedValueException;
    use LogicException;

    class User{
        public $ozy_tool;
        public $token;
        public $id;
        public $prm;
        public $dkm;
        public function __construct(OzyTool $ozy_tool){
            $this->ozy_tool = $ozy_tool;
            if(! isset($_COOKIE["token"])){
                $this->id = 0;
                $this->prm = -1;
                $this->dkm = 3;
            } else{
                $this->token = [
                    "payload" => null,
                    "expired" => false,
                    "invalidSignature" => false,
                ];

                try {
                    $payload = $ozy_tool->jwt_decode($_COOKIE["token"]);
                    $this->token["payload"] = $payload;

                } catch (ExpiredException $e) {
                    $this->token["expired"] = true;
                    list($header, $payload, $signature) = explode(".", $_COOKIE["token"]);
                    $this->token["payload"] = json_decode(base64_decode($payload));

                } catch (SignatureInvalidException $e) {
                    $this->token["invalidSignature"] = true;
                }

                if(! $this->token["invalidSignature"]){
                    $this->id = $this->token["payload"]->uid;
                    $this->prm = $this->token["payload"]->prm;
                    $this->dkm = $this->token["payload"]->dkm;
                }
            }
        }

        public function hasPerm(string $perm){
            $dbh = $this->ozy_tool->MySQL();
            if($dbh == null || $this->token["payload"] == null){
                return false;
            }

            $query = "select 1 from PERMISOS where PERM_ID = {$this->prm} && PERMISOS like ('%{$perm}%')";
            $cursor = $dbh->console($query);
            if($cursor->rowCount() != 0){
                return true;
            }

            $concatPerm = "";
            foreach(explode(".", $perm) as $item){
                if($item === "*"){
                    return false;
                }

                $concatPerm = $item . ".";
                $nPerm = $concatPerm . "*";
                $query = "select 1 from PERMISOS where PERM_ID = {$this->prm} && PERMISOS like ('%{$nPerm}%')";
                $cursor = $dbh->console($query);

                if($cursor->rowCount() != 0){
                    return true;
                }
            }
            
            return false;
        }

        public function getPersonalData(){
            $dbh = $this->ozy_tool->MySQL();
            if($dbh == null || $this->token["payload"] == null){
                return null;
            }

            $query = "select * from ALUMNOS where USER_ID = {$this->prm};";
            $cursor = $dbh->console($query);
            if($cursor->rowCount() != 0){
                return $cursor;
            }

            $query = "select * from DOCENTES where USER_ID = {$this->prm};";
            $cursor = $dbh->console($query);
            if($cursor->rowCount() == 0){
                return null;
            }

            return $cursor;
        }

        public function getLabels(){
            //Pendiente
        }
    }
?>