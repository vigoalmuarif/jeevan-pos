<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\EinvitationController;
use App\Livewire\Admin\Dashboard\Dashbaord;
use App\Livewire\User\Setting\EInvitation\OutputEInvitation;
use Illuminate\Support\Facades\Route;






Route::middleware('auth')->group(function () {
});

require __DIR__.'/auth.php';
