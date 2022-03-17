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
        $number = $_REQUEST["From"];
        $body = $_REQUEST["Body"];
        $this->messageRepository->create([
            "to" => $number,
            "content" => "Dear Customer $number, You said: $body"
        ]);

        $response = new MessagingResponse();
        $response->message("The Robots are coming! Head for the hills!");
        return response(
            "<Response>".
                "<Message>".
                    "thanks for messaging me.".
                "</Message>".
            "</Response>",
            200)->header('Content-Type', 'text/xml');
    }
    public function store() {
        $number = $_REQUEST["From"];
        $body = $_REQUEST["Body"];
        $this->messageRepository->create([
            "to" => $number,
            "content" => "Hello Dear customer, $number"
        ]);
        $response = new MessagingResponse();
        $message = [
            "to" => $number,
            "content" => "Hello Dear customer, $number"
          ];
        $this->messageRepository->create($message);
        $response->message("The Robots are coming! Head for the hills!");
        return response(
            "<Response>".
                "<Message>".
                    "Hello Dear Customer, $number".
                "</Message>".
            "</Response>",
            200)->header('Content-Type', 'text/xml');
    }
}
