<?php
require_once 'AppotaPayment.php';
class AppotaBank extends AppotaPayment{
    /**
     * return payment url
     * @Call $appotabankObj-> getPaymentUrl($developer_trans_id, $amount, $bank_id, $client_ip)
     * @param string $developer_trans_id
     * @param string $amount
     * @param string $bank_id
     * @param string $client_ip
     * @return string
     */
    public function getPaymentUrl($developer_trans_id, $amount, $bank_id = 0, $client_ip) {
        $api_url = $this->API_URL . $this->VERSION . '/' . $this->SANDBOX . '/services/ibanking?api_key=' . $this->API_KEY . '&lang=' . $this->LANG;
        $params = $this->setParamsBank($developer_trans_id, $amount, $bank_id, $client_ip);
        $result = json_decode($this->makeRequest($api_url, $params, $this->METHOD));
        if (isset($result->error_code) && $result->error_code === 0) { // charging success
            $transaction_id = $result->data->transaction_id;
            $bank_options = $result->data->bank_options;
            return $bank_options[0]->url;
        }
    }
}