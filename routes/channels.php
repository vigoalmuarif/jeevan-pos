<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('invitations.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});
