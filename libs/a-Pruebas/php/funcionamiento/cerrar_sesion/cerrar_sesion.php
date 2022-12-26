<?php
    setcookie("token", "", -13, "/", "localhost", true);
    echo json_encode(array("success" => 1));
?>