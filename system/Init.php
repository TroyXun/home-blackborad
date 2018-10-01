<?php
    /** 定义 */
    define ('FRAME_PATH', APP_PATH . '/system');
    define ('CONFIG_PATH', APP_PATH . '/config');
    define ('MODEL_PATH', APP_PATH . '/model');
    define ('VIEW_PATH', APP_PATH . '/templates');
    define ('CONTROLLER_PATH', APP_PATH . '/controller');
    define ('LIB_PATH', APP_PATH . '/lib');
    
    define ('FRAME_VERIONS', '1.0.0');

    require_once FRAME_PATH . '/Core.php';
    foreach (glob (CONFIG_PATH . '/*.php') as $configFile) {
        require_once $configFile;
    }

    $f = new Core;
    $f->run (3);
