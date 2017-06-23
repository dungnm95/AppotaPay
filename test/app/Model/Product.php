<?php
class Product extends AppModel{
    public $hasMany = array(
        'Order' => array(
            'className' => 'Order',
        )
    );
    /**
     * find product's information by id
     * @Call $this->Product->findProductById($product_id)
     * @param number $product_id
     * @return array
     */
    public function findProductById($product_id) {
        return $this->find('first', array(
            'recursive'  => -1,
            'conditions' => array(
                'Product.id' => $product_id
            )
        ));
    }
}