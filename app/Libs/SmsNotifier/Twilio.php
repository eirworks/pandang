<?php


namespace App\Libs\SmsNotifier;


use Twilio\Rest\Client;

class Twilio implements SmsContract
{
    /**
     * @var string
     */
    private $sid;
    /**
     * @var string
     */
    private $token;
    /**
     * @var string
     */
    private $from;

    public function __construct()
    {
        $this->sid = config('services.twilio.sid');
        $this->token = config('services.twilio.token');
        $this->from = config('services.twilio.from');
    }

    private function sendSMS($message, $to)
    {
        if (strlen($message) > 320)
        {
            throw new \Exception("SMS message body is too long");
        }

        if (empty($to))
        {
            throw new \Exception("Invalid target number");

        }

        $client = new Client($this->sid, $this->token);

        $client->messages->create(
            $to,
            [
                'from' => $this->from,
                'body' => $message,
            ]
        );
    }

    public function send($message, $to)
    {
        $this->sendSMS($message, $to);
    }
}
