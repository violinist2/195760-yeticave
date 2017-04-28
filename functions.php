<?php
function connect_code($address, $data) {
    if  (file_exists($address)) {
        
        require_once($address);
    } else { 
        return '';
    }
    }

?>

  <!--extract($array_data);
    ob_start();
    include_once($template);
    $html_template = ob_get_clean();
    return $html_template;
}-->

<?php
function connect_code_lot($address_lot, $data_lot) {
    if  (file_exists($address_lot)) {
        
        require_once($address_lot);
    } else { 
        return '';
    }
    }

?>

