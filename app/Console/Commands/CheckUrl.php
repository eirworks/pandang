<?php

namespace App\Console\Commands;

use App\Libs\SmsNotifier\SmsContract;
use App\Libs\SmsNotifier\Twilio;
use App\Models\Monitor;
use App\Models\Ping;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CheckUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check URL status and save it to pings';
    /**
     * @var SmsContract
     */
    private $sms;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SmsContract $sms)
    {
        parent::__construct();
        $this->sms = $sms;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $monitors = Monitor::where('activated', true)->get();

        foreach($monitors as $monitor)
        {
            $start = round(microtime(true) * 1000);
            $this->line("Pinging ".$monitor->url);
            $response = Http::get($monitor->url);
            $end = round(microtime(true) * 1000);
            $this->line("S".$start.", E".$end);

            $ping = new Ping([
                'status' => $response->status(),
                'request' => [],
                'response' => [],
                'time' => (($end - $start) / 1000),
            ]);
            $monitor->pings()->save($ping);
            $this->line("Pinged ".$monitor->url." for ".($ping->time)."ms");

            $cache[$monitor->url] = $ping;

            if ($ping->status != 200)
            {
                $this->sendNotification("Site Error!", $monitor->settings->get(Monitor::SETTING_SMS_NUMBER));
            }

            break;
        }

        return 0;
    }

    private function sendNotification($message, $target)
    {
        try {
            $this->line('Target: '.$target);
            $this->line('From: '.config('services.twilio.from'));
            $this->sms->send($message, $target);
        }
        catch (\Exception $exception)
        {
            $this->error("Error sending SMS notification: ".$exception->getMessage());
        }
    }
}
