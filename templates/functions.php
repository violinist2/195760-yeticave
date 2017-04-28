<?php
function connect_code($address, $data) {
    if  (file_exists($address)) {
        
        require_once($address);
    } else { 
        return '';
    }
    }

?>

