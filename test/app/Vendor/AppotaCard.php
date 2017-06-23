<?php

require_once 'AppotaPayment.php';

class AppotaCard extends AppotaPayment {
    /**
     * return payment url
     * @Call $appotaCardObj->cardCharging($developer_trans_id, $code, $serial, $vendor)
     * @param string $developer_trans_id
     * @param string $code
     * @param string $serial
     * @param string $vendor
     * @return string
     */
    public function cardCharging($developer_trans_id, $code, $serial, $vendor) {
        $api_url = $this->API_URL . $this->VERSION . '/' . $this->SANDBOX . '/services/card_charging?api_key=' . $this->API_KEY . '&lang=' . $this->LANG;
        $params = $this->setParamsCard($developer_trans_id, $code, $serial, $vendor);
        $result = json_decode($this->makeRequest($api_url, $params, $this->METHOD));
        if (isset($result->error_code) && $result->error_code === 0) { // charging success
            return array(
                'success' => true,
                'amount' => $result->data->amount,
                'transaction_id' => $result->data->transaction_id
            );
        } else {
            return array(
                'success' => false,
                'error_code' => $result->error_code,
                'message' => $result->message
            );
        }
    }
}
