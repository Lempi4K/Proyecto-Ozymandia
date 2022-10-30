<?php
    //include($_SERVER['DOCUMENT_ROOT']."/modules/Simple_MongoDB_lib/Simple_MongoDB.php");

    function displaySearchBar($AJAX = true){
        $char = $AJAX ? "" : "A";
        $HTML = <<< HTML
        <div id="search-propagation">
            <div class="search-container">
                <div class="search" style="justify-self: center;">
                    <input type="search" name="fetch" id="inpSrhBanner{$char}" placeholder="Buscar" autocomplete="off">
                    <button id="btnSearch{$char}">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                <div class="schBackBox">
                    <ul class="schFilters">
                        <li>
                            <div class="schFiterHeader">
                                <p>ORDENAR POR</p>
                                <hr>
                            </div>
                            <div class="schFiterBody">
                                <ul class="schFilterOptionList">
                                    <li>
                                        <input type="radio" name="inpRdbtnSchOrder" id="inpRdbtnSchOrder1" value="-1" checked>
                                        <label for="inpRdbtnSchOrder1">
                                            M&aacute;s Recientes
                                        </label>
                                    </li>
                                    <li>
                                        <input type="radio" name="inpRdbtnSchOrder" id="inpRdbtnSchOrder2" value="1">
                                        <label for="inpRdbtnSchOrder2">
                                            M&aacute;s Antiguos
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="schFiterHeader">
                                <p>ETIQUETAS</p>
                                <hr>
                            </div>
                            <div class="schFiterBody">
                                    <ul class="schFilterLabelList">
                                        <li>
                                            <input type="radio" name="inpRdbtnSchLabel{$char}" id="inpRdbtnSchLabel0{$char}" value="0" checked>
                                            <label for="inpRdbtnSchLabel0{$char}">Todos</label>
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
                                            <input type="radio" name="inpRdbtnSchLabel{$char}" id="inpRdbtnSchLabel{$row['SUBLABEL_ID']}{$char}" value="{$row['SUBLABEL_ID']}">
                                            <label for="inpRdbtnSchLabel{$row['SUBLABEL_ID']}{$char}">{$row['NOMBRE']}</label>
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
