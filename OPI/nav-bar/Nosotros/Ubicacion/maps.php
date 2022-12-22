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
            <div class="article_pdf">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4036.8934196023356!2d-106.43603125645!3d31.699249713954117!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86e75c26e9a25371%3A0x2e423b264f8403e!2sC.B.T.i.s.%20No.%20114!5e0!3m2!1ses-419!2smx!4v1670791390837!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            HTML;
        }
    }

    $OPI = new OPI();
    echo $OPI->getJSON();
?>