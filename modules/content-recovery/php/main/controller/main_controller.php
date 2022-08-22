<?php 
    class MainController{
        //Miembros de datos
        private $section;
        private $article_id;
        private $model;
        private $view;
        private $HTML;

        //Constructor
        public function __construct($section, $article_id){
            $this->$section = $section;
            $this->article_id = $article_id;
        }

        //Funciones
        public function getHTML(){
            $this->HTML = <<< HTML
                <div class="article_divisor">
                    <div>
                        <input type="radio" name="inpRdbtnArtdiv" id="inpRdbtnArtdiv1">
                        <label for="inpRdbtnArtdiv1">General</label>
                    </div>
                    <div>
                        <input type="radio" name="inpRdbtnArtdiv" id="inpRdbtnArtdiv2" checked>
                        <label for="inpRdbtnArtdiv2">Administrativo</label>
                    </div>
                    <div>
                        <input type="radio" name="inpRdbtnArtdiv" id="inpRdbtnArtdiv3">
                        <label for="inpRdbtnArtdiv3">Siguiendo</label>
                    </div>
                </div>

                <div class="articles-container">
                    <article class="article">
                        <div class="article_head">
                            <i class="fa-solid fa-user-astronaut article_userPic"></i>
                            <div>
                                <p>Nombre del Autor</p>
                                <p>@Usuario | <time pubdate="2022-02-07">2022-02-07</time></p>
                            </div>
                            <input type="button" value="Seguir">
                        </div>
                        <div class="article_container article_1">
                            <div class="article_title article_1_title">
                                <p>Template 1</p>
                                <p class="article_text article_2_text">Texto de titulo</p>
                            </div>
                            <hr>
                            <div class="article_content article_1_content">
                                <div class="article_1_head">
                                    <img src="/src/img/logo/logo.png" alt="">
                                    <p>
                                        CENTRO DE BACHILLERATO TECNOL&Oacute;GICO
                                        <br>
                                        industrial y de servicios N&uacute;m. 114
                                    </p>
                                    <hr>
                                </div>
                                <div class="article_main article_1_main">
                                    <p class="article_subtitle_1 article_1_subtitle_1">
                                        Subtitulo 1
                                    </p>
                                    <p class="article_subtitle_2 article_1_subtitle_2">
                                        Subtitulo 2
                                    </p>
                                    <p class="article_text article_1_text">
                                        Texto normal
                                        <ul class="article_text_list article_1_text_list">
                                            <li>
                                                Lista
                                                <ul class="article_text_list article_1_text_list">
                                                    <li>
                                                        Sublista
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                Lista
                                            </li>
                                        </ul>                                        
                                        <a href="" class="article_text_link article_2_text_link">
                                            Link
                                        </a>
                                        <br>
                                        <i>Cursiva </i> <b>Negrita </b> <b><i>Cursiva-Negreita </i></b> <u>Subrrayado</u>
                                    </p>
                                    <a href="" class="article_linkBtn article_1_linkBtn">
                                        Link
                                    </a>
                                    <div class="article_video article_2_video">
                                        <hr>
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/jfKfPfyJRdk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                    <div class="article_img article_2_img">
                                        <hr>
                                        <img src="/src/img/articles/img_article.jpg" alt="">
                                    </div>
                                    <div class="article_link_img article_2_link_img">
                                        <hr>
                                        <a href="">
                                            <img src="/src/img/articles/img_article.jpg" alt="">
                                        </a>
                                    </div>
                                    <hr>
                                    <p class="article_end article_1_end">
                                        ¡UNA VEZ LOBOS, SIEMPRE LOBOS!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                    <br>
                    <article class="article">
                        <div class="article_head">
                            <i class="fa-solid fa-user-astronaut article_userPic"></i>
                            <div>
                                <p>Nombre del Autor</p>
                                <p>@Usuario | <time pubdate="2022-02-07">2022-02-07</time></p>
                            </div>
                            <input type="button" value="Seguir">
                        </div>
                        <div class="article_container article_2">
                            <div class="article_title article_2_title">
                                <p>Template 2</p>
                                <p class="article_text article_2_text">Texto de titulo</p>
                            </div>
                            <hr>
                            <div class="article_content article_2_content">
                                <div class="article_main article_2_main">
                                    <p class="article_subtitle_1 article_2_subtitle_1">
                                        Subtitulo
                                    </p>
                                    <p class="article_text article_2_text">
                                        Texto normal
                                        <ul class="article_text_list article_2_text_list">
                                            <li>
                                                Lista
                                                <ul class="article_text_list article_2_text_list">
                                                    <li>
                                                        Sublista
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                Lista
                                            </li>
                                        </ul>
                                        <a href="" class="article_text_link article_2_text_link">
                                            Link
                                        </a>
                                        <br>
                                        <i>Cursiva </i> <b>Negrita </b> <b><i>Cursiva-Negreita</i></b> <u>Subrrayado</u>
                                    </p>
                                    <a href="" class="article_linkBtn article_2_linkBtn">
                                        Linksdfsdfsdfsdf
                                    </a>
                                    <div class="article_video article_2_video">
                                        <hr>
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/jfKfPfyJRdk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                    <div class="article_img article_2_img">
                                        <hr>
                                        <img src="/src/img/articles/img_article.jpg" alt="">
                                    </div>
                                    <div class="article_link_img article_2_link_img">
                                        <hr>
                                        <a href="">
                                            <img src="/src/img/articles/img_article.jpg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            HTML;
            return $this->HTML;
        }
    }
?>