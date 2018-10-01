<?php
    define ('APP_PATH', __DIR__);
    define ('APP_URL', rtrim (rtrim (dirname ($_SERVER['SCRIPT_NAME']), '\\'), '/'));
    
    require_once 'system/Init.php';
    