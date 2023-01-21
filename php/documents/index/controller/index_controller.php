<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/libs/OzyTool/OzyTool.php");

    include($_SERVER['DOCUMENT_ROOT']."/php/documents/index/model/index_model.php");
    include($_SERVER['DOCUMENT_ROOT']."/php/documents/index/view/index_view.php");

    $view = new IndexView(new IndexModel); 
?>