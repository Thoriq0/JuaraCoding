<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(0);
// API key
$apiKey = '4ad75498f665ec44c5b91e70c3cf6698';

// API auth credentials
$apiUser = "admindika";
$apiPass = "B3ndh1L2019";

// API URL
$url = 'https://rest-api.ptdika.com/api/email?Email_ID=d0adfc970fa7ff8937be8dbfe14e5ec1';

// Create a new cURL resource
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: " . $apiKey));
curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");

$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);
$data = json_decode($result)->data;

$config['charset'] = 'utf-8';
$config['useragent'] = 'CodeIgniter';
$config['protocol'] = 'smtp';
$config['smtp_crypto'] = 'ssl'; //mail, sendmail, or smtp
$config['smtp_host'] = 'mail.ptdika.com';
$config['smtp_port'] = 465;
$config['smtp_timeout'] = 5; //SMTP Timeout (in seconds)
$config['smtp_user'] = $data->Email; //change this
$config['smtp_pass'] = $data->Password; //change this
$config['validate'] = TRUE; // bool whether to validate email or not
$config['wordwrap'] = TRUE;
$config['priority'] = 3; //Email Priority. 1 = highest. 5 = lowest. 3 = normal.
$config['newline'] = "\r\n"; //use double quotes to comply with RFC 822 standard