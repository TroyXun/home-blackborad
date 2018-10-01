<?php
    /**
     * Model Base Class
     * 模型基类
     * 
     * @author  Troy<troy@tencoe.com>
     * @since   Version 1.0.0
     */
    
    class Model extends Base {
        /** 
         * 数据库类
         * 
         * @var    medoo
         */
        protected $db;
        
        /**
         * 构造类
         *
         * @return void
         */
        public function __construct () {
            if (DBHOST != '') {
                $this->db = new \Medoo\Medoo ([
                    'database_type' => 'mysql',
                    'database_name' => DATABASE_NAME,
                    'server' => DATABASE_HOST,
                    'username' => DATABASE_USERNAME,
                    'password' => DATABASE_PASSWORD,
                    'charset' => 'utf8',
                    'option' => array (
                        PDO::ATTR_PERSISTENT => DBPERSISTENT
                    )
                ]);
            }
        }
    }
