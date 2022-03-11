<?php
namespace Webkul\Admin\Http\Controllers\Message;
use Webkul\Admin\Http\Controllers\Controller;
use XmlResponse\Facades\XmlFacade;
use Webkul\Message\Repositories\MessageRepository;

// reply controller
class ReplyController extends Controller {
    protected $messageRepository;
    public function __construct(MessageRepository $messageRepository){
        $this->messageRepository = $messageRepository;
    }
    public function index() {
        // $number = $_POST["From"];
        // $body = $_POST["Body"];
        // $this->messageRepository->create([
        //     "to" => $number,
        //     "content" => "Dear Customer $number, You said: $body"
        // ]);
        return response(
            "<Response>".
                "<Message>".
                    "thanks for messaging me.".
                "</Message>".
            "</Response>", 
            200)->header('Content-Type', 'text/xml');
        // return response()->xml([
        //     "Message" => "This is a test"
        // ]);
    } 
    public function store() {
        // $number = $_POST["From"];
        // $body = $_POST["Body"];
        // $this->messageRepository->create([
        //     "to" => $number,
        //     "content" => "Dear Customer $number, You said: $body"
        // ]);
        return response(
            "<Response>".
                "<Message>".
                    "thanks for messaging me.".
                "</Message>".
            "</Response>", 
            200)->header('Content-Type', 'text/xml');
        // return response()->xml([
        //     "Message" => "This is a test"
        // ]);
    } 
}