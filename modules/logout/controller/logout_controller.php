<?php
    include("../view/logout_view.php");
    setcookie("token", "", -13, "/", $_SERVER["HTTP_HOST"], false, true);
    Logout_View::sendData_AJAX(array("success" => true), "");
?>