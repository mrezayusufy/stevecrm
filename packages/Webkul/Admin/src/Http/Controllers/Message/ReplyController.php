<?php
namespace Webkul\Admin\Http\Controllers\Message;
use Webkul\Admin\Http\Controllers\Controller;
use XmlResponse\Facades\XmlFacade;

class ReplyController extends Controller {
    public function __construct(){}
    public function index() {
        $number = $_POST["From"];
        $body = $_POST["Body"];
        header("Content-type: text/xml");
        return response()->xml([
            "Response"=> [
                "Message" => "Dear Customer $number, Your message: $body."
            ]
        ]);
    }
}