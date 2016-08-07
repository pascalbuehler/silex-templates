<?php
require_once __DIR__.'/../classes/AbstractController.class.php';

class HomeController extends AbstractController {
    public function home() {
        $this->app[__CLASS__.'.'.__FUNCTION__.'.data'] = array(
            'title' => 'Home',
            'content' => 'Empty',
        );
        
        return '';
    }
}

