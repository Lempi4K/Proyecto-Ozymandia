<?php
    use OzyTool\OzyTool;
    class Canvas_Model{
        //Miembros de datos

        /**
         * Artículo en crudo
         * @var array
         */
        private $article;

        /**
         * Error en la clase
         * @var string
         */
        private $errors = "";

        //Constructor
        public function __construct($articleJSON){
            $ozy_tool = new OzyTool(1);
            if(isset($_COOKIE["token"])){
                $dataT = $ozy_tool->jwt_decode($_COOKIE["token"]);

                $user_id = $dataT->uid;

                $this->article = $articleJSON;
                $this->article["meta"]["autor_uid"] = (int)$user_id;
                $this->article["meta"]["pub_date"] = date("U");

                if($this->article["meta"]["label"] == 1 && $this->article["meta"]["sublabel"] == 4){
                    $query = "select GEN_LABEL from ALUMNOS where USER_ID = $user_id";
                    $db_handler = $ozy_tool->MySQL();
                    $gen_lbl = $db_handler->console($query);
                    if($gen_lbl != null && $gen_lbl->rowCount() > 0){
                        $gen_lbl->setFetchMode(PDO::FETCH_BOTH);
                        $gen_lbl = $gen_lbl->fetch()["GEN_LABEL"];
                    } else{
                        $gen_lbl = null;
                    }

                    $this->article["meta"]["gen_label"] = $gen_lbl;
                }
            } else{
                $this->errors = $this->errors . "PHP.canvas_model:Construct:DB-Error:Cookie-Empty;";
            }
        }

        //setters & getters
        public function sendArticle(){
            if(isset($this->article)){
                try{
                    $ozy_tool = new OzyTool(1);
                    $mongo = $ozy_tool->MongoDB();
                    $mongo->ARTICLES_DATA->RECIPES->insertOne($this->article);
                    return true;
                }catch (Exception $e){
                    $this->errors = $this->errors . 'PHP.canvas_model:F_sendArticle():DB-Error:' . $e->getMessage() . ';';
                    return false;
                }
            }else{
                $this->errors = $this->errors . 'PHP.canvas_model:F_sendArticle():$article empty;';
            }
        }

        public function getErrors(){
            return $this->errors;
        }
    }
?>