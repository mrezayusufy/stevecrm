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
        $number = $_POST["From"];
        $body = $_POST["Body"];
        $this->messageRepository->create([
            "to" => $number,
            "body" => $body
        ]);
        return response(
            "<Response>".
                "<Message>".
                    "Dear Customer $number, You said: $body".
                "</Message>".
            "</Response>", 
            200)->header('Content-Type', 'text/xml');
    }
}