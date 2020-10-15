<?php


namespace App\Libs\SmsNotifier;


interface SmsContract
{
    public function send($message, $to);
}
