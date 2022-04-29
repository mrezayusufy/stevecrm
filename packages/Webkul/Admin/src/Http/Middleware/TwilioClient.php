<?php

namespace Webkul\Admin\Http\Middleware;

class TwilioClient {
    protected $accountSid;
    protected $authToken;
    protected $client;
    protected $curl;
    protected $_url;
    protected $post;
    protected $_postFields;
    protected $_option;
    function __construct() {
        $this->accountSid = env('TWILIO_ACCOUNT_SID');
        $this->authToken = env('TWILIO_AUTH_TOKEN');
    }
    // get conversations ? params: sid;
    function conversations(){
        $url = curl_init('https://conversations.twilio.com/v1/Conversations/');
    }
    // get messages ? params: sid
    // get participants
    function client($url){
        $curl = curl_init("https://conversations.twilio.com/v1/Conversations".$url);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $this->accountSid.":".$this->authToken); //Your credentials goes here
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //IMP if the url has https and you don't want to verify source certificate
        if($this->post) {
            curl_setopt($curl,CURLOPT_POST,true);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$this->_postFields);
        }
        $curl_response = curl_exec($curl);
        curl_close($curl);
        return $curl_response;
    }
}
