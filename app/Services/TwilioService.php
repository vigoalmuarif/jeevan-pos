<?php
namespace App\Services;

use App\Models\Invitation;
use Twilio\Rest\Client;
use Exception;

class TwilioService
{
    protected $client;
    protected $from;

    public function __construct()
    {
        $this->client = new Client(config('services.twilio.sid'), config('services.twilio.token'));
        $this->from = config('services.twilio.from');
    }

    public function sendWhatsApp($user, $message, $imageUrl = null)
    {
        try {
            $sendData = [
                'from' => $this->from,
                'body' => $message,
                'statusCallback' => route('invitation_whatsapp_status_update'),
            ];

            
            if (!empty($imageUrl)) {
                $sendData['mediaUrl'] = asset($imageUrl);
            }
            // dd($sendData);

           $send =  $this->client->messages->create(
                "whatsapp:".formatPhoneNumber($user->whatsapp),
            $sendData
            );
            
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'WhatsApp berhasil dikirim.',
                'data' => [
                    'sid' => $send->sid,
                    'to' => $send->to,
                    'status' => $send->status,
                ]
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => 'WhatsApp gagal dikirim.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
