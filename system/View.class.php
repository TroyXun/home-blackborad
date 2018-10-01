<?php
    /**
     * View Base Class
     * 视图基类
     * 
     * @author  Troy<troy@tencoe.com>
     * @since   Version 1.0.0
     */
    class View extends Base {
        /** 
         * 当前的控制器
         * 
         * @var    string
         */
        private $controller;
        
        /** 
         * 当前的动作
         * 
         * @var    string
         */
        private $action;
        
        /** 
         * 当前的模块
         * 
         * @var    string
         */
        private $module;
        
        /** 
         * 当前的参数
         * 
         * @var    array
         */
        protected $param;
        
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
        }

        /**
         * 渲染视图
         * 
         * @param  string $view  渲染的视图名
         * @param  string $data  传递给视图的数据 
         * @return void
         */
        public function render ($path = NULL, $noModule = false) {
            if ($path === NULL)
                $view = $this->controller;
            else
                $view = $this->controller . '/' . $path;
            if ($this->module == '' || $noModule == true)
                require_once VIEW_PATH . '/' . $view . '/' . 'index.php';
            else
                require_once VIEW_PATH . '/' . $this->module . '/' . 'index.php';
        }

        /**
         * 加载资源
         *
         * @param  string $name  文件名
         * @return string        资源地址
         */
        public function loadSource ($name) {
            return VIEW_URL . '/' . $name;
        }
    }
