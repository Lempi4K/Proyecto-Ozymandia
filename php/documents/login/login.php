<!--
      #########@      %#####################################     ####   (###*   
    ######  #####     &####%&&&&&&&&&&&&&&&&&&&&&&&&&&&#####     ####&  ####%   
   ######&  &#####     @####@                         #####     .#####  #####   
  (######@  /######     @####@      %%%%%%%%%#       #####      @##### @#####   
  &######    ######      @####@      #######&       #####       ######@######&  
  (######@  /######       %####%      ######      ,#####        ##@###########  
   ######@  @#####         %####&     (####      #####%        ##@ /######  ##  
    %#####  #####      @#########      &##      ##########/    #@    ###%    #% 
      %########.       @#########       #%      ##########/    &      #@      % 

    PROYECTO OZYMANDIA
    @author Leonardo Moreno Pinto
    @link https://github.com/Lempi4K/Proyecto-Ozymandia
                    © 2023 Lempi4K
-->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion | Proyecto Ozymandia</title>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/includes/def_1/head_addi.inc.php") ?>
    <style>
        @import url("/css/def_1/login/login.css") screen;
        @import url("/css/def_1/login/login-logo.css") screen;
        @import url("/css/def_1/login/login-form.css") screen;
        @import url("/css/def_1/login/login-gallery.css") screen;

        @import url("/css/responsive/login.css") screen;   
        
        @import url("/css/color/color.css");
    </style>
    <script src="/modules/check-token/js/check-token_ajax.js"></script>
    <script src="/modules/single-blocker/js/single-blocker.js"></script>
    <script src="/modules/login/js/login_ajax.js"></script>
    <script src="/php/documents/login/js/gallery.js"></script>
    <script src="/php/documents/login/js/login-validator.js"></script>
    <script src="/js/loadAnimation.js"></script>
    <script src="/js/height-mobile-fix.js"></script>
</head>
<body>
    <div class="charging-display-container" id="charging-display-main"><img src="/src//img/logo/logo.png" alt=""></div>
    <div class="block-display-container" id="block-display-main"><p>Ya iniciaste sesi&oacute;n<br>Volviendo a la p&aacute;gina principal...</p></div>
    <div class="all-container">
        <div class="gallery">
            <ul>
                <li>
                    <img src="/php/documents/login/src/img/slide-image-1.jpg" alt="">
                </li> 
                <li>
                    <img src="/php/documents/login/src/img/slide-image-2.jpg" alt="">
                </li>
                <li>
                    <img src="/php/documents/login/src/img/slide-image-3.jpg" alt="">
                </li>
                <li>
                    <img src="/php/documents/login/src/img/slide-image-4.jpg" alt="">
                </li>
                <li>
                    <img src="/php/documents/login/src/img/slide-image-5.jpg" alt="">
                </li>
                <li>
                    <img src="/php/documents/login/src/img/slide-image-6.jpg" alt="">
                </li>
            </ul>
            <div class="gradient">

            </div>
        </div>
        <div class="login-container">
            <div class="login-main">
                <div class="login-logo">
                    <a href="/inicio" class="no_select">
                        <img src="/src/img/logo/logo.png" alt="">
                        <img src="/src/img/logo/text.png" class="logo_text" alt="">
                        <!--<p class="no_select">CBTIS 114</p>-->
                    </a>
                </div>
                <form action="" class="login-form">
                    <div class="login-text">
                        <p class="no_select c_default">Ingresa tus credenciales</p>
                    </div>
                    <div class="inp-element">
                        <input type="text" id="inpTxtUser" placeholder="User">
                        <label for="inpTxtUser" class="no_select">Usuario</label>
                    </div>
                    <div class="inp-element">
                        <input type="password" id="inpPassPassword" placeholder="Pass">
                        <label for="inpPassPassword" class="no_select">Contraseña</label>
                    </div>
                    <input type="button" value="Iniciar Sesión" id="inpBtnLogin" disabled>
                </form>
            </div>
            <footer class="no_select c_default">
                &copy; <?php echo date("Y"); ?> C.B.T.I.s XXX
                <br>
                <a href="tel:(656) 123 45 67">(656) 123 45 67</a> | <a href="tel:(656) 234 56 78">(656) 234 56 78</a>
                <br>
                <a href="mailto:contacto@cbtisXXX.edu.mx">contacto@cbtisXXX.edu.mx</a>
            </footer>
        </div>
    </div>
</body>
</html>