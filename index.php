<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Ozymandia</title>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/includes/def_1/head_addi.inc.php") ?>
    <?php include($_SERVER['DOCUMENT_ROOT']."/php/documents/index/controller/index_controller.php") ?>
    <style>
        @import url("/css/color/color.css");
    </style>
    <script src="/js/height-mobile-fix.js"></script>
    <script src="/modules/check-token/js/check-token_ajax.js"></script>
    <script src="/php/documents/index/js/user-menu.js"></script>
    <script src="/modules/router/js/router.js"></script>
    <script src="/modules/content-recovery/content-recovery.js"></script>
    <script src="/modules/logout/js/logout_ajax.js"></script>
    <script src="/php/documents/index/js/nav-menu.js"></script>
    <script src="/modules/drk-mode/js/drk-mode_logic.js"></script>
    <script src="/js/scroll_up.js"></script>
    <script src="/modules/canvas/js/canvas.js"></script>
    <script src="/modules/canvas/js/frame-changer.js"></script>
    <script src="/modules/canvas/js/navasidcard-canvas.js"></script>
    <script src="/modules/canvas/js/set-article-data.js"></script>
</head>
<body>
    <div class="charging-display-container" id="charging-display-main"><img src="/src//img/logo/logo.png" alt=""></div>
    <div class="block-display-container" id="block-display-main"><p>Contenido no disponible para tí :///<br>Volviendo a la p&aacute;gina principal...</p></div>
    <?php $view->displayPage() ?> 
</body>
</html>