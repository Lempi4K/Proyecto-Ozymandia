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
                <div class="article_TabNav">
                    <ul class="article_TabMenu">
                        <li>
                            <label for="inpRdbtnTabContent1" class="article_TabActive">Justificación de la Carrera</label>
                        </li>
                        <li>
                            <label for="inpRdbtnTabContent2">Perfil de Egreso</label>
                        </li>
                        <li>
                            <label for="inpRdbtnTabContent3">Estructura Curricular</label>
                        </li>
                        <li>
                            <label for="inpRdbtnTabContent4">Competencias Profesionales</label>
                        </li>
                        <li>
                            <label for="inpRdbtnTabContent5">Descargas</label>
                        </li>
                    </ul>

                    <div class="article_img article_1_img">
                        <img src="/OPI/nav-bar/Oferta-Educativa/RecHumanos/recursos/Banner - Administracion de Recursos Humanos.png" alt="">
                        <hr>
                    </div>

                    <ul class="article_TabContent">
                        <li>
                            <input type="radio" name="inpRdbtnTabContent" id="inpRdbtnTabContent1" checked>
                            <div class="article_TabContainer">
                                <p class="article_subtitle_1 article_1_subtitle_1">
                                        Justificación de la Carrera
                                </p>
                                <p class="article_text article_1_text">
                                    La carrera de Técnico en administración de recursos humanos se desarrolla como vertiente de la carrera de Administración y ofrece las 
                                    competencias profesionales que permiten al estudiante elaborar y gestionar documentación administrativa referente a recursos humanos, 
                                    integrar al personal a la organización, asistir en actividades de capacitación, desarrollo y evaluación del personal, así como determinar 
                                    las remuneraciones al personal.
                                </p>
                                <p class="article_text article_1_text">
                                    Asimismo podrá desarrollar competencias genéricas relacionadas principalmente con la participación en los procesos de comunicación en 
                                    distintos contextos, la integración efectiva a los equipos de trabajo y la intervención consciente, desde su comunidad en particular, en 
                                    el país y el mundo en general, todo con apego al cuidado del medio ambiente.
                                </p>
                                <p class="article_text article_1_text">
                                    La formación profesional se inicia en el segundo semestre y se concluye en el sexto semestre, desarrollando en este lapso de tiempo las 
                                    competencias para elaborar y gestionar la información de la organización, integrar el capital humano a la organización, asistir en el 
                                    control y evaluación del desempeño del capital humano de la organización, controlar los procesos y servicios de higiene y seguridad del 
                                    capital humano en la organización, determinar las remuneraciones al capital humano de la organización.
                                </p>
                                <p class="article_text article_1_text">
                                    Todas estas competencias posibilitan al egresado su incorporación al mundo laboral o desarrollar procesos productivos independientes, 
                                    de acuerdo con sus intereses profesionales o las necesidades en su entorno social.
                                </p>
                                <p class="article_text article_1_text">
                                    Los primeros tres módulos de la carrera técnica tienen una duración de 272 horas cada uno, y los dos últimos de 192, un total de 1200 horas 
                                    de formación profesional.
                                </p>
                            </div>
                        </li>
                        <li>
                            <input type="radio" name="inpRdbtnTabContent" id="inpRdbtnTabContent2">
                            <div class="article_TabContainer">
                                <p class="article_subtitle_1 article_1_subtitle_1">
                                        Perfil de Egreso
                                </p>
                                <p class="article_text article_1_text">
                                    Durante el proceso de formación de los cinco módulos, el estudiante desarrollará o reforzará las siguientes competencias 
                                    profesionales, correspondientes al Técnico en administración de recursos humanos:
                                </p>
                                <p class="article_text article_1_text">
                                    • Elabora y gestiona la información administrativa de la organización.
                                    <br>
                                    • Integra el capital humano a la organización.
                                    <br>
                                    • Asiste en el control y evaluación del desempeño del capital humano de la organización.
                                    <br>
                                    • Controla los procesos y servicios de higiene y seguridad del capital humano en la organización.
                                    <br>
                                    • Determina las remuneraciones al capital humano de la organización.
                                </p>
                                <p class="article_text article_1_text">
                                    Además se presentan las 11 competencias genéricas, para que usted intervenga en su desarrollo o reforzamiento, y con ello 
                                    enriquezca el perfil de egreso del bachiller. Como resultado del análisis realizado por los docentes elaboradores de este programa 
                                    de estudios, se considera que el egresado de la carrera de Técnico en contabilidad está en posibilidades de desarrollar las 
                                    competencias genéricas antes mencionadas. Sin embargo se deja abierta la posibilidad de que usted contribuya a la adquisición de 
                                    otras que considere pertinentes, de acuerdo con el contexto regional, laboral y académico:
                                </p>
                                <p class="article_text article_1_text">
                                    1. Se conoce y valora a sí mismo y aborda problemas y retos teniendo en cuenta los objetivos que persigue.
                                    <br>
                                    2. Es sensible al arte y participa en la apreciación e interpretación de sus expresiones en distintos géneros.
                                    <br>
                                    3. Elige y practica estilos de vida saludables.
                                    <br>
                                    4. Escucha, interpreta y emite mensajes pertinentes en distintos contextos mediante la utilización de medios, códigos y herramientas apropiados.
                                    <br>
                                    5. Desarrolla innovaciones y propone soluciones a problemas a partir de métodos establecidos.
                                    <br>
                                    6. Sustenta una postura personal sobre temas de interés y relevancia general, considerando otros puntos de vista de manera crítica y reflexiva.
                                    <br>
                                    7. Aprende por iniciativa e interés propio a lo largo de la vida.
                                    <br>
                                    8. Participa y colabora de manera efectiva en equipos diversos.
                                    <br>
                                    9. Participa con una conciencia cívica y ética en la vida de su comunidad, región, México y el mundo.
                                    <br>
                                    10. Mantiene una actitud respetuosa hacia la interculturalidad y la diversidad de creencias, valores, ideas y prácticas sociales.
                                    <br>
                                    11. Contribuye al desarrollo sustentable de manera crítica, con acciones responsables.
                                </p>
                                <p class="article_text article_1_text">
                                    Es importante recordar que, en este modelo educativo, el egresado de la educación media superior desarrolla las competencias genéricas 
                                    a partir de la contribución de las competencias profesionales al componente de formación profesional, y no en forma aislada e individual, 
                                    sino a través de una propuesta de formación integral, en un marco de diversidad.
                                </p>
                            </div>
                        </li>
                        <li>
                            <input type="radio" name="inpRdbtnTabContent" id="inpRdbtnTabContent3">
                            <div class="article_TabContainer">
                                <div class="article_img article_1_img">
                                    <img src="/API/nav-bar/Oferta-Educativa/RecHumanos/recursos/Estructura Curricular AdmRecHum.png" alt="">
                                </div>
                            </div>
                        </li>
                        <li>
                            <input type="radio" name="inpRdbtnTabContent" id="inpRdbtnTabContent4">
                            <div class="article_TabContainer">
                                <div class="article_img article_1_img">
                                    <img src="/API/nav-bar/Oferta-Educativa/RecHumanos/recursos/Competencias Profesionales AdmRecHum.png" alt="">
                                </div>
                            </div>
                        </li>
                        <li>
                            <input type="radio" name="inpRdbtnTabContent" id="inpRdbtnTabContent5">
                            <div class="article_TabContainer">
                                <table class="article_table  {$this->theme}_table">
                                    <thead>
                                        <tr>
                                            <th width="45%">Descripción</th>
                                            <th width="55%">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Plan de Estudios</td>
                                            <td><a href="/API/nav-bar/Oferta-Educativa/RecHumanos/recursos/Admon_de_Recursos_Humanos.pdf" target="_blank"><i class="fa-solid fa-download"></i> Descargar</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    </ul>
                </div>
                <script src="/js/tab-style.js"></script>
            HTML;
        }
    }

    $OPI = new OPI();
    echo $OPI->getJSON();
?>