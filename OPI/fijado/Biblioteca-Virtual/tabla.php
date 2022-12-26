<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/OPI/OPI-DevKit.php");

    class OPI extends OPI_DevKit{
        //Constructor
        public function __construct(){
            $uid = $_GET["uid"] ?? 0;
            $thm = $_GET["theme"] ?? "";
            parent::__construct($uid, $thm);
        }

        //Funciones implementadas
        public function createHTML(){
            $this->HTML = <<< HTML
                <p class="article_subtitle_1 article_1_subtitle_1 cpeEditable">Bibliotecas Virtuales y Recursos Gratuitos</p>
                <table class="article_table  {$this->theme}_table">
                    <thead>
                        <tr>
                            <th width="45%">Nombre</th>
                            <th width="55%">URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Bibliotecas Varias en Portal SEP</td>
                            <td>
                                <a href="http://www.sep.gob.mx/swb/sep1/sep1_Bibliotecas" target="_blank">
                                    www.sep.gob.mx/swb/sep1/sep1_Bibliotecas
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Biblioteca Miguel de Cervantes</td>
                            <td>
                                <a href="http://www.cervantesvirtual.com/" target="_blank">www.cervantesvirtual.com/</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Biblioteca Científica-Electrónica</td>
                            <td>
                                <a href="http://www.scielo.org/php/index.php" target="_blank">
                                    www.scielo.org/php/index.php
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Biblioteca Digital Mundial</td>
                            <td>
                                <a href="https://www.wdl.org/es/" target="_blank">https://www.wdl.org/es/</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p class="article_subtitle_1 article_1_subtitle_1 cpeEditable">Literatura</p>
                <table class="article_table  {$this->theme}_table">
                    <thead>
                        <tr>
                            <th width="45%">Nombre</th>
                            <th width="55%">URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Imaginaria</td>
                            <td><a href="http://www.imaginaria.com.ar/" target="_blank">www.imaginaria.com.ar/</a></td>
                        </tr>
                        <tr>
                            <td>Lengua y Literatura</td>
                            <td><a href="http://www.educaguia.com/" target="_blank">http://www.educaguia.com/</a></td>
                        </tr>
                        <tr>
                            <td>E-Libro</td>
                            <td><a href="http://www.e-libro.com/" target="_blank">http://www.e-libro.com/</a></td>
                        </tr>
                        <tr>
                            <td>Nueva Literatura</td>
                            <td><a href="http://www.nuevaliteratura.com.ar/" target="_blank">http://www.nuevaliteratura.com.ar/</a></td>
                        </tr>
                    </tbody>
                </table>

                <p class="article_subtitle_1 article_1_subtitle_1 cpeEditable">Ciencias</p>
                <table class="article_table  {$this->theme}_table">
                    <thead>
                        <tr>
                            <th width="45%">Nombre</th>
                            <th width="55%">URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>UNAM - Conocimientos Fundamentales</td>
                            <td><a href="http://www.conocimientosfundamentales.unam.mx/" target="_blank">http://www.conocimientosfundamentales.unam.mx/</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Biblioteca en Ingeniería</td>
                            <td><a href="http://www.citeseerx.ist.psu.edu/" target="_blank">www.citeseerx.ist.psu.edu/</a></td>
                        </tr>
                    </tbody>
                </table>

                <p class="article_subtitle_1 article_1_subtitle_1 cpeEditable">Revistas</p>
                <table class="article_table  {$this->theme}_table">
                    <thead>
                        <tr>
                            <th width="45%">Nombre</th>
                            <th width="55%">URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Psicología Científica</td>
                            <td><a href="http://www.psicologiacientifica.com/" target="_blank">http://www.psicologiacientifica.com/</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p class="article_subtitle_1 article_1_subtitle_1 cpeEditable" target="_blank">Revistas de Economía</p>
                <table class="article_table  {$this->theme}_table">
                    <thead>
                        <tr>
                            <th width="45%">Nombre</th>
                            <th width="55%">URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>América economía</td>
                            <td><a href="https://www.americaeconomia.com/" target="_blank">https://www.americaeconomia.com/</a></td>
                        </tr>
                        <tr>
                            <td>Alto Nivel</td>
                            <td><a href="https://www.altonivel.com.mx/" target="_blank">https://www.altonivel.com.mx/</a></td>
                        </tr>
                        <tr>
                            <td>Sobre México</td>
                            <td><a href="http://www.sobremexico.mx/" target="_blank">http://www.sobremexico.mx/</a></td>
                        </tr>
                    </tbody>
                </table>
            HTML;
        }
    }

    $OPI = new OPI();
    echo $OPI->getJSON();
?>