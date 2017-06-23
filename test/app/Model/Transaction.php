<?php
class Transaction extends AppModel{
    public $belongsTo = array(
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'order_id'
        )
    );
    /**
     * save all information of transaction into database
     * @Call $this->Transaction->saveTrans($param)
     * @param array $param
     * @return array
     */
    public function saveTrans($param) {
        if ($this->save($param)) {
            $this->log('Save transaction SUCCESSFUL ', 'debug');
            return array('key' => 1, 'message' => 'Transation has been saved');
        } else {
            return array('key' => 0, 'message' => 'Transation could not saved');
        }
    }
    /**
     * check transaction is successfull or not
     * @Call $this->Transaction->checkTransaction($developer_trans_id)
     * @param string $developer_trans_id
     * @return array
     */
    public function checkTransaction($developer_trans_id) {
        $api_url = $this->API_URL . $this->VERSION . '/' . $this->SANDBOX . '/services/check_transaction_status?api_key=' . $this->API_KEY . '&lang=' . $this->LANG;
        $params = array(
            'developer_trans_id' => $developer_trans_id,
            'transaction_type' => 'BANK'
        );
        $result = $this->makeRequest($api_url, $params, $this->METHOD);
        $result = json_decode($result);
        if (isset($result->error_code) && $result->error_code === 0) { // transaction success
            $transaction_id = $result->data->transaction_id; // appota transaction id
            $developer_trans_id = $result->data->developer_trans_id; // developer transaction id
            $amount = $result->data->amount;
        } else { // trasaction fail 
            return array(
                'error_code' => $result->error_code,
                'message' => $result->message
            );
        }
    }
}