<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notification(){
        return view('dashboardPages.notification.notification');
    }
}
