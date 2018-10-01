<?php
    class Index extends Controller {
        public function run () {
            $this->controllerRunURLCheck ();
            $this->view->render ();
        }
    }
