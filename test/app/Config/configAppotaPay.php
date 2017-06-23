<?php
//Appota payment gateway, cannot edit
define('API_URL', 'https://api.appotapay.com/');
//The API key
define('API_KEY', 'A180471-IJ3WAL-408A0269A4CD7478');
//The secret key
define('SECRET_KEY', 'WiMAtPI7SrjKvaRm');
//if wanna run in sandbox, if not, please set null value
define('SANDBOX', 'sandbox');
//set language, there are 2 value: vi and en
define('LANG', 'vi');

define('VERSION', 'v1');

define('METHOD', 'POST');
//app will direct to success url after payment has completed successfull.
define('SUCCESSURL', 'http://appota.dungnm/test/orders/success/');
//app will direct to success url after payment could not completed or not successfull.
define('ERRORURL', 'http://appota.dungnm/test/orders/error/');
define('STATE', '');
define('TARGET', '');