<?php

namespace Webkul\Admin\Http\Controllers\Chat;

use Exception;
use Webkul\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;
use Twilio\Rest\Client;

class ChatController extends Controller
{
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
        $this->identity = config('services.twilio')['identity'];
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
        return response()->json(['token' => $token->toJWT()]);
    }
    public function conversations($name)
    {
        $con = $this->twilio_client->conversations->v1->conversations
            ->create([
                'friendlyName' => $name,
            ]);
        return response()->json($con->sid);
    }
    public function createConversation(Request $request)
    {
        $friendlyName = $request->get('friendlyName');
        $participant = $request->get('participant');
        $twilio = $this->twilio_client->conversations->v1;
        if (!$friendlyName && !$participant) {
            return response()->json(['error' => 'Please send data.'], 400);
        }
        $current = $twilio->participantConversations->read(["address" => $participant], 20);
        if (!$current) {
            try {
                $response = $twilio->conversations->create([
                    'friendlyName' => $friendlyName,
                ]);
                $twilio->conversations($response->sid)
                    ->participants
                    ->create([
                        "messagingBindingAddress"       => $participant,
                        "messagingBindingProxyAddress"  => $this->number,
                    ]);

                $result = [
                    'sid' => $response->sid,
                    'friendlyName' => $response->friendlyName,
                    'participant' => $participant,
                    'message' => 'Conversation created successfully',
                ];
                return response()->json($result);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage() . " " . $e->getCode()], 400);
            }
        } else {
            return response()->json(['message' => "the address is exist already."], 400);
        }
    }
    public function fetchConversations()
    {
        try {
            //code...
            $twilio = $this->twilio_client->conversations->v1;
            $response = $twilio->conversations->read(20);
            $data = [];
            foreach ($response as $item) {
                if ($item->friendlyName)
                    $data['conversations'][] = [
                        'sid' => $item->sid,
                        'friendlyName' => $item->friendlyName,
                        'date_created' => $item->dateCreated,
                        'date_updated' => $item->dateUpdated,
                        'messaging_service_sid' => $item->messagingServiceSid,
                        'chatService_sid' => $item->chatServiceSid,
                        'state' => $item->state,
                        'account_sid' => $item->accountSid,
                        'bindings' => $item->bindings,
                    ];
            }
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    /**
     * delete conversation
     * @param request sid
     */
    public function deleteConversation($sid)
    {
        $this->twilio_client->conversations($sid)->delete();
        $result = [
            'message' => 'Conversation deleted successfully',
            'status' => 200
        ];
        return response()->json($result);
    }
    /**
     * description: sendMessage()
     * @param string $sid
     */
    public function sendMessage($sid, Request $request)
    {
        $twilio = $this->twilio_client->conversations->v1;
        $body = $request->all();
        $response = $twilio->conversations($sid)
            ->messages->create([
                'body' => $body['body'],
                'author' => $this->identity,
            ]);

        return response()->json([
            'message' => 'Message sent successfully',
            'status' => 200,
            'response' => [
                'sid' => $response->sid,
                'account_sid' => $response->accountSid,
                'author' => $response->author,
                'body' => $response->body,
                'conversation_sid' => $response->conversationSid,
                'created_at' => $response->dateCreated,
                'updated_at' => $response->dateUpdated,
                'participant_sid' => $response->participantSid,
            ]
        ]);
    }
    /**
     * fetch messages by sid
     * @param sid
     * @return Array messages
     */
    public function messages($sid)
    {
        try {
            $twilio = $this->twilio_client->conversations->v1;
            $response = $twilio->conversations($sid)->messages->read([], 1000);
            $messages = [];
            foreach ($response as $message) {
                $messages[] = [
                    'sid' => $message->sid,
                    'account_sid' => $message->accountSid,
                    'conversation_sid' => $message->conversationSid,
                    'author' => $message->author,
                    'body' => $message->body,
                    'identity' => $this->identity,
                    'participant_sid' => $message->participantSid,
                    'created_at' => $message->dateCreated,
                    'updated_at' => $message->dateUpdated,
                    'media' => $message->media,
                ];
            }
            return response()->json(['messages' =>$messages]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e.getMessages()], 400);
        }
    }
    // create participant
    public function participant($participant, $sid)
    {
        $twilio = new Client($this->twilio_account_sid, $this->twilio_auth_token);
        $participant = $twilio->conversations->v1->conversations($sid)
            ->participants
            ->create([
                "messagingBindingAddress"       => $participant,
                "messagingBindingProxyAddress"  => $this->number,
            ]);
        return response()->json($participant->sid);
    }
    public function identity($identity)
    {
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
        return response()->json(['token' => $token->toJWT()]);
    }
}
