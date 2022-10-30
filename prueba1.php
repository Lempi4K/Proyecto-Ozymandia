<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Xdddd?</h1>
    <div>
        <?php
            require_once __DIR__ . '/vendor/autoload.php';
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML('<h1>¡Hola, Mundo!</h1>');
            echo $mpdf->Output("Archivo.pdf", "I");
        ?>
    </div>

</body>
</html>