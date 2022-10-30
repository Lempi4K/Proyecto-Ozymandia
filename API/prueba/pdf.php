<?php
    include($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML('<h1>Este pdf fue creado en el servidor y traido por una API ;)</h1>');
    echo $mpdf->Output("Archivo.pdf", "I");
?>