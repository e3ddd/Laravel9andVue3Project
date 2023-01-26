<?php

namespace App\Http\Controllers;


use App\Mail\RegisterMail;

use App\Models\User;
use App\Notifications\RegisterNotification;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class Test extends Controller
{

    public function index(EmailVerificationRequest $request)
    {
        return $request;
    }

}
