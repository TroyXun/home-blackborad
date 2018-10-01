<?php
    /**
     * Day Model
     * 倒数日模块
     * 
     * @author  Troy<troy@tencoe.com>
     * @since   Version 1.0.0
     */
    class DayModel extends Model {
        /**
         * 添加一条倒数日
         * 
         * @param  int    $timestamp      倒数日日期
         * @param  string $content        倒数日内容
         * @param  int    $editTimestamp  修改日期
         * @return int                    倒数日 ID
         */
        public function add ($timestamp, $content, $editTimestamp) {
            $return = $this->db->insert ('days_matter', [
                'timestamp' => $timestamp,
                'content' => $content,
                'edit_timestamp' => $editTimestamp
            ]);
            
            return $return;
        }
        
        /**
         * 修改一条倒数日
         * 
         * @param  int    $id             倒数日 ID
         * @param  int    $timestamp      倒数日日期
         * @param  string $content        倒数日内容
         * @param  int    $editTimestamp  修改日期
         * @return int                    倒数日 ID
         */
        public function edit ($id, $timestamp, $content, $editTimestamp) {
            $return = $this->db->update ('days_matter', [
                'timestamp' => $timestamp,
                'content' => $content,
                'edit_timestamp' => $editTimestamp
            ], [
                'id' => $id
            ]);
            
            return $return;
        }
        
        /**
         * 删除一条倒数日
         * 
         * @param  integer $id  要删除的倒数日的 ID
         * @return void
         */
        public function delete ($id) {
            $this->db->delete ('days_matter', [
                '$id' => $id
            ]);
        }
        
        /**
         * 获取单条倒数日信息
         * 
         * @param  integer $id  获取倒数日的 ID
         * @return array        倒数日信息
         */
        public function getContent ($id) {
            $return = $this->db->select ('days_matter', '*', [
                'id' => $id
            ]);
            
            return $return ? : -1;
        }
        
        /**
         * 获取所有倒数日信息
         * 
         * @return array  倒数日信息
         */
        public function getAllContent () {
            $return = $this->db->select ('days_matter', '*');
            
            return $return ? : -1;
        }
    }
