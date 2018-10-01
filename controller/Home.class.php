<?php
    class Home extends Controller {
        public function run () {
            $this->controllerRunURLCheck ();
            $this->view->render ();
        }
    }
