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
    use Exception;

    class User{
        public $ozy_tool;
        public $token;
        public $id;
        public $prm;
        public $dkm;
        public function __construct(OzyTool $ozy_tool, int $uid = 0){
            $this->ozy_tool = $ozy_tool;

            if($uid != 0){
                $query = "select PERM from USUARIOS where USER_ID = $uid";
                try{
                    $cursor = $ozy_tool->MySQL()->console($query);
                } catch(Exception $e){
                    return null;
                }

                if($cursor->rowCount()){
                    foreach($cursor as $item){
                        $this->prm = $item["PERM"];
                        break;
                    }
                    $this->id = $uid;
                    $this->dkm = 3;

                    return;
                }

                return null;
            }

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
            if($dbh == null){
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

        public function getSublabels(){
            $dbh = $this->ozy_tool->MySQL();
            if($dbh == null){
                return null;
            }
            $sublabels = ["G" => []];

            if($this->hasPerm("Ozy.Labels.General")){
                $query = "select * from SUBETIQUETAS where LABEL_ID = 2 && SUBLABEL_ID != 0";

                $cursor = $dbh->console($query);
                foreach($cursor as $item){
                    $sublabels["G"][$item["SUBLABEL_ID"]] = $item["NOMBRE"];
                }
                return $sublabels;
            }

            $query = "select JSON from PERM_LABELS where USER_ID = {$this->id}";
            $cursor = $dbh->console($query);

            $json = [];
            foreach($cursor as $item){
                $json = json_decode($item["JSON"], true);
                break;
            }

            $query = "select * from SUBETIQUETAS where LABEL_ID = 2 && SUBLABEL_ID != 0";
            $cursor = $dbh->console($query);
            //var_dump($json["G"]);
            foreach($cursor as $item){
                //echo "key: {$item["SUBLABEL_ID"]}";
                if(in_array($item["SUBLABEL_ID"], $json["G"])){
                    $sublabels["G"][$item["SUBLABEL_ID"]] = $item["NOMBRE"];
                }
            }

            return $sublabels;
        }

        public function getType(){
            $dbh = $this->ozy_tool->MySQL();
            if($dbh == null){
                return null;
            }

            $query = "select TIPO from USUARIOS where USER_ID = {$this->id}";
            $cursor = $dbh->console($query);

            foreach($cursor as $item){
                return $item["TIPO"];
            }
        }

        public function isBlocked(){
            $dbh = $this->ozy_tool->MySQL();
            if($dbh == null || $this->token["payload"] == null){
                return null;
            }

            $query = "select ESTADO from USUARIOS where USER_ID = {$this->id}";
            $cursor = $dbh->console($query);

            foreach($cursor as $item){
                return $item["ESTADO"] != 1 ? true : false;
            }
        }
    }
?>