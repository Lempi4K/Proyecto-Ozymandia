<?php 
    class AsideController{
        //Miembros de datos
        private $article_id;
        private $model;
        private $view;
        private $HTML;


        //Constructor
        public function __construct($article_id_c){
            $this->article_id = $article_id_c;
        }

        //Funciones
        public function getHTML(){
            $this->HTML = <<< HTML
                <div class="articles-container articles-container-single">
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
                                <p>Acuerdos de Convivencia</p>
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