<?php
    class SearchView{
        //Miembros de datos
        private $model;
        private $HTML;


        //constructor
        public function __construct($model){
            $this->model = $model;
        }

        //Funciones
        public function displayCards(){
            /*
            $subtypes = array("Nosotros", "Oferta Educativa", "Departamentos", "Docentes", "Transparencia", "Aplicaciones", "Contacto");
            $this->HTML = <<< HTML
                <div class="articles-container articles-container-single">
                    <h1>{$subtypes[$this->model->subtype-1]}</h1>
            HTML;
            */
            $cursor = $this->model->getCursor()->toArray();
            if(count( $cursor ) > 0){
                foreach($cursor as $item){
                    $this->HTML .= <<< HTML
                        <article class="article article_navasicard">
                            <a class="navBarLink frame_change" data-get="id={$item['meta']['id']}">
                                <div class="article_container article_navasicard_container">
                                    <div class="article_title article_navasicard_title">
                                        <p>{$item['meta']['title']}</p>
                                        <p class="article_text article_navasicard_text">{$item['meta']['description']}</p>
                                    </div>
                                    <hr>
                                </div>
                            </a>
                            <img src="{$item['meta']['background_img']}" alt="" class="article_navasicard_background">
                        </article>
                    HTML;
                }
                $this->HTML .=  <<< HTML
                    <script src="/modules/events/subNavAsideLinks.js"></script>
                HTML;
            } else{
                $this->HTML .= <<< HTML
                    <h3>No hay contenido</h3>
                HTML;
            }
            
            /*
            $this->HTML .= <<< HTML
                    <footer class="no_select c_default">
                        &copy; 2022 C.B.T.I.s 114
                        <br>
                        <a href="tel:(656) 887 27 06">(656) 887 27 06</a> | <a href="tel:(656) 887 27 06">(656) 887 27 07</a>
                        <br>
                        <a href="mailto:contacto@cbtis114.edu.mx">contacto@cbtis114.edu.mx</a>
                    </footer>
                </div>
            HTML;
            */
            return $this->HTML;
        }

        public function displayArticles(){
            if($this->model->getCursor() == null){
                return <<< HTML
                    <h3>Error en base de datos: {$this->model->getErrors()}</h3>
                HTML;
            }
            $cursor = $this->model->getCursor()->toArray();
            if(count( $cursor ) > 0){
                foreach($cursor as $item){
                    $this->HTML .= articleDecoder($item, false);
                    $this->HTML .= <<< HTML
                            <br>
                    HTML;
                }
            } else{
                if($this->model->getStart() == 0){
                    $this->HTML .= <<< HTML
                        <h3>No hay contenido</h3>
                    HTML;
                }
                $this->HTML .= <<< HTML

                HTML;
            }
            return $this->HTML;
        }
    }
?>