<?php
require_once __DIR__.'/../classes/AbstractController.class.php';

class ProductsController extends AbstractController {
    private $products = array(
        array(
            'name' => 'Tree Portals',
            'img' => 'http://www.crystalinks.com/fractaltrees.jpg',
        ),
        array(
            'name' => 'Buddhabrot',
            'img' => 'http://superliminal.com/fractals/bbrot/bbrot.jpg',
        ),
        array(
            'name' => 'Seamless',
            'img' => 'http://img5.cliparto.com/pic/xl/267385/5489558-seamless-abstract-fractal-pattern-background.jpg',
        ),
        array(
            'name' => 'Replicating',
            'img' => 'https://s-media-cache-ak0.pinimg.com/564x/e5/b7/55/e5b75554d1504edaf11c1c17520db7de.jpg',
        ),
        array(
            'name' => 'Tunnel',
            'img' => 'http://www.fractaldomains.com/site/wp-content/uploads/2011/08/twisted-tunnel-of-madness.jpg',
        ),
    );
    
    
    public function products() {
        $this->addData('title', 'Products');
        $this->addData('products', $this->products);

        return '';
    }
}

