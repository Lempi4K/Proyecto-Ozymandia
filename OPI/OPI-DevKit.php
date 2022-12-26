<?php
    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MongoDB_lib/Simple_MongoDB.php");

    include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MySQL_lib/Simple_MySQL.php");

    include($_SERVER['DOCUMENT_ROOT']."/libs/php-jwt-master/src/JWT.php");

    class OPI_DevKit{
        //Data Members
        /** 
         * OPI element HTML code
         * @var HEREDOC_string
        */
        protected string $HTML;

        /** 
         * Request status
         * @var int 1 = Ok
         * @var int 0 = Error
         * @var int 2 = Data Error
        */
        protected int $status = 1;

        /** 
         * User ID
         * @var int
        */
        protected int $uid;

        /** 
         * Article theme
         * @var string
        */
        protected string $theme;

        //Constructor
        /**
         * Initialize the class members
         * @param token User token
         * @param theme Article theme
         */
        public function __construct(int $uid, string $theme){
            $this->uid = $uid;
            $this->theme = $theme;
            if(!isset($this->uid) || !isset($this->theme)){
                $this->status = 2;
            }
        }

        //Funtions
        /**
         * Instructions for create a HTML string
         * @return void
        */
        public function createHTML(){
            /**
             * Instructions
            */
        }

        /**
         * Create a JSON object with the data of the class and return it
         * @return string
        */
        public function getJSON(){
            $this->createHTML();
            $JSON = [
                "data" => [
                    "HTML" => $this->HTML,
                ],
                "status" => $this->status
            ];
            return json_encode($JSON);
        }

        /**
         * Return the user token payload
         * @return null
         * @return array
        */
        public function getTokenData(){
            $query = "select TOKEN from CREDENCIALES as CRED where CRED.USER_ID = " . $this->uid;
            try{
                $dbh = new S_MySQL("USER_DATA");
                $cursor = $dbh->console($query);
                foreach($cursor as $row){
                    return $row["TOKEN"];
                }
            } catch(Throwable $t){
                return null;
            }

        }
    }
?>