<?php

namespace App\Console\Commands;

use App\Models\RV;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Medecin;

use Illuminate\Console\Command;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Api\SendSmsApi;
use Infobip\Configuration;
use Infobip\Model\SmsDestination;

use Exception;
use Throwable;

class alert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'command:name';
    protected $signature = 'alert:rappel_rv';

    /**
     * The console command description.
     *
     * @var string
     */
    //protected $description = 'Command description';
    protected $description = 'Alert pour des rappels de rendez-vous';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $demain = date('Y-m-d', strtotime('+1 day'));
        //return Command::SUCCESS;

        $rvs = RV::where('daterv', '=',  $demain )->get();
        if($rvs->count() > 0){
            foreach ($rvs as $rv) {
                $user = User::where('id', $rv->user_id)->firstOrFail();
                $medecin = User::where('id', $rv->medecin_id)->firstOrFail();

                             //send sms
                                $BASE_URL = "https://dm4me1.api.infobip.com";
                                $API_KEY = "cbb5e46dd28e62a771789d2917236f10-28445fa3-7849-4fca-9d1d-b1af47f2745f";

                                $SENDER = "Dr's Help";
                                $RECIPIENT='221'.$user->tel;
                                $MESSAGE_TEXT="Bonjour " . $user->prenom ." ". $user->nom . "\nN'oubliez pas votre renedez-vous avec Dr " . $medecin->nom ." demain le " . $rv->daterv . " à " . $rv->heurerv . "\nDoctor's Help vous souhaite un bon rétablissement !" ;

                                $configuration = (new Configuration())
                                    ->setHost($BASE_URL)
                                    ->setApiKeyPrefix('Authorization', 'App')
                                    ->setApiKey('Authorization', $API_KEY);

                                $client = new Client(['verify'=>false]);

                                $sendSmsApi = new SendSMSApi($client, $configuration);
                                $destination = (new SmsDestination())->setTo($RECIPIENT);
                                $message = (new SmsTextualMessage())
                                    ->setFrom($SENDER)
                                    ->setText($MESSAGE_TEXT)
                                    ->setDestinations([$destination]);

                                $request = (new SmsAdvancedTextualRequest())->setMessages([$message]);

                                try {
                                    $smsResponse = $sendSmsApi->sendSmsMessage($request);
                                    echo ("Response body: " . $smsResponse);
                                } catch (Throwable $apiException) {
                                    echo("HTTP Code: " . $apiException->getCode() . "\n");
                                }
                                // Medecin::create([
                                //     'qualite' => "informaticien1",
                                //     'user_id'=> 1
                                // ]);
            }
        }

     }
}
