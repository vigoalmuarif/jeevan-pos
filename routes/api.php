<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('v1.')->group(function(){
    Route::prefix('products/{warehouse_id}/{business_id}/')->name('products.')->group(function(){
        Route::get('/', [ProductController::class, 'index'])->name('index');
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::post('invitation-whatsapp-status-update', [WebhookController::class, 'invitationWhatsappStatusUpdate'])
// ->name('invitation_whatsapp_status_update')->withoutmiddleware('twilio-request-valid');