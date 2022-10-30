<?php
    //include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MongoDB_lib/Simple_MongoDB.php");

    function displaySearchBar(){
        $HTML = <<< HTML
        <div id="search-propagation">
            <div class="search-container">
                <div class="search" style="justify-self: center;">
                    <input type="search" name="fetch" id="inpSrhBanner" placeholder="Buscar">
                    <button id="btnSearch">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                <div class="schBackBox">
                    <ul class="schFilters">
                        <!--
                        <li>
                            <div class="schFiterHeader">
                                <p>ORDENAR POR</p>
                                <hr>
                            </div>
                            <div class="schFiterBody">
                                <ul class="schFilterOptionList">
                                    <li>
                                        <input type="radio" name="inpRdbtnSchOrder" id="inpRdbtnSchOrder1" checked>
                                        <label for="inpRdbtnSchOrder1">
                                            M&aacute;s Recientes
                                        </label>
                                    </li>
                                    <li>
                                        <input type="radio" name="inpRdbtnSchOrder" id="inpRdbtnSchOrder2">
                                        <label for="inpRdbtnSchOrder2">
                                            M&aacute;s Antiguos
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </li>-->
                        <li>
                            <div class="schFiterHeader">
                                <p>ETIQUETAS</p>
                                <hr>
                            </div>
                            <div class="schFiterBody">
                                    <ul class="schFilterLabelList">
                                        <li>
                                            <input type="radio" name="inpRdbtnSchLabel" id="inpRdbtnSchLabel0" value="0" checked>
                                            <label for="inpRdbtnSchLabel0">Todas</label>
                                        </li>
        HTML;

        $query = "select * from SUBETIQUETAS where LABEL_ID = 2 and SUBLABEL_ID != 0";
        try{
            $db_handler =  new S_MySQL("USER_DATA");
            $cursor = $db_handler->console($query);
            $cursor->setFetchMode(PDO::FETCH_BOTH);
            foreach($cursor as $row){
                $HTML .= <<< HTML
                                        <li>
                                            <input type="radio" name="inpRdbtnSchLabel" id="inpRdbtnSchLabel{$row['SUBLABEL_ID']}" value="{$row['SUBLABEL_ID']}">
                                            <label for="inpRdbtnSchLabel{$row['SUBLABEL_ID']}">{$row['NOMBRE']}</label>
                                        </li>
                HTML;
            }
            
        } catch(Exception $e){
            $HTML .= <<< HTML
                                                Error
            HTML;
        }
        $HTML .= <<< HTML
                                            
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        HTML;
        return $HTML;
    }
?>
