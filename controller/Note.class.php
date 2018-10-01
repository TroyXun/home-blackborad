<?php
    class Note extends Controller {
        public function run () {
            $this->controllerRunURLCheck ();
            $this->view->render ();
        }
        
        public function new () {
            $this->view->render ('new');
        }
        
        public function edit () {
            if (!isset ($_POST['content'])) {
                $this->view->render ('edit');
            } else {
                $noteModel = new NoteModel;
            
                $id = $noteModel->edit ($_POST['id'], $_POST['content'], time ());
            
                header ('Content-type: application/json');
                if ($id == -1) {
                    exit (json_encode (array ('code' => -1, 'msg' => 'Edit note failed.')));
                }
                
                exit (json_encode (array ('code' => 0)));
            }
        }
        
        public function add () {
            $noteModel = new NoteModel;
            
            $id = $noteModel->add ($_POST['content'], time ());
            
            header ('Content-type: application/json');
            if ($id == -1) {
                exit (json_encode (array ('code' => -1, 'msg' => 'Add note failed.')));
            }
            
            exit (json_encode (array ('code' => 0)));
        }
        
        public function delete () {
            $noteModel = new NoteModel;
            
            $id = $noteModel->delete ($_POST['id']);
            
            header ('Content-type: application/json');
            exit (json_encode (array ('code' => 0)));
        }
        
        public function getContent () {
            $noteModel = new NoteModel;
            
            $content = $noteModel->getContent ($_POST['id']);
            
            header ('Content-type: application/json');
            if ($content == -1) {
                exit (json_encode (array ('code' => -1, 'msg' => 'Get note content failed.')));
            }
            
            exit (json_encode ($content));
        }
        
        public function getAllContent () {
            $noteModel = new NoteModel;
            
            $content = $noteModel->getAllContent ();
            
            header ('Content-type: application/json');
            if ($content == -1) {
                exit (json_encode (array ('code' => -1, 'msg' => 'Get all note content failed.')));
            }
            
            exit (json_encode ($content));
        }
    }
