<h2>All products</h2>
<div class="row">
    <?php
    foreach ($products as $product) {
        echo '<div class="col-sm-3">';
        echo '<div>' . $this->Html->image('../img/' . $product['Product']['img'], array('class' => 'product_img')) . '</div>';
        echo '<div class="product_info"><p>' . $product['Product']['name'] . ' ' . $product['Product']['code'] . '</p>';
        $modal_view = 'myModal_'.$product['Product']['id'];
        echo $this->Form->button('View detail', array(
            'type' => 'button',
            'class' => 'btn btn-default',
            'data-toggle' => 'modal',
            'data-target' => '#'.$modal_view
        ));
        echo '</div></div>';

        //modal
        ?>
        <div id="<?php echo $modal_view; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Product detail</h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body-left"> 
                            <?php echo $this->Html->image('../img/' . $product['Product']['img'], array('class' => 'product_img')); ?>
                        </div>
                        <div class="modal-body-right">
                            <h4><?php echo $product['Product']['name'] . ' ' . $product['Product']['code']; ?></h4>
                            <p>Full color</p>
                            <p>Free size</p>
                            <h3><?php echo $product['Product']['amount']; ?></h3>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="modal-footer">
                        <?php echo $this->Html->link('Order and pay', array('controller' => 'orders', 'action' => 'payment', $product['Product']['id']),array('class' => 'btn btn-primary')) ?>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }
    ?>
</div>
