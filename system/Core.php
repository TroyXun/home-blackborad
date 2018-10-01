<?php
    /**
     * 框架主类
     */
    class Core {
        /** 
         * 当前 URL 模式
         * 
         * @var    string
         */
        private $urlmode;
        
        /**
         * 运行框架
         *
         * @return void
         */
        public function run ($urlmode = 1) {
            $this->urlmode = $urlmode;
            spl_autoload_register (array ($this, 'autoload'));
            if (!defined ('NOROUTE'))
            	$this->route ();
        }

        /**
         * 处理 URL
         *
         * @return void
         */
        public function route () {
        	/** 初始化变量 */
            $module = '';
            $controller = 'index';
            $action = 'run';
            
            /** 处理路由 */
            /** @ 为忽略错误 */
            if ($this->urlmode == 1) {
                $mode = explode (':', @$_GET['mod']);
            } else if ($this->urlmode == 2) {
                $mode = explode ('/', @$_SERVER['QUERY_STRING']);
            } else if ($this->urlmode == 3) {
                if (!isset ($_SERVER['PATH_INFO']))
                    $_SERVER['PATH_INFO'] = '';
                if (substr ($_SERVER['PATH_INFO'], -1) == '/') {
                    header ('Location: ' . APP_URL . '/index.php');
                    exit ();
                }
                    
                $mode = explode ('/', $_SERVER['PATH_INFO']);
                array_shift ($mode); // PATH_INFO 以 / 开头，应删除数组中第一个元素 / 。
            }
            
            /** 处理变量 */
            if (isset ($mode[0]) && is_dir (CONTROLLER_PATH . '/' . ucfirst ($mode[0]))) { // ucfirst () 首字母转为大写。
            	$module = $mode[0];
                array_shift ($mode);
            } else if (isset ($mode[0]) && file_exists (CONTROLLER_PATH . '/' . $module . '/' . ucfirst ($mode[0]) . '.class.php')) {
            	$controller = $mode[0];
            	array_shift ($mode);
            } else if ($_SERVER['PATH_INFO'] != '' && $_SERVER['PATH_INFO'] != 'index.php') {
                header ('HTTP/1.1 404 Not Found');
                exit ();
            }
            
            $initFile = CONTROLLER_PATH . '/' . ucfirst ($module) . '/Init.class.php';
            $initExists = file_exists ($initFile);
            $controllerFile = CONTROLLER_PATH . '/' . $module . '/' . ucfirst ($controller) . '.class.php';
            if ($initExists)
                require_once $initFile;
            require_once $controllerFile;
            
            if (isset ($mode[0]) && method_exists ($controller, $mode[0])) {
            	$action = $mode[0];
            	array_shift ($mode);
            }
            $parameter = $mode;
            
            /** 分发 */
            if ($initExists) {
                $initObject = new Init ($controller, $action, $module, $parameter); // 带参数的 new 。
                $initObject->run ();
                if (method_exists ($initObject, $controller))
                	$controllerObject->controller ();
            }
            $controllerObject = new $controller ($controller, $action, $module, $param);
            if (method_exists ($controller, 'init'))
            	$controllerObject->init ();
            $controllerObject->$action ();
        }

        /**
         * 自动加载
         *
         * @param  string $class 要加载的类
         * @return void
         */
        public function autoload ($class){
            /** 以 \ 分割，取分割后数组的第一个元素 */
            $class = reset (explode ('\\', $class));
            // $class = $class[0];
            /** 初始化变量 */
            $frame = FRAME_PATH . '/' . $class . '.class.php';
            $model = MODEL_PATH . '/' . $class . '.class.php';

            /** 检查文件并引入 */
            if (file_exists ($model)) {
                require_once $model;
            } else if (file_exists ($frame)) {
                require_once $frame;
            } else {
                die ('引入了一个不存在的类:' . $class);
            }
        }
    }
