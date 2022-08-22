<?php 
    class NavController{
        //Miembros de datos
        private $article_id;
        private $subtype;
        private $model;
        private $view;
        private $HTML;


        //Constructor
        public function __construct($article_id_c, $subtype_c){
            $this->article_id = $article_id_c;
            $this->subtype = $subtype_c;
        }

        //Funciones
        public function getHTML(){
            $subtypes = array("Nosotros", "Oferta Educativa", "Departamentos", "Docentes", "Transparencia", "Aplicaciones", "Contacto");
            $this->HTML = <<< HTML
                <div class="articles-container articles-container-single">
                <h1>{$subtypes[$this->subtype-1]}</h1>
                    <article class="article article_navasicard">
                        <a href="">
                            <div class="article_container article_navasicard_container">
                                <div class="article_title article_navasicard_title">
                                    <p>Aside Card</p>
                                    <p class="article_text article_navasicard_text">Texto de titulo</p>
                                </div>
                                <hr>
                            </div>
                        </a>
                        <img src="/src/img/articles/navcard_background_1.jpg" alt="" class="article_navasicard_background">
                    </article>
                    <footer class="no_select c_default">
                        &copy; 2022 C.B.T.I.s 114
                        <br>
                        <a href="tel:(656) 887 27 06">(656) 887 27 06</a> | <a href="tel:(656) 887 27 06">(656) 887 27 07</a>
                        <br>
                        <a href="mailto:contacto@cbtis114.edu.mx">contacto@cbtis114.edu.mx</a>
                    </footer>
                </div>
            HTML;
            return $this->HTML;
        }
    }
?>