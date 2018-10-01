<?php
    /**
     * Note Model
     * 笔记模块
     * 
     * @author  Troy<troy@tencoe.com>
     * @since   Version 1.0.0
     */
    class NoteModel extends Model {
        /**
         * 添加一条笔记
         * 
         * @param  string $content    笔记内容
         * @param  int    $timestamp  修改日期
         * @return int                笔记 ID
         */
        public function add ($content, $timestamp) {
            $return = $this->db->insert ('note', [
                'content' => $content,
                'timestamp' => $timestamp
            ]);
            
            return $return ? : -1;
        }
        
        /**
         * 修改一条笔记
         * 
         * @param  integer $id         笔记 ID
         * @parar  string  $content    笔记内容
         * @param  int     $timestamp  修改日期
         * @return int                 笔记 ID
         */
        public function edit ($id, $content, $timestamp) {
            $return = $this->db->update ('note', [
                'content' => $content,
                'timestamp' => $timestamp
            ], [
                'id' => $id
            ]);
            
            return $return ? : -1;
        }
        
        /**
         * 删除一条笔记
         * 
         * @param  integer $id  要删除笔记的 ID
         * @return void
         */
        public function delete ($id) {
            $this->db->delete ('note', [
                'id' => $id
            ]);
        }

        /**
         * 获取单条笔记信息
         * 
         * @param  integer $id  获取笔记的 ID
         * @return array        笔记信息
         */
        public function getContent ($id) {
            $return = $this->db->select ('note', '*', [
                'id' => $id
            ]);
            
            return $return ? : -1;
        }
        
        /**
         * 获取所有笔记信息
         * 
         * @return array  笔记信息
         */
        public function getAllContent () {
            $return = $this->db->select ('note', '*');
            
            return $return ? : -1;
        }
    }
