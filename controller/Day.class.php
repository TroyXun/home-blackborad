<?php
    class Day extends Controller {
        public function run () {
            $this->controllerRunURLCheck ();
            $this->view->render ();
        }
        
        public function new () {
            $this->view->render ('new');
        }
        
        public function add () {
            $dayModel = new DayModel;
            
            $id = $dayModel->add (substr ($_POST['timestamp'], 0, 10), $_POST['content'], time ());
            
            header ('Content-type: application/json');
            if ($id == -1) {
                exit (json_encode (array ('code' => -1, 'msg' => 'Add day failed.')));
            }
            
            exit (json_encode (array ('code' => 0)));
        }
        
        public function edit () {
            if (!isset ($_POST['content'])) {
                $this->view->render ('edit');
            } else {
                $dayModel = new DayModel;
                
                $id = $dayModel->edit ($_POST['id'], substr ($_POST['timestamp'], 0, 10), $_POST['content'], time ());
                
                header ('Content-type: application/json');
                if ($id == -1) {
                    exit (json_encode (array ('code' => -1, 'msg' => 'Edit day failed.')));
                }
                
                exit (json_encode (array ('code' => 0)));
            }
        }
        
        public function delete () {
            $dayModel = new DayModel;
            
            $id = $dayModel->delete ($_POST['id']);
            
            header ('Content-type: application/json');
            exit (json_encode (array ('code' => 0)));
        }
        
        public function getContent () {
            $dayModel = new DayModel;
            
            $content = $dayModel->getContent ($_POST['id']);
            
            header ('Content-type: application/json');
            if ($content == -1) {
                exit (json_encode (array ('code' => -1, 'msg' => 'Get day content failed.')));
            }
            
            exit (json_encode ($content));
        }
        
        public function getAllContent () {
            $dayModel = new DayModel;
            
            $content = $dayModel->getAllContent ();
            
            header ('Content-type: application/json');
            if ($content == -1) {
                exit (json_encode (array ('code' => -1, 'msg' => 'Get all day content failed.')));
            }
            
            exit (json_encode ($content));
        }
    }
