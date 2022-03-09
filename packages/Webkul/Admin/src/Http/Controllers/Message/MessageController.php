<?php

namespace Webkul\Admin\Http\Controllers\Message;

use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Message\Repositories\MessageRepository;
use Webkul\Automation\Repositories\AutomationRepository;
use Webkul\Core\Repositories\CoreConfigRepository as ConfigurationRepository;
use Twilio\Rest\Client;

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
  public function get($phone) {
    $response = $this->messageRepository->where('to', 'like', "%$phone%")->get();
    return response()->json($response);
  }
  public function send($phone)
  {
    $data = request()->all();
    $account_sid = $this->twilio['twilio_sid'];
    $auth_token = $this->twilio['twilio_secret'];
    $twilio_number = $this->twilio['twilio_number'];
    $client = new Client($account_sid, $auth_token);
    $client->messages->create(
      $phone,
      ['from' => $twilio_number, 'body' => $data['body']]
    );
    $message = [
      'to' => "$phone",
      'content' => $data['body']
    ];
    $this->messageRepository->create($message);
    session()->flash('success', trans('admin::app.leads.update-success'));
    return redirect()->back();
  }
  public function sendByAutomation($id){
    $now = Carbon::now("UTC");
    $automation = $this->automationRepository->findOrFail($id);
    $to = $automation['title'];
    $body = $automation['comment'];
    $message = '';
    $schedule_from = Carbon::parse($automation['schedule_from']);
    $schedule_to = Carbon::parse($automation['schedule_to']);
    $result = [];
    $at_period = $automation['at_period'];
    $is_done = $automation['is_done'];
    $account_sid = $this->twilio['twilio_sid'];
    $auth_token = $this->twilio['twilio_secret'];
    $twilio_number = $this->twilio['twilio_number'];
    $client = new Client($account_sid, $auth_token);
    if(isset($schedule_from) && isset($schedule_to) ){
      $client->messages->create(
        $to,
        ['from' => $twilio_number, 'body' => $body]
      );
      $message = [
        'to' => "$to",
        'content' => $body,
      ];
      $this->messageRepository->create($message);
      $result = [
        "msg" => "message send successfully.",
        "data" => $message
      ];
    } elseif ($schedule_from <= $now && $now <= $schedule_to) {
      $client->messages->create(
        $to,
        ['from' => $twilio_number, 'body' => $body]
      );
      $message = [
        'to' => "$to",
        'content' => $body,
      ];
      $this->messageRepository->create($message);
      $result = [
        "msg" => "message is scheduled successfully.",
        "data" => $message
      ];
    } 
    
    // session()->flash('success', trans('admin::app.leads.update-success'));
    return response()->json($result);
  }
}
