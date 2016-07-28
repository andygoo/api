<?php

class Controller_Error extends Controller_Api {

    public function action_404() {
        $this->response = array('errno'=>-1, 'errmsg'=>'The method does not exist!');
    }
}
       