<?php
    /**
     * 控制器基类
     */
    class Controller extends Base {
        /** 
         * 当前的控制器
         * 
         * @var    string
         */
        protected $controller;
        
        /** 
         * 当前的动作
         * 
         * @var    string
         */
        protected $action;

        /** 
         * 视图
         * 
         * @var    string
         */
        protected $view;
        
        /** 
         * 模块
         * 
         * @var    string
         */
        protected $module;
        
        /** 
         * 参数
         * 
         * @var    string
         */
        protected $parameter;
        
        /**
         * 构造类
         *
         * @param  string $controller  控制器
         * @param  string $action      动作
         * @return void
         */
        public function __construct ($controller, $action, $module, $parameter) {
            $this->controller = $controller;
            $this->action = $action;
            $this->module = $module;
            $this->param = $parameter;
            $this->view = new View ($controller, $action, $module, $parameter);
        }
        
        /**
         * Controller Run URL 检查
         * 
         * @return void
         */
        function controllerRunURLCheck () {
            if (substr_count ($_SERVER['REQUEST_URI'], '/') > 1) {
                header ('HTTP/1.1 404 Not Found');
                exit ();
            }
        }
    }
