<?php

namespace App\Jobs;

use App\Models\WhTelegramMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TelegramJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $result = WhTelegramMessage::whereIssend('N')
                                    ->get();
        foreach($result as $row){
            $this->send_message($row->message);
            $row->issend = 'Y';
            $row->save();            
        }
    }

    private function send_message($message){
        $chat_id = env('TELEGRAM_CHANNEL_ID', '-1001504214634');
        $token = env('TELEGRAM_BOT_TOKEN','6869546401:AAGEhmIHvOUePT6aCAIXln0c-mtaOozAY84');
        $ch = curl_init("https://api.telegram.org/bot{$token}/sendMessage");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query([
            'chat_id' => $chat_id,
            'parse_mode' => 'HTML',
            'text' => $message,
        ]));
        $r = curl_exec($ch);
        curl_close($ch);

    }

}
