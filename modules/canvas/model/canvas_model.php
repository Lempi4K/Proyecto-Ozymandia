<?php
    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MongoDB_lib/Simple_MongoDB.php");

    include($_SERVER['DOCUMENT_ROOT']."/libs/php-jwt-master/src/JWT.php");
    use Firebase\JWT\JWT;

    class Canvas_Model{
        //Miembros de datos
        private $article;
        private $db_handler;
        private $errors = "";

        //Constructor
        public function __construct($articleJSON){
            if(isset($_COOKIE["token"])){
                $token_ck = $_COOKIE["token"];
                $dataT = JWT::decode($_COOKIE["token"], "P.O.");

                $user_id = $dataT->uid;

                $this->article = $articleJSON;
                $this->article["meta"]["autor_uid"] = $user_id;
                $this->article["meta"]["pub_date"] = date("d-m-Y");
            } else{
                $this->errors = $this->errors . "PHP.canvas_model:Construct:DB-Error:Cookie-Empty;";
            }
        }

        //setters & getters
        public function sendArticle(){
            if(isset($this->article)){
                try{
                    $mongo = Simple_MongoDB::connection("ARTICLES_DATA", 1);
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
    /*
    $mongo = Simple_MongoDB::connection("ARTICLES_DATA", 1);
    var_dump($mongo->ARTICLES_DATA->RECIPES->find());
    $mongo->ARTICLES_DATA->RECIPES->insertOne();
    print("aaaa")
    
    $mongo = Simple_MongoDB::connection("ARTICLES_DATA", 1);
    foreach($mongo->ARTICLES_DATA->RECIPES->find() as $item){
        print(var_dump($item["AEM"][0]["pdf"]));
    }
    */
?>