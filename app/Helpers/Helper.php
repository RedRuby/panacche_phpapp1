<?php
namespace App\Helpers;
use Mail;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;

class Helper {
    public static function sendmail($data, $template, $subject, $fromEmail, $fromName, $toEmail, $emailTitle){

        try{

        $mail = Mail::send(['text'=>$template], $data, function($message) use ($subject, $toEmail, $emailTitle, $fromEmail, $fromName) {
                $message->to($toEmail, $emailTitle)->subject($subject);
                $message->from($fromEmail,$fromName);
             });
        Log::info("my email".$mail);
        return $mail;


            /*
                $message->from($address, $name = null);
                $message->sender($address, $name = null);
                $message->to($address, $name = null);
                $message->cc($address, $name = null);
                $message->bcc($address, $name = null);
                $message->replyTo($address, $name = null);
                $message->subject($subject);
                $message->priority($level);
                $message->attach($pathToFile, array $options = []);

                // Attach a file from a raw $data string...
                $message->attachData($data, $name, array $options = []);

                // Get the underlying SwiftMailer message instance...
                $message->getSwiftMessage();
            */

        }catch(\Exception $e){
            return response()->json(["status"=>500, "errors"=>$e->getMessage(), "message"=>"error"])->setStatusCode(500);
        }
    }

    public static function log_activity($model, $user, $properties, $log_message){
                activity()
                ->performedOn($model)
                ->causedBy($user)
                ->withProperties($properties)
                ->log($log_message);
    }
}



