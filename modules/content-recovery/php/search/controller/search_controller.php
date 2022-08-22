<?php 
    class SearchController{
        //Miembros de datos
        private $search;
        private $subtype;
        private $model;
        private $view;
        private $HTML;


        //Constructor
        public function __construct($search_c, $subtype_c){
            $this->search = $search_c;
            $this->subtype = $subtype_c;
        }

        //Funciones
        public function getHTML(){
            $subtypes = array("Nosotros", "Oferta Educativa", "Departamentos", "Docentes", "Transparencia", "Aplicaciones", "Contacto", "Buscar");
            $this->HTML = <<< HTML
                <h1>{$subtypes[$this->subtype-1]}</h1>
                <div class="search search-nav" style="justify-self: center;">
                    <input type="search" name="fetch" id="inpSrhBanner" placeholder="Buscar">
                    <button>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                <div class="aside_container">
                    <article class="article article_navasicard article_navasicard-nav">
                        <a class="c_click frame_change" data-url="aside?id=1" data-articleID="1" href="javascript:article_navasicard('aside?id=1')">
                            <div class="article_container article_navasicard_container">
                                <div class="article_title article_navasicard_title">
                                    <p>Acuerdos de Convivencia</p>
                                    <p class="article_text article_navasicard_text">Texto de titulo</p>
                                </div>
                                <hr>
                            </div>
                        </a>
                        <img src="/src/img/articles/aside_background_1.jpg" alt="" class="article_navasicard_background">
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