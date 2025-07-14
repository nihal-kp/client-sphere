<?php

use App\Models\User;
use App\Enums\UserType;
use App\Enums\UserStatus;

if (!function_exists('getClients')) {
    function getClients()
    {
        return User::where('type', UserType::CLIENT->value)->where('status', UserStatus::ACTIVE->value)->orderBy('id', 'DESC')->pluck('name', 'id');
    }
}