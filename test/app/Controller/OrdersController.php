<?php

App::uses('Product', 'Model');
App::uses('Order', 'Model');
App::uses('Transaction', 'Model');
require_once '../Vendor/AppotaBank.php';
require_once '../Vendor/AppotaCard.php';
require_once '../Vendor/AppotaCredit.php';

class OrdersController extends AppController {

    public $uses = array('Order', 'Product', 'Transaction');
    public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash', 'Cookie', 'RequestHandler');
    /**
     * 
     * @param number $product_id
     */
    public function payment($product_id = '') {
        $this->set('vendor', $this->Order->getVendor());
        $this->set('product_id', $product_id);
        if ($product_id != null) {
            if ($this->request->is('post')) {
                $product = $this->Product->findProductById($product_id);
                $developer_trans_id = $product['Product']['code'] . time();
                $amount = $product['Product']['amount'];
                $client_ip = $this->RequestHandler->getClientIP();
                $this->saveProcessPayment($developer_trans_id, $amount, $client_ip, $product_id);
            }
        } else {
            $order = $this->Cookie->read('order');
            if (isset($this->params->params['named']['success'])) {
                if ($this->Order->updateOrder($order)) {
                    $this->Flash->success(__('Transaction successful'));
                } else {
                    $this->Flash->error(__('Transaction fail'));
                }
            }
        }
    }
    /**
     * This function will run after transation is successful.
     * $this->succes();
     * No additional parameters
     */
    public function success() {
        $this->set('check', $this->Order->checkSuccesProcess($_REQUEST));
    }
    
    /**
     * Save process payment 
     * @Call $this->saveProcessPayment($developer_trans_id, $amount, $client_ip, $product_id);
     * @param type $developer_trans_id
     * @param type $amount
     * @param type $client_ip
     * @param type $product_id
     * @return redirect to payment url
     */
    public function saveProcessPayment($developer_trans_id, $amount, $client_ip, $product_id) {
        if ($this->request->data['Order']['payment_method'] == '') {
            return $this->Flash->error(__('Please choose Payment method or Banking'));
        } else {
            $paymentUrl = $this->checkPaymentMethod($this->request->data['Order']['payment_method'],$developer_trans_id,$amount,$client_ip);
            if ($order = $this->Order->saveOrder($developer_trans_id, $product_id, $amount, $client_ip > 0)) {
                $this->Cookie->write('order', $order);
                $this->redirect($paymentUrl);
            }
        }
    }
    /**
     * this function will run after transation is error.
     * @Call $this->error()
     * @param No additional parameters
     */
    public function error() {
        $this->set('check', $this->Order->checkErrorProcess($_REQUEST));
    }
    /**
     * Get payment url.
     * @Call $this->checkPaymentMethod($payment_method,$developer_trans_id,$amount,$client_ip);
     * @param string $payment_method
     * @param string $developer_trans_id
     * @param string $amount
     * @param string $client_ip
     * @return string
     */
    public function checkPaymentMethod($payment_method,$developer_trans_id,$amount,$client_ip) {
        $paymentUrl = '';
        switch ($payment_method) {
            case 0:
                $bankObj = new AppotaBank();
                $paymentUrl = $bankObj->getPaymentUrl($developer_trans_id, $amount, 0, $client_ip);
                break;
            case 1:
                $creditObj = new AppotaCredit();
                $paymentUrl = $creditObj->getPaymentUrl($developer_trans_id, $amount, 0, $client_ip);
                break;
            case 2:
                $cardObj = new AppotaCard();
                $paymentUrl = $cardObj->cardCharging($developer_trans_id, $this->request->data['Order']['card_code'], $this->request->data['Order']['card_serial'], $this->request->data['Order']['vendor']);
                break;
        }
        return $paymentUrl;
    }

}
