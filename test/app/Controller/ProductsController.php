<?php

App::uses('Product', 'Model');

class ProductsController extends AppController {

    public $uses = array('Product', 'Category');
    public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash', 'Session');
    /**
     * set all products in db to variable and render to view
     */
    public function index() {
        $this->set('products', $this->Product->find('all'));
    }
}
