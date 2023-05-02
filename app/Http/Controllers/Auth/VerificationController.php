<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller
{
    /**
     * Verification user email after registration
     * @param EmailVerificationRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/home');
    }

    public function notice()
    {
//        return view();
    }
}
