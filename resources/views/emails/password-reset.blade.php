<x-mail::message>
# {{ __('Hello, :name!', ['name' => $user->name]) }}

{{ __('This is a confirmation that your password has been successfully reset.') }}

{{ __('You can now log in to your account using your new password.') }}

<x-mail::button :url="$loginUrl">
    {{ __('Go to Login') }}
</x-mail::button>

---

### {{ __('Didn’t request this change?') }}

{{ __('If you did not request a password reset, please secure your account immediately by resetting your password again or contacting our support team.') }}

<x-mail::button :url="$resetUrl">
    {{ __('Reset Password Again') }}
</x-mail::button>

---

{{ __('Stay safe,') }}
**{{ config('app.name') }}**
</x-mail::message>
