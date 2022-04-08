<?php
namespace Webkul\Admin\Http\Controllers\Chat;

use Webkul\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;
use Twilio\Rest\Client;
class ChatController extends Controller {
    private $twilio_account_sid;
    private $twilio_api_key;
    private $twilio_api_secret;
    private $chat_service_sid;
    private $twilio_auth_token;
    private $twilio_client;
    private $number;
    private $identity;
    public function __construct()
    {
        $this->twilio_account_sid = config('services.twilio')['sid'];
        $this->twilio_auth_token = config('services.twilio')['auth'];
        $this->twilio_api_key = config('services.twilio')['key'];
        $this->twilio_api_secret = config('services.twilio')['secret'];
        $this->chat_service_sid = config('services.twilio')['grant'];
        $this->number = config('services.twilio')['number'];
        $this->twilio_client = new Client($this->twilio_account_sid, $this->twilio_auth_token);
        $this->identity = '';
    }
    public function index()
    {
        return view('admin::chat.index');
    }
    /**
     * description: getToken()
     * @param Request
     */
    public function getToken($identity)
    {
      $this->identity = $identity;
      // Create access token, which we will serialize and send to the client
      $token = new AccessToken(
        $this->twilio_account_sid,
        $this->twilio_api_key,
        $this->twilio_api_secret,
        3600,
        $this->identity
      );
      // Create Chat grant
      $chat_grant = new ChatGrant();
      $chat_grant->setServiceSid("IS6b569bbef20c4d5793fb0fd72de805c5");

      // Add grant to token
      $token->addGrant($chat_grant);

      // render token to string

      header('Access-Control-Allow-Origin:*');
      header('Access-Control-Allow-Methods:*');
      header('Access-Control-Allow-Headers:*');
      return response()->json( ['token'=>$token->toJWT()]);
    }
    public function conversations(){
        $twilio = new Client($this->twilio_account_sid, $this->twilio_auth_token);
        $con = $twilio->conversations->v1->conversations
                    ->create([
                        'friendlyName' => "Steve conversation"
                    ]);
        return response()->json($con->sid);
    }
    public function createConversation(){

    }
    public function fetchConversations(){
        $twilio = $this->twilio_client->conversations->v1;
        $response = $twilio->conversations->read(20);
        $data = [];
        foreach($response as $item){
            // $data['conversations'][] = ['sid'=>$item->sid];
            $messages = $twilio->conversations($item->sid)->messages->read([], 20);
            $message_list = [];
            foreach ($messages as $message) {
                $message_list[] = [
                    'sid' => $message->sid,
                    'author' => $message->author,
                    'body' => $message->body,
                ];
            }
            $data['conversations'][] = [
                'sid' => $item->sid,
                'friendlyName' => $item->friendlyName,
                'dateCreated' => $item->dateCreated,
                'dateUpdated' => $item->dateUpdated,
                'messagingServiceSid' => $item->messagingServiceSid,
                'chatServiceSid' => $item->chatServiceSid,
                'state' => $item->state,
                'accountSid' => $item->accountSid,
                'bindings' => $item->bindings,
                'messages' => $message_list,
            ];
            if(!!$message_list) {
            }

        }
        return response()->json($data);
    }

    public function messages($sid,$msid){
        $response = $this->twilio_client->conversations->v1->conversations($sid)
                    ->messages($msid)
                    ->fetch();
        $messages = [];
        foreach ($response as $msg) {
            $messages['messages'] = [
                $msg
            ];
        }
        return response()->json($messages);
    }
    // create participant
    public function participant($participant, $sid){
        $twilio = new Client($this->twilio_account_sid, $this->twilio_auth_token);
        $participant = $twilio->conversations->v1->conversations($sid)
                    ->participants
                    ->create([
                        "messagingBindingAddress"       => $participant,
                        "messagingBindingProxyAddress"  => $this->number,
                    ]);
        return response()->json($participant->sid);
    }
    public function identity($identity){
        $participant = $this->twilio_client->conversations->v1->conversations("CH70d503c762af45839d6678a196e4191c")
                    ->participants
                    ->create([
                        "identity" => $identity,
                    ]);
        return response()->json($participant->sid);
    }
    public function token($identity)
    {
      $this->identity = $identity;
      // Create access token, which we will serialize and send to the client
      $token = new AccessToken(
        $this->twilio_account_sid,
        $this->twilio_api_key,
        $this->twilio_api_secret,
        3600,
        $this->identity
      );

      // Create Chat grant
      $chat_grant = new ChatGrant();
      $chat_grant->setServiceSid($this->chat_service_sid);

      // Add grant to token
      $token->addGrant($chat_grant);
      header('Access-Control-Allow-Origin:*');
      header('Access-Control-Allow-Methods:*');
      header('Access-Control-Allow-Headers:*');
      // render token to string
      return response()->json([ 'token' => $token->toJWT()]);
    }

    public function deleteChannel()
    {
      $twilio = new Client($this->twilio_account_sid, env('TWILIO_TOKEN'));

      $twilio->chat->v2->services("IS6122135e5f254c43aada3655f2e85f75")
                 ->channels("CHb174f415825847399d884d55577c6924")
                 ->delete();

                 dd("done");
    }

}
