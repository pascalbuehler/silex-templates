<?php
require_once __DIR__.'/../classes/AbstractController.class.php';

class HomeController extends AbstractController {
    public function home() {
        $this->addData('title', 'Home');
        $this->addData('content', 'Home is empty');
        
        return '';
    }
}

