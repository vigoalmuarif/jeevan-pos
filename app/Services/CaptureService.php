<?php
namespace App\Services;

use App\Models\EInvitation;
use App\Models\EventItem;
use App\Models\Invitation;
use Barryvdh\Snappy\Facades\SnappyImage;
// use Barryvdh\Snappy\Facades\SnappyImage;
use Twilio\Rest\Client;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;

class CaptureService
{
    protected $client;
    protected $from;


    public function captureImage(string $view = null, $path, $selector = '' )
    {
       try {

            Browsershot::html($view)
            ->noSandbox()
            // ->hideBackground()
            ->setOption('args', ['--disable-web-security'])
            ->select($selector)
            ->save($path);

        return response()->json([
            'status' => true,
            'message' => 'Halaman berhasil dicapture',
        ], 200);

    } catch (\Throwable $e) {
           return response()->json([
               'status' => false,
               'message' => 'Halaman gagal dicapture',
               'error' => $e->getMessage()
           ], 500);
       }
    }
}
