<?php

App::uses('Transaction', 'Model');

class Order extends AppModel {

    private $banking_id = array(
        1 => 'Vietcombank',
        2 => 'Techcombank',
        3 => 'TienPhong Bank',
        4 => 'Viettin Bank',
        5 => 'VIB',
        6 => 'DongA Bank',
        7 => 'HD Bank',
        8 => 'MB',
        9 => 'VietA Bank',
        10 => 'Maritime Bank',
        11 => 'Eximbank',
        12 => 'SHB',
        14 => 'VP Bank',
        15 => 'AnBinh Bank',
        16 => 'SacomBank',
        17 => 'NamA Bank',
        18 => 'Ocean Bank',
        19 => 'BIDV',
        20 => 'Sea Bank',
        22 => 'BacA Bank',
        23 => 'Navibank',
        24 => 'Agribank',
        25 => 'Saigonbank',
        27 => 'PVCombank',
    );
    private $vendor = array(
        'viettel' => 'Viettel',
        'vinaphone' => 'Vinaphone',
        'mobifone' => 'Mobifone',
        'fpt' => 'FPT',
        'mega' => 'Mega',
        'vtc' => 'VTC',
        'appota' => 'Appota',
    );
    public $belongsTo = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'product_id'
        )
    );
    public $hasMany = array(
        'Transaction' => array(
            'className' => 'Transaction',
        )
    );
    public $components = array('Cookie');
    /**
     * get list of bank
     * @Call $this->Order->getListBanking()
     * @return array
     */
    public function getListBanking() {
        return $this->banking_id;
    }
    /**
     * get list of vendor
     * @Call $this->Order->getVendor()
     * @return array
     */
    public function getVendor() {
        return $this->vendor;
    }
    /**
     * Find order by code
     * @Call $this->Order->findOrderByCode($product_code)
     * @param string $product_code
     * @return array
     */
    public function findOrderByCode($product_code) {
        return $this->find('first', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'Order.code' => $product_code
                    )
        ));
    }
    /**
     * build array params order to make payment url
     * @Call $this->buildDataOrder($status, $request)
     * @param string $status
     * @param array $request
     * @return array
     */
    public function buildDataOrder($status, $request) {
        $data_order = array(
            'status' => $status,
            'code' => $request['developer_trans_id'],
            'currency' => $request['currency'],
            'country_code' => $request['country_code']
        );
        return $data_order;
    }
    /**
     * save order into database
     * @Call $this->Order->saveOrder($developer_trans_id,$product_id,$amount,$client_ip)
     * @param string $developer_trans_id
     * @param number $product_id
     * @param string $amount
     * @param string $client_ip
     * @return number
     */
    public function saveOrder($developer_trans_id,$product_id,$amount,$client_ip) {
        $data = array(
            'status' => 'FAIL',
            'code' => $developer_trans_id,
            'product_id' => $product_id,
            'amount' => $amount,
        );
        if ($order_id = $this->save($data)) {
            $this->log('ADD ORDER: \n code:' . $developer_trans_id . ' amount: ' . $amount . ' client_IP: ' . $client_ip, 'debug');
            return $order_id;
        }else{
            return false;
        }
    }
    /**
     * update order after transaction is successfull
     * @Call $this->Order->updateOrder($data)
     * @param array $data
     * @return boolean
     */
    public function updateOrder($data) {
        $data['Order']['status'] = 'SUCCESS';
        if ( $this->save($data)) {
            $this->log('UPDATE ORDER: \n code:' . $data['Order']['code'] . ' amount:'. $data['Order']['amount']. ' pay by card', 'debug');
            return true;
        }else{
            return false;
        }
    }
    /**
     * build array params transation 
     * @Call $this->buildDataTrans($request)
     * @param array $request
     * @return array
     */
    public function buildDataTrans($request) {
        $data_trans = array(
            'hash' => $request['hash'],
            'transaction_type' => $request['transaction_type'],
            'type' => $request['type']
        );
        return $data_trans;
    }
    /**
     * check proccess and give a message after save order and transaction in db
     * @Call $this->Order->checkSuccesProcess($request)
     * @param array $request
     * @return boolean
     */
    public function checkSuccesProcess($request) {
        $data_order = $this->buildDataOrder('SUCCESS', $request);
        $data_trans = $this->buildDataTrans($request);
        if ($order = $this->findOrderByCode($request['developer_trans_id'])) {
            $data_order['id'] = $order['Order']['id'];
        }
        $check_save = array();
        if ($this->save($data_order)) {
            $check_save['order'] = array('key' => 1, 'message' => 'Save order successfull');
            $this->log('UPDATE ORDER: code: ' . $request['developer_trans_id'] . ' status: SUCCESS', 'debug');
        } else {
            $check_save['order'] = array('key' => 0, 'message' => 'Save order fail');
            $this->log('UPDATE ORDER: code: ' . $request['developer_trans_id'] . ' status: ERROR', 'debug');
        }
        $data_trans['order_id'] = $order['Order']['id'];
        $check_save['trans'] = $this->Transaction->saveTrans($data_trans);
        return $check_save;
    }
    /**
     * check proccess and give a message after save order with status is error and transaction in db
     * @Call $this->Order->checkErrorProcess($request)
     * @param array $request
     * @return boolean
     */
    public function checkErrorProcess($request) {
        $data = $this->buildDataOrder('CANCEL', $request);
        $data_trans = $this->buildDataTrans($request);
        if ($order = $this->findOrderByCode($request['developer_trans_id'])) {
            $data['id'] = $order['Order']['id'];
        }
        $check_save = array();
        if ($this->save($data)) {
            $check_save['order'] = array('key' => 1, 'message' => 'Cancel order successfull');
        } else {
            $check_save['order'] = array ('key' => 0, 'message' => 'Cancel order fail');
        }
        $data_trans['order_id'] = $order['Order']['id'];
        $check_save['trans'] = $this->Transaction->saveTrans($data_trans);
        return $check_save;
    }

}
