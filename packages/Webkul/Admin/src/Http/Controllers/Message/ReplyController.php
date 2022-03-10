<?php
namespace Webkul\Admin\Http\Controllers\Message;
use Webkul\Admin\Http\Controllers\Controller;
use XmlResponse\Facades\XmlFacade;

class ReplyController extends Controller {
    public function __construct(){}
    public function index() {
        $number = $_POST["From"];
        $body = $_POST["Body"];
        
        return response("<Response><Message>Dear Customer $number, You said: $body</Message></Response>", 200)
                  ->header('Content-Type', 'text/xml');
    }
}