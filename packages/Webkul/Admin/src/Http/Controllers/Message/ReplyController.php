<?php
namespace Webkul\Admin\Http\Controllers\Message;
use Webkul\Admin\Http\Controllers\Controller;
use XmlResponse\Facades\XmlFacade;
use Webkul\Message\Repositories\MessageRepository;
use Twilio\TwiML\MessagingResponse;

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
        
        $response = new MessagingResponse();
        $response->message("The Robots are coming! Head for the hills!");
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
        $response = new MessagingResponse();
        $response->message("The Robots are coming! Head for the hills!");
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