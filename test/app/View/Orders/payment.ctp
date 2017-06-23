<?php
if($product_id > 0){
    
echo $this->Form->create('Order');
echo $this->Form->input('payment_method', array(
    'options' => array('Bank Charging', 'Visa/ Credit Card Charging', 'Card Charging'),
    'empty' => '--Choose a payment method--'
), array('id' => 'payment_method'));
?>
<div class="hidden" id="card_charging">
    <?php
    echo $this->Form->input('vendor', array(
        'lable' => 'Vendor',
        'options' => $vendor,
        'empty' => '--Choose a vendor--'
    ));
    echo $this->Form->input('card_code', array('label' => 'Card code'));
    echo $this->Form->input('card_serial', array('label' => 'Card serial'));
    ?>
</div>
<?php 
echo $this->Form->end('Pay');

}
?>
