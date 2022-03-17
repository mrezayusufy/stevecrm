<?php

namespace Webkul\Admin\Http\Controllers\Message;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Message\Repositories\MessageRepository;
use Webkul\Attribute\Http\Requests\AttributeForm as Request;
use Webkul\Automation\Repositories\AutomationRepository;
use Webkul\Core\Repositories\CoreConfigRepository as ConfigurationRepository;
use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;
use Webkul\Automation\Models\TextTemplate;
use Thunder\Shortcode\HandlerContainer\HandlerContainer;
use Thunder\Shortcode\Parser\RegularParser;
use Thunder\Shortcode\Processor\Processor;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Webkul\Automation\Models\Automation;

class MessageController extends Controller
{
  protected $messageRepository;
  protected $automationRepository;
  protected $configurationRepository;
  protected $twilio;
  public function __construct(
    MessageRepository $messageRepository,
    ConfigurationRepository $configurationRepository,
    AutomationRepository $automationRepository
  ) {
    $this->messageRepository = $messageRepository;
    $this->automationRepository = $automationRepository;
    $this->configurationRepository = $configurationRepository;
    $this->twilio = $this->configurationRepository->twilio();
  }
  public function get($phone)
  {
    $response = $this->messageRepository->where('to', 'like', "%$phone%")->get();
    return response()->json($response);
  }
  public function send(Request $request, $phone)
  {

    $input = request()->all();
    $body = $input['body'];
    $account_sid = $this->twilio['twilio_sid'];
    $auth_token = $this->twilio['twilio_secret'];
    $twilio_number = $this->twilio['twilio_number'];
    $client = new Client($account_sid, $auth_token);
    $client->messages->create(
      $phone,
      ['from' => $twilio_number, 'body' => $body]
    );
    $message = [
      'to' => "$phone",
      'content' => $body
    ];
    $this->messageRepository->create($message);
    session()->flash('success', trans('admin::app.leads.update-success'));
    return redirect()->back();
  }
  public function sendAll(){
    $automaions = $this->automationRepository->all();
    $result = array();
    foreach($automaions as $a){
      if($this->sendByAutomation($a->id)) {
        $result[$a->id] = ["msg" =>"Message send successfully."];
      } else {
        $result[$a->id] = ["msg" =>"Message did not send."];
      }
    }

    return response()->json($result);
  }
  public function sendByAutomation($id)
  {
    $account_sid = $this->twilio['twilio_sid'];
    $auth_token = $this->twilio['twilio_secret'];
    $twilio_number = $this->twilio['twilio_number'];
    $client = new Client($account_sid, $auth_token);
      // find the stage id
    // find the leads
    $now = Carbon::now("UTC");
    // $automation = Automation::findOrFail($id);
    $automation = $this->automationRepository->findOrFail($id);
    $pipeline_stage_id = $automation['lead_pipeline_stage_id'];
    $recipient = $automation['recipient'];
    $time = $automation['send_time']; // time
    $days = $automation['days_after']; // days
    $res = [];
    if($recipient !== null) {
        $query = "SELECT l.created_at AS createdAt, l.title AS title, s.code AS code, p.name AS name, l.phone AS phone, l.firstname AS firstname, l.lastname AS lastname
                    FROM leads AS l
                    INNER JOIN lead_pipeline_stages AS s ON l.lead_pipeline_stage_id=s.id
                    INNER JOIN persons AS p ON l.person_id=p.id
                    WHERE s.id=$pipeline_stage_id
                    OR l.id=$recipient";
        $res = DB::select($query);
    } else {
        $query = "SELECT l.title, s.code, p.name
                    FROM leads AS l
                    INNER JOIN lead_pipeline_stages AS s ON l.lead_pipeline_stage_id=s.id
                    INNER JOIN persons AS p ON l.person_id=p.id
                    WHERE s.id=$pipeline_stage_id;";
        $res = DB::select($query);
    }
    $text_template_id = $automation['text_template_id'];
    $text_template = TextTemplate::find($text_template_id);

    foreach ($res as $item) {
        $createdAt = Carbon::parse($item->createdAt);
        $createdAt->addDays($days);
        $createdAt->setHour($time);
        $to = $item->phone;
        $name = $item->name;
        $body = $text_template->body;
        $message = '';
        $result = [];
        $message = [
          'to' => "$to",
          'content' => $body,
        ];

        if (
            $now->hour === $createdAt->hour
          && $now->year === $createdAt->year
          && $now->month === $createdAt->month
          && $now->day === $createdAt->day
        ) {
          // send msg by twilio to client
          $client->messages->create(
            $to,
            ['from' => $twilio_number, 'body' => $body]
          );
          // store the msg
          $this->messageRepository->create($message);
          $automation->status = '0';
          $automation->is_done = '1';
          $automation->save();
          // result
          $result = [
            "msg" => "message is scheduled successfully.",
            "data" => $body
          ];
          return $result;
        } elseif ($days === "0" && $time === "0") {
            $client->messages->create(
                $to,
                ['from' => $twilio_number, 'body' => $body]
              );
              // store the msg
              $this->messageRepository->create($message);
              $automation->status = '0';
              $automation->is_done = '1';
              $automation->save();
              // result
              $result = [
                "msg" => "message is sent immediately successfully.",
                "data" => $body
              ];
            return $result;
        } else {
            return [
                "msg" => "msg not send"
            ];
        }
    } // end foreach
    return $res;
  }


      // $message->body("Thanks for the message. Configure your number's SMS URL to change this message.Reply HELP for help.Reply STOP to unsubscribe.Msg&Data rates may apply.");
      //333 $this->messageRepository->create([
      //   "to" => $number,
      //   "body" => $body
      // ]);
}
