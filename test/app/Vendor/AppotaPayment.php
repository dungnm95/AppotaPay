<?php
require_once '../Config/configAppotaPay.php';
class AppotaPayment {

    protected $API_URL = API_URL;
    protected $API_KEY = API_KEY;
    protected $SECRET_KEY = SECRET_KEY;
    protected $SANDBOX = SANDBOX;
    protected $LANG = LANG;
    protected $VERSION = VERSION;
    protected $METHOD = METHOD;
    protected $SUCCESSURL = SUCCESSURL;
    protected $ERRORURL = ERRORURL;
    
    /**
     * build a array params of bank transation
     * @Call $this->setParamsBank($developer_trans_id,$amount,$bank_id,$client_ip)
     * @param string $developer_trans_id
     * @param string $amount
     * @param string $bank_id
     * @param string $client_ip
     * @return array
     */
    protected function setParamsBank($developer_trans_id,$amount,$bank_id,$client_ip){
        return array(
            'developer_trans_id' => $developer_trans_id, // product_code + time()
            'amount' => $amount, // product price
            'state' => STATE, // Optional param
            'target' => TARGET, // Optional param
            'success_url' => $this->SUCCESSURL, // Optional param
            'error_url' => $this->ERRORURL, // Optional param
            'bank_id' => $bank_id, // Optional param
            'client_ip' => $client_ip // Require param
        );
    }
    /**
     * build a array params of card transation
     * @Call $this->setParamsCard($developer_trans_id, $code, $serial, $vendor)
     * @param string $developer_trans_id
     * @param string $code
     * @param string $serial
     * @param string $vendor
     * @return array
     */
    protected function setParamsCard($developer_trans_id, $code, $serial, $vendor) {
        return array(
            'developer_trans_id' => $developer_trans_id,
            'card_code' => $code,
            'card_serial' => $serial,
            'vendor' => $vendor,
            'success_url' => $this->SUCCESSURL, 
            'error_url' => $this->ERRORURL,
            'state' => STATE, // Optional param
            'target' => TARGET // Optional param
        );
    }
    /**
     * make url and get respone result
     * @Call $this->makeRequest($url, $params, $method)
     * @param type $url
     * @param type $params
     * @param type $method
     * @return boolean
     */
    public function makeRequest($url, $params, $method = 'POST') {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); // Time out 60s
        curl_setopt($ch, CURLOPT_TIMEOUT, 60); // connect time out 60s
        $result = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_error($ch)) {
            return false;
        }
        if ($status != 200) {
            curl_close($ch);
            return false;
        }
        curl_close($ch);
        return $result;
    }

}
