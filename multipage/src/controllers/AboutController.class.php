<?php
require_once __DIR__.'/../classes/AbstractController.class.php';

class AboutController extends AbstractController {
    public function about() {
        $this->addData('title', 'About');
        $this->addData('content', 'About is empty');
        
        return '';
    }
}

