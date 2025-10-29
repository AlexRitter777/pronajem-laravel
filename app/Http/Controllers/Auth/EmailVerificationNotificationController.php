<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        try{
            $request->user()->sendEmailVerificationNotification();
        }catch (\Throwable $e){
            Log::error('Verification email send failed: ' . $e->getMessage());
            return back()->with('error', __('Something went wrong. Please try again later.'));
        }

        return back()->with('status', __('auth.verification-link-sent'));
    }
}
