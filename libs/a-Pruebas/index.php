<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="js/librerias/JQuery.js"></script>
    <script type="text/javascript" src="js/inicio_sesion/inicio_sesion_ajax.js"></script>
    <script type="text/javascript" src="js/inicio_sesion/verificador_token_ajax.js"></script>
    <title>Index</title>
</head>
<body>
    <form id="loginForm" method="POST">
        <h1>Iniciar Sesion</h1>
        <label for="inpTxtUser">Usuario: </label>
        <input type="text" name="user" id="inpTxtUser" placeholder="Ingresa Usuario">
        <br>
        <label for="inpPassPassword">Contraseña: </label>
        <input type="password" name="pass" id="inpPassPassword" placeholder="Ingresa Contraseña">
        <br>
        <input type="hidden" name="direccion" id="inpHiddDireccion" value="../home.php">
        <input type="submit" value="Iniciar Sesion" id="inpSubMandar">
    </form>
</body>
</html>

