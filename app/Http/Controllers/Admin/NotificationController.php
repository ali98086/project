<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function readAll(){

        $user= User::find(1);
        $user->unreadNotifications->markAsRead(); //or foreach
    }
}
