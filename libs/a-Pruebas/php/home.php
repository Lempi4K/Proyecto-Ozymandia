<?php
    include("funcionamiento/home_page/home_page.php");
    $hp = new HomePage_Class();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../js/librerias/JQuery.js"></script>
    <script type="text/javascript" src="../js/verificacion/verificacion_ajax.js"></script>
    <script type="text/javascript" src="../js/cerrar_sesion/cerrar_sesion_ajax.js"></script>

    <title>Home</title>
</head>
<body>
    <h1>Home</h1>
    <?php 
        $hp->print_result();
    ?>
    <input id="inpBtnCS" type="button" value="Cerrar Sesion">
</body>
</html>