<?php
    include("canvas/model/canvas_model.php");
    include("canvas/view/canvas_view.php");
use OzyTool\OzyTool;

    class CanvasController{
        //Miembros de datos
        private $article_id;
        private $model;
        private $view;

        //Constructor
        public function __construct($article_id){
            $this->article_id = $article_id;
            $this->model = new CanvasModel();
            $this->view = new CanvasView($this->model);
        }

        //Funciones
        public function getHTML(){
            if($this->isMyArticle($this->article_id)){
                return $this->view->displayCanvas();
            } else{
                return <<< HTML
                <div class='display-error-main'>
                    <p>
                        PHP.error: Acceso Denegado
                        <br>
                        <u>Recarga la p&aacute;gina o contacta al webmaster<u>
                    </p>
                </div>
                HTML;
            }
        }
        
        public function isMyArticle($aid){
            $ozy_tool = new OzyTool();
            try{
                if($aid == 0){
                    return true;
                }
                $article_id = (int) $aid;
                $query = array(
                    '$and' => array(
                        array("meta.id" => (int)$article_id),
                        array("delete" => false)
                    )
                );
                $mongo = Simple_MongoDB::connection("ARTICLES_DATA", 1);
                $cursor = $mongo->ARTICLES_DATA->RECIPES->findOne($query);

                $dataT = $ozy_tool->jwt_decode($_COOKIE["token"]);
                $perm = $dataT->prm;
                $uid = $dataT->uid;
                if(is_null($cursor)){
                    return false;
                }
                if(((int) $cursor["meta"]["autor_uid"] == (int) $uid) || ($perm > 0 && $perm < 4) || $cursor["delete"]){
                    return true;
                }   
            }catch (Exception $e){
                return false;
            }
        }
    }
?>