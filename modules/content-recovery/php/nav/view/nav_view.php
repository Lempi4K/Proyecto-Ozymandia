<?php
    class NavView{
        //Miembros de datos
        private $model;
        private $HTML;


        //constructor
        public function __construct($model){
            $this->model = $model;
        }

        //Funciones
        public function displayCards(){
            $subtypes = array("Nosotros", "Oferta Educativa", "Departamentos", "Docentes", "Transparencia", "Aplicaciones", "Contacto");
            $this->HTML = <<< HTML
                <div class="articles-container articles-container-single">
                    <h1>{$subtypes[$this->model->subtype-1]}</h1>
            HTML;

            $cursor = $this->model->getCursor()->toArray();
            if(count( $cursor ) > 0){
                foreach($cursor as $item){
                    $this->HTML .= <<< HTML
                        <article class="article article_navasicard">
                            <a class="navBarLink" data-get="id={$item['meta']['id']}">
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
            $date = date("Y");
            $this->HTML .= <<< HTML
                    <footer class="no_select c_default">
                        &copy; <?php echo date("Y"); ?> C.B.T.I.s XXX
                        <br>
                        <a href="tel:(656) 123 45 67">(656) 123 45 67</a> | <a href="tel:(656) 234 56 78">(656) 234 56 78</a>
                        <br>
                        <a href="mailto:contacto@cbtisXXX.edu.mx">contacto@cbtisXXX.edu.mx</a>
                    </footer>
                </div>
            HTML;

            return $this->HTML;
        }

        public function displayArticle(){
            $this->HTML = <<< HTML
                <div class="articles-container articles-container-single">
            HTML;
            $cursor = $this->model->getCursor()->toArray();
            if(count( $cursor ) > 0){
                foreach($cursor as $item){
                    $this->HTML .= articleDecoder($item, true);
                }
            } else{
                $this->HTML .= <<< HTML
                    <h3>No hay contenido</h3>
                HTML;
            }
            $this->HTML .= <<< HTML
                </div>
            HTML;
            return $this->HTML;
        }
    }
?>