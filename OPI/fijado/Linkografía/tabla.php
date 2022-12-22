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
                <p class="article_subtitle_1 article_1_subtitle_1 cpeEditable">Lógica</p>
                <table class="article_table  {$this->theme}_table">
                    <thead>
                        <tr>
                            <th width="45%">Contenido</th>
                            <th width="55%">URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Contenido del Enlace 01</td>
                            <td>
                                <a href="http://humanidades.cosdac.sems.gob.mx" target="_blank">http://humanidades.cosdac.sems.gob.mx</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 02</td>
                            <td>
                                <a href="http://tugimnasiacerebral.com" target="_blank">http://tugimnasiacerebral.com</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 03</td>
                            <td>
                                <a href="http://www.youtube.com/watch?v=RDNKn02AZlg" target="_blank">http://www.youtube.com/watch?v=RDNKn02AZlg</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p class="article_subtitle_1 article_1_subtitle_1 cpeEditable">Física</p>
                <table class="article_table  {$this->theme}_table">
                    <thead>
                        <tr>
                            <th width="45%">Contenido</th>
                            <th width="55%">URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Contenido del Enlace 01</td>
                            <td>
                                <a href="http://es.khanacademic.org//science/physics" target="_blank">http://es.khanacademic.org//science/physics</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 02</td>
                            <td>
                                <a href="http://phet.colorado.edu//es/simulationscategory" target="_blank">http://phet.colorado.edu//es/simulationscategory</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 03</td>
                            <td>
                                <a href="http://www.unicoos.com/asignatura/fisica" target="_blank">http://www.unicoos.com/asignatura/fisica</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p class="article_subtitle_1 article_1_subtitle_1 cpeEditable">Tecnologías de la Información y la Comunicación</p>
                <table class="article_table  {$this->theme}_table">
                    <thead>
                        <tr>
                            <th width="45%">Contenido</th>
                            <th width="55%">URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Contenido del Enlace 01</td>
                            <td>
                                <a href="https://web.ua.es/es/accesibilidad/documentos-electronicos-accesibles.html" target="_blank">https://web.ua.es/es/accesibilidad/documentos-electronicos-accesibles.html</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 02</td>
                            <td>
                                <a href="http://aprendeenlinea.udea.edu.co/lms/investigacion/mod/page/view.php?id=3118" target="_blank">http://aprendeenlinea.udea.edu.co/lms/investigacion/mod/page/view.php?id=3118</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 03</td>
                            <td>
                                <a href="https://www.editorialdigitaltec.com/materialadicional/ID194_GilCastro_Fundamentos_de_TI.cap1.pdf" target="_blank">https://www.editorialdigitaltec.com/materialadicional/ID194_GilCastro_Fundamentos_de_TI.cap1.pdf</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 04</td>
                            <td>
                                <a href="http://publishing.fca.unam.mx/tic/TIC-Organizaciones.pdf" target="_blank">http://publishing.fca.unam.mx/tic/TIC-Organizaciones.pdf</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 05</td>
                            <td>
                                <a href="http://tugimnasiacerebral.com/herramientas-de-estudio/que-son-las-tics-tic-o-tecnologias-de-la-informacion-y-la-comunicacion" target="_blank">http://tugimnasiacerebral.com/herramientas-de-estudio/que-son-las-tics-tic-o-tecnologias-de-la-informacion-y-la-comunicacion</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 06</td>
                            <td>
                                <a href="https://www.uv.es/bellochc/pedagogia/EVA1.pdf" target="_blank">https://www.uv.es/bellochc/pedagogia/EVA1.pdf</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 07</td>
                            <td>
                                <a href="https://www.uv.es/~bellochc/pdf/pwtic1.pdf" target="_blank">https://www.uv.es/~bellochc/pdf/pwtic1.pdf</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 08</td>
                            <td>
                                <a href="http://ticscarops.blogspot.com/" target="_blank">	http://ticscarops.blogspot.com/</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 09</td>
                            <td>
                                <a href="https://educrea.cl/las-tics-en-el-ambito-educativo/" target="_blank">	https://educrea.cl/las-tics-en-el-ambito-educativo/</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 10</td>
                            <td>
                                <a href="http://www.cej.es/portal/prl/implementat15/docs/NNTT/01.pdf" target="_blank">http://www.cej.es/portal/prl/implementat15/docs/NNTT/01.pdf</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p class="article_subtitle_1 article_1_subtitle_1 cpeEditable">Química</p>
                <table class="article_table  {$this->theme}_table">
                    <thead>
                        <tr>
                            <th width="45%">Contenido</th>
                            <th width="55%">URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p align="justify">Edmodo: Plataforma tecnológica, social, educativa y gratuita, que permite la comunicación
                                    entre los alumnos y los profesores en un entorno cerrado y privado a modo de microblogging, creado para
                                    un uso específico en educación.</p>
                            </td>
                            <td><a href="http://www.edmodo.com/?lenguaje=es" target="_blank">http://www.edmodo.com/?lenguaje=es</a></td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 02</td>
                            <td><a href="http://academia.mx/#/" target="_blank">http://academia.mx/#/</a></td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 03</td>
                            <td><a href="http://educalab.es/recursos" target="_blank">http://educalab.es/recursos</a></td>
                        </tr>
                        <tr>
                            <td>Khan Academy</td>
                            <td><a href="https://es.khanacademy.org/science/chemistry" target="_blank">https://es.khanacademy.org/science/chemistry</a></td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 05</td>
                            <td><a href="http://dimetilsulfuro.es/" target="_blank">http://dimetilsulfuro.es/</a></td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 06</td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td>
                                <p align="justify">Eduredes: Red social en español, con fines predominantemente educativos, alojada en la
                                    popular plataforma Ning, donde se intercambian numerosas experiencias tanto en la administración de
                                    redes sociales educativas como del uso que los docentes dan a las redes, señalando posibilidades,
                                    marcando pautas y en general, conversando sobre todos los temas relacionados con el uso de las redes
                                    sociales con propósitos educativos.</p>
                            </td>
                            <td><a href="http://eduredes.ning.com/" target="_blank">http://eduredes.ning.com/</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Plataforma educativa que tiene el objetivo de acercar a la gente a cursos masivos abiertos, en línea, los
                                cuales serán impartidos por las más importantes instituciones educativas del país. </td>
                            <td><a href="http://mexicox.gob.mx/" target="_blank">http://mexicox.gob.mx/</a></td>
                        </tr>
                        <tr>
                            <td>Servicio semántico para toda la comunidad educativa, concebido como el nodo nuclear de una red inteligente,
                                social y distribuida, que se enmarca en un ecosistema educativo.</td>
                            <td><a href="http://educalab.es/recursos" target="_blank">http://educalab.es/recursos</a></td>
                        </tr>
                        <tr>
                            <td>DIMETILSULFURO EL BLOG</td>
                            <td><a href="http://dimetilsulfuro.es/" target="_blank">http://dimetilsulfuro.es/</a></td>
                        </tr>
                    </tbody>
                </table>

                <p class="article_subtitle_1 article_1_subtitle_1 cpeEditable">Biología y Ecología</p>
                <table class="article_table  {$this->theme}_table">
                    <thead>
                        <tr>
                            <th width="45%">Contenido</th>
                            <th width="55%">URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Contenido del Enlace 01</td>
                            <td>
                                <a href="http://portaloacademico.cch.unam.mx/alumno/biologia/" target="_blank">http://portaloacademico.cch.unam.mx/alumno/biologia/</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 02</td>
                            <td>
                                <a href="http://www.estudiaraprender.com/2011/11/22/importancia/" target="_blank">http://www.estudiaraprender.com/2011/11/22/importancia/</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 03</td>
                            <td>
                                <a href="http://objetos.unam.mx/" target="_blank">http://objetos.unam.mx/</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p class="article_subtitle_1 article_1_subtitle_1 cpeEditable">Mantenimiento Automotríz</p>
                <table class="article_table  {$this->theme}_table">
                    <thead>
                        <tr>
                            <th width="45%">Contenido</th>
                            <th width="55%">URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Contenido del Enlace 01</td>
                            <td>
                                <a href="www.todomecanica.com" target="_blank">www.todomecanica.com</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido del Enlace 02</td>
                            <td>
                                <a href="http://www.aprendetodamecanica.com" target="_blank">http://www.aprendetodamecanica.com</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p class="article_subtitle_1 article_1_subtitle_1 cpeEditable">Soporte y Mantenimiento</p>
                <table class="article_table  {$this->theme}_table">
                    <thead>
                        <tr>
                            <th width="45%">Contenido</th>
                            <th width="55%">URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Contenido del Enlace 01</td>
                            <td>
                                <a href="http://www.netacad.com.mx/" target="_blank">http://www.netacad.com.mx/</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p class="article_subtitle_1 article_1_subtitle_1 cpeEditable">Programación</p>
                <table class="article_table  {$this->theme}_table">
                    <thead>
                        <tr>
                            <th width="45%">Contenido</th>
                            <th width="55%">URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Contenido del Enlace 01</td>
                            <td>
                                <a href="http://www.tutorialesdeprogramacionya.com//java.ya" target="_blank">	http://www.tutorialesdeprogramacionya.com//java.ya</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            HTML;
        }
    }

    $OPI = new OPI();
    echo $OPI->getJSON();
?>